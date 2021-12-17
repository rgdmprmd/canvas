<?php

// Fungsi helper untuk cek login, via session
function checkLogin()
{
    // get_instance untuk bisa menggunakan semua function dasar codeigniter
    $ci = get_instance();

    if (!$ci->session->userdata('email')) {
        redirect('auth');
    } else {
        $role_id = $ci->session->userdata('role_id');
        $menu = $ci->uri->segment(1);

        $tb_menu = $ci->db->get_where('tb_menu', ['menu_nama' => $menu])->row_array();
        $menu_id = $tb_menu['menu_id'];

        $access = $ci->db->get_where('tb_access', ['role_id' => $role_id, 'menu_id' => $menu_id]);

        if ($access->num_rows() < 1) {
            redirect('auth/blocked');
        }
    }
}

// Fungsi yang menangkap role apa yang memiliki menu apa
function check_access($roleId, $menuId)
{
    // get instance untuk bisa menggunakan semua function codeigniter
    $ci = get_instance();

    // Tangkap idRole yang dikirim memiliki idMenu apa saja
    $result = $ci->db->get_where('tb_access', ['role_id' => $roleId, 'menu_id' => $menuId]);

    // Jika hasil dari query diatas memiliki hasil
    if ($result->num_rows() > 0) {
        // maka return attr checked untuk checkbox
        return "checked='checked'";
    }
}