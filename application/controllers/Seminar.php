<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Seminar extends CI_Controller
{
    public function __construct()
    {
    	parent::__construct();
    	$this->load->model("seminar_model");
      $this->load->model("user_model");
      $this->load->model("Peserta_model");
      $this->load->model("kategori_model");
    }



    public function getBarcodeSeminar(){
        $id_seminar = $this->input->post('id_seminar');
        $qrcode = $this->input->post('qrcode');
        $this->db->select('*'); // <-- There is never any reason to write this line!
        $this->db->from('tpeserta');
        $this->db->where('barcode', $qrcode);
        $seminar = $this->db->get();
        $data = $seminar->result_array();
  
        // CEK QRCODE ADA GA
        if($data){

          //JIKA ADA, CEK QRCODE BEDASARKAN URL SAMA GA
          $this->db->select('*');
          $this->db->from('tseminar a, tpeserta b');
          $this->db->where('b.id_seminar', $id_seminar);
          $this->db->where('b.barcode', $qrcode);
          $this->db->where('b.hadir', null);
          $this->db->where('a.id_seminar = b.id_seminar');
          $seminar2 = $this->db->get();
          $data2 = $seminar2->result_array();

          if($data2){
            //update
            $this->db->set('hadir', 1);
            $this->db->where('barcode', $qrcode);
            $this->db->update('tpeserta');
            echo json_encode($data2);

          }else{
            // CEK SUDAH ABSEN BLOM
            $this->db->select('*');
            $this->db->from('tseminar a, tpeserta b');
            $this->db->where('b.id_seminar', $id_seminar);
            $this->db->where('b.barcode', $qrcode);
            $this->db->where('b.hadir', 1);
            $this->db->where('a.id_seminar = b.id_seminar');
            $seminar3 = $this->db->get();
            $data3 = $seminar3->result_array();
            if($data3){
              echo json_encode(2);
            }else{
              // SALAH SEMINAR
              echo json_encode(1);
            }
            
          }
          

        }else{
          // barcode gaada didatabase
        }

        
    }

    public function updateSeminar($url = "")
    {
       	$data['title'] = 'Yukseminar.id | Aplikasi daftar dan buat seminar secara mudah dan gratis';
        $data['user'] = $this->user_model->getDataUser($this->session->userdata('email'));
        $data['data'] = $this->seminar_model->getDataSeminarById($url);

        $id_kategori = $data['data']['kategori_seminar'];

        $data['get_kategori'] = $this->kategori_model->getKategoriById($id_kategori);

        $this->load->view('templates/header_user', $data);
        $this->load->view('seminar/updateSeminar', $data);
        $this->load->view('templates/footer_user');

    }

    public function editSeminar()
    {
      if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $data['title'] = 'Yukseminar.id | Aplikasi daftar dan buat seminar secara mudah dan gratis';
        $data['user'] = $this->user_model->getDataUser($this->session->userdata('email'));
        $data['data'] = $this->seminar_model->getDataSeminarById($this->input->post('url',true));

        $this->form_validation->set_rules('deskripsi', 'Deskripsi seminar', 'required');
        $this->form_validation->set_rules('tempat', 'Tempat seminar', 'required');
        $this->form_validation->set_rules('narasumber', 'Narasumber seminar', 'required');
        $this->form_validation->set_rules('jadwal', 'Jadwal seminar', 'required');
        $this->form_validation->set_rules('jam', 'Jam seminar', 'required');
        $this->form_validation->set_rules('nama_gedung', 'Nama Gedung', 'required');
        $this->form_validation->set_rules('lantai', 'Lantai', 'numeric');
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header_user', $data );
            $this->load->view('seminar/updateSeminar', $data);
            $this->load->view('templates/footer_user');
            // return redirect(base_url('seminar/updateSeminar/'.$this->input->post('url',true)));
        
        
        } else {

          $dataform = [
              'deskripsi_seminar' => $this->input->post('deskripsi',true),
              'tempat_seminar' => $this->input->post('tempat',true),
              'narasumber' => $this->input->post('narasumber',true),
              'nama_gedung' => $this->input->post('nama_gedung',true),
              'lantai' => $this->input->post('lantai',true),
              'jadwal' => $this->input->post('jadwal',true),
              'waktu' => $this->input->post('jam',true)
          ];

          $url = $this->input->post('url',true);

          $cek = $this->seminar_model->updateSeminar($dataform, $url);
          if ($cek) {
            $this->session->set_flashdata('message', 'Berhasil ubah seminar...');

            $dataform2 = [
              'updated_at' => date("Y-m-d H:i:s")
            ];
            $this->seminar_model->updateSeminar($dataform2, $url);
            redirect(base_url('seminar/updateSeminar/'.$url));
          }else{
            $this->session->set_flashdata('messagefailed', 'Gagal ubah seminar...');
            redirect(base_url('seminar/updateSeminar/'.$url));
          }


        }

      }else {
        return redirect(base_url());
      }
    }

    public function editSeminarPhoto(){
      if ($_SERVER['REQUEST_METHOD'] === 'POST') {
          $data['title'] = 'Yukseminar.id | Aplikasi daftar dan buat seminar secara mudah dan gratis';
          $data['user'] = $this->user_model->getDataUser($this->session->userdata('email'));
          $data['data'] = $this->seminar_model->getDataSeminarById($this->input->post('url',true));
      if (empty($_FILES['photo']['name']))
        {
            $this->form_validation->set_rules('photo','Poster','required');
        }
        //karena butuh validasi, jika hanya photo ga bisa
        $this->form_validation->set_rules('id','...','required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header_user', $data );
            $this->load->view('seminar/updateSeminar', $data);
            $this->load->view('templates/footer_user');
        } else {
            $upload_image = $_FILES['photo']['name'];

            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_size']      = '2048';
            $config['upload_path'] = './assets/img_seminar';

            $this->load->library('upload', $config);

                if ( ! $this->upload->do_upload('photo'))
                {
                        $error = array('error' => $this->upload->display_errors());

                        $this->load->view('upload_form', $error);
                }
                else
                {
                    $old_image = $data['data']['poster'];
                    unlink(FCPATH . 'assets/' . $old_image);
                    
                    $new_image = 'img_seminar/'. $this->upload->data('file_name');

                    $this->db->set('poster', $new_image);
                    $this->db->where('id_seminar', $this->input->post('id'));
                    $this->db->update('tseminar');

                    $url = $this->input->post('url',true);

                    $this->session->set_flashdata('message', 'Poster berhasil diubah!');
                    redirect(base_url('seminar/updateSeminar/'.$url));
            }
          }
        }
    }




    public function printAbsen()
    {
      if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $url = $this->input->post('url',true);
        if ($url != null) {
          $data['user'] = $this->user_model->getDataUser($this->session->userdata('email'));
          $data['dataseminar'] = $this->seminar_model->getDataSeminarById($url);
          $cek = $this->seminar_model->cekPunyaUserBukan($data['dataseminar']['id_seminar'], $data['user']['id_user']);
          if ($cek) {
            $data['peserta'] = $this->seminar_model->daftarPeserta($data['dataseminar']['id_seminar']);
            $data['jadwal']= date('l, d F Y', strtotime($data['dataseminar']['jadwal']));
            // $this->load->view('user/printAbsen',$data);
            $absen = new \Mpdf\Mpdf();
            // $absen->SetTitle('Absen Seminar');a
        		$data = $this->load->view('user/printAbsen',$data, TRUE );
        		$absen->WriteHTML($data);
        		$absen->Output();
          }else{
            redirect(base_url());
          }
        }else{
          redirect(base_url());
        }
      }else{
        redirect(base_url());
      }



    }
    public function printKehadiran()
    {
      if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $url = $this->input->post('url',true);
        if ($url != null) {
          $data['user'] = $this->user_model->getDataUser($this->session->userdata('email'));
          $data['dataseminar'] = $this->seminar_model->getDataSeminarById($url);
          $cek = $this->seminar_model->cekPunyaUserBukan($data['dataseminar']['id_seminar'], $data['user']['id_user']);
          if ($cek) {
            $data['peserta'] = $this->seminar_model->daftarPeserta($data['dataseminar']['id_seminar']);
            $data['jadwal']= date('l, d F Y', strtotime($data['dataseminar']['jadwal']));
            // $this->load->view('user/printAbsen',$data);
            $absen = new \Mpdf\Mpdf();
            // $absen->SetTitle('Absen Seminar');a
            $data = $this->load->view('user/printKehadiran',$data, TRUE );
            $absen->WriteHTML($data);
            $absen->Output();
          }else{
            redirect(base_url());
          }
        }else{
          redirect(base_url());
        }
      }else{
        redirect(base_url());
      }



    }

    public function cekPrintAbsen()
    {
      $data['dataseminar'] = $this->seminar_model->getDataSeminarById("Seminar_Kita");
      $data['peserta'] = $this->seminar_model->daftarPeserta($data['dataseminar']['id_seminar']);
      $data['jadwal']= date('l, d F Y', strtotime($data['dataseminar']['jadwal']));
      $this->load->view('user/printAbsen',$data);
    }

    public function cekPrintKehadiran()
    {
      $data['dataseminar'] = $this->seminar_model->getDataSeminarById("Seminar_Kita");
      $data['peserta'] = $this->seminar_model->daftarPeserta($data['dataseminar']['id_seminar']);
      $data['jadwal']= date('l, d F Y', strtotime($data['dataseminar']['jadwal']));
      $this->load->view('user/printKehadiran',$data);
    }


    public function registration($url = ""){
      $data['title'] = 'Yukseminar.id | Aplikasi daftar dan buat seminar secara mudah dan gratis';
      $data['user'] = $this->user_model->getDataUser($this->session->userdata('email'));
      $data['seminar'] = $this->seminar_model->getDataSeminarById($url);
      $data['cekIkutBelum'] = $this->Peserta_model->cekSudahIkutBelum($data['user']['id_user'], $data['seminar']['id_seminar']);

      // GET ID user by id seminar
        $data['pemilik'] =  $this->seminar_model->getIDPemilik($data['tampil_seminarbyid']['id_seminar']);
      if ($data['seminar']['selesai_seminar'] == "1") {
        $this->session->set_flashdata('failed', 'Maaf seminar ini sudah selesai...');
        redirect('seminar/detailSeminar/'. $data['seminar']['url_seminar'] );
      }
      if ($data['seminar']['buka_pendaftaran'] == "0") {
        $this->session->set_flashdata('failed', 'Maaf seminar ini sudah menutup pendaftarannya...');
        redirect('seminar/detailSeminar/'. $data['seminar']['url_seminar'] );
      }

    //Cek apakah kode promo benar
      if ($data['seminar']['kode_promo'] == $this->input->post('kode_promo', true)){

        //Cek apakah dia sudah ikut
      if ($data['cekIkutBelum']) {
        $this->session->set_flashdata('failed', 'Kamu sudah terdaftar dalam seminar ini...');
        redirect('seminar/detailSeminar/'. $data['seminar']['url_seminar'] );
      }else{

          if ($data['seminar']['paper'] == "1" || $data['seminar']['pembayaran'] == "1" ) {

          $simpan = [
              'id_seminar' => $data['seminar']['id_seminar'],
              'id_user' => $data['user']['id_user'],
              'konfirmasi_peserta' => '0',
              'promo' => '1',
              'barcode' => 'P'.$data['user']['id_user'].date('dmyy')
          ];

          $this->Peserta_model->tambahPeserta($simpan);

          $this->session->set_flashdata('message', 'Berhasil daftar seminar, silahkan lengkapi berkas...');
          redirect('user/panel');
          // redirect('seminar/detailSeminar/'. $data['seminar']['url_seminar'] );
          // var_dump("Konfirmasi 0");
        }else{

          $simpan = [
              'id_seminar' => $data['seminar']['id_seminar'],
              'id_user' => $data['user']['id_user'],
              'konfirmasi_peserta' => '1',
              'promo' => '1',
              'barcode' => 'P'.$data['user']['id_user'].date('dmyy')
          ];
          $this->Peserta_model->tambahPeserta($simpan);
          $this->_sendEmailPendaftaran($data['user']['email_user'],$data['user']['nama_user'],$data['seminar']['nama_seminar'],$data['seminar']['url_seminar'], 'P'.$data['user']['id_user'].date('dmyy'));
          $this->session->set_flashdata('message', 'Berhasil daftar seminar...');
          redirect('user/panel');
          // redirect('seminar/detailSeminar/'. $data['seminar']['url_seminar'] );
          // var_dump("Konfirmasi 1");
        }

      }
        //jika kode promo kosong
      }else if($this->input->post('kode_promo', true) == '') {
      //Cek apakah dia sudah ikut
      if ($data['cekIkutBelum']) {
        $this->session->set_flashdata('failed', 'Kamu sudah terdaftar dalam seminar ini...');
        redirect('seminar/detailSeminar/'. $data['seminar']['url_seminar'] );
      }else{

        //Jika Berbayar
        if ($data['seminar']['paper'] == "1" || $data['seminar']['pembayaran'] == "1" ) {

          $simpan = [
              'id_seminar' => $data['seminar']['id_seminar'],
              'id_user' => $data['user']['id_user'],
              'konfirmasi_peserta' => '0',
              'promo' => '0',
              'barcode' => 'P'.$data['user']['id_user'].date('dmyy')
          ];

          $this->Peserta_model->tambahPeserta($simpan);

          $this->session->set_flashdata('message', 'Berhasil daftar seminar, silahkan lengkapi berkas...');
          redirect('user/panel');
          // redirect('seminar/detailSeminar/'. $data['seminar']['url_seminar'] );
          // var_dump("Konfirmasi 0");
        }else{

          $simpan = [
              'id_seminar' => $data['seminar']['id_seminar'],
              'id_user' => $data['user']['id_user'],
              'konfirmasi_peserta' => '1',
              'promo' => '0',
              'barcode' => 'P'.$data['user']['id_user'].date('dmyy')
          ];
          $this->Peserta_model->tambahPeserta($simpan);
          $this->_sendEmailPendaftaran($data['user']['email_user'],$data['user']['nama_user'],$data['seminar']['nama_seminar'],$data['seminar']['url_seminar'], 'P'.$data['user']['id_user'].date('dmyy'));
          $this->session->set_flashdata('message', 'Berhasil daftar seminar...');
          redirect('user/panel');
          // redirect('seminar/detailSeminar/'. $data['seminar']['url_seminar'] );
          // var_dump("Konfirmasi 1");
        }

      }
      //Jika Kode Salah
      }else if($data['seminar']['kode_promo'] != $this->input->post('kode_promo', true)){
        $this->session->set_flashdata('failed-kode', 'Kode yang anda masukan salah!');
        redirect('seminar/detailSeminar/'. $data['seminar']['url_seminar'] );
      }
    }

    public function detailseminar($url = "")
    {
       	$data['title'] = 'Yukseminar.id | Aplikasi daftar dan buat seminar secara mudah dan gratis';
        $data['user'] = $this->db->get_where('tuser', ['email_user' => $this->session->userdata('email')])->row_array();
        $data['tampil_seminarbyid'] = $this->seminar_model->getDataSeminarById($url);
        $id_user = $data['user']['id_user'];
        $data['sudah_ikut'] = $this->seminar_model->cekikutSeminar($data['tampil_seminarbyid']['id_seminar'],$id_user);
        $data['kurang_kuota'] = $this->seminar_model->kurangkuota($data['tampil_seminarbyid']['id_seminar']);

        // GET ID user by id seminar
        $data['pemilik'] =  $this->seminar_model->getIDPemilik($data['tampil_seminarbyid']['id_seminar']);


        $id_kategori = $data['tampil_seminarbyid']['kategori_seminar'];

        $data['get_kategori'] = $this->kategori_model->getKategoriById($id_kategori);
      

        // var_dump($data['cek_berbayarInternal'], $data['cek_berbayarEksternal']);

        $data['tampil_seminarbyid']['jml_peserta'];
        $data['kurangHasil'] = $data['tampil_seminarbyid']['jml_peserta'] - $data['kurang_kuota'];
        $data['recentSeminar'] = $this->seminar_model->recentSeminar('0','4');

        if ($url != null) {
          $data['title'] = 'Yukseminar.id | Aplikasi daftar dan buat seminar secara mudah dan gratis';
          $data['user'] = $this->db->get_where('tuser', ['email_user' => $this->session->userdata('email')])->row_array();
          $data['tampil_seminarbyid'] = $this->seminar_model->getDataSeminarById($url);
          $id_user = $data['user']['id_user'];
          $data['sudah_ikut'] = $this->seminar_model->cekikutSeminar($data['tampil_seminarbyid']['id_seminar'],$id_user);
          $data['kurang_kuota'] = $this->seminar_model->kurangkuota($data['tampil_seminarbyid']['id_seminar']);

          $data['tampil_seminarbyid']['jml_peserta'];
          $data['kurangHasil'] = $data['tampil_seminarbyid']['jml_peserta'] - $data['kurang_kuota'];
          $data['recentSeminar'] = $this->seminar_model->recentSeminar('0','4');

          if ($data['tampil_seminarbyid'] != null) {

                    $this->load->view('templates/header_user', $data);
                    $this->load->view('seminar/detailseminar', $data);
                    $this->load->view('templates/footer_user');
          }else{
            redirect(base_url());
          }


        }else{
          redirect(base_url());
        }


    }

    public function regisSeminar()
    {
      if (!$this->session->userdata('email')) {
        redirect('user');
      }

      $data['title'] = 'YukSeminar';
      $data['user'] = $this->db->get_where('tuser', ['email_user' => $this->session->userdata('email')])->row_array();
      $data['kategori'] = $this->seminar_model->getKategori();

      $this->form_validation->set_rules('namaseminar', 'Judul Seminar', 'required|trim|is_unique[tseminar.nama_seminar]');
      $this->form_validation->set_rules('kategori', 'Kategori seminar', 'required|trim');
      $this->form_validation->set_rules('descseminar', 'Deskripsi seminar', 'required|trim');
      $this->form_validation->set_rules('tempatseminar', 'Tempat seminar', 'required|trim');
      $this->form_validation->set_rules('narasumber', 'Narasumber seminar', 'required|trim');
      $this->form_validation->set_rules('jadwalseminar', 'Jadwal seminar', 'required|trim');
      $this->form_validation->set_rules('nama_gedung', 'Nama Gedung', 'required|trim');
      $this->form_validation->set_rules('lantai', 'Lantai', 'required|trim|numeric');
      $this->form_validation->set_rules('jamseminar', 'Jam seminar', 'required|trim');
      $this->form_validation->set_rules('kode_promo', 'Kode Promo', 'trim|is_unique[tseminar.kode_promo]');
      $this->form_validation->set_rules('rekening', 'Nomor Rekening', 'numeric');
      $this->form_validation->set_rules('hargainternal', 'Harga', 'numeric');
      $this->form_validation->set_rules('hargaumum', 'Harga', 'numeric');
      $this->form_validation->set_rules('jumlahpeserta', 'Jumlah peserta', 'required|trim|numeric');

      if (empty($_FILES['poster']['name']))
      {
          $this->session->set_flashdata('messagefailed', 'poster belum di upload');
          $this->form_validation->set_rules('poster', 'Document', 'required');
      }

      if ($this->form_validation->run() == false) {
        // var_dump("validation ga lolos");

          $this->load->view('templates/header_user', $data );
          $this->load->view('seminar/createSeminar');
          $this->load->view('templates/footer_user');
      } else {
        // var_dump("validation oke");
          $user = $data['user']['id_user'];
          $namaseminar = $this->input->post('namaseminar', true);
          $kategori = $_POST['kategori'];
          $descseminar = $this->input->post('descseminar', true);
          $tempatseminar = $this->input->post('tempatseminar', true);
          $narasumber = $this->input->post('narasumber', true);
          $jadwalseminar = $this->input->post('jadwalseminar', true);
          // $jadwal = date('l, d F Y', strtotime($jadwal));
          $jamseminar = $this->input->post('jamseminar', true);
          $jumlahpeserta = $this->input->post('jumlahpeserta', true);
          $nama_gedung = $this->input->post('nama_gedung', true);
          $lantai = $this->input->post('lantai', true);

          $paper= $this->input->post('paper', true);
          $berbayar = $this->input->post('berbayar', true);
          $rekening = $this->input->post('rekening', true);
          $bank = $this->input->post('bank', true);
          $atasnama = $this->input->post('atasnama', true);
          $hargainternal = $this->input->post('hargainternal', true);

          //Kondisi jika harga internal
          if($this->input->post('hargainternal', true)){
            $kode_promo = $this->input->post('kode_promo', true);
          }else{
            $kode_promo = NULL;
          }
          $hargaumum = $this->input->post('hargaumum', true);
          $explode = explode(' ',$this->input->post('namaseminar', true));
          // $baru = array();
          // for ($i=0; $i < 4; $i++) {
          //   array_push($baru, $explode[$i]);
          // }
          $url = implode('_',$explode);
          // var_dump($url);

          // gambar
          $sumber = $_FILES['poster']['tmp_name'];
          $namafile = $_FILES['poster']['name'];

          $ekstensiGambar = explode('.',$namafile);
          $ekstensiGambar = strtolower(end($ekstensiGambar));

          $namaFileBaru = $user;
          $namaFileBaru .= uniqid();
          $namaFileBaru .= '.';
          $namaFileBaru .= $ekstensiGambar;


          $tujuan = "./assets/img_seminar/".$namaFileBaru;  //untuk di upload
          $alamat ="img_seminar/".$namaFileBaru;  //untuk di simpan
          $alamatkosong = "";
          //akhir gambar

          // $this->session->set_flashdata('message', 'Seminar berhasil dibuat, silahkan menunggu verifikasi dari admin...');
          // redirect('seminar/createSeminar');



          $upload_image = $namaFileBaru;

          $config['file_name'] = $namaFileBaru;
          $config['allowed_types'] = 'gif|jpg|png';
          $config['max_size']      = '2048';
          $config['upload_path'] = './assets/img_seminar/';

          $this->load->library('upload', $config);
          if ( ! $this->upload->do_upload('poster'))
          {
              $error = array('error' => $this->upload->display_errors());

              $this->load->view('upload_form', $error);
          }
          else
          {
              $data = [
                  'nama_seminar' => htmlspecialchars($namaseminar),
                  'jadwal' => $jadwalseminar,
                  'tempat_seminar' => htmlspecialchars($tempatseminar),
                  'narasumber' => $narasumber,
                  'jml_peserta' => $jumlahpeserta,
                  'id_user' =>$user,
                  'status' => '0',
                  'paper' => $paper,
                  'pembayaran' => $berbayar,
                  'waktu' => $jamseminar,
                  'poster' => $alamat,
                  'kategori_seminar' => $kategori,
                  'deskripsi_seminar' => $descseminar,
                  'harga_seminar' => $hargainternal,
                  'nama_gedung' => $nama_gedung,
                  'lantai' => $lantai,
                  'harga_umum' => $hargaumum,
                  'kode_promo' => $kode_promo,
                  'rekening_seminar' => $rekening,
                  'an_penyelenggara' => $atasnama,
                  'bank_rekening' => $bank,
                  'buka_pendaftaran' => '1',
                  'selesai_seminar' => '0',
                  'url_seminar' => $url
              ];
              // $this->db->insert('tseminar', $data);
              // $this->_sendEmail($url);

              $this->seminar_model->createSeminar($data);
              $this->_sendEmail($url);

              $this->session->set_flashdata('message', 'Seminar berhasil dibuat, silahkan menunggu persetujuan dari admin...');
              redirect('seminar/createSeminar');
          }
        }
    }

    public function createSeminar()
    {
      if ($this->session->userdata('email')) {
          $data['title'] = 'YukSeminar';
          $data['user'] = $this->db->get_where('tuser', ['email_user' => $this->session->userdata('email')])->row_array();
          $data['kategori'] = $this->seminar_model->getKategori();
          if ($data['user']['role_user']=="user") {
            $this->load->view('templates/header_user', $data );
            $this->load->view('seminar/createSeminar');
            $this->load->view('templates/footer_user');
          }else{
            redirect(base_url());
          }

      }else{
        redirect(base_url());
      }

    }

    private function _sendEmailPendaftaran($to, $namauser,$namaseminar, $url, $qrcode = null)
    {


        $config = [
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://mail.yukseminar.id',
            'smtp_user' => 'admin.noreply@yukseminar.id',
            'smtp_pass' => 'adminyukseminar',
            'smtp_port' => 465,
            'mailtype' => 'html',
            'charset' => 'utf-8',
            'newline' => "\r\n"
        ];

        $this->email->initialize($config);

        $this->email->from('admin.noreply@yukseminar.id', 'YukSeminar');
        $this->email->to($to);

            $this->email->subject('Konfirmasi pendaftaran seminar');
            $this->email->message('<!DOCTYPE html>
             <html>
             <head>
                 <title></title>
                 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">


                <style>
              .header-mail {
              min-height:50px;

            background: rgba(6,209,220,1);
            background: -moz-linear-gradient(-45deg, rgba(6,209,220,1) 0%, rgba(116,26,250,1) 100%);
            background: -webkit-gradient(left top, right bottom, color-stop(0%, rgba(6,209,220,1)), color-stop(100%, rgba(116,26,250,1)));
            background: -webkit-linear-gradient(-45deg, rgba(6,209,220,1) 0%, rgba(116,26,250,1) 100%);
            background: -o-linear-gradient(-45deg, rgba(6,209,220,1) 0%, rgba(116,26,250,1) 100%);
            background: -ms-linear-gradient(-45deg, rgba(6,209,220,1) 0%, rgba(116,26,250,1) 100%);
            background: linear-gradient(135deg, rgba(6,209,220,1) 0%, rgba(116,26,250,1) 100%);
            filter: progid:DXImageTransform.Microsoft.gradient( startColorstr="#06d1dc", endColorstr="#741afa", GradientType=1 );
            }

            .message-body {

              background: white;
              color: black;
              min-height: auto;
              border-bottom:  5px solid rgb(0, 123, 255);
              padding-bottom: 20px;
            }

            .btn-primary {

                color: #fff;
                background-color: #007bff;
                border-color: #007bff;

            }

            .btn {

                display: inline-block;
                font-weight: 400;
                text-align: center;
                white-space: nowrap;
                vertical-align: middle;
                -webkit-user-select: none;
                -moz-user-select: none;
                -ms-user-select: none;
                user-select: none;
                border: 1px solid transparent;
                    border-top-color: transparent;
                    border-right-color: transparent;
                    border-bottom-color: transparent;
                    border-left-color: transparent;
                padding: .375rem .75rem;
                font-size: 1rem;
                line-height: 1.5;
                border-radius: .25rem;
                transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out;

            }

            .header-mail h1{
                padding-bottom: 10px;
                padding-top: 10px;
              text-align:   center;
              color: white;
            }

            .message-body h1{
                text-align:   center;
              margin-top: 20px;
            }

            .message-body p{
              text-align:   center;
              margin-top:   20px;
              padding-left:   20px;
              padding-right:  20px;
              font-size:  13px;
            }

            .text-center {
                text-align: center;
            }
            </style>

            </head>
             <body>
            <div class="col-lg-12">
              <div class="row">
                <div class="col-sm-12 header-mail">
                  <h1>Pendaftaran Seminar</h1>
                </div>
                <div class="col-sm-10 mx-auto message-body">
                  <h1>Hallo '.$namauser.' !</h1>
                  <p style="font-size:18px;">Selamat anda telah diterima untuk mengikuti seminar <a href="'. base_url('seminar/detailSeminar/'.$url) .'">'.$namaseminar.'</a></p>
                  <p>Gunakan QR Code dibawah ini untuk presensi</p>
                  <div class="col text-center mt-4 mb-4">
                    <form target="_blank" action="'. base_url('user/detailQrcode').'" method="post">
                    <input type="hidden" value="'.$qrcode.'" name="qrcode">
                    <input type="hidden" value="'.$namaseminar.'" name="namaseminar">
                    <button class="btn btn-primary" type="submit">Lihat Qrcode</button>
                    </form>
                  </div>

                </div>
              </div>
            </div>

             </body>
             </html>');

             $this->email->send();
    }

    private function _sendEmail($url)
    {


        $config = [
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://mail.yukseminar.id',
            'smtp_user' => 'admin.noreply@yukseminar.id',
            'smtp_pass' => 'adminyukseminar',
            'smtp_port' => 465,
            'mailtype' => 'html',
            'charset' => 'utf-8',
            'newline' => "\r\n"
        ];

        $this->email->initialize($config);

        $this->email->from('admin.noreply@yukseminar.id', 'YukSeminar');
        $this->email->to('goldywidiyanto@gmail.com', 'rezaputrawinata09@gmail.com', 'henrycuber@gmail.com');

            $this->email->subject('Verifikasi Seminar');
            $this->email->message('<!DOCTYPE html>
             <html>
             <head>
                 <title></title>
                 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">


                <style>
              .header-mail {
              min-height:50px;

            background: rgba(6,209,220,1);
            background: -moz-linear-gradient(-45deg, rgba(6,209,220,1) 0%, rgba(116,26,250,1) 100%);
            background: -webkit-gradient(left top, right bottom, color-stop(0%, rgba(6,209,220,1)), color-stop(100%, rgba(116,26,250,1)));
            background: -webkit-linear-gradient(-45deg, rgba(6,209,220,1) 0%, rgba(116,26,250,1) 100%);
            background: -o-linear-gradient(-45deg, rgba(6,209,220,1) 0%, rgba(116,26,250,1) 100%);
            background: -ms-linear-gradient(-45deg, rgba(6,209,220,1) 0%, rgba(116,26,250,1) 100%);
            background: linear-gradient(135deg, rgba(6,209,220,1) 0%, rgba(116,26,250,1) 100%);
            filter: progid:DXImageTransform.Microsoft.gradient( startColorstr="#06d1dc", endColorstr="#741afa", GradientType=1 );
            }

            .message-body {

              background: white;
              color: black;
              min-height: auto;
              border-bottom:  5px solid rgb(0, 123, 255);
              padding-bottom: 20px;
            }

            .btn-primary {

                color: #fff;
                background-color: #007bff;
                border-color: #007bff;

            }

            .btn {

                display: inline-block;
                font-weight: 400;
                text-align: center;
                white-space: nowrap;
                vertical-align: middle;
                -webkit-user-select: none;
                -moz-user-select: none;
                -ms-user-select: none;
                user-select: none;
                border: 1px solid transparent;
                    border-top-color: transparent;
                    border-right-color: transparent;
                    border-bottom-color: transparent;
                    border-left-color: transparent;
                padding: .375rem .75rem;
                font-size: 1rem;
                line-height: 1.5;
                border-radius: .25rem;
                transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out;

            }

            .header-mail h1{
                padding-bottom: 10px;
                padding-top: 10px;
              text-align:   center;
              color: white;
            }

            .message-body h1{
                text-align:   center;
              margin-top: 20px;
            }

            .message-body p{
              text-align:   center;
              margin-top:   20px;
              padding-left:   20px;
              padding-right:  20px;
              font-size:  13px;
            }

            .text-center {
                text-align: center;
            }
            </style>

            </head>
             <body>
            <div class="col-lg-12">
              <div class="row">
                <div class="col-sm-12 header-mail">
                  <h1>Verifikasi Seminar</h1>
                </div>
                <div class="col-sm-10 mx-auto message-body">
                  <h1>Hallo Admin Yukseminar !</h1>
                  <p style="font-size:18px;">Ada penyelenggara yang mendaftar seminar nih, tolong di verifikasi dahulu ya....</p>
                      <div class="col text-center mt-4 mb-4">
                  <a href="yukseminar.id"><button class="text-center btn btn-primary">Verifikasi</button></a>
                      </div>
                </div>
              </div>
            </div>

             </body>
             </html>');

             $this->email->send();
    }
}
