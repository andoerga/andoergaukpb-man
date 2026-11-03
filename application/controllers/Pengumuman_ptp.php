<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pengumuman_ptp extends CI_Controller {

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
	 
	private $module = 'pengumuman_ptp';
	private $tipe_jabfung = 'ptp';
	
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
		
		$filter[] = array(
			'name' => 'tipe_jabfung',
			'value' => $this->tipe_jabfung
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
				$data['tipe_jabfung'] = $this->tipe_jabfung;
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
		/*
		if(!$this->special_user && ($output['data']->user_id != $this->user->id)){
			show_404();
		}
		 * 
		 */
		if($output['data']->tipe_jabfung != $this->tipe_jabfung){
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
				$data['tipe_jabfung'] = $this->tipe_jabfung;
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
		if($output['data']->tipe_jabfung != $this->tipe_jabfung){
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
		$output['data'] = $this->pengumuman_model->get_row($id);
		if(!is_object($output['data'])){
			show_404();
		}
		if($output['data']->tipe_jabfung != $this->tipe_jabfung){
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
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
