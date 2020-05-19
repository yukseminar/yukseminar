<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kategori_model extends CI_Model
{
  public function selectAllKategori()
  {
    $data = $this->db->get_where('tkategori')->result_array();
    return $data;
  }

  public function insertKategori($data_kategori){
    $this->db->insert('tkategori', $data_kategori);
  }

  public function updateKategori($id_kategori, $data_kategori){
    $this->db->where('id_kategori', $id_kategori);
    $this->db->update('tkategori', $data_kategori);
    $row = $this->db->affected_rows();
    return $row;
  }

  public function deleteKategori($id_kategori){
    $this->db->where('id_kategori', $id_kategori);
    $this->db->delete('tkategori');
  }

  public function getKategoriById($id_kategori){
      $this->db->select('*'); // <-- There is never any reason to write this line!
      $this->db->from('tkategori');
      $this->db->where('id_kategori', $id_kategori);
      $seminar = $this->db->get();
      $data = $seminar->row_array();
      return $data;
  }
}
