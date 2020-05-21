<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("user_model");
        $this->load->model("Seminar_model");
        $this->load->model("peserta_model");
        $this->load->library('Ciqrcode');

    }

    public function index()
    {
        $data['title'] = 'Yukseminar.id | Aplikasi daftar dan buat seminar secara mudah dan gratis';
        $data['user'] = $this->user_model->getDataUser($this->session->userdata('email'));
        $data['tampil_seminar_baru'] = $this->Seminar_model->getDataSeminar();
        // $data['pagination'] = $this->Seminar_model->getAllDataSeminar();
        // $data['tampil_seminar'] = $data['pagination']['data_seminar'];
        // $data['halaman_aktif'] = $data['pagination']['halaman_aktif'];
        // $data['jumlah_halaman'] = $data['pagination']['jumlah_halaman'];
        $data['kategori'] = $this->Seminar_model->getKategori();
        $seminar = $this->Seminar_model->getSeminarMore();
        $data['tampil_seminar'] = $seminar['seminar'];
        $data['halaman'] = $seminar['halaman'];
        // var_dump($dataa);
        $this->load->view('templates/header_user', $data);
        $this->load->view('user/index',$data);
        $this->load->view('templates/footer_user');

        // if ($data['user']['role_user'] == 'user') {
        //
        //   $this->load->view('templates/header_user', $data);
        //   $this->load->view('user/index',$data);
        //   $this->load->view('templates/footer_user');
        //   // $jumlah= count($data['tampil_seminar']);
        //   // var_dump($data['tampil_seminar']);
        // }
        if ($data['user']['role_user'] == 'admin') {
          redirect(base_url('admin'));
        }
        if ($data['user']['role_user'] == 'pengawas') {
          redirect(base_url('pengawas'));
        }
    }

    public function moreSeminar()
    {
        $halaman = $this->input->post('halaman');
        $data = $this->Seminar_model->getSeminarMoreNext($halaman);
        if (sizeOf($data)>0) {
          echo json_encode($data);
        }else{
          echo null;
        }
    }

    public function detailQrcode(){
      // if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $data['seminar'] = $this->input->post('namaseminar');
        $data['qrcode'] = $this->input->post('qrcode');
        $this->load->view('user/qrcode',$data);
      // }else{
        // redirect(base_url());
      // }
    }

    public function absenPesertaOption($url){
      // var_dump($url);
      $data['title'] = 'Yukseminar.id | Aplikasi daftar dan buat seminar secara mudah dan gratis';
      $data['user'] = $this->user_model->getDataUser($this->session->userdata('email'));
      $data['dataseminar'] = $this->Seminar_model->getDataSeminarById($url);
      $data['cekPunyaUserBukan'] = $this->Seminar_model->cekPunyaUserBukan($data['dataseminar']['id_seminar'], $data['user']['id_user']);
      $data['url'] = $url;
      if ($data['cekPunyaUserBukan']!= null) {
        $data['daftar'] = $this->Seminar_model->daftarPeserta($data['dataseminar']['id_seminar']);
        $this->load->view('templates/header_user', $data);
        // $this->load->view('user/absenpeserta',$data);
        $this->load->view('user/absenpesertaoption',$data);
        $this->load->view('templates/footer_user');
      }else{
        redirect(base_url());
      }
    }

    public function absenPeserta($url){
      // var_dump($url);
      $data['title'] = 'Yukseminar.id | Aplikasi daftar dan buat seminar secara mudah dan gratis';
      $data['user'] = $this->user_model->getDataUser($this->session->userdata('email'));
      $data['dataseminar'] = $this->Seminar_model->getDataSeminarById($url);
      $data['cekPunyaUserBukan'] = $this->Seminar_model->cekPunyaUserBukan($data['dataseminar']['id_seminar'], $data['user']['id_user']);
      $data['url'] = $url;
      if ($data['cekPunyaUserBukan']!= null) {
        $data['daftar'] = $this->Seminar_model->daftarPeserta($data['dataseminar']['id_seminar']);
        $this->load->view('templates/header_user', $data);
        // $this->load->view('user/absenpeserta',$data);
        $this->load->view('user/absenbarcode',$data);
        $this->load->view('templates/footer_user');
      }else{
        redirect(base_url());
      }
    }

    public function absenpassword($url){
      // var_dump($url);
      $data['title'] = 'Yukseminar.id | Aplikasi daftar dan buat seminar secara mudah dan gratis';
      $data['user'] = $this->user_model->getDataUser($this->session->userdata('email'));
      $data['dataseminar'] = $this->Seminar_model->getDataSeminarById($url);
      $data['cekPunyaUserBukan'] = $this->Seminar_model->cekPunyaUserBukan($data['dataseminar']['id_seminar'], $data['user']['id_user']);
      $data['url'] = $url;
      if ($data['cekPunyaUserBukan']!= null) {
        $data['daftar'] = $this->Seminar_model->daftarPeserta($data['dataseminar']['id_seminar']);
        $this->load->view('templates/header_user', $data);
        $this->load->view('user/absenpeserta',$data);
        $this->load->view('templates/footer_user');
      }else{
        redirect(base_url());
      }
    }

    public function daftarPengawas($url){
      $data['title'] = 'Yukseminar.id | Aplikasi daftar dan buat seminar secara mudah dan gratis';
      $data['user'] = $this->user_model->getDataUser($this->session->userdata('email'));
      $data['seminar'] = $this->Seminar_model->getDataSeminarById($url);
      $data['url'] = $url;
      $cek = $this->Seminar_model->cekPunyaUserBukan($data['seminar']['id_seminar'],$data['user']['id_user']);

      if ($data['user']['role_user'] == 'user') {

        if ($cek) {
          $ceksudahada = $this->Seminar_model->cekPengawas($data['seminar']['id_seminar']);
          if ($data['seminar']['paper']==1 || $data['seminar']['pembayaran']==1 ) {
            if ($ceksudahada == null) {
              $this->load->view('templates/header_user', $data);
              $this->load->view('user/daftarpengawas',$data);
              $this->load->view('templates/footer_user');
            }else {
              redirect(base_url());
            }
          }else {
            redirect(base_url());
          }


        }else {
          redirect(base_url());
        }

      }else if ($data['user']['role_user'] == 'pengawas') {

      }else if ($data['user']['role_user'] == 'admin'){

      }else{
        redirect(base_url());
      }
    }

    public function daftarPengawasPost()
    {
      if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $data['title'] = 'Yukseminar.id | Aplikasi daftar dan buat seminar secara mudah dan gratis';
        $data['user'] = $this->user_model->getDataUser($this->session->userdata('email'));
        $data['url'] =  $this->input->post('url',true);
        $data['seminar'] = $this->Seminar_model->getDataSeminarById($data['url']);
        $pass = $this->input->post('pass',true);
        $pass2 = $this->input->post('pass2',true);

        if ($data['user']['role_user'] == 'user') {
            $this->form_validation->set_rules('username', 'Username', 'required');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[tuser.email_user]');
            $this->form_validation->set_rules('pass', 'Password', 'trim|required|min_length[3]|matches[pass2]');
            $this->form_validation->set_rules('pass2', 'Repeat Password', 'trim|required|min_length[3]|matches[pass]');

            if ($this->form_validation->run() == false) {
                $this->load->view('templates/header_user', $data);
                $this->load->view('user/daftarpengawas',$data);
                $this->load->view('templates/footer_user');
            }else{
                $enkripsi = PASSWORD_HASH($pass, PASSWORD_BCRYPT);
                $datauser = [
                    'nama_user' => $this->input->post('username',true),
                    'email_user' => $this->input->post('email',true),
                    'pass_user' => $enkripsi,
                    'is_active' => '1',
                    'pengawas_seminar' => $data['seminar']['id_seminar'],
                    'role_user' => 'pengawas',
                    'photo_user' => 'img_user/default.jpg'
                ];

                $insert = $this->user_model->createUser($datauser);
                if ($insert) {
                  $this->session->set_flashdata('message','Akun pengawas telah dibuat !');
                  redirect(base_url('user/panel'));
                }else {
                  $this->session->set_flashdata('message','Ada yang salah !');
                  redirect(base_url('user/panel'));
                }

            }
         
        }else if ($data['user']['role_user'] == 'pengawas') {

        }else if ($data['user']['role_user'] == 'admin'){

        }else{
          redirect(base_url());
        }


      }else {
        redirect(base_url());
      }
    }

    public function daftarPeserta($url){
      // var_dump($url);
      $data['title'] = 'Yukseminar.id | Aplikasi daftar dan buat seminar secara mudah dan gratis';
      $data['user'] = $this->user_model->getDataUser($this->session->userdata('email'));
      $data['dataseminar'] = $this->Seminar_model->getDataSeminarById($url);
      $data['cekPunyaUserBukan'] = $this->Seminar_model->cekPunyaUserBukan($data['dataseminar']['id_seminar'], $data['user']['id_user']);
      if ($data['user']['role_user'] == 'user') {
        if ($data['cekPunyaUserBukan']!= null) {
          $data['daftar'] = $this->Seminar_model->daftarPeserta($data['dataseminar']['id_seminar']);

          $this->load->view('templates/header_user', $data);
          $this->load->view('user/daftar_peserta',$data);
          $this->load->view('templates/footer_user');
        }else{
          redirect(base_url());
        }
      }else if ($data['user']['role_user'] == 'pengawas') {

      }else if ($data['user']['role_user'] == 'admin'){

      }else{
        redirect(base_url());
      }
    }

    public function daftarPesertaHadir($url){
      // var_dump($url);
      $data['title'] = 'Yukseminar.id | Aplikasi daftar dan buat seminar secara mudah dan gratis';
      $data['user'] = $this->user_model->getDataUser($this->session->userdata('email'));
      $data['dataseminar'] = $this->Seminar_model->getDataSeminarById($url);
      $data['cekPunyaUserBukan'] = $this->Seminar_model->cekPunyaUserBukan($data['dataseminar']['id_seminar'], $data['user']['id_user']);
      if ($data['user']['role_user'] == 'user') {
        if ($data['cekPunyaUserBukan']!= null) {
          $data['daftar'] = $this->Seminar_model->daftarPeserta($data['dataseminar']['id_seminar']);

          $this->load->view('templates/header_user', $data);
          $this->load->view('user/daftar_pesertahadir',$data);
          $this->load->view('templates/footer_user');
        }else{
          redirect(base_url());
        }
      }else if ($data['user']['role_user'] == 'pengawas') {

      }else if ($data['user']['role_user'] == 'admin'){

      }else{
        redirect(base_url());
      }
    }

    public function selesaiSeminar(){
      if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = $this->input->post('iselesai_seminar',true);
        $status = $this->Seminar_model->seminarSelesai($id);
        if ($status) {
            $this->session->set_flashdata('messageselesai','Terima kasih sudah menggunakan Yukseminar.id !');
            redirect('user/panel');
        }else{
            $this->session->set_flashdata('failedselesai','Gagal menyelesaikan seminar, coba untuk refresh halaman !');
            redirect('user/panel');
        }
      }else{
        redirect(base_url());
      }
    }

    public function absenIkutSeminar(){
      if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // $nama =  $this->input->post('nama',true);
        $url =  $this->input->post('url',true);
        $nama =  $this->input->post('nama',true);
        $email = $this->input->post('email',true);
        $pass = $this->input->post('pass',true);
        $peserta = $this->input->post('peserta',true);
        $data['user'] = $this->user_model->getDataUser($this->session->userdata('email'));

        if ($data['user']['role_user'] == 'user') {
           $data['peserta'] = $this->user_model->getDataUser($email);
            $cek = password_verify($pass, $data['peserta']['pass_user']);
            if ($cek) {
              $cekBerhasil = $this->peserta_model->absenPeserta($peserta);
              if ($cekBerhasil) {
                $this->session->set_flashdata('successabsen','Anda berhasil present !');
                redirect('user/absenpassword/'.$url);
              }else{
                $this->session->set_flashdata('failedabsen','Ada kesalahan !');
                redirect('user/absenpassword/'.$url);
              }
            }else{
              $this->session->set_flashdata('failedpass','Password yang anda masukan salah !');
              redirect('user/absenpassword/'.$url);
            }
          }else if ($data['user']['role_user'] == 'pengawas') {

        }else if ($data['user']['role_user'] == 'admin'){

        }else{
          redirect('tot');
        }
      }else{
        redirect('ddd');
      }
    }

    public function ajaxDetailSeminar(){
      if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $url = $this->input->post('url',true);
        if ($url != null) {
          $data = $this->Seminar_model->getDataSeminarById($url);
          echo json_encode($data);

        }else{
          redirect(base_url());
        }

      }else{
        redirect(base_url());
      }
    }
    


    public function ajaxDetailUser(){
      if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $id = $this->input->post('id',true);
        if ($id != null) {
          $data = $this->user_model->getDataUserById($id);
          echo json_encode($data);

        }else{
          redirect(base_url());
        }


      }else{
        redirect(base_url());
      }
    }

    public function uploadBukti(){
      if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $peserta = $this->input->post('peserta',true);
        $rek = $this->input->post('rekening',true);
        $an = $this->input->post('atasnama',true);

        $sumber = $_FILES['bukti']['tmp_name'];
        $namafile = $_FILES['bukti']['name'];

        $ekstensiGambar = explode('.',$namafile);
        $ekstensiGambar = strtolower(end($ekstensiGambar));

        $namaFileBaru = $peserta;
        $namaFileBaru .= uniqid();
        $namaFileBaru .= '.';
        $namaFileBaru .= $ekstensiGambar;


        $tujuan = "./assets/pembayaran_seminar/";  //untuk di upload
        $alamat ="pembayaran_seminar/".$namaFileBaru;  //untuk di simpan
        $alamatkosong = "";

        $config['file_name'] = $namaFileBaru;
        $config['allowed_types'] = 'jpeg|jpg|png';
        $config['max_size']      = '10240';
        $config['upload_path'] = $tujuan;

        $this->load->library('upload', $config);
        if ( ! $this->upload->do_upload('bukti'))
        {
            $this->session->set_flashdata('failedbukti','Bukti pembayaran gagal diupload!');
            redirect('user/panel');
        }
        else
        {
          $this->peserta_model->uploadBukti($peserta,$alamat,$rek,$an);
          $this->session->set_flashdata('messagebukti','Bukti pembayaran berhasil diupload!');
          redirect('user/panel');
        }


      }else{
        redirect(base_url());
      }
    }

    public function uploadPaper(){
      if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $peserta = $this->input->post('peserta',true);

        $sumber = $_FILES['paper']['tmp_name'];
        $namafile = $_FILES['paper']['name'];

        $ekstensiGambar = explode('.',$namafile);
        $ekstensiGambar = strtolower(end($ekstensiGambar));

        $namaFileBaru = $peserta;
        $namaFileBaru .= uniqid();
        $namaFileBaru .= '.';
        $namaFileBaru .= $ekstensiGambar;


        $tujuan = "./assets/paper_seminar/";  //untuk di upload
        $alamat ="paper_seminar/".$namaFileBaru;  //untuk di simpan
        $alamatkosong = "";

        $config['file_name'] = $namaFileBaru;
        $config['allowed_types'] = 'doc|docx|pdf';
        $config['max_size']      = '20480';
        $config['upload_path'] = $tujuan;

        $this->load->library('upload', $config);
        if ( ! $this->upload->do_upload('paper'))
        {
            $this->session->set_flashdata('failed','Paper gagal diupload!');

            redirect('user/panel');
        }
        else
        {
          $this->peserta_model->uploadPaper($peserta,$alamat);
          $this->session->set_flashdata('message','Paper berhasil diupload!');
          redirect('user/panel');
        }

        // var_dump($alamat);
      }else{
        redirect(base_url());
      }
    }

    public function QRcode($kodenya = null){
    	//render qrcode dengan format gambar png
    	QRcode::png(
    		$kodenya,
    		$outfile = false,
    		$level = QR_ECLEVEL_H,
    		$size = 13,
    		$margin = 3
    	);
    }

    public function getDetailSeminarPeserta(){
        $id_seminar = $this->input->post('id_seminar');
        $id_user = $this->input->post('id_user');
        $seminarku = $this->Seminar_model->getMySeminar2($id_seminar, $id_user);
        $data = $seminarku['seminarku'];
        echo json_encode($data);
    }

    public function getAllPeserta(){
      $id_seminar = $this->input->post('id_seminar');
      $data = $this->Seminar_model->daftarPeserta($id_seminar);
      echo json_encode($data);
    }

 

    public function getDetailPeserta(){
        $id_seminar = $this->input->post('id_seminar');
        $id_peserta = $this->input->post('id_peserta');
        $this->db->select('*'); // <-- There is never any reason to write this line!
        $this->db->from('tpeserta');
        $this->db->where('id_seminar', $id_seminar);
        $this->db->where('id_peserta', $id_peserta);
        $seminar = $this->db->get();
        $data = $seminar->result_array();
        echo json_encode($data);
    }

    public function panel(){
      if ($this->session->userdata('email')) {
        $data['title'] = 'Yukseminar.id | Aplikasi daftar dan buat seminar secara mudah dan gratis';
        $data['user'] = $this->user_model->getDataUser($this->session->userdata('email'));

        //Menu Seminar yang diikuti
        $data['seminarku'] = $this->Seminar_model->getMySeminar($data['user']['id_user']);
        $data['list_seminarku'] = $data['seminarku']['seminarku'];
        $data['jumlah_seminar_diikuti'] = $data['seminarku']['jumlah_seminar_diikuti'];
        // var_dump($data['list_seminarku']);

        //Menu Seminar yang dihadiri
        $data['objekseminardihadiri'] = $this->Seminar_model->SeminarDihadiri($data['user']['id_user']);
        $data['seminardihadiri'] = $data['objekseminardihadiri']['seminardihadiri'];
        $data['jumlah_seminar_dihadiri'] = $data['objekseminardihadiri']['jumlah_seminar_dihadiri'];


        //Menu Seminar dibuat
        $data['objekseminardibuat'] = $this->Seminar_model->SeminarDibuat($data['user']['id_user']);
        $data['seminardibuat'] = $data['objekseminardibuat']['seminardibuat'];
        $data['jumlah_seminar_dibuat'] = $data['objekseminardibuat']['jumlah_seminar_dibuat'];
        // var_dump($data['seminardibuat']);

        //Riwayat Seminar
        $data['objekriwayatseminar'] = $this->Seminar_model->riwayatSeminar($data['user']['id_user']);
        $data['riwayatseminar'] = $data['objekriwayatseminar']['riwayatseminar'];
        $data['jumlah_riwayat_seminar'] = $data['objekriwayatseminar']['jumlah_riwayat_seminar'];

        // var_dump($this->Seminar_model->SeminarDibuat($data['user']['id_user']));

        if ($data['user']['role_user']=="user") {
          // var_dump($data['list_seminarku']);
          $this->load->view('templates/header_user', $data);
          $this->load->view('user/panel_user',$data);
          $this->load->view('templates/footer_user');
        }elseif ($data['user']['role_user'] == 'pengawas') {

        }
      }else{
        redirect(base_url());
      }
    }



    public function statusPendaftaran(){
      if ($this->session->userdata('email')) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
          $url = $this->input->post('url',true);
          $data['detail_seminar'] = $this->Seminar_model->getDataSeminarById($url);
          // echo json_encode($url);
          if ($data['detail_seminar']['buka_pendaftaran']== 0) {
            $data['detail_baru'] = $this->Seminar_model->tutupbukaPendaftaran($url, 1);
            echo json_encode($data['detail_baru']);
            // echo "Pendaftaran dibuka";
          }else{
            $data['detail_baru'] = $this->Seminar_model->tutupbukaPendaftaran($url, 0);
            echo json_encode($data['detail_baru']);
            // echo "Pendaftaran ditutup";
          }
        }else{
          redirect(base_url());
        }

      }else{
        redirect(base_url());
      }
    }

    public function editprofile(){
        $data['title'] = 'Yukseminar.id | Aplikasi daftar dan buat seminar secara mudah dan gratis';
        $data['user'] = $this->db->get_where('tuser', ['email_user' => $this->session->userdata('email')])->row_array();
        $this->load->view('templates/header_user', $data);
        $this->load->view('user/editprofile',$data);
        $this->load->view('templates/footer_user');
    }

    public function editbio(){
        $data['title'] = 'Yukseminar.id | Aplikasi daftar dan buat seminar secara mudah dan gratis';
        $data['user'] = $this->db->get_where('tuser', ['email_user' => $this->session->userdata('email')])->row_array();
        $this->form_validation->set_rules('nama_user', 'Nama user', 'required|trim');
        $this->form_validation->set_rules('phone_user', 'Telepon', 'numeric');
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header_user', $data);
            $this->load->view('user/editprofile',$data);
            $this->load->view('templates/footer_user');
        }else{

            $datauser = [
                'nama_user' => $this->input->post('nama_user',true),
                'email_user' => $this->input->post('email_user',true),
                'phone_user' => $this->input->post('phone_user',true),
                'address_user' => $this->input->post('address_user',true),
                'bday_user' => $this->input->post('bday_user',true),
                'gender_user' => $this->input->post('gender_user',true),
                'universitas' => $this->input->post('universitas',true),
                'nim_user' => $this->input->post('nim_user',true)
            ];



            $sukses = $this->user_model->editbio($data['user']['email_user'],$datauser);
            if ($sukses) {
                  $this->session->set_flashdata('message','Data user berhasil diubah!');
                  $datauser2 = [
                    'updated_at' => date("Y-m-d H:i:s")
                  ];
                  $this->user_model->editbio($data['user']['email_user'],$datauser2);
                  redirect('user/editprofile');
            }else{
                  $this->session->set_flashdata('message_wrong', 'Data user belum diubah');
                  redirect('user/editprofile');
            } 
            
        }

    }


    public function editphoto()
    {
        $data['title'] = 'Yukseminar.id | Aplikasi daftar dan buat seminar secara mudah dan gratis';
        $data['user'] = $this->db->get_where('tuser', ['email_user' => $this->session->userdata('email')])->row_array();

        if (empty($_FILES['photo']['name']))
        {
            $this->form_validation->set_rules('photo','File KTP','required');
        }
        //karena butuh validasi, jika hanya photo ga bisa
        $this->form_validation->set_rules('id2','...','required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header_user', $data);
            $this->load->view('user/editprofile',$data);
            $this->load->view('templates/footer_user');
        } else {
            $upload_image = $_FILES['photo']['name'];

            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size']      = '2048';
            $config['upload_path'] = './assets/img_user/';

            $this->load->library('upload', $config);

                if ( ! $this->upload->do_upload('photo'))
                {
                        $error = array('error' => $this->upload->display_errors());

                        $this->load->view('upload_form', $error);
                }
                else
                {
                    $old_image = $data['user']['photo_user'];
                    if ($old_image != 'img/profile/default.jpg') {
                        unlink(FCPATH . 'assets/' . $old_image);
                    }
                    $new_image = 'img_user/'. $this->upload->data('file_name');

                    $this->db->set('photo_user', $new_image);

                    $this->db->where('email_user', $this->session->userdata('email'));
                    $this->db->update('tuser');

                    $this->session->set_flashdata('message', 'Foto profile berhasil diubah!');
                    redirect('user/editprofile');
            }

        }
    }


    public function changePassword()
    {
        $data['title'] = 'Change Password';
        $data['user'] = $this->db->get_where('tuser', ['email_user' => $this->session->userdata('email')])->row_array();

        $this->form_validation->set_rules('current_password', 'Password lama', 'required|trim');
        $this->form_validation->set_rules('new_password1', 'Password baru', 'required|trim|min_length[3]|matches[new_password2]');
        $this->form_validation->set_rules('new_password2', 'Konfirmasi password', 'required|trim|min_length[3]|matches[new_password1]');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header_user', $data);
            $this->load->view('user/editprofile',$data);
            $this->load->view('templates/footer_user');
        } else {
            $current_password = $this->input->post('current_password');
            $new_password = $this->input->post('new_password1');
            if (!password_verify($current_password, $data['user']['pass_user'])) {
                $this->session->set_flashdata('message_wrong', 'Password lama salah!');
                redirect('user/editprofile');
            } else {
                if ($current_password == $new_password) {
                    $this->session->set_flashdata('message_wrong', 'Password baru tidak boleh sama dengan password sebelumnya!');
                    redirect('user/editprofile');
                } else {
                    // password sudah ok
                    $password_hash = password_hash($new_password, PASSWORD_DEFAULT);

                    $this->db->set('pass_user', $password_hash);
                    $this->db->where('email_user', $this->session->userdata('email'));
                    $this->db->update('tuser');

                    $this->session->set_flashdata('message', 'Password berhasil diubah!');
                    redirect('user/editprofile');
                }
            }
        }
    }
}
