<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Peserta_pamong_budaya extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	 
	private $module = 'peserta_pamong_budaya';
	private $tipe_jabfung = 'pamong_budaya';
	
	public function __construct(){
		parent::__construct();
		
		$user = $this->session->userdata('user');
		$this->user = $user;
		if(!$user){
			redirect(site_url('login'));
		}
		
		$modules = $this->module_model->get_active();
		$mapping_modules = array();
		foreach($modules as $m){
			$mapping_modules[$m->parent_id][] = $m;
		}
		$this->modules = $mapping_modules;
		
		$special_usergroup_id = $this->config->item('special_usergroup_id');
		$this->special_user = false;
		if(in_array($user->user_group_id, $special_usergroup_id)){
			$this->special_user = true;
		}
		
		$crud = $this->crud_model->get_by_user_group($user->user_group_id);
		
		$mapping_crud = array();
		foreach($crud as $c){
			$mapping_crud[$c->initial] = $c;
		}
		$this->crud = $mapping_crud;
		
		if(!isset($mapping_crud[$this->module])){
			show_404();
		}
		$this->add_priv = $mapping_crud[$this->module]->add_priv;
		$this->edit_priv = $mapping_crud[$this->module]->edit_priv;
		$this->delete_priv = $mapping_crud[$this->module]->delete_priv;
		
		$this->module_object = $this->module_model->get_by_initial($this->module);
	}
	
	public function index()
	{
		$output['add_priv'] = $this->add_priv;
		$output['edit_priv'] = $this->edit_priv;
		$output['delete_priv'] = $this->delete_priv;
		$output['modules'] = $this->modules;
		$output['crud'] = $this->crud;
		$output['module'] = $this->module;
		$output['module_object'] = $this->module_object;
		$output['page'] = 'list';
		$output['customjs'] = array('peserta_ptp.js');
		//$output['data'] = $this->kegiatan_model->get_all();
		$this->load->view('layout/layout', $output);
	}
	
	public function ajax(){
		$draw = $this->input->get('draw');
		$columns = $this->input->get('columns');
		$order = $this->input->get('order');
		$start = $this->input->get('start');
		$length = $this->input->get('length');
		
		$filter = array();
		$fields = array();
		foreach($columns as $column){
			$fields[$column['data']] = $column['name'];
			if($column['search']['value']){
				$filter[] = array(
					'name' => $column['name'],
					'value' => $column['search']['value']
				);
			}
		}
		
		$filter[] = array(
			'name' => 'status_approval',
			'value' => 'approved'
		);
		$filter[] = array(
			'name' => 'tipe_jabfung',
			'value' => $this->tipe_jabfung
		);
		$filter[] = array(
			'name' => 'registered',
			'value' => '1'
		);
		
		$order_column = $fields[$order[0]['column']];
		$order_method = $order[0]['dir'];
		
		$data = $this->peserta_model->get_filter($filter, $length, $start, $order_column, $order_method);
		$recordsTotal = $this->peserta_model->count_all();
		$recordsFiltered = $this->peserta_model->count_filter($filter);
		
		$data_output = array();
		foreach($data as $d){
			$temp = array();
			foreach($fields as $field){
				if(!empty($field)){
					$temp[] = $d->{$field};
				}
			}
			$data_output[] = $temp;
		}
		
		header('Cache-Control: no-cache, must-revalidate');
		header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
		header('Content-type: application/json');
		echo json_encode(array(
			'draw' => $draw,
			'recordsTotal' => $recordsTotal,
			'recordsFiltered' => $recordsFiltered,
			'data' => $data_output
		));
	}
	
	public function add()
	{
		if(!$this->add_priv){
			show_404();
		}
		$output['add_priv'] = $this->add_priv;
		$output['edit_priv'] = $this->edit_priv;
		$output['delete_priv'] = $this->delete_priv;
		$output['modules'] = $this->modules;
		$output['module_object'] = $this->module_object;
		$output['crud'] = $this->crud;
		$output['user'] = $this->user_model->get_all();
		if($this->input->post('form-submit')){
			$this->form_validation->set_message('required', 'Harap diisi');
			$this->form_validation->set_message('unique', 'Inputan sudah dipakai, harap gunakan kata lain');
			$this->form_validation->set_error_delimiters('<div class="error col-xs-12 col-sm-12 col-md-4"><label>', '</label></div>');
			
			$this->form_validation->set_rules('name', 'Nama', 'required|max_length[255]');
			$this->form_validation->set_rules('user_id', 'PIC', 'required');
			$this->form_validation->set_rules('location', 'Lokasi', 'max_length[255]');
			$this->form_validation->set_rules('tahun_anggaran', 'Tahun Anggaran', 'required|numeric');
			
			if ($this->form_validation->run() == FALSE)
			{
				$output['module'] = $this->module;
				$output['page'] = 'add';
				$this->load->view('layout/layout', $output);
			}
			else
			{
				$data['name'] = $this->input->post('name');
				$data['status'] = $this->input->post('status');
				$data['location'] = $this->input->post('location');
				$data['user_id'] = $this->input->post('user_id');
				$data['tahun_anggaran'] = $this->input->post('tahun_anggaran');
				$data['start_date'] = $this->input->post('start_date') ? date('Y-m-d', strtotime($this->input->post('start_date'))) : null;
				$data['end_date'] = $this->input->post('end_date') ? date('Y-m-d', strtotime($this->input->post('end_date'))) : null;
				$insert_id = $this->kegiatan_model->add($data);
				if($insert_id){
					redirect(site_url($this->module . '/detail/'.$insert_id));
				}else{
					redirect(site_url($this->module . '/add'));
				}
			}
		}
		$output['module'] = $this->module;
		$output['page'] = 'add';
		$this->load->view('layout/layout', $output);
	}
	
	public function process($type, $id = false)
	{
		header('Cache-Control: no-cache, must-revalidate');
		header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
		header('Content-type: application/json');
		
		if(!$this->edit_priv){
			echo json_encode(array(
				'success' => false,
				'message' => 'Sorry, you have no access'
			));
			die();
		}
		
		if($type != 'accept' && $type != 'reject' && $type != 'cancel'){
			echo json_encode(array(
				'success' => false,
				'message' => 'Process unknown'
			));
			die();
		}
		
		if(!$id){
			echo json_encode(array(
				'success' => false,
				'message' => 'missing id'
			));
			die();
		}
		
		$pendaftar = $this->peserta_model->get_row($id);
		if(!$pendaftar){
			echo json_encode(array(
				'success' => false,
				'message' => 'data not found'
			));
			die();
		}
		if($pendaftar->registered = 0){
			echo json_encode(array(
				'success' => false,
				'message' => 'data cannot be processed'
			));
			die();
		}
		if($pendaftar->tipe_jabfung != $this->tipe_jabfung){
			echo json_encode(array(
				'success' => false,
				'message' => 'data cannot be processed cause is not yours'
			));
			die();
		}
		/*
		if($pendaftar->status_approval != 'unset'){
			echo json_encode(array(
				'success' => false,
				'message' => 'data cannot be processed cause this object already processed'
			));
			die();
		}
		*/
		/*
		$status_inpassing_id = $this->input->post('status_inpassing_id');
		if(!$status_inpassing_id){
			echo json_encode(array(
				'success' => false,
				'message' => 'missing status_inpassing_id'
			));
			die();
		}
		$data['status_inpassing_id'] = $status_inpassing_id;
		*/
		if($type == 'reject'){
			$data['status_approval'] = 'rejected';
		}if($type == 'cancel'){
			$data['status_approval'] = 'unset';
		}else{
			$data['status_approval'] = 'approved';
		}
		$insert_id = $this->peserta_model->edit($id, $data);
		if($insert_id){
			echo json_encode(array(
				'success' => true,
				'message' => 'succeed'
			));
			die();
		}else{
			echo json_encode(array(
				'success' => false,
				'message' => 'process fail'
			));
			die();
		}
	}
	
	public function edit($id = false)
	{
		if(!$this->edit_priv){
			show_404();
		}
		$output['add_priv'] = $this->add_priv;
		$output['edit_priv'] = $this->edit_priv;
		$output['delete_priv'] = $this->delete_priv;
		$output['modules'] = $this->modules;
		$output['module_object'] = $this->module_object;
		$output['crud'] = $this->crud;
		$output['user'] = $this->user_model->get_all();
		if(empty($id)){
			show_404();
		}
		$output['data'] = $this->kegiatan_model->get_row($id);
		if(!is_object($output['data'])){
			show_404();
		}
		
		if($this->input->post('form-submit')){
			$this->form_validation->set_message('required', 'Harap diisi');
			$this->form_validation->set_message('unique', 'Inputan sudah dipakai, harap gunakan kata lain');
			$this->form_validation->set_error_delimiters('<div class="error col-xs-12 col-sm-12 col-md-4"><label>', '</label></div>');
			
			$this->form_validation->set_rules('name', 'Nama', 'required|max_length[255]');
			$this->form_validation->set_rules('user_id', 'PIC', 'required');
			$this->form_validation->set_rules('location', 'Lokasi', 'max_length[255]');
			$this->form_validation->set_rules('tahun_anggaran', 'Tahun Anggaran', 'required|numeric');
			
			if ($this->form_validation->run() == FALSE)
			{
				$output['module'] = $this->module;
				$output['page'] = 'edit';
				$this->load->view('layout/layout', $output);
			}
			else
			{
				$data['name'] = $this->input->post('name');
				$data['status'] = $this->input->post('status');
				$data['user_id'] = $this->input->post('user_id');
				$data['location'] = $this->input->post('location');
				$data['tahun_anggaran'] = $this->input->post('tahun_anggaran');
				$data['start_date'] = $this->input->post('start_date') ? date('Y-m-d', strtotime($this->input->post('start_date'))) : null;
				$data['end_date'] = $this->input->post('end_date') ? date('Y-m-d', strtotime($this->input->post('end_date'))) : null;
				$insert_id = $this->kegiatan_model->edit($id, $data);
				if($insert_id){
					redirect(site_url($this->module . '/detail/'.$insert_id));
				}else{
					redirect(site_url($this->module . '/edit/'.$id));
				}
			}
		}
		
		$output['module'] = $this->module;
		$output['page'] = 'edit';
		$this->load->view('layout/layout', $output);
	}
	
	public function detail($id = false)
	{
		$output['add_priv'] = $this->add_priv;
		$output['edit_priv'] = $this->edit_priv;
		$output['delete_priv'] = $this->delete_priv;
		$output['modules'] = $this->modules;
		$output['module_object'] = $this->module_object;
		$output['crud'] = $this->crud;
		if(empty($id)){
			show_404();
		}
		$output['data'] = $this->kegiatan_model->get_row($id);
		if(!is_object($output['data'])){
			show_404();
		}
		$output['module'] = $this->module;
		$output['page'] = 'detail';
		$this->load->view('layout/layout', $output);
	}
	
	public function detail_ajax($id = false)
	{
		$output['add_priv'] = $this->add_priv;
		$output['edit_priv'] = $this->edit_priv;
		$output['delete_priv'] = $this->delete_priv;
		$output['modules'] = $this->modules;
		$output['module_object'] = $this->module_object;
		$output['crud'] = $this->crud;
		if(empty($id)){
			show_404();
		}
		$output['data'] = $this->peserta_model->get_row($id);
		$output['status_inpassing'] = $this->status_inpassing_model->get_all($id);
		if(!is_object($output['data'])){
			show_404();
		}
		$output['module'] = $this->module;
		$output['provinsi'] = $this->provinsi_model->get_row($output['data']->propinsi_rumah);
		$output['kotkab'] = $this->kotkab_model->get_row($output['data']->kota_rumah);
		$output['provinsi_instansi'] = $this->provinsi_model->get_row($output['data']->propinsi_kantor);
		$output['kotkab_instansi'] = $this->kotkab_model->get_row($output['data']->kota_kantor);
		$output['page'] = 'detail_ajax';
		$this->load->view('pages/'.$this->module.'/'.$output['page'], $output);
	}
	
	public function upload($id = false)
	{
		$output['add_priv'] = $this->add_priv;
		$output['edit_priv'] = $this->edit_priv;
		$output['delete_priv'] = $this->delete_priv;
		$output['modules'] = $this->modules;
		$output['module_object'] = $this->module_object;
		$output['crud'] = $this->crud;
		if(empty($id)){
			show_404();
		}
		$output['data'] = $this->kegiatan_model->get_row($id);
		if(!is_object($output['data'])){
			show_404();
		}
		$output['module'] = $this->module;
		$output['page'] = 'upload';
		$output['customjs'] = array('jquery.ui.widget.js', 'jquery.iframe-transport.js', 'jquery.fileupload.js', 'upload_kegiatan.js');
		$this->load->view('layout/layout', $output);
	}
	
	public function upload_process($type = false, $id = false)
	{
		if(!$type || !$id){
			die();
		}
		
		$output['data'] = $this->kegiatan_model->get_row($id);
		if(!is_object($output['data'])){
			die();
		}
		
		$type_array = array('design', 'surat_tugas', 'laporan', 'biodata', 'hasil');
		if(!in_array($type, $type_array)){
			die();
		}
		
		$year = date('Y');
		$month = date('m');
		$date = date('d');
		
		$allowed = array('png', 'jpg', 'gif','zip','doc','docx','xls','xlsx','rar','pdf');

		if(isset($_FILES['upl']) && $_FILES['upl']['error'] == 0){

			$extension = pathinfo($_FILES['upl']['name'], PATHINFO_EXTENSION);
			
			if(!is_dir('uploads/'.$year)){
				mkdir('uploads/'.$year);
			}
			if(!is_dir('uploads/'.$year.'/'.$month)){
				mkdir('uploads/'.$year.'/'.$month);
			}
			if(!is_dir('uploads/'.$year.'/'.$month.'/'.$date)){
				mkdir('uploads/'.$year.'/'.$month.'/'.$date);
			}

			if(!in_array(strtolower($extension), $allowed)){
				echo '{"status":"error"}';
				exit;
			}
			
			$filename = $id . '_' . $type . '.' . $extension;
			$path = 'uploads/'.$year.'/'.$month.'/'.$date.'/'.$filename;
			
			if(move_uploaded_file($_FILES['upl']['tmp_name'], $path)){
				
				$data['doc_' . $type] = $path;
				$insert_id = $this->kegiatan_model->edit($id, $data);
				
				echo '{"status":"success", "path":"'.$path.'"}';
				exit;
			}
			
			
			
		}

		echo '{"status":"error"}';
		exit;
	}
	
	public function delete($id = false)
	{
		if(!$this->delete_priv){
			show_404();
		}
		$output['add_priv'] = $this->add_priv;
		$output['edit_priv'] = $this->edit_priv;
		$output['delete_priv'] = $this->delete_priv;
		$output['modules'] = $this->modules;
		$output['module'] = $this->module;
		$output['module_object'] = $this->module_object;
		$output['crud'] = $this->crud;
		if(empty($id)){
			show_404();
		}
		$output['data'] = $this->kegiatan_model->get_row($id);
		if(!is_object($output['data'])){
			show_404();
		}
		
		if($this->input->post('form-submit')){
			$this->kegiatan_model->delete($id);
			$output['page'] = 'delete_success';
		}else{
			$output['page'] = 'delete';
		}
		
		$this->load->view('layout/layout', $output);
	}
	
	public function peserta($id = false)
	{
		$output['add_priv'] = $this->add_priv;
		$output['edit_priv'] = $this->edit_priv;
		$output['delete_priv'] = $this->delete_priv;
		$output['modules'] = $this->modules;
		$output['module_object'] = $this->module_object;
		$output['crud'] = $this->crud;
		if(empty($id)){
			show_404();
		}
		$output['data'] = $this->kegiatan_model->get_row($id);
		if(!is_object($output['data'])){
			show_404();
		}
		$output['module'] = $this->module;
		$jenis_peserta = $this->jenis_peserta_model->get_all();
		$output['jenis_peserta'] = '';
		foreach($jenis_peserta as $j){
			$output['jenis_peserta'] .= '<option value="' . $j->id . '">'.$j->name.'</option>';
		}
		$user = $this->user_model->get_all();
		$userMap = array();
		$userMap2 = array();
		foreach($user as $u){
			$userMap[] = array('label' => $u->name, 'id' => $u->id);
			$userMap2[$u->id] = $u;
		}
		$output['peserta'] = $this->peserta_kegiatan_model->get_by_kegiatan($id);
		$output['user'] = $userMap;
		$output['userMap'] = $userMap2;
		$output['page'] = 'peserta';
		$output['customjs'] = array('peserta.js');
		$this->load->view('layout/layout', $output);
	}
	
	public function peserta_process($id = false)
	{
		if(!$this->edit_priv){
			show_json_error('No edit privilege', '403');
		}
		if(empty($id)){
			show_json_error('Missing param id', '404');
		}
		$output['data'] = $this->kegiatan_model->get_row($id);
		if(!is_object($output['data'])){
			show_json_error('Content not found', '404');
		}
		$peserta_id = $this->input->post('peserta_id');
		if(!$peserta_id){
			show_json_error('Missing param peserta_id', '404');
		}
		$jenis_peserta_id = $this->input->post('jenis_peserta_id');
		if(!$jenis_peserta_id){
			show_json_error('Missing param jenis_peserta_id', '404');
		}
		
		$return = $this->peserta_kegiatan_model->insert_if_not_exist($id, $peserta_id, $jenis_peserta_id);
		print_json($return);
	}
	
	public function delete_peserta($id, $peserta_id)
	{
		if(!$this->edit_priv){
			show_json_error('No edit privilege', '403');
		}
		if(empty($id)){
			show_json_error('Missing param id', '404');
		}
		$output['data'] = $this->kegiatan_model->get_row($id);
		if(!is_object($output['data'])){
			show_json_error('Content not found', '404');
		}
		$this->peserta_kegiatan_model->delete($id, $peserta_id);
		print_json(array(
			'success' => 'true'
		));
	}
	
	public function edit_peserta()
	{
		$id = $this->input->post('id');
		if(!$id){
			show_json_error('Missing param id', '404');
		}
		$jenis_peserta_id = $this->input->post('value');
		if(!$jenis_peserta_id){
			show_json_error('Missing param value', '404');
		}
		$id_edit = $this->peserta_kegiatan_model->edit($id, array('jenis_peserta_id' => $jenis_peserta_id));
		$data = $this->peserta_kegiatan_model->get_row($id_edit, true);
		if($data){
			show_json($data);
		}else{
			show_json_error('Update error', 'failed');
		}
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */