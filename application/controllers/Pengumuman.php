<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pengumuman extends CI_Controller {

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
	 
	private $module = 'pengumuman';
	
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
		$output['customjs'] = array('kegiatan.js');
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
					'value' => $column['search']['value'],
					'method' => 'like'
				);
			}
		}
		
		if(!$this->special_user){
			$filter[] = array(
				'name' => 'user_id',
				'value' => $this->user->id
			);
		}
		
		$order_column = $fields[$order[0]['column']];
		$order_method = $order[0]['dir'];
		
		$data = $this->pengumuman_model->get_filter($filter, $length, $start, $order_column, $order_method);
		$recordsTotal = $this->pengumuman_model->count_all();
		$recordsFiltered = $this->pengumuman_model->count_filter($filter);
		
		$data_output = array();
		//$masking_field = array('doc_design', 'doc_surat_tugas', 'doc_laporan', 'doc_biodata', 'doc_hasil');
		foreach($data as $d){
			$temp = array();
			foreach($fields as $field){
				if(!empty($field)){
					/*
					if(in_array($field, $masking_field)){
						if($d->$field){
							$temp[] = '<a href="'.$d->{$field}.'" target="_blank"><i class="fa fa-check document-icon"></i></a>';
						}else{
							$temp[] = '<i class="fa fa-close document-icon"></i>';
						}
						
					}else{
						$temp[] = $d->{$field};
					}
					*/
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
		
		$year = date('Y');
		$month = date('m');
		$date = date('d');
		
		$output['add_priv'] = $this->add_priv;
		$output['edit_priv'] = $this->edit_priv;
		$output['delete_priv'] = $this->delete_priv;
		$output['modules'] = $this->modules;
		$output['module_object'] = $this->module_object;
		$output['crud'] = $this->crud;
		if($this->input->post('form-submit')){
			$this->form_validation->set_message('required', 'Harap diisi');
			$this->form_validation->set_message('unique', 'Inputan sudah dipakai, harap gunakan kata lain');
			$this->form_validation->set_error_delimiters('<div class="error col-xs-12 col-sm-12 col-md-4"><label>', '</label></div>');
			
			$this->form_validation->set_rules('title', 'Judul Pengumuman', 'required|max_length[255]');
			
			if ($this->form_validation->run() == FALSE)
			{
				$output['module'] = $this->module;
				$output['page'] = 'add';
				$this->load->view('layout/layout', $output);
			}
			else
			{
				
				$data['title'] = $this->input->post('title');
				$data['creator'] = $this->user->id;
				//$data['tipe_jabfung'] = $this->input->post('tipe_jabfung');
				$data['status'] = $this->input->post('status');
				$data['detail'] = $this->input->post('detail');
				$data['created'] = date('Y-m-d H:i:s');
				$insert_id = $this->pengumuman_model->add($data);
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
	
	public function edit($id = false)
	{
		if(!$this->edit_priv){
			show_404();
		}
		
		$year = date('Y');
		$month = date('m');
		$date = date('d');
		
		$output['add_priv'] = $this->add_priv;
		$output['edit_priv'] = $this->edit_priv;
		$output['delete_priv'] = $this->delete_priv;
		$output['modules'] = $this->modules;
		$output['module_object'] = $this->module_object;
		$output['crud'] = $this->crud;
		$output['special_user'] = $this->special_user;
		
		if(empty($id)){
			show_404();
		}
		$output['data'] = $this->pengumuman_model->get_row($id);
		if(!is_object($output['data'])){
			show_404();
		}
		
		if(!$this->special_user && ($output['data']->user_id != $this->user->id)){
			show_404();
		}
		
		if($this->input->post('form-submit')){
			$this->form_validation->set_message('required', 'Harap diisi');
			$this->form_validation->set_message('unique', 'Inputan sudah dipakai, harap gunakan kata lain');
			$this->form_validation->set_error_delimiters('<div class="error col-xs-12 col-sm-12 col-md-4"><label>', '</label></div>');
			
			$this->form_validation->set_rules('title', 'Judul Pengumuman', 'required|max_length[255]');
			
			if ($this->form_validation->run() == FALSE)
			{
				$output['module'] = $this->module;
				$output['page'] = 'edit';
				$this->load->view('layout/layout', $output);
			}
			else
			{
				
				$data['title'] = $this->input->post('title');
				$data['creator'] = $this->user->id;
				//$data['tipe_jabfung'] = $this->input->post('tipe_jabfung');
				$data['status'] = $this->input->post('status');
				$data['detail'] = $this->input->post('detail');
				$data['created'] = date('Y-m-d H:i:s');
				$insert_id = $this->pengumuman_model->edit($id, $data);
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
		$output['data'] = $this->pengumuman_model->get_row($id);
		if(!is_object($output['data'])){
			show_404();
		}
		if(!$this->special_user && ($output['data']->user_id != $this->user->id)){
			show_404();
		}
		$output['module'] = $this->module;
		$output['page'] = 'detail';
		$this->load->view('layout/layout', $output);
	}
	
	public function export_naskah($id = false)
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
		$output['data'] = $this->pengumuman_model->get_row($id);
		if(!is_object($output['data'])){
			show_404();
		}
		if(!$this->special_user && ($output['data']->user_id != $this->user->id)){
			show_404();
		}
		
		$output['content'] = $output['data']->naskah;
		
		$this->load->view('naskah', $output);
		
	}
	
	public function export_naskah_final($id = false)
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
		$output['data'] = $this->pengumuman_model->get_row($id);
		if(!is_object($output['data'])){
			show_404();
		}
		if($output['data']->status != 'disetujui'){
			show_404();
		}
		if(!$this->special_user && ($output['data']->user_id != $this->user->id)){
			show_404();
		}
		
		$output['content'] = $output['data']->description;
		
		$this->load->view('naskah', $output);
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
		$output['data'] = $this->pengumuman_model->get_row($id);
		if(!is_object($output['data'])){
			show_404();
		}
		if(!$this->special_user && ($output['data']->user_id != $this->user->id)){
			show_404();
		}
		$output['data_component'] = $this->pengumuman_model->get_component($id);
		$output['module'] = $this->module;
		$output['page'] = 'upload';
		$output['customjs'] = array('jquery.ui.widget.js', 'jquery.iframe-transport.js', 'jquery.fileupload.js', 'upload_kegiatan.js');
		$output['special_user'] = $this->special_user;
		$this->load->view('layout/layout', $output);
	}
	
	public function upload_process($type = false, $id = false, $component_id = false)
	{
		if(!$type || !$id){
			die();
		}
		
		$output['data'] = $this->pengumuman_model->get_row($id);
		if(!is_object($output['data'])){
			die();
		}
		
		$year = date('Y');
		$month = date('m');
		$date = date('d');
		
		$allowed = array('png', 'jpg', 'gif', 'avi', 'mkv', 'flv', 'mov', '3gp', 'mp4', 'wmv', 'mpg', 'mpeg', 'mts');
		
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
			
			$filename = $id . '_' . date('YmdHis') . '.' . $extension;
			$path = 'uploads/'.$year.'/'.$month.'/'.$date.'/'.$filename;
			
			if(move_uploaded_file($_FILES['upl']['tmp_name'], $path)){
				
				$data['source'] = $path;
				$data['title'] = $_FILES['upl']['name'];
				$insert_id = $this->pengumuman_model->add_component($id, $data);
				$href = site_url($this->module . '/update_component/' . $insert_id . '/');
				$remove_link = site_url($this->module . '/remove_component/' . $insert_id);
				/*
				if($type = 'new'){
					$insert_id = $this->pengumuman_model->add_component($id, $data);
				}else{
					$insert_id = $this->pengumuman_model->edit_component($component_id, $data);
				}
				*/
				$result = array(
					'status' => 'success',
					'path' => $path,
					'title' => $data['title'],
					'id' => $insert_id,
					'href' => $href,
					'remove_link' => $remove_link
				);
				echo json_encode($result);
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
		$output['data'] = $this->pengumuman_model->get_row($id);
		if(!is_object($output['data'])){
			show_404();
		}
		
		if($this->input->post('form-submit')){
			$this->pengumuman_model->delete($id);
			$output['page'] = 'delete_success';
		}else{
			$output['page'] = 'delete';
		}
		
		$this->load->view('layout/layout', $output);
	}
	
	public function update_component($id = false, $field_name = false){
		header('Cache-Control: no-cache, must-revalidate');
		header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
		header('Content-type: application/json');
		
		if(!$this->edit_priv){
			$response = array('success' => false, 'message' => 'You have no access');
			echo json_encode($response);
			die();
		}
		
		if(empty($id)){
			$response = array('success' => false, 'message' => 'Param id not found');
			echo json_encode($response);
			die();
		}
		if(empty($field_name)){
			$response = array('success' => false, 'message' => 'Param field_name not found');
			echo json_encode($response);
			die();
		}
		$output['data'] = $this->pengumuman_model->get_component_detail($id);
		if(!is_object($output['data'])){
			$response = array('success' => false, 'message' => 'Component not found');
			echo json_encode($response);
			die();
		}
		
		$article = $this->pengumuman_model->get_row($output['data']->article_id);
		if(!is_object($article)){
			$response = array('success' => false, 'message' => 'Content not found');
			echo json_encode($response);
			die();
		}
		
		if(!$this->special_user && ($article->user_id != $this->user->id)){
			$response = array('success' => false, 'message' => 'You have no access');
			echo json_encode($response);
			die();
		}
		
		if(!$this->input->post('value')){
			$response = array('success' => false, 'message' => 'Param field_name not found');
			echo json_encode($response);
			die();
		}
		
		$insert_id = $this->pengumuman_model->edit_component($id, array($field_name => $this->input->post('value')));
		
		echo json_encode(array('success' => true));
	}
	
	public function remove_component($id = false){
		header('Cache-Control: no-cache, must-revalidate');
		header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
		header('Content-type: application/json');
		
		if(!$this->edit_priv){
			$response = array('success' => false, 'message' => 'You have no access');
			echo json_encode($response);
			die();
		}
		
		if(empty($id)){
			$response = array('success' => false, 'message' => 'Param id not found');
			echo json_encode($response);
			die();
		}
		$output['data'] = $this->pengumuman_model->get_component_detail($id);
		if(!is_object($output['data'])){
			$response = array('success' => false, 'message' => 'Component not found');
			echo json_encode($response);
			die();
		}
		
		$article = $this->pengumuman_model->get_row($output['data']->article_id);
		if(!is_object($article)){
			$response = array('success' => false, 'message' => 'Content not found');
			echo json_encode($response);
			die();
		}
		
		if(!$this->special_user && ($article->user_id != $this->user->id)){
			$response = array('success' => false, 'message' => 'You have no access');
			echo json_encode($response);
			die();
		}
		
		$result = $this->pengumuman_model->delete_component($id);
		
		echo json_encode(array('success' => true));
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
