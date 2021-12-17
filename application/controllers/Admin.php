<?php defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        checkLogin();
        $this->load->model('Admin_model', 'admin');
        $this->load->library('pagination');
    }

    /* -------------------------- DASHBOARD ----------------------------- */
    public function index()
    {
        $email = $this->session->userdata('email');
        $data['user'] = $this->db->get_where('tb_users', ['user_email' => $email])->row_array();
        $data['title'] = 'Dashboard';

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('templates/footer', $data);
    }

    /* -------------------------- MENU MANAGEMENT ----------------------------- */
    public function menu()
    {
        $email = $this->session->userdata('email');
        $data['user'] = $this->db->get_where('tb_users', ['user_email' => $email])->row_array();
        $data['menus'] = $this->admin->getMenu(1);
        $data['title'] = 'Menu Management';

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/menu', $data);
        $this->load->view('templates/footer', $data);
    }

    public function ajaxGetAllMenu()
    {
        $search = $this->input->post('search', true);
        $status = $this->input->post('status', true);
        $offset = $this->uri->segment(3, 0);
        $limit  = 10;

        $menu = $this->admin->getAllMenu($search, $status, $limit, $offset);
        $tr = '';
        $paging = '';

        if ($menu['total'] > 0) {
            $total = $menu['total'];
            $i = $offset + 1;

            foreach ($menu['data'] as $m) {
                ($m['menu_status'] != 1) ? $text_color = "text-danger" : $text_color = "";

                $tr .= '<tr>';
                $tr .= '<td class="text-center ' . $text_color . '">' . $i++ . '</td>';
                $tr .= '<td class="text-left ' . $text_color . '">' . ucwords($m['menu_nama']) . '</td>';
                $tr .= '<td class="text-center">';
                $tr .= '<a href="" class="btn btn-sm btn-success px-3 menu-edit" title="Edit menu" data-id="' . $m['menu_id'] . '" data-toggle="modal" data-target="#newMenuModal"><i class="fas fa-edit"></i></a>';
                $tr .= '</td>';
                $tr .= '</tr>';
            }

            $paging .= $this->_paging($total, $limit, 'ajaxGetAllMenu');
            $paging .= '<span class="page-info">Displaying ' . ($i - 1) . ' of ' . $total . ' data</span>';
        } else {
            $tr .= '<tr>';
            $tr .= '<td colspan="4">No data</td>';
            $tr .= '</tr>';
        }

        $result = [
            'result' => true,
            'message' => $paging,
            'row' => $tr
        ];

        echo json_encode($result);
    }

    public function ajaxGetAllSubmenu()
    {
        $search = $this->input->post('search', true);
        $status = $this->input->post('status', true);
        $offset = $this->uri->segment(3, 0);
        $limit  = 10;

        $submenu = $this->admin->getAllSubmenu($search, $status, $limit, $offset);
        $tr = '';
        $paging = '';

        if ($submenu['total'] > 0) {
            $total = $submenu['total'];
            $i = $offset + 1;

            foreach ($submenu['data'] as $m) {
                ($m['submenu_status'] != 1) ? $text_color = "text-danger" : $text_color = "";

                $tr .= '<tr>';
                $tr .= '<td class="text-center ' . $text_color . '">' . $i++ . '</td>';
                $tr .= '<td class="text-left ' . $text_color . '"><i class="' . $m['submenu_icon'] . '"></i> ' . $m['submenu_nama'] . '</td>';
                $tr .= '<td class="text-left ' . $text_color . '">' . $m['menu_nama'] . '</td>';
                $tr .= '<td class="text-left ' . $text_color . '">' . $m['submenu_url'] . '</td>';
                $tr .= '<td class="text-center">';
                $tr .= '<a href="" class="btn btn-sm btn-success px-3 submenu-edit" data-id="' . $m['submenu_id'] . '" data-toggle="modal" data-target="#newSubMenuModal"><i class="fas fa-edit"></i></a>';
                $tr .= '</td>';
                $tr .= '</tr>';
            }

            $paging .= $this->_paging($total, $limit, 'ajaxGetAllSubmenu');
            $paging .= '<span class="page-info">Displaying ' . ($i - 1) . ' of ' . $total . ' data</span>';
        } else {
            $tr .= '<tr>';
            $tr .= '<td colspan="5">No data</td>';
            $tr .= '</tr>';
        }

        $result = [
            'result' => true,
            'message' => $paging,
            'row' => $tr
        ];

        echo json_encode($result);
    }

    public function ajaxGetMenuById()
    {
        $id = $this->input->post('idJson', true);
        $menu = $this->admin->getMenuById($id);

        echo json_encode($menu);
    }

    public function ajaxGetSubmenuById()
    {
        $id = $this->input->post('idJson', true);
        $menu = $this->admin->getSubmenuById($id);

        echo json_encode($menu);
    }

    public function addMenu()
    {
        $this->form_validation->set_rules('menu', 'nama', 'required|trim');
        $this->form_validation->set_rules('menu_status', 'status', 'required|trim');

        if ($this->form_validation->run() == FALSE) {
            $errrr = [
                'menu' => form_error('menu', '<small class="text-danger ml-3">', '</small>'),
                'menu_status' => form_error('menu_status', '<small class="text-danger ml-3">', '</small>'),
            ];

            $result = [
                'result' => false,
                'message' => $errrr
            ];

            echo json_encode($result);
        } else {
            $menu_nama = $this->input->post('menu', true);
            $menu_status = $this->input->post('menu_status', true);

            $data = [
                'menu_nama' => $menu_nama,
                'menu_url' => $menu_nama,
                'menu_icon' => null,
                'menu_status' => $menu_status,
                'id_input' => $this->session->userdata('email'),
                'dt_input' => Date('Y-m-d H:i:s'),
                'id_update' => $this->session->userdata('email'),
                'dt_update' => Date('Y-m-d H:i:s'),
            ];

            $this->admin->insert($data, 'tb_menu');

            $result = [
                'result' => true,
                'message' => 'Tambah'
            ];

            echo json_encode($result);
        }
    }

    public function updateMenu()
    {
        $this->form_validation->set_rules('menu', 'Menu', 'required|trim');
        $this->form_validation->set_rules('menu_status', 'status', 'required|trim');

        if ($this->form_validation->run() == FALSE) {
            $errrr = [
                'menu' => form_error('menu', '<small class="text-danger ml-3">', '</small>'),
                'menu_status' => form_error('menu_status', '<small class="text-danger ml-3">', '</small>'),
            ];

            $result = [
                'result' => false,
                'message' => $errrr
            ];

            echo json_encode($result);
        } else {
            $menu_id = $this->input->post('menu_id', true);
            $menu_nama = $this->input->post('menu', true);
            $menu_status = $this->input->post('menu_status', true);

            $data = [
                'menu_nama' => $menu_nama,
                'menu_status' => $menu_status,
                'id_update' => $this->session->userdata('email'),
                'dt_update' => date('Y-m-d H:i:s'),
            ];

            $this->admin->update($data, 'tb_menu', $menu_id, 'menu_id');

            $result = [
                'result' => true,
                'message' => 'Update'
            ];

            echo json_encode($result);
        }
    }

    public function addSubmenu()
    {
        $this->form_validation->set_rules('submenu_nama', 'Submenu', 'required|trim');
        $this->form_validation->set_rules('submenu_url', 'Submenu URL', 'required|trim');
        $this->form_validation->set_rules('submenu_icon', 'Submenu Icon', 'required|trim');
        $this->form_validation->set_rules('submenu_status', 'Submenu Status', 'required|trim');
        $this->form_validation->set_rules('id_menu', 'Menu', 'required|trim');

        if ($this->form_validation->run() == FALSE) {
            $errrr = [
                'submenu_nama' => form_error('submenu_nama', '<small class="text-danger ml-3">', '</small>'),
                'submenu_url' => form_error('submenu_url', '<small class="text-danger ml-3">', '</small>'),
                'submenu_icon' => form_error('submenu_icon', '<small class="text-danger ml-3">', '</small>'),
                'submenu_status' => form_error('submenu_status', '<small class="text-danger ml-3">', '</small>'),
                'id_menu' => form_error('id_menu', '<small class="text-danger ml-3">', '</small>'),
            ];

            $result = [
                'result' => false,
                'message' => $errrr
            ];

            echo json_encode($result);
        } else {
            $submenu_nama = $this->input->post('submenu_nama', true);
            $submenu_url = $this->input->post('submenu_url', true);
            $submenu_icon = $this->input->post('submenu_icon', true);
            $submenu_status = $this->input->post('submenu_status', true);
            $id_menu = $this->input->post('id_menu', true);

            $data = [
                'menu_id' => $id_menu,
                'submenu_nama' => $submenu_nama,
                'submenu_url' => $submenu_url,
                'submenu_icon' => $submenu_icon,
                'submenu_status' => $submenu_status,
                'id_input' => $this->session->userdata('email'),
                'dt_input' => date('Y-m-d H:i:s'),
                'id_update' => $this->session->userdata('email'),
                'dt_update' => date('Y-m-d H:i:s'),
            ];

            $this->admin->insert($data, 'tb_submenu');

            $result = [
                'result' => true,
                'message' => 'Tambah'
            ];

            echo json_encode($result);
        }
    }

    public function updateSubmenu()
    {
        $this->form_validation->set_rules('submenu_nama', 'Submenu', 'required|trim');
        $this->form_validation->set_rules('submenu_url', 'Submenu URL', 'required|trim');
        $this->form_validation->set_rules('submenu_icon', 'Submenu Icon', 'required|trim');
        $this->form_validation->set_rules('submenu_status', 'Submenu Status', 'required|trim');
        $this->form_validation->set_rules('id_menu', 'Menu ID', 'required|trim');

        if ($this->form_validation->run() == FALSE) {
            $errrr = [
                'submenu_nama' => form_error('submenu_nama', '<small class="text-danger ml-3">', '</small>'),
                'submenu_url' => form_error('submenu_url', '<small class="text-danger ml-3">', '</small>'),
                'submenu_icon' => form_error('submenu_icon', '<small class="text-danger ml-3">', '</small>'),
                'submenu_status' => form_error('submenu_status', '<small class="text-danger ml-3">', '</small>'),
                'id_menu' => form_error('id_menu', '<small class="text-danger ml-3">', '</small>'),
            ];

            $result = [
                'result' => false,
                'message' => $errrr
            ];

            echo json_encode($result);
        } else {
            $submenu_id = $this->input->post('submenu_id', true);
            $submenu_nama = $this->input->post('submenu_nama', true);
            $submenu_url = $this->input->post('submenu_url', true);
            $submenu_icon = $this->input->post('submenu_icon', true);
            $submenu_status = $this->input->post('submenu_status', true);
            $id_menu = $this->input->post('id_menu', true);

            $data = [
                'menu_id' => $id_menu,
                'submenu_nama' => $submenu_nama,
                'submenu_url' => $submenu_url,
                'submenu_icon' => $submenu_icon,
                'submenu_status' => $submenu_status,
                'id_update' => $this->session->userdata('email'),
                'dt_update' => date('Y-m-d H:i:s'),
            ];

            $this->admin->update($data, 'tb_submenu', $submenu_id, 'submenu_id');

            $result = [
                'result' => true,
                'message' => 'Update'
            ];

            echo json_encode($result);
        }
    }

    /* -------------------------- ROLE MANAGEMENT ----------------------------- */
    public function role()
    {
        $email = $this->session->userdata('email');
        $data['user'] = $this->db->get_where('tb_users', ['user_email' => $email])->row_array();
        $data['menus'] = $this->admin->getMenu(1);
        $data['title'] = 'Role';

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/role', $data);
        $this->load->view('templates/footer', $data);
    }

    public function ajaxGetAllRole()
    {
        $role = $this->admin->getAllRole();
        $tr = '';

        if ($role) {
            $i = 1;

            foreach ($role as $r) {
                $tr .= '<tr>';
                $tr .= '<td class="text-center">' . $i++ . '</td>';
                $tr .= '<td class="text-left">' . $r['role_nama'] . '</td>';
                $tr .= '<td class="text-center">';
                $tr .= '<a href="" class="btn btn-sm btn-success px-3 role-edit" data-id="' . $r['role_id'] . '" data-toggle="modal" data-target="#roleModal"><i class="fas fa-fw fa-edit"></i></a>';
                $tr .= '<a href="" class="btn btn-sm btn-primary px-3 role-access ml-1" data-id="' . $r['role_id'] . '" data-toggle="modal" data-target="#accessModal"><i class="fas fa-fw fa-lock"></i></a>';
                $tr .= '</td>';
                $tr .= '</tr>';
            }
        } else {
            $tr .= '<tr>';
            $tr .= '<td colspan="3">No data</td>';
            $tr .= '</tr>';
        }

        echo json_encode($tr);
    }

    public function ajaxGetRoleById()
    {
        $id = $this->input->post('idJson');
        $data = $this->admin->getRoleById($id);

        echo json_encode($data);
    }

    public function ajaxGetRoleAccess()
    {
        $role_id = $this->input->post('role_id', true);
        $role = $this->admin->getRoleById($role_id);
        $menu = $this->admin->getMenu(2);
        $tr = '';

        if ($menu) {
            $i = 1;

            foreach ($menu as $m) {
                $tr .= '<tr>';
                $tr .= '<td class="text-center">' . $i++ . '</td>';
                $tr .= '<td class="text-center">' . $m['menu_nama'] . '</td>';
                $tr .= '<td class="text-center">';
                $tr .= '<div class="form-check">';
                $tr .= '<input class="form-check-input cekboxs" type="checkbox" ' . check_access($role_id, $m['menu_id']) . ' data-role="' . $role_id . '" data-menu="' . $m['menu_id'] . '">';
                $tr .= '</div>';
                $tr .= '</td>';
                $tr .= '</tr>';
            }
        } else {
            $tr .= '<tr>';
            $tr .= '<td colspan="4">No data</td>';
            $tr .= '</tr>';
        }

        echo json_encode(array('role' => $role, 'menu' => $tr));
    }

    public function changeAccess()
    {
        $role_id = $this->input->post('roleId');
        $menu_id = $this->input->post('menuId');

        $data = [
            'role_id' => $role_id,
            'menu_id' => $menu_id
        ];

        $getAccess = $this->admin->getAccess($data);

        if ($getAccess < 1) {
            $insert = [
                'role_id' => $role_id,
                'menu_id' => $menu_id,
                'id_input' => $this->session->userdata('email'),
                'dt_input' => Date('Y-m-d H:i:s'),
                'id_update' => $this->session->userdata('email'),
                'dt_update' => Date('Y-m-d H:i:s'),
            ];

            $this->admin->setAccess($insert);
        } else {
            $this->admin->dropAccess($data);
        }

        echo json_encode('Access changed!');
    }

    private function _paging($total, $limit, $modul)
    {
        $config = [
            'base_url'  => base_url() . 'admin/' . $modul,
            'total_rows' => $total,
            'per_page'  => $limit,
            'uri_segment' => 3
        ];

        $this->pagination->initialize($config);

        return $this->pagination->create_links();
    }
}
