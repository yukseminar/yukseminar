<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends CI_Model
{
		public function createUser($data){
			$this->db->insert('tuser', $data);
			if ($this->db->affected_rows()>0) {
				return true;
			}else{
				return false;
			}
		}

		public function getDataUser($email)
		{
				$data = $this->db->get_where('tuser', ['email_user' => $email])->row_array();
				return $data;
		}

		public function getDataUserById($id){
			$data = $this->db->get_where('tuser', ['id_user' => $id])->row_array();
			return $data;
		}

		public function editbio($email,$datauser){
	    	$this->db->where('email_user', $email);
	        $this->db->update('tuser', $datauser);
	        $row = $this->db->affected_rows();
	        return $row;
    	}
}
