<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Peserta_model extends CI_Model
{

  public function uploadPaper($idpeserta, $alamat){
    $this->db->set('paper_peserta', $alamat );
    $this->db->where('id_peserta', $idpeserta);
    $this->db->update('tpeserta'); 
    return true;
  }

  public function uploadBukti($idpeserta, $alamat, $rek,$an){
    $this->db->set('pembayaran_peserta', $alamat );
    $this->db->set('rekening_user', $rek );
    $this->db->set('an_user', $an );
    $this->db->where('id_peserta', $idpeserta);
    $this->db->update('tpeserta');
    return true;
  }

  public function cekSudahIkutBelum($iduser,$idseminar){
    $data = $this->db->get_where('tpeserta', ['id_seminar' => $idseminar, 'id_user' => $iduser])->row_array();
    if ($data != null) {
      return true;
    }else{
      return false;
    }

  }

  public function tambahPeserta($data){
    $this->db->insert('tpeserta', $data);
    return true;
  }

  public function absenPeserta($idpeserta){
    $this->db->set('hadir', 1);
    $this->db->where('id_peserta', $idpeserta);
    $this->db->update('tpeserta');
    if ($this->db->affected_rows()>0) {
      return true;
    }else{
      return false;
    }
  }

  public function getDetailPeserta($id_seminar, $id_peserta){

      $this->db->select('*'); // <-- There is never any reason to write this line!
      $this->db->from('tpeserta');
      $this->db->where('id_seminar', $id_seminar);
      $this->db->where('id_peserta', $id_peserta);

      $this->db->where('a.id_user = b.id_user');
      $seminar = $this->db->get();
      $data = $seminar->result_array();
      return $data;
  
  }

    public function getPesertaById($id_peserta){

      $this->db->select('*'); // <-- There is never any reason to write this line!
      $this->db->from('tpeserta');
      $this->db->where('id_peserta', $id_peserta);
      $seminar = $this->db->get();
      $data = $seminar->row_array();
      return $data;
  
  }
}
