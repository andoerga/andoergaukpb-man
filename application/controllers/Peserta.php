<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Peserta extends CI_Controller {

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
	 
	private $module = 'peserta';
	
	public function __construct(){
		parent::__construct();
		
		$user = $this->session->userdata('user');
		if(!$user){
			redirect(site_url('login'));
		}
		
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
		$output['data'] = $this->peserta_model->get_all();
		$output['tipe_registrasi'] = $this->peserta_model->get_tipe_registrasi(true);
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
		$output['user_group'] = $this->user_group_model->get_all(true);
		$output['inputan'] = $this->input->post();
		$output['page'] = 'add';
		if($this->input->post('form-submit')){
			
			$this->form_validation->set_message('required', 'Harap diisi');
			$this->form_validation->set_message('unique', 'Inputan sudah dipakai, harap gunakan kata lain');
			$this->form_validation->set_error_delimiters('<div class="error col-xs-12 col-sm-12 col-md-4"><label>', '</label></div>');
			
			$this->form_validation->set_rules('user_group_id', 'Kelompok Pengguna', 'required|integer');
			$this->form_validation->set_rules('name', 'Nama Pengguna', 'max_length[150]');
			$this->form_validation->set_rules('username', 'Username', 'required|max_length[100]|alpha_dash|is_unique[user.username]');
			$this->form_validation->set_rules('email', 'Email', 'required|max_length[100]|valid_email|is_unique[user.email]');
			$this->form_validation->set_rules('password', 'Password', 'required|max_length[50]|matches[retype-password]');
			$this->form_validation->set_rules('retype-password', 'Ulangi Password', 'required|max_length[50]');
			$this->form_validation->set_rules('status', 'Status', 'required|integer');
			
			if ($this->form_validation->run() != FALSE)
			{
				$data['user_group_id'] = $this->input->post('user_group_id');
				$data['name'] = $this->input->post('name');
				$data['username'] = $this->input->post('username');
				$data['email'] = $this->input->post('email');
				$data['password'] = $this->mytools->encrypt_password($this->input->post('password'));
				$data['status'] = $this->input->post('status');
				$insert_id = $this->user_model->add($data);
				if($insert_id){
					redirect(site_url('user/detail/'.$insert_id));
				}else{
					redirect(site_url('user/add'));
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
		$output['data'] = $this->user_model->get_row($id);
		if(!is_object($output['data'])){
			show_404();
		}
		$output['user_group'] = $this->user_group_model->get_all(true);
		$output['inputan'] = $this->input->post();
		if($this->input->post('form-submit')){
			$this->form_validation->set_message('required', 'Harap diisi');
			$this->form_validation->set_message('unique', 'Inputan sudah dipakai, harap gunakan kata lain');
			$this->form_validation->set_error_delimiters('<div class="error col-xs-12 col-sm-12 col-md-4"><label>', '</label></div>');
			
			$this->form_validation->set_rules('user_group_id', 'Kelompok Pengguna', 'required|integer');
			$this->form_validation->set_rules('name', 'Nama Pengguna', 'max_length[150]');
			if($output['data']->username != $this->input->post('username')){
				$this->form_validation->set_rules('username', 'Username', 'required|max_length[100]|alpha_dash|is_unique[user.username]');
			}else{
				$this->form_validation->set_rules('username', 'Username', 'required|max_length[100]|alpha_dash');
			}
			if($output['data']->email != $this->input->post('email')){
				$this->form_validation->set_rules('email', 'Email', 'required|max_length[100]|valid_email|is_unique[user.email]');
			}else{
				$this->form_validation->set_rules('email', 'Email', 'required|max_length[100]|valid_email');
			}
			if ($this->form_validation->run() != FALSE){

				$data['user_group_id'] = $this->input->post('user_group_id');
				$data['name'] = $this->input->post('name');
				$data['username'] = $this->input->post('username');
				$data['email'] = $this->input->post('email');
				$data['status'] = $this->input->post('status');
				$insert_id = $this->user_model->edit($id, $data);
				if($insert_id){
					redirect(site_url('user/detail/'.$insert_id));
				}else{
					redirect(site_url('user/edit'));
				}
			}
		}
		
		$this->load->view('layout/layout', $output);
	}
	
	public function edit_password($id = false)
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
		$output['page'] = 'edit_password';
		if(empty($id)){
			show_404();
		}
		$output['data'] = $this->user_model->get_row($id);
		if(!is_object($output['data'])){
			show_404();
		}
		$output['user_group'] = $this->user_group_model->get_all(true);
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
				$data['password'] = $this->mytools->encrypt_password($this->input->post('password'));
				$insert_id = $this->user_model->edit($id, $data);
				if($insert_id){
					redirect(site_url('user/detail/'.$insert_id));
				}else{
					redirect(site_url('user/edit_password'));
				}
			}
		}
		
		$this->load->view('layout/layout', $output);
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
		$output['data'] = $this->user_model->get_row($id);
		if(!is_object($output['data'])){
			show_404();
		}
		$output['user_group'] = $this->user_group_model->get_row($output['data']->user_group_id);
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
		$output['data'] = $this->user_model->get_row($id);
		$output['user_group'] = $this->user_group_model->get_row($output['data']->user_group_id);
		if(!is_object($output['data'])){
			show_404();
		}
		
		if($this->input->post('form-submit')){
			$this->user_model->delete($id);
			$output['page'] = 'delete_success';
		}else{
			$output['module'] = $this->module;
			$output['page'] = 'delete';
		}
		
		$this->load->view('layout/layout', $output);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */