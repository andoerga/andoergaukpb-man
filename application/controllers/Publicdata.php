<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Publicdata extends CI_Controller {

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
	 
	protected $module = 'publicdata';
	protected $user;
	protected $field_utama;
	protected $field_informasi;
	
	public function __construct(){
		parent::__construct();
	}
	
	public function index()
	{
		show_404();
	}
	
	private function output_csv($data, $title)
    {
        $this->output->set_content_type('text/csv');
        $filename = $title . "_" . date('Ymd_His') . ".csv";
        $this->output->set_header("Content-Disposition: attachment; filename=\"$filename\"");

        $output = fopen('php://output', 'w');
        if (!empty($data)) {
            // Write header
            fputcsv($output, array_keys($data[0]), ',');
            // Write rows
            foreach ($data as $row) {
                fputcsv($output, $row, ',');
            }
        }
        fclose($output);
    }
	
	public function peserta()
	{
		$data = $this->peserta_model->get_all_2026_process(false);
		$output_data = array();
		$jf = array(
			'11' => 'Pamong Belajar',
			'12' => 'Pamong Belajar',
			'13' => 'Pamong Belajar',
			'21' => 'Penilik',
			'22' => 'Penilik',
			'23' => 'Penilik',
		);
		foreach($data as $d){
			$output_data[] = array(
				'Id' => $d->id,
				'Nama Verifikator' => $d->nama_verifikator,
				'Nama' => $d->nama,
				'Email' => $d->username,
				'NIP' => $d->nip,
				'TMT Golongan' => date('d F Y', strtotime($d->tmt_golongan)),
				'JF' => $jf[$d->tingkat_id],
				'Jenjang' => $d->tingkat_name,
				'Golongan' => $d->golongan_name,
				'No. Handphone' => $d->handphone,
				'Instansi' => $d->instansi_name,
				'Provinsi' => $d->nama_provinsi,
				'Kota/Kabupaten' => $d->nama_kotkab,
				'SK Jabatan' => $d->doc_sk_terakhir != '' ? "https://ujikom-pnf.kemendikdasmen.go.id/".$d->doc_sk_terakhir : '',
				'SK Pangkat Terakhir' => $d->doc_sk_pengangkatan != '' ? "https://ujikom-pnf.kemendikdasmen.go.id/".$d->doc_sk_pengangkatan : '',
				'Pakta Integritas' => $d->doc_pakta != '' ? "https://ujikom-pnf.kemendikdasmen.go.id/".$d->doc_pakta : '',
				'PAK' => $d->doc_pak != '' ? "https://ujikom-pnf.kemendikdasmen.go.id/".$d->doc_pak : '',
				'SKP' => $d->doc_skp != '' ? "https://ujikom-pnf.kemendikdasmen.go.id/".$d->doc_skp : '',
				'Surat Usulan' => $d->doc_pengantar != '' ? "https://ujikom-pnf.kemendikdasmen.go.id/".$d->doc_pengantar : '',
				'Surat Penetapan' => $d->doc_kebutuhan != '' ? "https://ujikom-pnf.kemendikdasmen.go.id/".$d->doc_kebutuhan : '',
				'Status Pendaftaran' => $d->status_approval
			);
		}
		
		$this->output_csv($output_data, "Peserta");
		die();
		//$this->load->view('layout/layout', $output);
	}
	
	public function peserta_ukpjl()
	{
		$data = $this->peserta_model->get_all_2026_process_ukpjl(false);
		$output_data = array();
		$jf = array(
			'penilik' => "Penilik",
			'pamong_belajar' => "Pamong Belajar"
		);
		foreach($data as $d){
			$output_data[] = array(
				'Id' => $d->id,
				'Nama Verifikator' => $d->nama_verifikator,
				'Nama' => $d->nama,
				'Email' => $d->username,
				'NIP' => $d->nip,
				'TMT Golongan' => date('d F Y', strtotime($d->tmt_golongan)),
				'JF' => $jf[$d->tipe_jabfung],
				'Jenjang' => $d->tingkat_name,
				'Golongan' => $d->golongan_name,
				'No. Handphone' => $d->handphone,
				'Instansi' => $d->instansi_name,
				'Provinsi' => $d->nama_provinsi,
				'Kota/Kabupaten' => $d->nama_kotkab,
				'SK Jabatan' => $d->doc_sk_terakhir != '' ? "https://ujikom-pnf.kemendikdasmen.go.id/".$d->doc_sk_terakhir : '',
				'Scan ijazah' => $d->doc_ijazah != '' ? "https://ujikom-pnf.kemendikdasmen.go.id/".$d->doc_ijazah : '',
				
				'SK Pangkat Terakhir' => $d->doc_sk_pengangkatan != '' ? "https://ujikom-pnf.kemendikdasmen.go.id/".$d->doc_sk_pengangkatan : '',
				'Pakta Integritas' => $d->doc_pakta != '' ? "https://ujikom-pnf.kemendikdasmen.go.id/".$d->doc_pakta : '',
				'SKP' => $d->doc_skp != '' ? "https://ujikom-pnf.kemendikdasmen.go.id/".$d->doc_skp : '',
				'Surat Usulan' => $d->doc_pengantar != '' ? "https://ujikom-pnf.kemendikdasmen.go.id/".$d->doc_pengantar : '',
				'Surat Penetapan' => $d->doc_kebutuhan != '' ? "https://ujikom-pnf.kemendikdasmen.go.id/".$d->doc_kebutuhan : '',
				'Surat Keterangan' => $d->doc_sertifikat != '' ? "https://ujikom-pnf.kemendikdasmen.go.id/".$d->doc_sertifikat : '',
				'Status Pendaftaran' => $d->status_approval
			);
		}
		
		$this->output_csv($output_data, "Peserta");
		die();
		//$this->load->view('layout/layout', $output);
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
		$output['customjs'] = array('jquery.ui.widget.js', 'jquery.iframe-transport.js', 'jquery.fileupload.js', 'upload_kegiatan.js');
		$this->load->view('layout/layout', $output);
	}

    
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */