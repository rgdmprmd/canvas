<?php defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Auth_model', 'auth');
    }

    /* ------------------------------LOGIN--------------------------------------- */
    public function index()
    {
        if ($this->session->userdata('email')) {
            redirect('user');
        }

        $data['title'] = 'Login';

        $this->load->view('templates/auth_header', $data);
        $this->load->view('auth/login');
        $this->load->view('templates/auth_footer');
    }

    public function ajaxLogin()
    {
        $this->form_validation->set_rules('email', 'email', 'required|trim|valid_email');
        $this->form_validation->set_rules('password', 'password', 'required|trim');

        if ($this->form_validation->run() == FALSE) {
            $errrrr = [
                'email' => form_error('email', '<span class="text-danger ml-3">', '</span>'),
                'password' => form_error('password', '<span class="text-danger ml-3">', '</span>')
            ];

            $result = [
                'result' => 400,
                'message' => $errrrr
            ];

            echo json_encode($result);
        } else {
            $this->_login();
        }
    }

    private function _login()
    {
        $email = $this->input->post('email', true);
        $password = $this->input->post('password', true);

        $user = $this->auth->getUser($email);

        if ($user) {
            if ($user['user_status'] == 1) {
                if (password_verify($password, $user['user_password'])) {
                    $data = [
                        'email' => $user['user_email'],
                        'role_id' => $user['role_id']
                    ];

                    $this->session->set_userdata($data);

                    $result = [
                        'result' => 200,
                        'message' => $user['role_id']
                    ];

                    echo json_encode($result);
                } else {
                    $result = [
                        'result' => 403,
                        'message' => $email
                    ];

                    echo json_encode($result);
                }
            } else {
                $result = [
                    'result' => 402,
                    'message' => $email
                ];

                echo json_encode($result);
            }
        } else {
            $result = [
                'result' => 401,
                'message' => $email
            ];

            echo json_encode($result);
        }
    }

    /* ------------------------------REGIST--------------------------------------- */
    public function registration()
    {
        if ($this->session->userdata('email')) {
            redirect('user');
        }

        $data['title'] = 'Registration Users';

        $this->load->view('templates/auth_header', $data);
        $this->load->view('auth/registration');
        $this->load->view('templates/auth_footer');
    }

    public function ajaxRegist()
    {
        if ($this->session->userdata('email')) {
            redirect('user');
        }

        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[tb_users.user_email]', ['is_unique' => 'Email has already registered!']);
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]', ['matches' => 'Password is not match!', 'min_length' => 'Password is too short!']);
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');

        if ($this->form_validation->run() == FALSE) {
            $errrrr = [
                'nama' => form_error('name', '<small class="text-danger ml-3">', '</small>'),
                'email' => form_error('email', '<small class="text-danger ml-3">', '</small>'),
                'password' => form_error('password1', '<small class="text-danger ml-3">', '</small>')
            ];

            $result = [
                'result' => false,
                'message' => $errrrr
            ];

            echo json_encode($result);
        } else {
            $nameRegister = htmlspecialchars($this->input->post('name', true));
            $emailRegister = htmlspecialchars($this->input->post('email', true));
            $passwordRegister = $this->input->post('password1');

            // Siapkan data yang akan di register
            $data = [
                'role_id' => 2,
                'user_nama' => $nameRegister,
                'user_email' => $emailRegister,
                'user_picture' => 'default.jpg',
                'user_password' => password_hash($passwordRegister, PASSWORD_DEFAULT),
                'user_bio' => 'Hello, i am recently using this app!',
                'user_status' => 0,
                'user_created' => Date('Y-m-d H:i:s'),
                'user_modified' => NULL
            ];

            // Buat token untuk verifikasi email
            $token = base64_encode(random_bytes(32));

            // Siapkan data yang akan di insert ke user_token
            $user_token = [
                'user_email' => $emailRegister,
                'token' => $token,
                'token_status' => 200,
                'token_created' => Date('Y-m-d H:i:s')
            ];

            // Insert data user baru dan insert token untuk verifikasi email, via model
            $this->auth->insertData($data, 'tb_users');
            $this->auth->insertData($user_token, 'tb_token');

            // Setelah di insert, maka jalankan method _sendEmail untuk mengirimkan email verifkasi
            $this->_sendEmail($token, 'verify', $emailRegister);

            $result = [
                'result' => true,
                'message' => ''
            ];

            echo json_encode($result);
        }
    }

    /* ------------------------------EMAIL--------------------------------------- */
    private function _sendEmail($token, $type, $email)
    {
        // Config standar untuk SMTP sendEmail menggunakan GMAIL
        $config = [
            'protocol'  => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_user' => getenv('SMTP_EMAIL'),
            'smtp_pass' => getenv('SMTP_PASSWORD'),
            'smtp_port' => 465,
            'mailtype'  => 'html',
            'charset'   => 'utf-8',
            'newline'   => "\r\n"
        ];

        // Load library email beserta configurasinya
        $this->load->library('email', $config);
        $this->email->initialize($config);

        // Email nya nanti mau dikirim oleh siapa
        $this->email->from(getenv('SMTP_EMAIL'), 'Bad Code Society');

        // Email nya nanti mau dikirim ke siapa
        $this->email->to($email);

        // Jika tipenya verify tentukan subject dan messagenya
        if ($type == 'verify') {
            // Subject emailnya apa
            $this->email->subject('Account Verification');

            // Isi emailnya apa
            $this->email->message('Hello, welcome to our app, We are glad you are here! Check out <a href="' . base_url() . 'auth/verify?email=' . $email . '&token=' . urlencode($token) . '">this link</a> to start building your first cluster.');
        } else if ($type == 'forgot') {
            // Jika tipenya forgot, Subject emailnya apa
            $this->email->subject('Reset Password');

            // Isi emailnya apa
            $this->email->message('Hello, this link to reset your password : <a href="' . base_url() . 'auth/resetpassword?email=' . $email . '&token=' . urlencode($token) . '">Reset password</a>. Please keep your password carefully in the future.');
        }

        // Cek apakah emailnya berhasil dikirm
        if ($this->email->send()) {
            // Jika berhasil return true
            return true;
        } else {
            // Jika gagal tampilkan errornya
            echo $this->email->print_debugger();
            die;
        }
    }

    public function verify()
    {
        // Tangkap email dan token dari URLs yang dikirimkan dari _sendEmail
        $email = $this->input->get('email');
        $token = $this->input->get('token');

        // cari email dari table user berdasarkan email yang dikirmkan melalui URLs, via model
        $user = $this->auth->getUser($email);

        // Cek apakah usernya ada
        if ($user) {
            // Jika ada, cari token berdasarkan token yang dikirimkan melalui URLs, via model
            $user_token = $this->auth->getToken($token);

            // Cek, apakah token ketemu
            if ($user_token) {
                // Jika ketemu, cek apakah tokennya expired selama 24 jam
                if (time() - strtotime($user_token['token_created']) < (60 * 60 * 24)) {
                    // Jika blm expired, update user menjadi active dan hapus tokennya, via model
                    $this->auth->emailIsVerify($email);

                    // Tampilkan pesan berhasil dan redirect ke halaman login
                    $this->session->set_flashdata('successtoken', $email);
                    redirect('auth');
                } else {
                    // Jika expired, maka hapus data user dan tokennya berdasarkan email yang dikirimkan, via model
                    $this->auth->verifyTokenIsExpired($email);

                    // Tampilkan pesan token expired, dan redirect ke halaman login
                    $this->session->set_flashdata('expiredtoken', 'token');
                    redirect('auth');
                }
            } else {
                // Jika tokennya ga ketemu, tampilkan pesan error dan redirect ke halaman login
                $this->session->set_flashdata('wrongtoken', 'Activation');
                redirect('auth');
            }
        } else {
            // Jika usernya ga ada, tampilkan pesan email salah
            $this->session->set_flashdata('wrongemail', $email);
            redirect('auth');
        }
    }

    public function resetPassword()
    {
        $email = $this->input->get('email');
        $token = $this->input->get('token');

        $user = $this->auth->getUser($email);

        if ($user) {
            $user_token = $this->auth->getToken($token);

            if ($user_token) {
                // Jika ada, cek apakah tokennya expired atau blm 24 Jam
                if (time() - strtotime($user_token['token_created']) < (60 * 60 * 24)) {
                    $this->session->set_userdata('reset_email', $email);
                    $this->changePassword();
                } else {
                    $this->auth->forgotTokenIsExpired($email);

                    $this->session->set_flashdata('expiredtoken', 'Reset Password');
                    redirect('auth');
                }
            } else {
                $this->session->set_flashdata('wrongtoken', 'Reset Password');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('wrongemail', $email);
            redirect('auth');
        }
    }

    /* ------------------------------FORGOT--------------------------------------- */
    public function forgotPassword()
    {
        // Cek apakah si user lagi login atau nga
        if ($this->session->userdata('email')) {
            redirect('user');
        }

        $data['title'] = 'Forgot Password';

        $this->load->view('templates/auth_header', $data);
        $this->load->view('auth/forgot-password');
        $this->load->view('templates/auth_footer');
    }

    public function ajaxForgot()
    {
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|trim');

        if ($this->form_validation->run() == FALSE) {
            $errrr = [
                'email' => form_error('email', '<small class="text-danger ml-3">', '</small>'),
            ];

            $result = [
                'result' => 400,
                'message' => $errrr
            ];

            echo json_encode($result);
        } else {
            $email = $this->input->post('email');
            $user = $this->auth->getActiveUserByEmail($email);

            if ($user) {
                $token = base64_encode(random_bytes(32));
                $user_token = [
                    'user_email' => $email,
                    'token' => $token,
                    'token_status' => 400,
                    'token_created' => Date('Y-m-d H:i:s')
                ];

                $this->auth->insertData($user_token, 'tb_token');
                $this->_sendEmail($token, 'forgot', $email);

                $result = [
                    'result' => 200,
                    'message' => 'Please check your email to reset your password.'
                ];

                echo json_encode($result);
            } else {
                $result = [
                    'result' => 401,
                    'message' => $email
                ];

                echo json_encode($result);
            }
        }
    }

    public function changePassword()
    {
        // cek apakah session reset_email sudah dibuat
        if (!$this->session->userdata('reset_email')) {
            redirect('auth');
        }

        $data['title'] = 'Change Password';
        $this->load->view('templates/auth_header', $data);
        $this->load->view('auth/change-password');
        $this->load->view('templates/auth_footer');
    }

    public function ajaxChange()
    {
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]');
        $this->form_validation->set_rules('password2', 'Repeat Password', 'required|trim|min_length[3]|matches[password1]');

        if ($this->form_validation->run() == FALSE) {
            $errrr = [
                'password1' => form_error('password1', '<small class="text-danger ml-3">', '</small>'),
                'password2' => form_error('password2', '<small class="text-danger ml-3">', '</small>'),
            ];

            $result = [
                'result' => 400,
                'message' => $errrr
            ];

            echo json_encode($result);
        } else {
            $password = password_hash($this->input->post('password1'), PASSWORD_DEFAULT);
            $email = $this->session->userdata('reset_email');

            // ganti password user berdasarkan password yang dikirimkan dan hapus tokennya, via model
            $users = [
                'user_password' => $password,
                'user_modified' => Date("Y-m-d H:i:s")
            ];

            $this->auth->updateData('tb_users', 'user_email', $users, $email);
            $this->auth->forgotTokenIsExpired($email);

            $this->session->unset_userdata('reset_email');

            $result = [
                'result' => 200,
                'message' => "changed"
            ];

            echo json_encode($result);
        }
    }

    /* ------------------------------SESSION--------------------------------------- */
    public function blocked()
    {
        // Mengambil data user berdasarkan email yang dikirimkan oleh session
        $email = $this->session->userdata('email');
        $data['user'] = $this->db->get_where('tb_users', ['user_email' => $email])->row_array();

        // Mencari menu yang ada, via model
        $data['menu'] = $this->auth->getMenu();
        $data['title'] = 'Access Forbidden';

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('auth/blocked', $data);
        $this->load->view('templates/footer');
    }

    public function logout()
    {
        // unset session yang ada
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('role_id');

        // Tampilkan pesan logout berhasil
        redirect('auth');
    }
}
