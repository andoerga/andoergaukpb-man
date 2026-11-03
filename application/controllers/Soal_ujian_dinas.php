<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Soal_ujian_dinas extends CI_Controller {

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
	 
	private $module = 'soal_ujian_dinas';
	private $tipe_registrasi_id = '11';
	private $tipe_jabfung = 'ptp';
	private $mata_ujian;
	private $mata_ujian_ids;
	
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
		
		$this->mata_ujian = $this->mata_ujian_model->get_all($this->tipe_registrasi_id);
		foreach($this->mata_ujian as $m){
			$this->mata_ujian_ids[] = $m->id;
		}
		
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
	
	public function index($category_id = false)
	{
		if(!$category_id){
			redirect(site_url($this->module . '/index/' . $this->mata_ujian_ids[0]));
		}
		$output['add_priv'] = $this->add_priv;
		$output['edit_priv'] = $this->edit_priv;
		$output['delete_priv'] = $this->delete_priv;
		$output['modules'] = $this->modules;
		$output['crud'] = $this->crud;
		$output['module'] = $this->module;
		$output['module_object'] = $this->module_object;
		$output['page'] = 'list';
		$output['customjs'] = array('kegiatan.js', 'change_category.js');
		$output['mata_ujian'] = $this->mata_ujian;
		$output['category_id'] = $category_id;
		
		$this->load->view('layout/layout', $output);
	}
	
	public function ajax($category_id = false){
		if(!$category_id){
			echo json_encode(array(
				'success' => 'false',
				'message' => 'category not found'
			));
			die();
		}
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
		
		$filter[] = array(
			'name' => 'ujian_id',
			'value' => $category_id
		);
		/*
		if(!$this->special_user){
			$filter[] = array(
				'name' => 'user_id',
				'value' => $this->user->id
			);
		}
		 * 
		 */
		
		$order_column = $fields[$order[0]['column']];
		$order_method = $order[0]['dir'];
		
		$data = $this->soal_model->get_filter($filter, $length, $start, $order_column, $order_method);
		$recordsTotal = $this->soal_model->count_all();
		$recordsFiltered = $this->soal_model->count_filter($filter);
		
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
		
		$year = date('Y', time());
		$month = date('m', time());
		$date = date('d', time());
		
		$output['add_priv'] = $this->add_priv;
		$output['edit_priv'] = $this->edit_priv;
		$output['delete_priv'] = $this->delete_priv;
		$output['modules'] = $this->modules;
		$output['module_object'] = $this->module_object;
		$output['mata_ujian'] = $this->mata_ujian;
		$output['crud'] = $this->crud;
		if($this->input->post('form-submit')){
			$this->form_validation->set_message('required', 'Harap diisi');
			$this->form_validation->set_message('unique', 'Inputan sudah dipakai, harap gunakan kata lain');
			$this->form_validation->set_error_delimiters('<div class="error col-xs-12 col-sm-12 col-md-4"><label>', '</label></div>');
			
			$this->form_validation->set_rules('ujian_id', 'Mata Ujian', 'required');
			$this->form_validation->set_rules('jenis', 'Jenis Soal', 'required');
			$this->form_validation->set_rules('tipe_soal', 'Tipe Soal', 'required');
			$this->form_validation->set_rules('soal', 'Soal', 'required');
			
			if ($this->form_validation->run() == FALSE)
			{
				$output['module'] = $this->module;
				$output['page'] = 'add';
				$this->load->view('layout/layout', $output);
			}
			else
			{
				
				$data['ujian_id'] = $this->input->post('ujian_id');
				$data['jenis'] = $this->input->post('jenis');
				$data['tipe_soal'] = $this->input->post('tipe_soal');
				$data['soal'] = $this->input->post('soal');
				$data['pil_1'] = $this->input->post('pil_1');
				$data['pil_2'] = $this->input->post('pil_2');
				$data['pil_3'] = $this->input->post('pil_3');
				$data['pil_4'] = $this->input->post('pil_4');
				$data['pil_5'] = $this->input->post('pil_5');
				$data['kunci'] = $this->input->post('kunci');
				$insert_id = $this->soal_model->add($data);
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
		$output['data'] = $this->soal_model->get_row($id);
		if(!is_object($output['data'])){
			show_404();
		}
		
		$output['mata_ujian'] = array();
		foreach($this->mata_ujian as $m){
			$output['mata_ujian'][$m->id] = $m;
		}
		
		if(!in_array($output['data']->ujian_id, $this->mata_ujian_ids)){
			show_404();
		}
		
		if($this->input->post('form-submit')){
			$this->form_validation->set_message('required', 'Harap diisi');
			$this->form_validation->set_message('unique', 'Inputan sudah dipakai, harap gunakan kata lain');
			$this->form_validation->set_error_delimiters('<div class="error col-xs-12 col-sm-12 col-md-4"><label>', '</label></div>');
			
			$this->form_validation->set_rules('ujian_id', 'Mata Ujian', 'required');
			$this->form_validation->set_rules('jenis', 'Jenis Soal', 'required');
			$this->form_validation->set_rules('tipe_soal', 'Tipe Soal', 'required');
			$this->form_validation->set_rules('soal', 'Soal', 'required');
			
			if ($this->form_validation->run() == FALSE)
			{
				$output['module'] = $this->module;
				$output['page'] = 'edit';
				$this->load->view('layout/layout', $output);
			}
			else
			{
				
				$data['ujian_id'] = $this->input->post('ujian_id');
				$data['jenis'] = $this->input->post('jenis');
				$data['tipe_soal'] = $this->input->post('tipe_soal');
				$data['soal'] = $this->input->post('soal');
				$data['pil_1'] = $this->input->post('pil_1');
				$data['pil_2'] = $this->input->post('pil_2');
				$data['pil_3'] = $this->input->post('pil_3');
				$data['pil_4'] = $this->input->post('pil_4');
				$data['pil_5'] = $this->input->post('pil_5');
				$data['kunci'] = $this->input->post('kunci');
				$insert_id = $this->soal_model->edit($id, $data);
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
		$output['data'] = $this->soal_model->get_row($id);
		if(!is_object($output['data'])){
			show_404();
		}
		$output['mata_ujian'] = array();
		foreach($this->mata_ujian as $m){
			$output['mata_ujian'][$m->id] = $m;
		}
		
		if(!in_array($output['data']->ujian_id, $this->mata_ujian_ids)){
			show_404();
		}
		/*
		if(!$this->special_user && ($output['data']->user_id != $this->user->id)){
			show_404();
		}
		 * 
		 */
		$output['module'] = $this->module;
		$output['page'] = 'detail';
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
		$output['data'] = $this->soal_model->get_row($id);
		if(!is_object($output['data'])){
			show_404();
		}
		
		$output['mata_ujian'] = array();
		foreach($this->mata_ujian as $m){
			$output['mata_ujian'][$m->id] = $m;
		}
		
		if(!in_array($output['data']->ujian_id, $this->mata_ujian_ids)){
			show_404();
		}
		
		if($this->input->post('form-submit')){
			$this->soal_model->delete($id);
			$output['page'] = 'delete_success';
		}else{
			$output['page'] = 'delete';
		}
		
		$this->load->view('layout/layout', $output);
	}
	
	public function export($id = false){
		if(!is_numeric($id)){
			show_404();
			die();
		}
		
		$data = $this->soal_model->get_by_category($id);
		$output['data'] = $data;
		
		$output['add_priv'] = $this->add_priv;
		$output['edit_priv'] = $this->edit_priv;
		$output['delete_priv'] = $this->delete_priv;
		$output['modules'] = $this->modules;
		$output['crud'] = $this->crud;
		$output['module'] = $this->module;
		$output['module_object'] = $this->module_object;
		$output['page'] = 'export';
		$output['customjs'] = array('kegiatan.js', 'change_category.js');
		$output['mata_ujian'] = $this->mata_ujian;
		$output['category_id'] = $id;
		
		$this->load->view('layout/layout', $output);
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
