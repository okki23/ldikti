<?php
defined('BASEPATH') or exit('No direct script access allowed');


class M_report_surat_keluar extends Parent_Model
{

   var $nama_tabel = 't_surat_keluar'; 
	var $daftar_field = array('id',	'id_jenis_surat','no_surat','nama_penerima','alamat_penerima','telp_penerima','tanggal_keluar','pic','file','date_update');
	var $primary_key = 'id';

   public function __construct()
   {
      parent::__construct();
      $this->load->database();
   }
   public function fetch_report_surat_keluar()
   {
      $getdata = $this->db->query("select a.*,b.jenis_surat,c.nama as picname,d.nip,d.nama as pdisposisi,e.nama_jabatan,e.eselon from t_surat_masuk a
      left join m_jenis_surat b on b.id = a.id_jenis_surat
      LEFT JOIN m_pegawai c on c.id = a.pic
      LEFT JOIN m_pegawai d on d.id = a.disposisi
      LEFT JOIN m_jabatan e on e.id = d.id_jabatan")->result();
      $data = array();
      $no = 1;
      foreach ($getdata as $row) {
         $sub_array = array(); 
         $sub_array[] = $row->no_surat;
         $sub_array[] = tanggalan($row->tanggal_masuk);
         $sub_array[] = $row->jenis_surat;
         $sub_array[] = $row->nip.' - '.$row->pdisposisi.' - '.$row->nama_jabatan.' - '.$row->eselon;



         $sub_array[] = ' <a href="javascript:void(0)" id="delete" class="btn btn-success btn-xs waves-effect" onclick="Show_Detail(' . $row->no_surat . ');" > <i class="material-icons">aspect_ratio</i> Detail </a> &nbsp;
                           <a href="javascript:void(0)" class="btn btn-warning btn-xs waves-effect" id="edit" onclick="Ubah_Data(' . $row->no_surat . ');" > <i class="material-icons">create</i> Ubah </a>  &nbsp;
                         <a href="javascript:void(0)" id="delete" class="btn btn-danger btn-xs waves-effect" onclick="Hapus_Data(' . $row->no_surat . ');" > <i class="material-icons">delete</i> Hapus </a>';

         $data[] = $sub_array;
         $no++;
      }

      return $output = array("data" => $data);
   }

   public function fetch_pegawai()
   {
      $sql = "select a.*,b.nama_jabatan,b.eselon from m_pegawai a
    LEFT JOIN m_jabatan b on b.id = a.id_jabatan";
      $getdata = $this->db->query($sql)->result();
      $data = array();

      foreach ($getdata as $row) {
         $sub_array = array();


         $sub_array[] = $row->nama;
         $sub_array[] = $row->nama_jabatan;
         $sub_array[] = $row->eselon;
         $sub_array[] = $row->id;


         $data[] = $sub_array;
      }

      return $output = array("data" => $data);
   }

   public function fetch_jenis_surat()
   { 
      $getdata = $this->db->get('m_jenis_surat')->result();
      $data = array();

      foreach ($getdata as $row) {
         $sub_array = array();


         $sub_array[] = $row->jenis_surat; 
         $sub_array[] = $row->id;


         $data[] = $sub_array;
      }

      return $output = array("data" => $data);
   }


   public function get_no(){
      $query = $this->db->query("SELECT SUBSTR(MAX(no_surat),-7) AS id  FROM t_surat_masuk"); 
      return $query;
   }
}
