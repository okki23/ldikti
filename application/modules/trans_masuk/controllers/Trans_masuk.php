<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Trans_masuk extends Parent_Controller
{

	var $nama_tabel = 'm_trans_masuk_pegawai';
	var $daftar_field = array('id', 'id_pegawai', 'trans_masukname', 'password', 'level');
	var $primary_key = 'id';

	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_trans_masuk');
		if (!$this->session->trans_masukdata('username')) {
			echo "<script language=javascript>
				 alert('Anda tidak berhak mengakses halaman ini!');
				 window.location='" . base_url('login') . "';
				 </script>";
		}
	}


	public function index()
	{
		$data['judul'] = $this->data['judul'];
		$data['konten'] = 'trans_masuk/trans_masuk_view';
		$this->load->view('template_view', $data);
	}


	public function fetch_trans_masuk()
	{
		$getdata = $this->m_trans_masuk->fetch_trans_masuk();
		echo json_encode($getdata);
	}

	public function fetch_pegawai()
	{
		$getdata = $this->m_trans_masuk->fetch_pegawai();
		echo json_encode($getdata);
	}
	public function get_data_edit()
	{
		$id = $this->uri->segment(3);
		$get = $this->db->query("select a.*,b.nama from m_trans_masuk a
LEFT JOIN m_pegawai b on b.id = a.id_pegawai  WHERE a.id = '" . $id . "' ")->row();
		echo json_encode($get, TRUE);
	}


	public function hapus_data()
	{
		$id = $this->uri->segment(3);

		$sqlhapus = $this->m_trans_masuk->hapus_data($id);

		if ($sqlhapus) {
			$result = array("response" => array('message' => 'success'));
		} else {
			$result = array("response" => array('message' => 'failed'));
		}

		echo json_encode($result, TRUE);
	}

	public function simpan_data_trans_masuk()
	{
		$data_form = $this->m_trans_masuk->array_from_post(array('id', 'id_pegawai', 'trans_masukname', 'password', 'level'));
		$id = $data_form['id'];

		//apabila trans_masuk id kosong maka input data baru
		if ($id == '' || empty($id)) {

			return $this->db->query("insert into m_trans_masuk set id_pegawai = '" . $data_form['id_pegawai'] . "', level = '" . $data_form['level'] . "', trans_masukname = '" . $data_form['trans_masukname'] . "', password = '" . base64_encode($data_form['password']) . "' ");


			//apabila trans_masuk id tersedia maka update data
		} else {

			if ($data_form['password'] == '' || empty($data_form['password'])) {

				return $this->db->query("update m_trans_masuk set id_pegawai = '" . $data_form['id_pegawai'] . "',level = '" . $data_form['level'] . "', trans_masukname = '" . $data_form['trans_masukname'] . "' where id = '" . $id . "' ");
			} else {

				return $this->db->query("update m_trans_masuk set id_pegawai = '" . $data_form['id_pegawai'] . "', level = '" . $data_form['level'] . "', trans_masukname = '" . $data_form['trans_masukname'] . "',password = '" . base64_encode($data_form['password']) . "'   where id = '" . $id . "' ");
			}
		}
	}
}
