<?php
defined('BASEPATH') or exit('No direct script access allowed');


class trans_keluar extends Parent_Controller
{

	var $nama_tabel = 't_surat_keluar'; 
	var $daftar_field = array('id',	'id_jenis_surat','no_surat','nama_penerima','alamat_penerima','telp_penerima','tanggal_keluar','pic','file','date_update');
	var $primary_key = 'id';

	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_trans_keluar');
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
		$data['konten'] = 'trans_keluar/trans_keluar_view';
		$this->load->view('template_view', $data);
	}
	
	function saveupload(){
	if($_FILES["file"]["name"] != ''){ 
		$location = './upload/' . str_replace(" ","_",$_FILES["file"]["name"]); 
		$lempar = move_uploaded_file(str_replace(" ","_",$_FILES["file"]["tmp_name"]), $location); 

			 if($lempar){
				$data = array("status"=>"OK","code"=>200,"message"=>"Successfully");
			 }else{
				$data = array("status"=>"NOT OK","code"=>200,"message"=>"Failed");
			 }
			 echo json_encode($data,true);
		}
	}
	public function get_last_id(){
		$params = date('Ymd');
		echo $this->transaksi_id($params); 
		$dataid = $this->transaksi_id($params); 
		//store
		$sql = "insert into t_surat_keluar (no_surat) values ('".$this->transaksi_id($params)."')";
		$this->db->query($sql); 
	}

	public function hapus_no_surat(){
		$no_surat = $this->input->post('no_surat');
		echo $no_surat;
   
		$this->db->query("delete from t_surat_keluar where no_surat = '".$no_surat."' ");
  
	  }

	public function transaksi_id($param = '') {
        $data = $this->m_trans_keluar->get_no();
        $lastid = $data->row();
        $idnya = $lastid->id;


        if($idnya == '') { // bila data kosong
            $ID = $param . "0000001";
            //00000001
        }else {
            $MaksID = $idnya;
            $MaksID++;
            if ($MaksID < 10)
                $ID = $param . "000000" . $MaksID;
            else if ($MaksID < 100)
                $ID = $param . "00000" . $MaksID;
            else if ($MaksID < 1000)
                $ID = $param . "0000" . $MaksID;
            else if ($MaksID < 10000)
                $ID = $param . "000" . $MaksID;
            else if ($MaksID < 100000)
                $ID = $param . "00" . $MaksID;
            else if ($MaksID < 1000000)
                $ID = $param . "0" . $MaksID;
            else
                $ID = $MaksID;
        }

        return $ID;
    }  	



	public function fetch_trans_keluar()
	{
		$getdata = $this->m_trans_keluar->fetch_trans_keluar();
		echo json_encode($getdata);
	}

	public function fetch_pegawai()
	{
		$getdata = $this->m_trans_keluar->fetch_pegawai();
		echo json_encode($getdata);
	}

	public function fetch_jenis_surat()
	{
		$getdata = $this->m_trans_keluar->fetch_jenis_surat();
		echo json_encode($getdata);
	}
	public function get_data_edit()
	{
		$no_surat = $this->uri->segment(3);
		$get = $this->db->query("select a.*,b.jenis_surat from t_surat_keluar a
		left join m_jenis_surat b on b.id = a.id_jenis_surat WHERE a.no_surat = '" . $no_surat . "' ")->row();
		echo json_encode($get, TRUE);
	}


	public function hapus_data()
	{
		$no_surat = $this->uri->segment(3);

		$cekfile = $this->db->where('no_surat',$no_surat)->get($this->nama_tabel)->row();  
		if($cekfile->file != '' || $cekfile->file != NULL){
          //apabila file ada maka dihapus,apabila sebaliknya maka tidak dihapus
          unlink("upload/".str_replace(" ","_",$cekfile->file));
		}   

		$sqlhapus = $this->db->where('no_surat',$no_surat)->delete($this->nama_tabel);
		 
		if ($sqlhapus) {
			$result = array("response" => array('message' => 'success'));
		} else {
			$result = array("response" => array('message' => 'failed'));
		}

		echo json_encode($result, TRUE);
	}

	public function simpan_data_trans_keluar()
	{
		$data_form = $this->m_trans_keluar->array_from_post(array('id',	'id_jenis_surat','no_surat','nama_penerima','alamat_penerima','telp_penerima','tanggal_keluar','pic','file','date_update'));
		$id = $data_form['id']; 
		return $this->db->query("update t_surat_keluar set id_jenis_surat = '" . $data_form['id_jenis_surat'] . "', tanggal_keluar = '" . $data_form['tanggal_keluar'] . "',nama_penerima = '" . $data_form['nama_penerima'] . "',alamat_penerima = '" . $data_form['alamat_penerima'] . "',telp_penerima = '" . $data_form['telp_penerima'] . "', pic = '" . $this->session->userdata('username'). "', file = '" . str_replace(" ","_",$data_form['file']). "', date_update = now() where no_surat = '" . $data_form['no_surat']."' ");
	}
}