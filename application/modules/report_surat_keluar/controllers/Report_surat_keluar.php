<?php
defined('BASEPATH') or exit('No direct script access allowed');


class report_surat_keluar extends Parent_Controller
{

	var $nama_tabel = 't_surat_keluar'; 
	var $daftar_field = array('id',	'id_jenis_surat','no_surat','nama_penerima','alamat_penerima','telp_penerima','tanggal_keluar','pic','file','date_update');
	var $primary_key = 'id';


	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_report_surat_keluar');
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
		$data['konten'] = 'report_surat_keluar/report_surat_keluar_view';
		$this->load->view('template_view', $data);
	}
	 

	public function fetch_report_surat_keluar()
	{
		$getdata = $this->m_report_surat_keluar->fetch_report_surat_keluar();
		echo json_encode($getdata);
	}

	public function process_report(){
		$from = $this->input->post('from');
		$to = $this->input->post('to');
		$db = $this->db->query('select a.*,b.jenis_surat from t_surat_keluar a
		left join m_jenis_surat b on b.id = a.id_jenis_surat where tanggal_keluar BETWEEN "'.$from.'" AND "'.$to.'" ')->result();

		$filename ="Laporan_Surat_Keluar_".str_replace(" ","_",$from)."_".str_replace(" ","_",$to).".xls";
		header('Content-type: application/ms-excel');
		header('Content-Disposition: attachment; filename='.$filename);
		
		echo ' 
		<table width="100%" border="1" cellpadding="3" cellspacing="0"> 
		<tr>
		<td colspan="8" style="text-align:center; font-weight:bold;"> Laporan Surat Keluar '.tanggalan($from).' - '.tanggalan($to).'</td>
		</tr>
		<tr> 
			<th> No Surat  </th>
			<th> Jenis Surat</th>
			<th> Penerima </th>
			<th> Alamat Penerima</th> 
			<th> Telp Penerima</th> 
			<th> Tanggal Keluar</th> 
			<th> PIC </th> 
			<th> File </th> 
		</tr>';
		foreach($db as $key=>$value){
			echo "<tr> 
			<td>'".$value->no_surat."</td>
			<td>".$value->jenis_surat."</td>
			<td>".$value->nama_penerima."</td>
			<td>".$value->alamat_penerima."</td> 
			<td>'".$value->telp_penerima."</td> 
			<td>".tanggalan($value->tanggal_keluar)."</td> 
			<td>".$value->pic."</td> 
			<td>".$value->file."</td> 
			</tr>";
		}
		
	}

	
 
}
