<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

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
	 
	private $module = 'home';
	
	public function __construct(){
		parent::__construct();
		$user = $this->session->userdata('user');
		if(!$user){
			redirect(site_url('login'));
		}
		$this->user = $user;
		$this->user_group = $this->user_group_model->get_row($user->user_group_id);
		
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
	}
	
	public function index()
	{
		$output['add_priv'] = true;
		$output['edit_priv'] = true;
		$output['delete_priv'] = true;
		$output['module'] = $this->module;
		$output['page'] = 'home';
		$output['modules'] = $this->modules;
		$output['crud'] = $this->crud;
		
		
		$output['data']['pendaftar_ptp'] = 0;
		
		
		$output['data']['pendaftar_pamong_budaya'] = 0;
		
		/* Count Pendaftar Pamong Belajar */
		/*
		$filter = array();
		$filter[] = array(
			'name' => 'status_approval',
			'value' => 'unset'
		);
		$filter[] = array(
			'name' => 'tipe_jabfung',
			'value' => 'pamong_belaejar'
		);
		$filter[] = array(
			'name' => 'registered',
			'value' => '1'
		);
		*/
		$output['data']['pendaftar_pamong_belajar'] = 0;
		
		/* Count Pendaftar Penilik */
		$output['data']['pendaftar_penilik'] = 0;
		
		$this->load->view('layout/layout', $output);
	}
	
	public function change_tahun_anggaran() {
		$callback = $this->input->post('callback');
		$tahun_anggaran = intval($this->input->post('tahun_anggaran'));
		$currentYear = date('Y');
		
		if($tahun_anggaran > $currentYear || $tahun_anggaran < ($currentYear-5)){
			$tahun_anggaran = $currentYear;
		}
		$this->session->set_userdata('tahun_anggaran', $tahun_anggaran);
		redirect($callback);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */