<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ujian_pg_pb extends CI_Controller {

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
	 
	private $module = 'ujian_pg_pb';
	
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
		$output['customjs'] = array('nilai_ptp_pg.js');
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
					'value' => $column['search']['value']
				);
			}
		}
		
		$filter[] = array(
			'name' => 'jenis_soal',
			'value' => 'pg'
		);
		$filter[] = array(
			'name' => 'tipe_jabfung',
			'value' => 'pamong_belajar'
		);
		
		$order_column = $fields[$order[0]['column']];
		$order_method = $order[0]['dir'];
		
		$data = $this->nilai_model->get_filter($filter, $length, $start, $order_column, $order_method);
		$recordsTotal = $this->nilai_model->count_all();
		$recordsFiltered = $this->nilai_model->count_filter($filter);
		
		$data_output = array();
		foreach($data as $d){
			$temp = array();
			foreach($fields as $field){
				if(!empty($field)){
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
		$output['add_priv'] = $this->add_priv;
		$output['edit_priv'] = $this->edit_priv;
		$output['delete_priv'] = $this->delete_priv;
		$output['modules'] = $this->modules;
		$output['module_object'] = $this->module_object;
		$output['crud'] = $this->crud;
		$output['user'] = $this->user_model->get_all();
		if($this->input->post('form-submit')){
			$this->form_validation->set_message('required', 'Harap diisi');
			$this->form_validation->set_message('unique', 'Inputan sudah dipakai, harap gunakan kata lain');
			$this->form_validation->set_error_delimiters('<div class="error col-xs-12 col-sm-12 col-md-4"><label>', '</label></div>');
			
			$this->form_validation->set_rules('name', 'Nama', 'required|max_length[255]');
			$this->form_validation->set_rules('user_id', 'PIC', 'required');
			$this->form_validation->set_rules('location', 'Lokasi', 'max_length[255]');
			$this->form_validation->set_rules('tahun_anggaran', 'Tahun Anggaran', 'required|numeric');
			
			if ($this->form_validation->run() == FALSE)
			{
				$output['module'] = $this->module;
				$output['page'] = 'add';
				$this->load->view('layout/layout', $output);
			}
			else
			{
				$data['name'] = $this->input->post('name');
				$data['status'] = $this->input->post('status');
				$data['location'] = $this->input->post('location');
				$data['user_id'] = $this->input->post('user_id');
				$data['tahun_anggaran'] = $this->input->post('tahun_anggaran');
				$data['start_date'] = $this->input->post('start_date') ? date('Y-m-d', strtotime($this->input->post('start_date'))) : null;
				$data['end_date'] = $this->input->post('end_date') ? date('Y-m-d', strtotime($this->input->post('end_date'))) : null;
				$insert_id = $this->kegiatan_model->add($data);
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
		$output['add_priv'] = $this->add_priv;
		$output['edit_priv'] = $this->edit_priv;
		$output['delete_priv'] = $this->delete_priv;
		$output['modules'] = $this->modules;
		$output['module_object'] = $this->module_object;
		$output['crud'] = $this->crud;
		$output['user'] = $this->user_model->get_all();
		if(empty($id)){
			show_404();
		}
		$output['data'] = $this->kegiatan_model->get_row($id);
		if(!is_object($output['data'])){
			show_404();
		}
		
		if($this->input->post('form-submit')){
			$this->form_validation->set_message('required', 'Harap diisi');
			$this->form_validation->set_message('unique', 'Inputan sudah dipakai, harap gunakan kata lain');
			$this->form_validation->set_error_delimiters('<div class="error col-xs-12 col-sm-12 col-md-4"><label>', '</label></div>');
			
			$this->form_validation->set_rules('name', 'Nama', 'required|max_length[255]');
			$this->form_validation->set_rules('user_id', 'PIC', 'required');
			$this->form_validation->set_rules('location', 'Lokasi', 'max_length[255]');
			$this->form_validation->set_rules('tahun_anggaran', 'Tahun Anggaran', 'required|numeric');
			
			if ($this->form_validation->run() == FALSE)
			{
				$output['module'] = $this->module;
				$output['page'] = 'edit';
				$this->load->view('layout/layout', $output);
			}
			else
			{
				$data['name'] = $this->input->post('name');
				$data['status'] = $this->input->post('status');
				$data['user_id'] = $this->input->post('user_id');
				$data['location'] = $this->input->post('location');
				$data['tahun_anggaran'] = $this->input->post('tahun_anggaran');
				$data['start_date'] = $this->input->post('start_date') ? date('Y-m-d', strtotime($this->input->post('start_date'))) : null;
				$data['end_date'] = $this->input->post('end_date') ? date('Y-m-d', strtotime($this->input->post('end_date'))) : null;
				$insert_id = $this->kegiatan_model->edit($id, $data);
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
		$output['data'] = $this->nilai_model->get_row($id);
		$soal = $this->nilai_model->get_soal($output['data']->ujian_id, $output['data']->tipe_soal);
		$soal_map = array();
		foreach($soal as $s){
			$soal_map[$s->id] = $s;
		}
		$output['soal'] = $soal_map;
		
		if(!is_object($output['data'])){
			show_404();
		}
		$output['module'] = $this->module;
		$output['page'] = 'detail';
		$this->load->view('layout/layout', $output);
	}
	
	public function process($id = false)
	{
		if(!$this->edit_priv){
			show_404();
		}
		
		if(!$id){
			show_404();
		}
		
		$data = $this->nilai_model->get_row($id);
		$soal = $this->nilai_model->get_soal($data->ujian_id, $data->tipe_soal);
		
		$ujian = $this->mata_ujian_model->get_row($data->ujian_id);
		
		$soal_map = array();
		foreach($soal as $s){
			$soal_map[$s->id] = $s;
		}
		
		$urutan_soal = json_decode($data->soal);
		$jawaban = json_decode($data->jawaban);
		$score = 0;
		foreach($urutan_soal as $ds){
			if($jawaban->$ds == $soal_map[$ds]->kunci){
				$score++;
			}
		}
		$nilai = round($score/$ujian->jumlah_soal, 2) * 100;
		$update_data = array(
			'score' => $score,
			'nilai' => $nilai,
			'create_score' => 1
		);
		$this->nilai_model->edit($id, $update_data);
		redirect(site_url($this->module . '/detail/' . $id));
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */