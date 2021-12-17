<?php defined('BASEPATH') or exit('No direct script access allowed');

class Admin_model extends CI_Model
{
    public function getMenu($status)
    {
        if($status > 1) {
            $sql = "SELECT * FROM tb_menu ORDER BY menu_id ASC";
        } else {
            $sql = "SELECT * FROM tb_menu WHERE menu_status = {$status} ORDER BY menu_id ASC";
        }

        return $this->db->query($sql)->result_array();
    }

    public function getAllMenu($search, $status, $limit, $offset)
    {
        ($search) ? $where_search = " AND menu_nama LIKE '%{$search}%'" : $where_search = '';
        ($status < 2) ? $where_status = " AND menu_status = {$status}" : $where_status = '';
        
        $sql = "SELECT * FROM tb_menu WHERE 0=0 {$where_status} {$where_search} ORDER BY menu_id ASC LIMIT {$offset}, {$limit}";
        $sql_count = "SELECT * FROM tb_menu WHERE 0=0 {$where_status} {$where_search}";
    
        $data['data'] = $this->db->query($sql)->result_array();
        $data['total'] = $this->db->query($sql_count)->num_rows();;

        return $data;
    }

    public function getAllSubmenu($search, $status, $limit, $offset)
    {
        ($search) ? $where_search = " AND (submenu_url LIKE '%{$search}%' OR submenu_nama LIKE '%{$search}%')" : $where_search = '';
        ($status != 2) ? $where_status = " AND submenu_status = {$status}" : $where_status = '';

        $sql = "SELECT * FROM tb_submenu s JOIN tb_menu m USING (menu_id) WHERE 0=0 {$where_status} {$where_search} ORDER BY s.submenu_id ASC LIMIT {$offset}, {$limit}";
        $sql_count = "SELECT * FROM tb_submenu s JOIN tb_menu m USING (menu_id) WHERE 0=0 {$where_status} {$where_search}";
        
        $data['data'] = $this->db->query($sql)->result_array();
        $data['total'] = $this->db->query($sql_count)->num_rows();

        return $data;
    }

    public function getMenuById($id)
    {
        return $this->db->get_where('tb_menu', ['menu_id' => $id])->row_array();
    }

    public function getSubmenuById($id)
    {
        return $this->db->get_where('tb_submenu', ['submenu_id' => $id])->row_array();
    }

    public function getAllRole()
    {
        return $this->db->get('tb_role')->result_array();
    }

    public function getRoleById($id)
    {
        return $this->db->get_where('tb_role', ['role_id' => $id])->row_array();
    }

    public function getAccess($data)
    {
        return $this->db->get_where('tb_access', $data)->num_rows();
    }

    public function setAccess($data)
    {
        $this->db->insert('tb_access', $data);
    }
    
    public function dropAccess($data)
    {
        $this->db->delete('tb_access', $data);
    }

    public function insert($data, $table)
    {
        $this->db->insert($table, $data);
    }

    public function update($data, $table, $id, $field_id)
    {
        $this->db->where($field_id, $id);
        $this->db->update($table, $data);
    }
}