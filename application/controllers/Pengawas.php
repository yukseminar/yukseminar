<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengawas extends CI_Controller
{
    public function __construct()
    {
    	parent::__construct();
    	$this->load->model("seminar_model");
      $this->load->model("user_model");
      $this->load->model("Peserta_model");
      $this->load->model("Pengawas_model");
    }


    public function index()
    {
        $data['title'] = 'Yukseminar.id | Aplikasi daftar dan buat seminar secara mudah dan gratis';
        $data['user'] = $this->user_model->getDataUser($this->session->userdata('email'));
        $data['list'] = $this->Pengawas_model->getDataPeserta($data['user']['pengawas_seminar']);
        $data['seminar'] = $this->seminar_model->getDataSeminarById2($data['user']['pengawas_seminar']);


        if ($data['user']['role_user']== 'pengawas') {
        $this->load->view('templates/header_user', $data);
        $this->load->view('pengawas/cek_data',$data);
        $this->load->view('templates/footer_user');
        }else{
          redirect(base_url());
        }

    }

    public function konfirmasi(){
      $data['title'] = 'Yukseminar.id | Aplikasi daftar dan buat seminar secara mudah dan gratis';
      $data['user'] = $this->user_model->getDataUser($this->session->userdata('email'));
      if ($data['user']['role_user']== 'pengawas') {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
          $idpeserta = $this->input->post('peserta',true);
          $idseminar = $this->input->post('seminar',true);
          $data['peserta'] = $this->Pengawas_model->getPesertaById($idpeserta);
          $data['seminar'] = $this->seminar_model->getDataSeminarById2($data['user']['pengawas_seminar']);
          $email = $data['peserta'][0]['email_user'];
          $nama = $data['peserta'][0]['nama_user'];
          $namaseminar = $data['seminar']['nama_seminar'];
          $url = $data['seminar']['url_seminar'];
          $seminarku = $this->Peserta_model->getPesertaById($idpeserta);
          $qrcode = $seminarku['barcode'];


          if ($data['seminar']['paper']==1 && $data['seminar']['pembayaran']==1) {
            if ($data['peserta'][0]['paper_peserta']!= null && $data['peserta'][0]['pembayaran_peserta']!= null) {
              $cek = $this->Pengawas_model->confirmPeserta($idpeserta);
              if ($cek) {
                $this->_sendEmail($email,$nama,$namaseminar,$url);
                $this->session->set_flashdata('selesaisuccess','Peserta atas nama '. $data['peserta'][0]['nama_user'] .' berhasil terkonfirmasi !');
                redirect(base_url('pengawas'));
              }else{
                $this->session->set_flashdata('selesaifailed','Ada kesalahan !');
                redirect(base_url('pengawas'));
              }
            }else{
              $this->session->set_flashdata('selesaifailed','Berkas belum lengkap !');
              redirect(base_url('pengawas'));
            }
          }else if ($data['seminar']['paper']==1) {
            if ($data['peserta'][0]['paper_peserta']!= null) {
              $cek = $this->Pengawas_model->confirmPeserta($idpeserta);
              if ($cek) {
                $this->_sendEmail($email,$nama,$namaseminar,$url,$qrcode);
                $this->session->set_flashdata('selesaisuccess','Peserta atas nama '. $data['peserta'][0]['nama_user'] .' berhasil terkonfirmasi !');
                redirect(base_url('pengawas'));
              }else{
                $this->session->set_flashdata('selesaifailed','Ada kesalahan !');
                redirect(base_url('pengawas'));
              }
            }else{
              $this->session->set_flashdata('selesaifailed','Berkas belum lengkap !');
              redirect(base_url('pengawas'));
            }
          }else if ($data['seminar']['pembayaran']==1) {
            if ($data['peserta'][0]['pembayaran_peserta']!= null) {
              $cek = $this->Pengawas_model->confirmPeserta($idpeserta);
              if ($cek) {
                $this->_sendEmail($email,$nama,$namaseminar,$url,$qrcode);
                $this->session->set_flashdata('selesaisuccess','Peserta atas nama '. $data['peserta'][0]['nama_user'] .' berhasil terkonfirmasi !');
                redirect(base_url('pengawas'));
              }else{
                $this->session->set_flashdata('selesaifailed','Ada kesalahan !');
                redirect(base_url('pengawas'));
              }

            }else{
              $this->session->set_flashdata('selesaifailed','Berkas belum lengkap !');
              redirect(base_url('pengawas'));
            }
          }



        }else{
          redirect(base_url('pengawas'));
        }
      }else{
        redirect(base_url());
      }

    }

    private function _sendEmail($to, $namauser,$namaseminar, $url, $qrcode)
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




}
