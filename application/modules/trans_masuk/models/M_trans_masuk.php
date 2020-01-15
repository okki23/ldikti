<?php
defined('BASEPATH') or exit('No direct script access allowed');


class M_trans_masuk extends Parent_Model
{

   var $nama_tabel = 't_surat_masuk';
   var $daftar_field = array('id', 'id_jenis_surat', 'no_surat', 'tanggal_masuk', 'pic','disposisi','file','date_insert');
   var $primary_key = 'id'; 
   public function __construct()
   {
      parent::__construct();
      $this->load->database();
   }
   public function fetch_trans_masuk()
   {
      $getdata = $this->db->query("select a.*,b.nama from m_trans_masuk a
LEFT JOIN m_pegawai b on b.id = a.id_pegawai")->result();
      $data = array();
      $no = 1;
      foreach ($getdata as $row) {
         $sub_array = array();
         $sub_array[] = $no;
         $sub_array[] = $row->trans_masukname;
         $sub_array[] = $row->nama;



         $sub_array[] = '<a href="javascript:void(0)" class="btn btn-warning btn-xs waves-effect" id="edit" onclick="Ubah_Data(' . $row->id . ');" > <i class="material-icons">create</i> Ubah </a>  &nbsp; <a href="javascript:void(0)" id="delete" class="btn btn-danger btn-xs waves-effect" onclick="Hapus_Data(' . $row->id . ');" > <i class="material-icons">delete</i> Hapus </a>';

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
}
