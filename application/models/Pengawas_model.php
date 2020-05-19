<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengawas_model extends CI_Model
{
  public function getDataPeserta($idseminar)
  {
    $this->db->select('b.id_peserta, b.id_user, b.promo, b.id_seminar, c.nama_user, c.universitas, c.jurusan, c.nim_user,a.paper, a.pembayaran, b.paper_peserta, b.pembayaran_peserta, b.konfirmasi_peserta, b.rekening_user, b.an_user, a.harga_umum, a.harga_seminar, c.phone_user');
    $this->db->from('tseminar a, tpeserta b, tuser c');
    $this->db->where('a.id_seminar', $idseminar);
    $this->db->where('b.id_seminar', $idseminar);
    $this->db->where('a.id_seminar = b.id_seminar');
    $this->db->where('b.id_user = c.id_user');
    $seminar = $this->db->get();
    $data = $seminar->result_array();
    return $data;
  }

  public function getPesertaById($idpeserta)
  {
    $this->db->select('*'); // <-- There is never any reason to write this line!
    $this->db->from('tpeserta a, tuser b');
    $this->db->where('id_peserta', $idpeserta);
    $this->db->where('a.id_user = b.id_user');
    $seminar = $this->db->get();
    $data = $seminar->result_array();
    return $data;
  }

  public function confirmPeserta($idpeserta)
  {
    $this->db->set('konfirmasi_peserta', 1);
    $this->db->where('id_peserta', $idpeserta);
    $this->db->update('tpeserta');
    if ($this->db->affected_rows()>0) {
      return true;
    }else{
      return false;
    }
  }


}
?>
