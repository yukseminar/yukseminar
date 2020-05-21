<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Seminar_model extends CI_Model
{

	public function getSeminarMore()
	{
		$limit = 1 ;
		$this->db->order_by("id_seminar", "desc");
		$this->db->limit($limit,0);
		$data['seminar'] = $this->db->get_where('tseminar', array('buka_pendaftaran' => 1, 'selesai_seminar' => 0,'status' => 1))->result_array();
		$data['halaman'] = 1;
		return $data;
	}

	public function getSeminarMoreNext($next)
	{
		$limit = 1 ;
		$next = $next +1;
		$awalData = ($limit * $next) - $limit ;
		$this->db->order_by("id_seminar", "desc");
		$this->db->limit($limit,$awalData);
		$data['seminar'] = $this->db->get_where('tseminar', array('buka_pendaftaran' => 1, 'selesai_seminar' => 0,'status' => 1))->result_array();
		$data['halaman'] = $next;
		return $data;
	}

	public function getKategori()
	{
		$data = $this->db->get_where('tkategori')->result_array();
		return $data;
	}

	public function updateSeminar($dataform, $url)
	{
		$this->db->where('url_seminar', $url);
		$this->db->update('tseminar', $dataform);
		$row = $this->db->affected_rows();
		return $row;
	}


	public function cekPengawas($idseminar)
	{
		$this->db->select('*'); // <-- There is never any reason to write this line!
		$this->db->from('tuser');
		$this->db->where('pengawas_seminar', $idseminar);
		$seminar = $this->db->get();
		$data = $seminar->result_array();
		return $data;
	}

	public function cekPunyaUserBukan($idseminar,$iduser)
	{
		$this->db->select('*'); // <-- There is never any reason to write this line!
		$this->db->from('tseminar');
		$this->db->where('id_seminar', $idseminar);
		$this->db->where('id_user', $iduser);
		$seminar = $this->db->get();
		$data = $seminar->result_array();
		return $data;
	}

	public function daftarPeserta($id){
		$this->db->select('*'); // <-- There is never any reason to write this line!
		$this->db->from('tpeserta a, tuser b');
		$this->db->where('a.id_seminar', $id);
		$this->db->where('a.id_user = b.id_user');
		$seminar = $this->db->get();
		$data = $seminar->result_array();
		return $data;
	}
	
	public function cekPromo($id_seminar){
		$this->db->select('*'); // <-- There is never any reason to write this line!
		$this->db->from('tpeserta a, tuser b');
		$this->db->where('a.id_seminar', $id_seminar);
		$this->db->where('a.id_user = b.id_user');
		$seminar = $this->db->get();
		$data = $seminar->result_array();
		return $data;
	}





	public function riwayatSeminar($id){
		$this->db->select('*'); // <-- There is never any reason to write this line!
		$this->db->from('tseminar a');
		$this->db->where('a.id_user', $id);
		$this->db->where('a.selesai_seminar', 1);
		$seminar = $this->db->get();
		$data['riwayatseminar'] = $seminar->result_array();
		$data['jumlah_riwayat_seminar'] = count($data['riwayatseminar']);
		return $data;
	}


	public function seminarSelesai($id){
		$this->db->select('*'); // <-- There is never any reason to write this line!
		$this->db->from('tpeserta a');
		$this->db->where('a.id_seminar', $id);
		$this->db->where('a.hadir', '1');
		$seminar = $this->db->get();
		$jumlah = count($seminar->result_array());

		$this->db->set('total_peserta', $jumlah);
		$this->db->set('selesai_seminar', 1);
		$this->db->where('id_seminar', $id);
		$this->db->update('tseminar');
		if ($this->db->affected_rows()>0) {
			return true;
		}else{
			return false;
		}
	}

	public function tutupbukaPendaftaran($url,$status){
		$this->db->set('buka_pendaftaran', $status);
		$this->db->where('url_seminar', $url);
		$this->db->update('tseminar');

		$this->db->select('*'); // <-- There is never any reason to write this line!
		$this->db->from('tseminar a');
		$this->db->where('a.url_seminar', $url);
		$seminar = $this->db->get();
		$data = $seminar->row_array();
		return $data;
	}

	public function SeminarDibuat($id){
		$this->db->select('a.*, b.id_user AS id_pengawas'); // <-- There is never any reason to write this line!
		$this->db->from('tseminar a');
		$this->db->join('tuser b', 'a.id_seminar = b.pengawas_seminar', 'left');
		$this->db->where('a.id_user', $id);
		$this->db->where('a.selesai_seminar', 0);
		$seminar = $this->db->get();
		$data['seminardibuat'] = $seminar->result_array();
		$data['jumlah_seminar_dibuat'] = count($data['seminardibuat']);
		return $data;
	}

	public function SeminarDihadiri($id){
		$this->db->select('b.poster, a.id_peserta, b.nama_seminar, b.jadwal, b.tempat_seminar, a.hadir'); // <-- There is never any reason to write this line!
		$this->db->from('tpeserta a, tseminar b, tuser c');
		$this->db->where('a.id_seminar = b.id_seminar');
		$this->db->where('a.konfirmasi_peserta', 1);
		$this->db->where('a.id_user', $id);
		$this->db->where('a.id_user = c.id_user');
		$seminar = $this->db->get();
		$data['seminardihadiri'] = $seminar->result_array();
		$data['jumlah_seminar_dihadiri'] = count($data['seminardihadiri']);
		return $data;
	}


	public function getMySeminar($id){
		$this->db->select('*'); // <-- There is never any reason to write this line!
		$this->db->from('tseminar a, tpeserta b');
		$this->db->where('b.id_user', $id);
		$this->db->where('b.hadir', null);
		$this->db->where('a.id_seminar = b.id_seminar');
		$seminar = $this->db->get();
		$data['seminarku'] = $seminar->result_array();
		$data['jumlah_seminar_diikuti'] = count($data['seminarku']);
		return $data;
	}

	public function getMySeminar2($id_seminar, $id_user){
		$this->db->select('*'); // <-- There is never any reason to write this line!
		$this->db->from('tseminar a, tpeserta b');
		$this->db->where('b.id_seminar', $id_seminar);
		$this->db->where('b.id_user', $id_user);
		$this->db->where('b.hadir', null);
		$this->db->where('a.id_seminar = b.id_seminar');
		$seminar = $this->db->get();
		$data['seminarku'] = $seminar->result_array();
		return $data;
	}

	public function getIDPemilik($id_seminar){
		$this->db->select('*'); 
		$this->db->from('tseminar');
		$this->db->where('id_seminar', $id_seminar);
		$seminar = $this->db->get();
		$data = $seminar->row_array();
		return $data;
	}




	public function getDataSeminar()
	{
		$this->db->order_by("id_seminar", "desc");
			return $this->db->get_where('tseminar', array('buka_pendaftaran' => 1, 'selesai_seminar' => 0,'status' => 1),1)->row_array();
	}

	public function getAllDataSeminar()
	{
		$jumlahDataPerhalaman = 8;
		$JmlTotalSeminar = $this->db->get_where('tseminar', array('buka_pendaftaran' => 1, 'selesai_seminar' => 0,'status' => 1));
		$jumlahData = $JmlTotalSeminar->num_rows();
		$jumlahHalaman = ceil($jumlahData / $jumlahDataPerhalaman);
		if (!isset($_GET["p"])) {
			$halamanAktif = 1;
		}else {
			$halamanAktif = $_GET["p"];
		}
				// RUMUS
		$awalData = ($jumlahDataPerhalaman * $halamanAktif) - $jumlahDataPerhalaman ;
		// var_dump($awalData);
		if (isset($_GET["s"])){
			$seminar = $_GET["s"];
			$this->db->order_by("id_seminar", "desc");
			$this->db->limit($jumlahDataPerhalaman,$awalData);
			$data['data_seminar'] = $this->db->get_where('tseminar', array('buka_pendaftaran' => 1, 'selesai_seminar' => 0,'status' => 1, 'nama_seminar'=> $seminar))->result_array();
			$data['jumlah_halaman'] = $jumlahHalaman;
			$data['halaman_aktif'] = $halamanAktif;
		}else {
			$this->db->order_by("id_seminar", "desc");
			$this->db->limit($jumlahDataPerhalaman,$awalData);
			$data['data_seminar'] = $this->db->get_where('tseminar', array('buka_pendaftaran' => 1, 'selesai_seminar' => 0,'status' => 1))->result_array();
			$data['jumlah_halaman'] = $jumlahHalaman;
			$data['halaman_aktif'] = $halamanAktif;
		}
		return $data;
	}



	public function getDataSeminarById($url)
	{
		$data = $this->db->get_where('tseminar',['url_seminar' => $url])->row_array();
		return $data;
	}

	public function getDataSeminarById2($id)
	{
		$data = $this->db->get_where('tseminar',['id_seminar' => $id])->row_array();
		return $data;
	}


	public function cekikutSeminar($id_seminar,$id_user)
	{
		return $this->db->get_where('tpeserta', array('id_seminar' => $id_seminar, 'id_user' => $id_user))->num_rows();
	}

	public function kurangkuota($id_seminar)
	{
		return $this->db->get_where('tpeserta', array('id_seminar' => $id_seminar))->num_rows();
	}

	public function recentSeminar($limit,$offset)
	{
			$data = $this->db->order_by("id_seminar", "desc");
			$data = $this->db->get_where('tseminar', array('status'=> '1', 'buka_pendaftaran' => '1'), $limit, $offset)->result_array();
			return $data;
	}

	public function createSeminar($data){
		$this->db->insert('tseminar', $data);
		// return ($this->db->affected_rows() != 1) ? false : true
		return true;
	}


}
