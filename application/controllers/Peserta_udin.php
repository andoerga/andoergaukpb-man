<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Peserta_udin extends CI_Controller {

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
	 
	protected $module = 'peserta_udin';
	protected $type = 'ujian_dinas';
	protected $user;
	protected $tipe_registrasi_id = '11';
	
	public function __construct(){
		parent::__construct();
		
		$user = $this->session->userdata('user');
		if(!$user){
			redirect(site_url('login'));
		}
		
		$this->user = $user;
		$modules = $this->module_model->get_active();
		$mapping_modules = array();
		foreach($modules as $m){
			$mapping_modules[$m->parent_id][] = $m;
		}
		$this->modules = $mapping_modules;
		
		
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
		$instansi_available = $this->instansi_model->get_available_id($this->user->instansi_id);
		if($this->user->user_group_id != 1){
			$output['data'] = $this->peserta_model->get_all_2025(false, $instansi_available, $this->user->id);
		}else{
			$output['data'] = $this->peserta_model->get_all_2025(false, $instansi_available);
		}
		/*
		if($this->user->user_group_id == '1' || $this->user->user_group_id == '19'){
			$output['data'] = $this->peserta_model->get_all_2025();
		}else{
			$filter = array(
				'instansi_id' => $this->user->instansi_id
			);
			$output['data'] = $this->peserta_model->get_all_2025(false, $this->user->instansi_id);
		}
		*/
		$output['user_group'] = $this->user_group_model->get_all(true);
		$output['instansi'] = $this->instansi_model->get_all(true);
		$this->load->view('layout/layout', $output);
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
		$output['module'] = $this->module;
		$output['module_object'] = $this->module_object;
		$output['crud'] = $this->crud;
		$output['instansi'] = $this->instansi_model->get_available($this->user->instansi_id);
		/*
		if($this->user->user_group_id == '1' || $this->user->user_group_id == '19'){
			$output['instansi'] = $this->instansi_model->get_all(true);
		}else{
			//$output['instansi'] = array($this->instansi_model->get_row($this->user->instansi_id));
			$output['instansi'] = $this->instansi_model->get_available($this->user->instansi_id);
		}
		*/
		
		$output['golongan'] = $this->golongan_model->get_all(true);
		$output['jenis'] = $this->tingkat_model->get_all(true, $this->type);
		$output['inputan'] = $this->input->post();
		$output['page'] = 'add';
		if($this->input->post('form-submit')){
			
			$this->form_validation->set_message('required', 'Harap diisi');
			$this->form_validation->set_message('unique', 'Inputan sudah dipakai, harap gunakan kata lain');
			$this->form_validation->set_message('numeric', 'Hanya bisa diisi oleh angka');
			$this->form_validation->set_error_delimiters('<div class="error col-xs-12 col-sm-12 col-md-4"><label>', '</label></div>');
			
			$this->form_validation->set_rules('instansi_id', 'Instansi', 'required|integer');
			$this->form_validation->set_rules('golongan_id', 'Golongan', 'required|integer');
			$this->form_validation->set_rules('tingkat_id', 'Jenis', 'required|integer');
			$this->form_validation->set_rules('nama', 'Nama Pengguna', 'max_length[150]');
			$this->form_validation->set_rules('username', 'Username', 'required|is_unique[peserta.username]');
			$this->form_validation->set_rules('nip', 'NIP', 'required|max_length[100]|is_unique[peserta.nip]');
			$this->form_validation->set_rules('handphone', 'Nomor Handphone', 'required|numeric');
			$this->form_validation->set_rules('tmt_golongan', 'TMT Golongan', 'required|date');
			$this->form_validation->set_rules('password', 'Password', 'required|max_length[50]|matches[retype-password]');
			$this->form_validation->set_rules('retype-password', 'Ulangi Password', 'required|max_length[50]');
			
			if ($this->form_validation->run() != FALSE)
			{
				$data['instansi_id'] = $this->input->post('instansi_id');
				$data['golongan_id'] = $this->input->post('golongan_id');
				$data['tingkat_id'] = $this->input->post('tingkat_id');
				$data['nama'] = $this->input->post('nama');
				$data['username'] = $this->input->post('username');
				$data['password'] = pass_peserta_encode($this->input->post('password'));
				$data['nip'] = $this->input->post('nip');
				$data['handphone'] = $this->input->post('handphone');
				$data['tmt_golongan'] = date('Y-m-d', strtotime($this->input->post('tmt_golongan')));
				$data['tipe_registrasi_id'] = $this->tipe_registrasi_id;
				$insert_id = $this->peserta_model->add($data);
				if($insert_id){
					redirect(site_url($this->module.'/detail/'.$insert_id));
				}else{
					redirect(site_url($this->module.'/add'));
				}
			}
		}
		$this->load->view('layout/layout', $output);
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
		$output['module'] = $this->module;
		$output['module_object'] = $this->module_object;
		$output['crud'] = $this->crud;
		$output['page'] = 'edit';
		if(empty($id)){
			show_404();
		}
		$output['data'] = $this->peserta_model->get_row($id);
		if(!is_object($output['data'])){
			show_404();
		}
		$output['instansi'] = $this->instansi_model->get_available($this->user->instansi_id);
		/*
		if($this->user->user_group_id == '1' || $this->user->user_group_id == '19'){
			$output['instansi'] = $this->instansi_model->get_all(true);
		}else{
			$output['instansi'] = array($this->instansi_model->get_row($this->user->instansi_id));
		}
		*/
		$output['golongan'] = $this->golongan_model->get_all(true);
		$output['jenis'] = $this->tingkat_model->get_all(true, $this->type);
		$output['inputan'] = $this->input->post();
		if($this->input->post('form-submit')){
			$this->form_validation->set_message('required', 'Harap diisi');
			$this->form_validation->set_message('unique', 'Inputan sudah dipakai, harap gunakan kata lain');
			$this->form_validation->set_message('numeric', 'Hanya bisa diisi oleh angka');
			$this->form_validation->set_error_delimiters('<div class="error col-xs-12 col-sm-12 col-md-4"><label>', '</label></div>');
			
			$this->form_validation->set_rules('instansi_id', 'Instansi', 'required|integer');
			$this->form_validation->set_rules('golongan_id', 'Golongan', 'required|integer');
			$this->form_validation->set_rules('tmt_golongan', 'TMT Golongan', 'required|date');
			$this->form_validation->set_rules('tingkat_id', 'Jenis', 'required|integer');
			$this->form_validation->set_rules('nama', 'Nama Pengguna', 'max_length[150]');
			$this->form_validation->set_rules('handphone', 'Nomor Handphone', 'required|numeric');
			$this->form_validation->set_rules('status_approval', 'Status', 'required|numeric');
			
			if($output['data']->username != $this->input->post('username')){
				$this->form_validation->set_rules('username', 'Username', 'required|max_length[100]|is_unique[peserta.username]');
			}else{
				$this->form_validation->set_rules('username', 'Username', 'required|max_length[100]');
			}
			if($output['data']->nip != $this->input->post('nip')){
				$this->form_validation->set_rules('nip', 'NIP', 'required|max_length[100]|is_unique[peserta.nip]');
			}else{
				$this->form_validation->set_rules('nip', 'NIP', 'required|max_length[100]');
			}
			if ($this->form_validation->run() != FALSE){
				$data['handphone'] = $this->input->post('handphone');
				$data['instansi_id'] = $this->input->post('instansi_id');
				$data['golongan_id'] = $this->input->post('golongan_id');
				$data['tingkat_id'] = $this->input->post('tingkat_id');
				$data['nama'] = $this->input->post('nama');
				$data['username'] = $this->input->post('username');
				$data['nip'] = $this->input->post('nip');
				$data['tmt_golongan'] = date('Y-m-d', strtotime($this->input->post('tmt_golongan')));
				$data['tipe_registrasi_id'] = $this->tipe_registrasi_id;
				if(in_array($data['tingkat_id'], array('11','12', '13'))){
					$data['tipe_jabfung'] = 'pamong_belajar';
				}
				if(in_array($data['tingkat_id'], array('21','22', '23'))){
					$data['tipe_jabfung'] = 'penilik';
				}
				if($this->input->post('status_approval') == '1'){
					$data['status_approval'] = 'approved';
				}else if($this->input->post('status_approval') == '2'){
					$data['status_approval'] = 'rejected';
				}else{
					$data['status_approval'] = 'unset';
				}
				//$data['status_approval'] = $this->input->post('status_approval') == '1' ? 'approved' : 'rejected';
				$insert_id = $this->peserta_model->edit($id, $data);
				if($insert_id){
					redirect(site_url($this->module.'/detail/'.$insert_id));
				}else{
					redirect(site_url($this->module.'/edit'));
				}
			}
		}
		
		$this->load->view('layout/layout', $output);
	}
	
	public function edit_password($id = false)
	{
		$this->load->library('Mytools');
		if(!$this->edit_priv){
			show_404();
		}
		$output['add_priv'] = $this->add_priv;
		$output['edit_priv'] = $this->edit_priv;
		$output['delete_priv'] = $this->delete_priv;
		$output['modules'] = $this->modules;
		$output['module'] = $this->module;
		$output['module_object'] = $this->module_object;
		$output['crud'] = $this->crud;
		$output['page'] = 'edit_password';
		if(empty($id)){
			show_404();
		}
		$output['data'] = $this->peserta_model->get_row($id);
		if(!is_object($output['data'])){
			show_404();
		}
		$output['inputan'] = $this->input->post();
		if($this->input->post('form-submit')){
			$this->form_validation->set_message('required', 'Harap diisi');
			$this->form_validation->set_message('unique', 'Inputan sudah dipakai, harap gunakan kata lain');
			$this->form_validation->set_error_delimiters('<div class="error col-xs-12 col-sm-12 col-md-4"><label>', '</label></div>');
			
			$this->form_validation->set_rules('password', 'Password', 'required|max_length[50]|matches[retype-password]');
			$this->form_validation->set_rules('retype-password', 'Ulangi Password', 'required|max_length[50]');
			if ($this->form_validation->run() == FALSE)
			{
				$this->load->view('layout/layout', $output);
			}
			else
			{
				$data['password'] = pass_peserta_encode($this->input->post('password'));
				//$data['password'] = $this->mytools->encrypt_password($this->input->post('password'));
				$insert_id = $this->peserta_model->edit($id, $data);
				if($insert_id){
					redirect(site_url($this->module.'/detail/'.$insert_id));
				}else{
					redirect(site_url($this->module.'/edit_password'));
				}
			}
		}
		
		$this->load->view('layout/layout', $output);
	}
	
	public function njajal_password(){
			echo pass_peserta_encode('123456');
	}
	
	public function detail($id = false)
	{
		$output['add_priv'] = $this->add_priv;
		$output['edit_priv'] = $this->edit_priv;
		$output['delete_priv'] = $this->delete_priv;
		$output['modules'] = $this->modules;
		$output['module'] = $this->module;
		$output['module_object'] = $this->module_object;
		$output['crud'] = $this->crud;
		$output['page'] = 'detail';
		if(empty($id)){
			show_404();
		}
		$output['data'] = $this->peserta_model->get_row($id);
		if(!is_object($output['data'])){
			show_404();
		}
		$output['customjs'] = array('jquery.ui.widget.js', 'jquery.iframe-transport.js', 'jquery.fileupload.js', 'upload_kegiatan.js');
		$this->load->view('layout/layout', $output);
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
		$output['data'] = $this->peserta_model->get_row($id);
		$output['instansi'] = $this->instansi_model->get_row($output['data']->instansi_id);
		if(!is_object($output['data'])){
			show_404();
		}
		
		if($this->input->post('form-submit')){
			$this->peserta_model->delete($id);
			$output['page'] = 'delete_success';
		}else{
			$output['module'] = $this->module;
			$output['page'] = 'delete';
		}
		
		$this->load->view('layout/layout', $output);
	}
	
	public function upload($id = false)
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
		if(empty($id)){
			show_404();
		}
		$output['data'] = $this->peserta_model->get_row($id);
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
		if(!$this->edit_priv){
			show_404();
		}
		if(!$type || !$id){
			die();
		}
		
		$output['data'] = $this->peserta_model->get_row($id);
		if(!is_object($output['data'])){
			die();
		}
		
		$type_array = array('pak', 'sk_pengangkatan', 'sk_terakhir', 'pengantar');
		if(!in_array($type, $type_array)){
			die();
		}
		
		$year = date('Y');
		$month = date('m');
		$date = date('d');
		
		$allowed = array('doc','docx','pdf');

		if(isset($_FILES['upl']) && $_FILES['upl']['error'] == 0){

			$extension = pathinfo($_FILES['upl']['name'], PATHINFO_EXTENSION);
			$baseUploadPath = "/var/www/html/assets/docs/";
			
			if(!is_dir($baseUploadPath.$year)){
				mkdir($baseUploadPath.$year);
			}
			if(!is_dir($baseUploadPath.$year.'/'.$month)){
				mkdir($baseUploadPath.$year.'/'.$month);
			}
			if(!is_dir($baseUploadPath.$year.'/'.$month.'/'.$date)){
				mkdir($baseUploadPath.$year.'/'.$month.'/'.$date);
			}

			if(!in_array(strtolower($extension), $allowed)){
				echo '{"status":"error"}';
				exit;
			}
			$time = time();
			$filename = $id .$time. '_' . $type . '.' . $extension;
			$fileLoc = '../assets/docs/'.$year.'/'.$month.'/'.$date.'/'.$filename;
			$path = $baseUploadPath.$year.'/'.$month.'/'.$date.'/'.$filename;
			$removeLink = site_url($this->module.'/remove_document/'.$type.'/'.$id);
			if(move_uploaded_file($_FILES['upl']['tmp_name'], $path)){
				
				$data['doc_' . $type] = $fileLoc;
				$insert_id = $this->peserta_model->edit($id, $data);
				
				echo '{"status":"success", "path":"'.$fileLoc.'", "removeLink":"'.$removeLink.'","type":"'.$type.'"}';
				exit;
			}
			
			
			
		}

		echo '{"status":"error"}';
		exit;
	}
	
	public function remove_document($type = false, $id = false){
		if(!$this->edit_priv){
			show_404();
		}
		if(!$type || !$id){
			die();
		}
		
		$output['data'] = $this->peserta_model->get_row($id);
		if(!is_object($output['data'])){
			die();
		}
		
		$type_array = array('pak', 'sk_pengangkatan', 'sk_terakhir', 'pengantar');
		$fields = array(
			'pak' => 'doc_pak',
			'sk_pengangkatan' => 'doc_sk_pengangkatan',
			'sk_terakhir' => 'doc_sk_terakhir',
			'pengantar' => 'doc_pengantar',
		);
		if(!in_array($type, $type_array)){
			die();
		}
		
		$data[$fields[$type]] = null;
		$insert_id = $this->peserta_model->edit($id, $data);
		if($insert_id){
			echo '{"status":"success"}';
				exit;
		}else{
			echo '{"status":"error"}';
			exit;
		}
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */