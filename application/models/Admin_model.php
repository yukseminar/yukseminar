<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin_model extends CI_Model
{
		public function getRequestSeminar()
		{
	      $this->db->order_by("id_seminar", "desc");
	      return $this->db->get_where('tseminar', array('status'=> '0'))->result_array();
		}

		public function getAllUser()
		{
	      
	      	$query = $this->db->query("select r.*, count(a.id_seminar) as seminar, count(b.id_peserta) as peserta
				from tuser r
				left outer join tseminar a on r.id_user = a.id_user 
				left outer join tpeserta b on r.id_user = b.id_user
				WHERE role_user = 'user'
				group by r.id_user ORDER BY created_at DESC ");
	      	return $query->result_array();
		}

		public function getRequestSeminarJumlah()
		{
	      $this->db->order_by("id_seminar", "desc");
	      return $this->db->get_where('tseminar', array('status'=> '0'))->num_rows();
		}

		public function getSeminarDitolak(){
			$this->db->order_by("id_seminar", "desc");
	     	return $this->db->get_where('tseminar', array('status'=> '2'))->result_array();
		}

		public function tolakSeminar($id_seminar, $keterangan){
			$this->db->set('keterangan', $keterangan);
			$this->db->set('selesai_seminar', '1');
			$this->db->set('status', '2');
			$this->db->where('id_seminar', $id_seminar);
    		$this->db->update('tseminar');
    		$row = $this->db->affected_rows();
    		return $row;
		}

		public function terimaSeminar($id_seminar){
			$this->db->set('selesai_seminar', '0');
			$this->db->set('status', '1');
			$this->db->where('id_seminar', $id_seminar);
    		$this->db->update('tseminar');
    		$row = $this->db->affected_rows();
    		return $row;
		}

		public function getuserbyid($iduser){
			$data = $this->db->get_where('tuser',['id_user' => $iduser])->row_array();
        	return $data;
		}

		public function getAllSeminar(){
			$this->db->order_by("created_at", "desc");
			$this->db->select('a.*, b.nama_user'); // <-- There is never any reason to write this line!
			$this->db->from('tseminar a');
			$this->db->join('tuser b', 'a.id_user = b.id_user', 'left');
			$this->db->limit(5);
			$seminar = $this->db->get();
			$data = $seminar->result_array();
			return $data;
		}

		public function getAllUser2()
		{
	      
	      	$this->db->order_by("created_at", "desc");
			$this->db->select('*'); // <-- There is never any reason to write this line!
			$this->db->from('tuser');
			$this->db->limit(5);
			$seminar = $this->db->get();
			$data = $seminar->result_array();
			return $data;
		}
}
