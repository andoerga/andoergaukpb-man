<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pengaturan extends CI_Controller {

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
	 
	private $module = 'pengaturan';
	
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
		
		$settingPath = FCPATH . "../application/config/_setting.json";
		$output['data'] = file_get_contents($settingPath);
		$output['data'] = json_decode($output['data'], false);
		if(!is_object($output['data'])){
			show_404();
		}
		
		if($this->input->post('form-submit')){
			$this->form_validation->set_message('required', 'Harap diisi');
			$this->form_validation->set_message('unique', 'Inputan sudah dipakai, harap gunakan kata lain');
			$this->form_validation->set_error_delimiters('<div class="error col-xs-12 col-sm-12 col-md-4"><label>', '</label></div>');
			
			$this->form_validation->set_rules('PendaftaranBuka', 'Waktu Buka Pendaftaran', 'required|max_length[100]');
			$this->form_validation->set_rules('PendaftaranTutup', 'Waktu Tutup Pendaftaran', 'required|max_length[100]');
			$this->form_validation->set_rules('UjianMulai', 'Waktu Mulai Ujian', 'required|max_length[100]');
			$this->form_validation->set_rules('UjianSelesai', 'Waktu Selesai Ujian', 'required|max_length[100]');
			
			if ($this->form_validation->run() == FALSE)
			{
				$this->load->view('layout/layout', $output);
			}
			else
			{
				$output['data']->Pendaftaran->Buka = $this->input->post('PendaftaranBuka');
				$output['data']->Pendaftaran->Tutup = $this->input->post('PendaftaranTutup');
				$output['data']->Ujian->Mulai = $this->input->post('UjianMulai');
				$output['data']->Ujian->Selesai = $this->input->post('UjianSelesai');
				$json = json_encode($output['data']);
				file_put_contents($settingPath, $json);
				//redirect(site_url($this->module));
			}
		}
		$this->load->view('layout/layout', $output);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */