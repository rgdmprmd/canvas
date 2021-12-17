<?php defined('BASEPATH') or exit('No direct script access allowed');

class Auth_model extends CI_Model
{
    public function getUser($email)
    {
        return $this->db->get_where('tb_users', ['user_email' => $email])->row_array();
    }

    public function getToken($token)
    {
        return $this->db->get_where('tb_token', ['token' => $token])->row_array();
    }

    public function getMenu()
    {
        return $this->db->get('tb_menu')->result_array();
    }

    public function getActiveUserByEmail($email)
    {
        return $this->db->get_where('tb_users', ['user_email' => $email, 'user_status' => 1])->row_array();
    }

    public function emailIsVerify($email)
    {
        // Update user is active berdasarkan email yang dikirimkan
        $this->db->set('user_status', 1);
        $this->db->where('user_email', $email);
        $this->db->update('tb_users');

        // dan hapus token yang sudah digunakan
        $this->db->delete('tb_token', ['user_email' => $email]);
    }

    public function verifyTokenIsExpired($email)
    {
        // Jika expired, hapus data user dari table user dan token berdasarkan email yang dikirimkan
        $this->db->delete('tb_users', ['user_email' => $email]);
        $this->db->delete('tb_token', ['user_email' => $email]);
    }

    public function forgotTokenIsExpired($email)
    {
        $this->db->delete('tb_token', ['user_email' => $email]);
    }

    public function insertData($data, $table)
    {
        $this->db->insert($table, $data);
    }

    public function updateData($table, $key, $data, $id)
    {
        $this->db->where($key, $id);
        $this->db->update($table, $data);
    }
}