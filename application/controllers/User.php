<?php defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        checkLogin();
        $this->load->model('User_model', 'user');
    }

    public function index()
    {
        $email = $this->session->userdata('email');
        $data['user'] = $this->db->get_where('tb_users', ['user_email' => $email])->row_array();

        $data['title'] = 'Profile';
        $data['env'] = getenv('SMTP_EMAIL');

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/index', $data);
        $this->load->view('templates/footer');
    }

    public function ajaxChangePassword()
    {
        $this->form_validation->set_rules('old-password', 'Current Password', 'required|trim');
        $this->form_validation->set_rules('newpassword-1', 'New Password', 'required|trim|min_length[3]|matches[newpassword-2]');
        $this->form_validation->set_rules('newpassword-2', 'Repeat New Password', 'required|trim|min_length[3]|matches[newpassword-1]');

        if ($this->form_validation->run() == FALSE) {
            $errrr = [
                'oldPassword' => form_error('old-password', '<small class="text-danger pl-3">', '</small>'),
                'password1' => form_error('newpassword-1', '<small class="text-danger pl-3">', '</small>'),
                'password2' => form_error('newpassword-2', '<small class="text-danger pl-3">', '</small>'),
            ];

            $result = [
                'result' => 400,
                'message' => $errrr
            ];

            echo json_encode($result);
        } else {
            $oldPassword = $this->input->post('old-password', true);
            $password1 = $this->input->post('newpassword-1', true);
            $password2 = $this->input->post('newpassword-2', true);
            $email = $this->session->userdata('email');
            $user = $this->db->get_where('tb_users', ['user_email' => $email])->row_array();

            if (!password_verify($oldPassword, $user['user_password'])) {
                $errrr = [
                    'notif' => 'Oops, change password failed!',
                    'alert' => 'Your current password is wrong.',
                ];

                $result = [
                    'result' => 404,
                    'message' => $errrr
                ];

                echo json_encode($result);
            } else {
                if ($oldPassword == $password1) {
                    $errrr = [
                        'notif' => 'Oops, change password failed!',
                        'alert' => 'New password cannot be the same as current password.',
                    ];

                    $result = [
                        'result' => 404,
                        'message' => $errrr
                    ];

                    echo json_encode($result);
                } else {
                    $hash = password_hash($password1, PASSWORD_DEFAULT);

                    $data = [
                        'user_password' => $hash,
                        'user_modified' => Date('Y-m-d H:i:s')
                    ];

                    $this->user->updatePassword($data, $email);

                    $result = [
                        'result' => 200,
                        'message' => 'changed'
                    ];

                    echo json_encode($result);
                }
            }
        }
    }

    public function ajaxChangeProfile()
    {
        $name = $this->input->post('name', true);
        $email = $this->input->post('email', true);
        $user = $this->db->get_where('tb_users', ['user_email' => $email])->row_array();

        $config['allowed_types'] = 'gif|jpg|jpeg|png';
        $config['max_size']     = '2048';
        $config['upload_path'] = './assets/img/profile/';
        $config['encrypt_name'] = TRUE;

        $this->load->library('upload', $config);

        $this->form_validation->set_rules('name', 'Name', 'required|trim');

        if ($this->form_validation->run() == FALSE) {
            $errrr = [
                'name' => form_error('name', '<small class="text-danger pl-3">', '</small>'),
                'img' => '<small class="text-danger pl-3 mt-2">' . $this->upload->display_errors() . '</small>'
            ];

            $result = [
                'result' => 400,
                'message' => $errrr,
            ];

            echo json_encode($result);
        } else {
            $uploadImage = $_FILES['image']['name'];
            if ($uploadImage) {

                if ($this->upload->do_upload('image')) {
                    $oldImage = $user['user_picture'];

                    if ($oldImage != 'default.jpg') {
                        unlink(FCPATH . 'assets/img/profile/' . $oldImage);
                    }

                    $newImage = $this->upload->data('file_name');
                    $this->user->updateProfile($name, $email, $newImage);

                    $result = [
                        'result' => true,
                        'message' => 'Berhasil'
                    ];

                    echo json_encode($result);
                } else {
                    $errrr = [
                        'name' => form_error('name', '<small class="text-danger pl-3">', '</small>'),
                        'img' => '<small class="text-danger pl-3 mt-2">' . $this->upload->display_errors() . '</small>'
                    ];

                    $result = [
                        'result' => 400,
                        'message' => $errrr
                    ];

                    echo json_encode($result);
                }
            } else {
                $this->user->updateProfile($name, $email, null);

                $result = [
                    'result' => true,
                    'message' => 'Berhasil'
                ];

                echo json_encode($result);
            }
        }
    }
}
