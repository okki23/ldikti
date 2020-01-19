<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Report_surat_masuk extends Parent_Controller
{

	var $nama_tabel = 't_surat_masuk';
	var $daftar_field = array('id','id_jenis_surat','no_surat','pengirim','alamat_pengirim','telp_pengirim','tanggal_masuk','pic','disposisi','file','date_insert');
	var $primary_key = 'id';

	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_report_surat_masuk');
		if (!$this->session->userdata('username')) {
			echo "<script language=javascript>
				 alert('Anda tidak berhak mengakses halaman ini!');
				 window.location='" . base_url('login') . "';
				 </script>";
		}
	} 
	public function index()
	{
		$data['judul'] = $this->data['judul'];
		$data['konten'] = 'report_surat_masuk/report_surat_masuk_view';
		$this->load->view('template_view', $data);
	}
	 

	public function fetch_report_surat_masuk()
	{
		$getdata = $this->m_report_surat_masuk->fetch_report_surat_masuk();
		echo json_encode($getdata);
	}

	public function process_report(){
		$from = $this->input->post('from');
		$to = $this->input->post('to');
		$db = $this->db->query('select a.*,b.jenis_surat,c.nama as disposisiname,c.nip as disposisinip,d.nama_jabatan as disposisijabatan,d.eselon as disposisieselon from t_surat_masuk a
		left join m_jenis_surat b on b.id = a.id_jenis_surat
		left join m_pegawai c on c.id = a.disposisi 
		left join m_jabatan d on d.id = c.id_jabatan where tanggal_masuk BETWEEN "'.$from.'" AND "'.$to.'" ')->result();

		$filename ="Laporan_Surat_Masuk_".str_replace(" ","_",$from)."_".str_replace(" ","_",$to).".xls";
		header('Content-type: application/ms-excel');
		header('Content-Disposition: attachment; filename='.$filename);
		
		echo ' 
		<table width="100%" border="1" cellpadding="3" cellspacing="0"> 
		<tr>
		<td colspan="9" style="text-align:center; font-weight:bold;"> Laporan Surat Masuk '.tanggalan($from).' - '.tanggalan($to).'</td>
		</tr>
		<tr> 
			<th> No Surat  </th>
			<th> Jenis Surat</th>
			<th> Pengirim </th>
			<th> Alamat Pengirim</th> 
			<th> Telp Pengirim</th> 
			<th> Tanggal Masuk</th>
			<th> Disposisi</th>
			<th> PIC </th> 
			<th> File </th> 
		</tr>';
		foreach($db as $key=>$value){
			echo "<tr> 
			<td>'".$value->no_surat."</td>
			<td>".$value->jenis_surat."</td>
			<td>".$value->pengirim."</td>
			<td>".$value->alamat_pengirim."</td> 
			<td>'".$value->telp_pengirim."</td> 
			<td>".tanggalan($value->tanggal_masuk)."</td>
			<td>".$value->disposisiname."</td>
			<td>".$value->pic."</td> 
			<td>".$value->file."</td> 
			</tr>";
		}
		
	}

	
 
}
