<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mata_ujian_pamong_belajar_bp extends CI_Controller {

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
	 
	private $module = 'mata_ujian_pamong_belajar_bp';
	
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
		$output['data'] = $this->mata_ujian_model->get_all('pamong_belajar_bp');
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
		$output['data'] = array();
		$output['jenjang_jabfung'] = $this->status_inpassing_model->get_all();
		$output['tipe_registrasi'] = $this->mata_ujian_model->get_tipe_registrasi_pambel_bp();
		if($this->input->post('form-submit')){
			$this->form_validation->set_message('required', 'Harap diisi');
			$this->form_validation->set_message('unique', 'Inputan sudah dipakai, harap gunakan kata lain');
			$this->form_validation->set_error_delimiters('<div class="error col-xs-12 col-sm-12 col-md-4"><label>', '</label></div>');
			
			$this->form_validation->set_rules('nama_ujian', 'Nama Mata Ujian', 'required|max_length[255]');
			$this->form_validation->set_rules('status_inpassing_id', 'Jenjang Jabatan', 'required');
			$this->form_validation->set_rules('jumlah_soal', 'Jumlah Soal', 'required');
			$this->form_validation->set_rules('waktu', 'Waktu', 'required');
			$this->form_validation->set_rules('tipe_soal', 'Tipe Soal', 'required');
			$this->form_validation->set_rules('jenis_soal', 'Jenis Soal', 'required');
			
			if ($this->form_validation->run() == FALSE)
			{
				$output['data'] = $this->input->post();
				$this->load->view('layout/layout', $output);
			}
			else
			{
				$data = array();
				$data['tipe_registrasi_id'] = '11';
				$data['tipe_jabfung'] = 'pamong_belajar';
				$data['nama_ujian'] = $this->input->post('nama_ujian');
				$data['status_inpassing_id'] = $this->input->post('status_inpassing_id');
				$data['jumlah_soal'] = $this->input->post('jumlah_soal');
				$data['waktu'] = $this->input->post('waktu');
				$data['tipe_soal'] = $this->input->post('tipe_soal');
				$data['jenis_soal'] = $this->input->post('jenis_soal');
				$insert_id = $this->mata_ujian_model->add($data);
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
		$output['page'] = 'edit';
		$output['crud'] = $this->crud;
		if(empty($id)){
			show_404();
		}
		$output['data'] = $this->mata_ujian_model->get_row($id, 'pamong_belajar_bp');
		$output['jenjang_jabfung'] = $this->status_inpassing_model->get_all();
		$output['tipe_registrasi'] = $this->mata_ujian_model->get_tipe_registrasi_pambel_bp();
		if(!is_object($output['data'])){
			show_404();
		}
		
		if($this->input->post('form-submit')){
			$this->form_validation->set_message('required', 'Harap diisi');
			$this->form_validation->set_message('unique', 'Inputan sudah dipakai, harap gunakan kata lain');
			$this->form_validation->set_error_delimiters('<div class="error col-xs-12 col-sm-12 col-md-4"><label>', '</label></div>');
			
			$this->form_validation->set_rules('nama_ujian', 'Nama Mata Ujian', 'required|max_length[255]');
			$this->form_validation->set_rules('status_inpassing_id', 'Jenjang Jabatan', 'required');
			$this->form_validation->set_rules('jumlah_soal', 'Jumlah Soal', 'required');
			$this->form_validation->set_rules('waktu', 'Waktu', 'required');
			$this->form_validation->set_rules('tipe_soal', 'Tipe Soal', 'required');
			$this->form_validation->set_rules('jenis_soal', 'Jenis Soal', 'required');
			
			if ($this->form_validation->run() == FALSE)
			{
				$this->load->view('layout/layout', $output);
			}
			else
			{
				$data['nama_ujian'] = $this->input->post('nama_ujian');
				$data['status_inpassing_id'] = $this->input->post('status_inpassing_id');
				$data['jumlah_soal'] = $this->input->post('jumlah_soal');
				$data['waktu'] = $this->input->post('waktu');
				$data['tipe_soal'] = $this->input->post('tipe_soal');
				$data['jenis_soal'] = $this->input->post('jenis_soal');
				$insert_id = $this->mata_ujian_model->edit($id, $data);
				if($insert_id){
					redirect(site_url($this->module.'/detail/'.$insert_id));
				}else{
					redirect(site_url($this->module.'/edit'));
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
		$output['data'] = $this->mata_ujian_model->get_row($id, 'pamong_belajar_bp');
		if(!is_object($output['data'])){
			show_404();
		}
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
		$output['data'] = $this->mata_ujian_model->get_row($id, 'pamong_belajar');
		if(!is_object($output['data'])){
			show_404();
		}
		
		if($this->input->post('form-submit')){
			$this->mata_ujian_model->delete($id);
			$output['page'] = 'delete_success';
		}else{
			$output['page'] = 'delete';
		}
		
		$this->load->view('layout/layout', $output);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */