<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("kategori_model");
        $this->load->model("user_model");
        $this->load->model("admin_model");
        $this->load->model("seminar_model");
    }




    public function index(){
      $data['user'] = $this->user_model->getDataUser($this->session->userdata('email'));
      if ($data['user']['role_user'] == 'admin') {
        $data['title'] = 'Dashboard';
        $data['getrequestseminarjumlah'] = $this->admin_model->getRequestSeminarJumlah();
        $data['getallseminar'] = $this->admin_model->getAllSeminar();
        $data['getalluser'] = $this->admin_model->getAllUser2();
        $data['getallusercount'] = $this->admin_model->getAllUserCount();
        $data['getrequestseminarjumlah'] = $this->admin_model->getRequestSeminarJumlah();
        $data['getseminartolakjumlah'] = $this->admin_model->getSeminarDitolakCount();
        $data['getseminaraktifjumlah'] = $this->admin_model->getSeminarAktifCount();

        // var_dump($data['getallusercount']);

        $this->load->view('templates/admin/header',$data);
        $this->load->view('templates/admin/topbar',$data);
        $this->load->view('templates/admin/sidebar',$data);
        $this->load->view('admin/index',$data);
        $this->load->view('templates/admin/footer');
      }else if ($data['user']['role_user'] == 'pengawas') {
        redirect(base_url('pengawas'));
      }else{
        redirect(base_url());
      }
    }

    public function tolakSeminar(){
      $keterangan = $this->input->post('keterangan');
      $id_seminar = $this->input->post('id_seminar');
      $data['user'] = $this->user_model->getDataUser($this->session->userdata('email'));
      if ($data['user']['role_user'] == 'admin') {
            $result = $this->admin_model->tolakSeminar($id_seminar, $keterangan);
            if ($result) {
                $this->session->set_flashdata('message', 'Seminar telah ditolak!');
                redirect('admin/requestseminar');
            }
            
      }else if ($data['user']['role_user'] == 'pengawas') {
        redirect(base_url('pengawas'));
      }else{
        redirect(base_url());
      }
    }

    public function terimaSeminar($id_seminar){
      $data['user'] = $this->user_model->getDataUser($this->session->userdata('email'));
      if ($data['user']['role_user'] == 'admin') {
            $result = $this->admin_model->terimaSeminar($id_seminar);
            if ($result) {
                $this->session->set_flashdata('message', 'Seminar berhasil diterima!');
                redirect('admin/requestseminar');
            }
            
      }else if ($data['user']['role_user'] == 'pengawas') {
        redirect(base_url('pengawas'));
      }else{
        redirect(base_url());
      }
    }

    public function kategori(){
      $data['user'] = $this->user_model->getDataUser($this->session->userdata('email'));
      if ($data['user']['role_user'] == 'admin') {
        $data['title'] = 'Kategori';
        $data['kategori'] = $this->kategori_model->selectAllKategori();
        $data['getrequestseminarjumlah'] = $this->admin_model->getRequestSeminarJumlah();
        $this->load->view('templates/admin/header',$data);
        $this->load->view('templates/admin/topbar',$data);
        $this->load->view('templates/admin/sidebar',$data);
        $this->load->view('admin/kategori',$data);
        $this->load->view('templates/admin/footer');
      }else if ($data['user']['role_user'] == 'pengawas') {
        redirect(base_url('pengawas'));
      }else{
        redirect(base_url());
      }
    }

    public function tambahkategori(){
      $data['user'] = $this->user_model->getDataUser($this->session->userdata('email'));
      if ($data['user']['role_user'] == 'admin') {

        $this->form_validation->set_rules('nama_kategori', 'Nama Kategori', 'required|is_unique[tkategori.nama_kategori]');
        if ($this->form_validation->run() == false) {
          $data['title'] = 'Kategori';
          $data['kategori'] = $this->kategori_model->selectAllKategori();
          $data['getrequestseminarjumlah'] = $this->admin_model->getRequestSeminarJumlah();
          $this->load->view('templates/admin/header',$data);
          $this->load->view('templates/admin/topbar',$data);
          $this->load->view('templates/admin/sidebar',$data);
          $this->load->view('admin/kategori',$data);
          $this->load->view('templates/admin/footer');

          //kasih js
        }else{
          $data_kategori = [
              'nama_kategori' => $this->input->post('nama_kategori')
          ];
          $result = $this->kategori_model->insertKategori($data_kategori);
          $this->session->set_flashdata('message', 'Kategori berhasil ditambahkan!');
          redirect('admin/kategori');
        }

      }else if ($data['user']['role_user'] == 'pengawas') {
        redirect(base_url('pengawas'));
      }else{
        redirect(base_url());
      }
    }

    public function ubahKategori(){
      $data['user'] = $this->user_model->getDataUser($this->session->userdata('email'));
      if ($data['user']['role_user'] == 'admin') {

        $this->form_validation->set_rules('nama_kategori', 'Nama Kategori', 'required');
        if ($this->form_validation->run() == false) {
          $data['title'] = 'Kategori';
          $data['kategori'] = $this->kategori_model->selectAllKategori();
          $data['getrequestseminarjumlah'] = $this->admin_model->getRequestSeminarJumlah();
          $this->load->view('templates/admin/header',$data);
          $this->load->view('templates/admin/topbar',$data);
          $this->load->view('templates/admin/sidebar',$data);
          $this->load->view('admin/kategori',$data);
          $this->load->view('templates/admin/footer');

          //kasih js
        }else{
          $id_kategori = $this->input->post('id_kategori');
          $data_kategori = [
              'nama_kategori' => $this->input->post('nama_kategori'),
              'updated_at' => date("Y-m-d h:i:s")
          ];
          $result = $this->kategori_model->updateKategori($id_kategori, $data_kategori);

          if ($result) {
              $this->session->set_flashdata('message', 'Kategori berhasil diubah');
              redirect('admin/kategori');
          }else{
              $this->session->set_flashdata('message_failed', 'Kategori belum diubah');
              redirect('admin/kategori');
            }
        }

      }else if ($data['user']['role_user'] == 'pengawas') {
        redirect(base_url('pengawas'));
      }else{
        redirect(base_url());
      }
    }

    public function hapusKategori($id_kategori) {
      $this->kategori_model->deleteKategori($id_kategori);
      $this->session->set_flashdata('message', 'Kategori berhasil dihapus');
      redirect('admin/kategori');
    }

    public function requestSeminar(){
      $data['title'] = 'Request Seminar';
      $data['requestSeminar'] = $this->admin_model->getRequestSeminar();
      $data['getrequestseminarjumlah'] = $this->admin_model->getRequestSeminarJumlah();

        $this->load->view('templates/admin/header',$data);
        $this->load->view('templates/admin/topbar',$data);
        $this->load->view('templates/admin/sidebar',$data);
        $this->load->view('admin/requestseminar',$data);
        $this->load->view('templates/admin/footer', $data);
    }
    

    public function seminarTolak(){
      $data['title'] = 'Seminar ditolak';
      $data['seminarditolak'] = $this->admin_model->getSeminarDitolak();
      $data['getrequestseminarjumlah'] = $this->admin_model->getRequestSeminarJumlah();

        $this->load->view('templates/admin/header',$data);
        $this->load->view('templates/admin/topbar',$data);
        $this->load->view('templates/admin/sidebar',$data);
        $this->load->view('admin/seminarditolak',$data);
        $this->load->view('templates/admin/footer', $data);
    }

    public function getDetailSeminar(){
        $id = $this->input->post('id');
        $data = $this->seminar_model->getDataSeminarById2($id);
        echo json_encode($data);
    }

    public function datauser(){
        $data['title'] = 'Data User';
        $data['getrequestseminarjumlah'] = $this->admin_model->getRequestSeminarJumlah();
        $data['getalluser'] = $this->admin_model->getAllUser();
        // var_dump($data['getalluser']);
        $this->load->view('templates/admin/header',$data);
        $this->load->view('templates/admin/topbar',$data);
        $this->load->view('templates/admin/sidebar',$data);
        $this->load->view('admin/datauser',$data);
        $this->load->view('templates/admin/footer', $data);
    }

    public function getUserById(){
      $iduser = $this->input->post('id');
      
      $data = $this->admin_model->getuserbyid($iduser);
      echo json_encode($data);
    }

    public function seminarAktif(){
      $data['title'] = 'Seminar Aktif';
      $data['getrequestseminarjumlah'] = $this->admin_model->getRequestSeminarJumlah();
      $data['getseminaraktif'] = $this->admin_model->getSeminarAktif();
      // var_dump($data['getseminaraktif']);

      $this->load->view('templates/admin/header',$data);
      $this->load->view('templates/admin/topbar',$data);
      $this->load->view('templates/admin/sidebar',$data);
      $this->load->view('admin/seminaraktif',$data);
      $this->load->view('templates/admin/footer', $data);

    }


}
