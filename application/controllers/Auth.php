<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model("user_model");
    }

    public function index()
    {
        if ($this->session->userdata('email')) {
            redirect('user');
        }

        $data['title'] = 'Login Page';
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('pass', 'Password', 'trim|required');

        if ($this->form_validation->run() == false) {
            
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/login');
            $this->load->view('templates/auth_footer');
        } else {
            // validasinya success
            $this->_login();
        }
    }


    private function _login()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('pass');

        $user = $this->db->get_where('tuser', ['email_user' => $email])->row_array();

        // jika usernya ada
        if ($user) {
            // jika usernya aktif
            if ($user['is_active'] == 1) {
                // cek password
                if (password_verify($password, $user['pass_user'])) {
                    $data = [
                        'id' => $user['id_user'],
                        'email' => $user['email_user'],
                        'role' => $user['role_user']
                    ];
                    $this->session->set_userdata($data);
                    if ($user['role_user'] == 'user') {
                        redirect('user');
                    }else if ($user['role_user'] == 'admin'){
                        redirect('admin');
                    }else if ($user['role_user'] == 'pengawas'){
                        redirect('pengawas');
                    }
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Password salah!</div>');
                    redirect('auth');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Email belum diaktivasi!</div>');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Email belum terdaftar!</div>');
            redirect('auth');
        }
    }


    public function registration()
    {
        if ($this->session->userdata('email')) {
            redirect('user');
        }

        $data['title'] = 'User Registration';
        $this->form_validation->set_rules('username', 'Username', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[tuser.email_user]');
        $this->form_validation->set_rules('pass', 'Password', 'required|trim|min_length[8]|matches[pass2]');
        $this->form_validation->set_rules('pass2', 'Password', 'required|trim|matches[pass]');
        $this->form_validation->set_rules('phone_user', 'Nomor HP', 'required|numeric');

        if ($this->form_validation->run() == false) {
            
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/registration');
            $this->load->view('templates/auth_footer');
        } else {
            $email = $this->input->post('email', true);
            $data = [
                'nama_user' => htmlspecialchars($this->input->post('username', true)),
                'email_user' => $email,
                'nim_user' => $this->input->post('nim', true),
                'universitas' => $this->input->post('universitas', true),
                'jurusan' => $this->input->post('jurusan', true),
                'pass_user' => password_hash($this->input->post('pass'), PASSWORD_DEFAULT),
                'role_user' => 'user',
                'phone_user' => $this->input->post('phone_user', true),
                'is_active' => 0,
                'photo_user' => 'img/profile/default.jpg'
            ];

            // siapkan token
            $token = md5(uniqid(rand(), true));
            $user_token = [
                'email' => $email,
                'token' => $token,
                'date_created' => date("Y-m-d")
            ];

            $regis = $this->user_model->createUser($data);
            if ($regis) {
              $this->db->insert('tuser_token', $user_token);

              $send = $this->_sendEmail($token, 'verify');
              if ($send) {
                $this->session->set_flashdata('message', '<div class="alert alert-primary" role="alert">Selamat! akun anda berhasil dibuat, cek email untuk lakukan Aktivasi!</div>');
                redirect('auth');
              }else{
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Maaf! Akun gagal dibuat, ada kesalahan!</div>');
                redirect('auth/registration');
              }

            }else{
              $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Maaf! Akun gagal dibuat, ada kesalahan!</div>');
              redirect('auth/registration');
            }


        }
    }


    private function _sendEmail($token, $type)
    {
        // $config = [
        //     'protocol' => 'smtp',
        //     'smtp_host' => 'ssl://smtp.googlemail.com',
        //     'smtp_user' => 'henrycuber@gmail.com',
        //     'smtp_pass' => 'modernw4r3',
        //     'smtp_port' => 465,
        //     'mailtype' => 'html',
        //     'charset' => 'utf-8',
        //     'newline' => "\r\n"
        // ];
        //
        // $this->email->initialize($config);
        //
        // $this->email->from('henrycuber@gmail.com', 'Yuk Seminar');
        // $this->email->to($this->input->post('email'));

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
        $this->email->to($this->input->post('email'));

        if ($type == 'verify') {
            $this->email->subject('Verifikasi Akun');
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
                <h1>Aktivasi Akun</h1>
              </div>
              <div class="col-sm-10 mx-auto message-body">
                <h1>Hallo ' .$this->input->post('username').' !</h1>
                <p style="font-size:18px;">Terimakasih '.$this->input->post('username').' telah daftar akun di yukseminar.id. Demi keamanan akun, kami membuat sistem agar user terlebih dahulu melakukan aktivasi akun dengan cara klik tombol dibawah ini.</p>
                    <div class="col text-center mt-4 mb-4">
                <a href="' . base_url() . 'auth/verify?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '"><button class="text-center btn btn-primary">Aktivasi</button></a>
                    </div>
              </div>
            </div>
          </div>

           </body>
           </html>');
        } else if ($type == 'forgot') {
            $this->email->subject('Reset Password');
            $this->email->message('Click this link to reset your password : <a href="' . base_url() . 'auth/resetpassword?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '">Reset Password</a>');
        }

        if ($this->email->send()) {
            return true;
        } else {
            // echo $this->email->print_debugger();
            // die;
            return false;
        }
    }


    public function verify()
    {
        $email = $this->input->get('email');
        $token = $this->input->get('token');

        $user = $this->db->get_where('tuser', ['email_user' => $email])->row_array();

        if ($user) {
            $user_token = $this->db->get_where('tuser_token', ['token' => $token])->row_array();

            if ($user_token) {
                // if (date('Y-m-d') - $user_token['date_created'] < (60 * 60 * 24)) {
                    $this->db->set('is_active', 1);
                    $this->db->where('email_user', $email);
                    $this->db->update('tuser');
                    $this->db->delete('tuser_token', ['email' => $email]);

                    $this->session->set_flashdata('message', '<div class="alert alert-primary" role="alert">' . $email . ' telah aktif! Silakan login.</div>');
                    redirect('auth');
                // } else {
                //     $this->db->delete('tuser', ['email_user' => $email]);
                //     $this->db->delete('tuser_token', ['email_user' => $email]);
                //
                //     $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Aktivasi gagal!, Token expired!.</div>');
                //     redirect('auth');
                // }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Aktivasi gagal! Token salah.</div>');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Aktivasi gagal! Email salah.</div>');
            redirect('auth');
        }
    }


    public function logout()
    {
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('role');
        $this->session->unset_userdata('ava');

        $this->session->set_flashdata('message', '<div class="alert alert-primary" role="alert">Anda berhasil keluar</div>');
        redirect(base_url());
    }


    public function blocked()
    {
        $this->load->view('auth/blocked');
    }


    public function forgotPassword()
    {
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Forgot Password';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/forgot-password');
            $this->load->view('templates/auth_footer');
        } else {
            $email = $this->input->post('email');
            $user = $this->db->get_where('tuser', ['email_user' => $email, 'is_active' => 1])->row_array();

            if ($user) {
                $token = base64_encode(random_bytes(32));
                $user_token = [
                    'email' => $email,
                    'token' => $token,
                    'date_created' => time()
                ];

                $this->db->insert('tuser_token', $user_token);
                $this->_sendEmail($token, 'forgot');

                $this->session->set_flashdata('message', '<div class="alert alert-primary" role="alert">Silakan cek email untuk melakukan reset password!</div>');
                redirect('auth/forgotpassword');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Email tidak terdaftar atau tidak aktif!</div>');
                redirect('auth/forgotpassword');
            }
        }
    }


    public function resetPassword()
    {
        $email = $this->input->get('email');
        $token = $this->input->get('token');

        $user = $this->db->get_where('tuser', ['email_user' => $email])->row_array();

        if ($user) {
            $user_token = $this->db->get_where('tuser_token', ['token' => $token])->row_array();

            if ($user_token) {
                $this->session->set_userdata('reset_email', $email);
                $this->changePassword();
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Reset password gagal! Token salah.</div>');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Reset password gagal! Email salah.</div>');
            redirect('auth');
        }
    }


    public function changePassword()
    {
        if (!$this->session->userdata('reset_email')) {
            redirect('auth');
        }

        $this->form_validation->set_rules('pass', 'Password', 'trim|required|min_length[3]|matches[pass2]');
        $this->form_validation->set_rules('pass2', 'Repeat Password', 'trim|required|min_length[3]|matches[pass]');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Change Password';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/change-password');
            $this->load->view('templates/auth_footer');
        } else {
            $password = password_hash($this->input->post('pass'), PASSWORD_DEFAULT);
            $email = $this->session->userdata('reset_email');

            $this->db->set('pass_user', $password);
            $this->db->where('email_user', $email);
            $this->db->update('tuser');

            $this->session->unset_userdata('reset_email');

            $this->db->delete('tuser_token', ['email' => $email]);

            $this->session->set_flashdata('message', '<div class="alert alert-primary" role="alert">Password berhasil diubah! Silakan login.</div>');
            redirect('auth');
        }
    }
}
