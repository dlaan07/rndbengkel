<?php

defined('BASEPATH') or exit('No direct script access allowed');

class User_Model extends CI_Model
{

    public function __construct()
    {
        $this->load->database();
    }

    //query untuk menampilkan daftar user
    public function master()
    {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->join('role', 'user.user_role = role.role_id');
        $this->db->join('bengkel', 'user.user_bengkel = bengkel.bengkel_id');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function listing()
    {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->join('role', 'user.user_role = role.role_id');
        $this->db->where('user_bengkel', $this->session->userdata('bengkel'));
        $query = $this->db->get();
        return $query->result_array();
    }

    public function role()
    {
        $this->db->select('*');
        $this->db->from('role');
        // $this->db->where('user_bengkel', $this->session->userdata('bengkel'));
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getbyId($user_id)
    {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where('user_bengkel', $this->session->userdata('bengkel'));
        $this->db->where('user_id', $user_id);
        $query = $this->db->get();
        return $query->row_array();
    }

    //query untuk menyimpan data baru
    public function tambah($user)
    {
        $this->db->insert('user', $user);
    }

    //query untuk menyimpan data yang dirubah (edit)
    public function edit($user)
    {
        $this->db->where('user_id', $user['user_id']);
        $this->db->update('user', $user);
    }

    //query untuk menghapus data
    public function delete($user)
    {
        $this->db->where('user_id', $user['user_id']);
        $this->db->delete('user', $user);
    }
}
