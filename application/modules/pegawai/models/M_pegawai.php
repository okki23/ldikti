<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_pegawai extends Parent_Model
{

     var $nama_tabel = 'm_pegawai';
     var $daftar_field = array('id', 'id_lokasi', 'npp', 'nama_pegawai', 'foto');
     var $primary_key = 'id';


     public function __construct()
     {
          parent::__construct();
          $this->load->database();
     }
     public function fetch_pegawai()
     {
          $sql = "select a.*,b.nama_jabatan,b.eselon from m_pegawai a
               LEFT JOIN m_jabatan b on b.id = a.id_jabatan";

          $getdata = $this->db->query($sql)->result();
          $data = array();
          $no = 1;
          foreach ($getdata as $row) {
               $sub_array = array();
               $sub_array[] = $no;
               $sub_array[] = $row->nip;
               $sub_array[] = $row->nama;
               $sub_array[] = $row->nama_jabatan;
               $sub_array[] = $row->jk;


               $sub_array[] = '
               <a href="javascript:void(0)" id="detail" class="btn btn-xs btn-primary waves-effect" onclick="Detail(' . $row->id . ');" > <i class="material-icons">aspect_ratio</i> Detail </a>  &nbsp; 
               <a href="javascript:void(0)" class="btn btn-warning btn-xs waves-effect" id="edit" onclick="Ubah_Data(' . $row->id . ');" > <i class="material-icons">create</i> Ubah </a>  &nbsp; 
               <a href="javascript:void(0)" id="delete" class="btn btn-danger btn-xs waves-effect" onclick="Hapus_Data(' . $row->id . ');" > <i class="material-icons">delete</i> Hapus </a>';


               $data[] = $sub_array;
               $no++;
          }

          return $output = array("data" => $data);
     }

     public function fetch_jabatan()
     {

          $getdata = $this->db->get('m_jabatan')->result();
          $data = array();

          foreach ($getdata as $row) {
               $sub_array = array();

               $sub_array[] = $row->nama_jabatan;
               $sub_array[] = $row->eselon;
               $sub_array[] = $row->id;

               $data[] = $sub_array;
          }

          return $output = array("data" => $data);
     }
}
