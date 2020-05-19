<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin_model extends CI_Model
{
		public function getRequestSeminar()
		{
	      $this->db->order_by("id_seminar", "desc");
	      return $this->db->get_where('tseminar', array('status'=> '0'))->result_array();
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
}
