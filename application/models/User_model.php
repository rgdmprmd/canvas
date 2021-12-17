<?php defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends CI_Model
{
    public function updatePassword($data, $email)
    {
        $this->db->where('user_email', $email);
        $this->db->update('tb_users', $data);
    }

    public function updateProfile($name, $email, $image)
    {
        if($image != null) {
            $data = [
                'user_nama' => $name,
                'user_picture' => $image,
                'user_modified' => Date('Y-m-d H:i:s')
            ];
        } else {
            $data = [
                'user_nama' => $name,
                'user_modified' => Date('Y-m-d H:i:s')
            ];
        }

        $this->db->where('user_email', $email);
        $this->db->update('tb_users', $data);
    }
}