<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Berkas extends CI_Controller {

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
	 
	protected $module = 'berkas';
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
		if($this->user->user_group_id == '1'){
			$output['data'] = $this->peserta_model->get_all();
		}else{
			$output['data'] = $this->peserta_model->get_all(false, $this->user->instansi_id);
		}
		$output['user_group'] = $this->user_group_model->get_all(true);
		$output['instansi'] = $this->instansi_model->get_all(true);
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
		$output['data'] = $this->peserta_model->get_row($id);
		if(!is_object($output['data'])){
			show_404();
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
		
		$type_array = array('tik', 'pi');
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
			if(move_uploaded_file($_FILES['upl']['tmp_name'], $path)){
				
				$data['doc_' . $type] = $fileLoc;
				$insert_id = $this->peserta_model->edit($id, $data);
				
				echo '{"status":"success", "path":"'.$fileLoc.'"}';
				exit;
			}
			
			
			
		}

		echo '{"status":"error"}';
		exit;
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */