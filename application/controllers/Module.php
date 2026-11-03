<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Module extends CI_Controller {

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
	 
	private $module = 'module';
	
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
		$data = $this->module_model->get_all();
		$mapping_data = array();
		foreach($data as $d){
			$mapping_data[$d->parent_id][] = $d;
		}
		$output['data'] = $mapping_data;
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
		$output['page'] = 'add';
		$output['crud'] = $this->crud;
		
		$parent = $this->module_model->get_all();
		$mapping_data = array();
		foreach($parent as $d){
			$mapping_data[$d->parent_id][] = $d;
		}
		$output['parent'] = $mapping_data;
		$output['inputan'] = $this->input->post();
		if($this->input->post('form-submit')){
			$this->form_validation->set_message('required', 'Harap diisi');
			$this->form_validation->set_message('unique', 'Inputan sudah dipakai, harap gunakan kata lain');
			$this->form_validation->set_error_delimiters('<div class="error col-xs-12 col-sm-12 col-md-4"><label>', '</label></div>');
			
			$this->form_validation->set_rules('parent_id', 'Kelompok Modul', 'integer');
			$this->form_validation->set_rules('name', 'Nama Pengguna', 'max_length[50]');
			$this->form_validation->set_rules('initial', 'Initial', 'required|max_length[50]|alpha_dash|is_unique[module.initial]');
			$this->form_validation->set_rules('icon', 'Icon', 'required|max_length[20]');
			$this->form_validation->set_rules('ordered_number', 'Urutan', 'integer');
			$this->form_validation->set_rules('active', 'Active', 'integer');
			
			if ($this->form_validation->run() == FALSE)
			{
				$this->load->view('layout/layout', $output);
			}
			else
			{
				$data = array();
				$data['parent_id'] = $this->input->post('parent_id');
				$data['name'] = $this->input->post('name');
				$data['initial'] = $this->input->post('initial');
				$data['icon'] = $this->input->post('icon');
				$data['ordered_number'] = $this->input->post('ordered_number');
				$data['active'] = $this->input->post('active');
				$insert_id = $this->module_model->add($data);
				if($insert_id){
					redirect(site_url('module/detail/'.$insert_id));
				}else{
					redirect(site_url('module/add'));
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
		$output['page'] = 'edit';
		$output['crud'] = $this->crud;
		if(empty($id)){
			show_404();
		}
		$parent = $this->module_model->get_all();
		$mapping_data = array();
		foreach($parent as $d){
			$mapping_data[$d->parent_id][] = $d;
		}
		$output['parent'] = $mapping_data;
		$output['data'] = $this->module_model->get_row($id);
		if(!is_object($output['data'])){
			show_404();
		}
		
		if($this->input->post('form-submit')){
			$this->form_validation->set_message('required', 'Harap diisi');
			$this->form_validation->set_message('unique', 'Inputan sudah dipakai, harap gunakan kata lain');
			$this->form_validation->set_error_delimiters('<div class="error col-xs-12 col-sm-12 col-md-4"><label>', '</label></div>');
			
			$this->form_validation->set_rules('parent_id', 'Kelompok Modul', 'integer');
			$this->form_validation->set_rules('name', 'Nama Pengguna', 'max_length[50]');
			$this->form_validation->set_rules('initial', 'Initial', 'required|max_length[50]|alpha_dash|is_unique[module.initial]');
			$this->form_validation->set_rules('icon', 'Icon', 'required|max_length[20]');
			$this->form_validation->set_rules('ordered_number', 'Urutan', 'integer');
			$this->form_validation->set_rules('active', 'Active', 'integer');
			if($output['data']->initial != $this->input->post('initial')){
				$this->form_validation->set_rules('initial', 'Initial', 'required|max_length[50]|alpha_dash|is_unique[module.initial]');
			}else{
				$this->form_validation->set_rules('initial', 'Initial', 'required|max_length[50]|alpha_dash');
			}
			if ($this->form_validation->run() == FALSE)
			{
				$this->load->view('layout/layout', $output);
			}
			else
			{
				$data = array();
				$data['parent_id'] = $this->input->post('parent_id');
				$data['name'] = $this->input->post('name');
				$data['initial'] = $this->input->post('initial');
				$data['icon'] = $this->input->post('icon');
				$data['ordered_number'] = $this->input->post('ordered_number');
				$data['active'] = $this->input->post('active');
				$insert_id = $this->module_model->edit($id, $data);
				if($insert_id){
					redirect(site_url('module/detail/'.$insert_id));
				}else{
					redirect(site_url('module/edit'));
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
		$output['page'] = 'detail';
		$output['crud'] = $this->crud;
		if(empty($id)){
			show_404();
		}
		$output['data'] = $this->module_model->get_row($id);
		if(!is_object($output['data'])){
			show_404();
		}
		$parent = null;
		if($output['data']->parent_id){
			$parent = $this->module_model->get_row($output['data']->parent_id);
		}
		$output['parent'] = $parent;
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
		$output['data'] = $this->module_model->get_row($id);
		if(!is_object($output['data'])){
			show_404();
		}
		$parent = null;
		$output['parent'] = $parent;
		if($output['data']->parent_id){
			$parent = $this->module_model->get_row($output['data']->parent_id);
		}
		if($this->input->post('form-submit')){
			$this->module_model->delete($id);
			$output['module'] = $this->module;
			$output['page'] = 'delete_success';
		}else{
			$output['module'] = $this->module;
			$output['page'] = 'delete';
		}
		
		$this->load->view('layout/layout', $output);
	}
	
	public function crud($id = false){
		if(!$this->edit_priv){
			show_404();
		}
		$output['add_priv'] = $this->add_priv;
		$output['edit_priv'] = $this->edit_priv;
		$output['delete_priv'] = $this->delete_priv;
		$output['modules'] = $this->modules;
		$output['module'] = $this->module;
		$output['module_object'] = $this->module_object;
		$output['page'] = 'crud';
		$output['crud'] = $this->crud;
		if(empty($id)){
			show_404();
		}
		$output['data'] = $this->module_model->get_row($id);
		if(!is_object($output['data'])){
			show_404();
		}
		$parent = null;
		if($output['data']->parent_id){
			$parent = $this->module_model->get_row($output['data']->parent_id);
		}
		$output['parent'] = $parent;
		$output['user_group'] = $this->user_group_model->get_all();
		$crud = $this->crud_model->get_by_module($id);
		$mapping_crud = array();
		foreach($crud as $c){
			$mapping_crud[$c->user_group_id] = $c;
		}
		$output['data_crud'] = $mapping_crud;
		
		if($this->input->post('form-submit')){
			$inputActive = $this->input->post('inputActive');
			$inputAdd = $this->input->post('inputAdd');
			$inputEdit = $this->input->post('inputEdit');
			$inputDelete = $this->input->post('inputDelete');
			
			$postCrudMapping = array();
			foreach($output['user_group'] as $u){
				if(array_key_exists($u->id, $inputActive)){
					$postCrudMapping[$u->id] = array(
						'user_group_id' => $u->id,
						'active' => false,
						'add' => false,
						'edit' => false,
						'delete' => false
					);
					if($inputActive[$u->id] == 'active'){
						$postCrudMapping[$u->id]['active'] = true;
					}
					if(isset($inputAdd[$u->id])){
						$postCrudMapping[$u->id]['add'] = true;
					}
					if(isset($inputEdit[$u->id])){
						$postCrudMapping[$u->id]['edit'] = true;
					}
					if(isset($inputDelete[$u->id])){
						$postCrudMapping[$u->id]['delete'] = true;
					}
				}
			}
			foreach($postCrudMapping as $p){
				if(array_key_exists($p['user_group_id'], $mapping_crud)){
					if($p['active']){
						/* Update crud record */
						$data = array(
							'user_group_id' => $p['user_group_id'],
							'module_id' => $id,
							'add_priv' => $p['add'],
							'edit_priv' => $p['edit'],
							'delete_priv' => $p['delete']
						);
						$this->crud_model->edit($mapping_crud[$p['user_group_id']]->id, $data);
					}else{
						/* Delete crud record */
						$this->crud_model->delete($mapping_crud[$p['user_group_id']]->id);
					}
				}else{
					if($p['active']){
						/* Insert crud record */
						$data = array(
							'user_group_id' => $p['user_group_id'],
							'module_id' => $id,
							'add_priv' => $p['add'],
							'edit_priv' => $p['edit'],
							'delete_priv' => $p['delete']
						);
						$this->crud_model->add($data);
					}
				}
			}
			redirect(site_url('module/crud/'.$id));
		}
		
		$this->load->view('layout/layout', $output);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */