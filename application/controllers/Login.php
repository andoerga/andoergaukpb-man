<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

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
	public function index()
	{
		
		$user = $this->session->userdata('user');
		if($user){
			redirect(site_url('home'));
		}
		
		$output = array();
		$output['message_error'] = false;
		if($this->input->post('form-submit')){
			$this->form_validation->set_rules('username', 'Username', 'required');
			$this->form_validation->set_rules('password', 'Password', 'required');
			if ($this->form_validation->run() != FALSE){
				$username = $this->input->post('username');
				$password = $this->mytools->encrypt_password($this->input->post('password'));
				$user = $this->user_model->check_login($username, $password);
				if(!$user){
					$output['message_error'] = 'Username dan Password tidak cocok';
				}else{
					$this->logging_in($user);
					redirect(site_url('home'));
				}
			}
		}
		$this->load->view('login', $output);
	}
	
	public function convert_pass($pass){
		echo $this->mytools->encrypt_password($pass);
	}
	
	private function logging_in($user){
		$data = array(
			'user_id' => $user->id,
			'user' => $user,
			'tahun_anggaran' => date('Y')
		);
		
		$this->session->set_userdata($data);
	}
	
	public function logout(){
		$this->session->unset_userdata('user_id');
		$this->session->unset_userdata('user');
		redirect(site_url('login'));
	}
	
	public function generate(){
		$this->load->model('generate_model');
		$data = $this->generate_model->get_jenis_barang();
		foreach($data as $d){
			echo $d->id . '<br />';
			$this->generate_model->insert($d);
		}
	}
	
	public function testpdf(){
		$this->load->library('Pdf');
		$pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
		// set font
		$pdf->SetFont('dejavusans', '', 10);

		// add a page
		$pdf->AddPage();

		// writeHTML($html, $ln=true, $fill=false, $reseth=false, $cell=false, $align='')
		// writeHTMLCell($w, $h, $x, $y, $html='', $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true)

		// create some HTML content
		$html = $this->load->view('testpdf', array(), true);
		// output the HTML content
		$pdf->writeHTML($html, true, false, true, false, '');
		
		$pdf->Output('example_006.pdf', 'I');
		
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */