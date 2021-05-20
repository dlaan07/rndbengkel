<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Bengkel_Model extends CI_Model
{

    public function __construct()
    {
        $this->load->database();
    }

    //query untuk menampilkan daftar bengkel
    public function master()
    {
        $this->db->select('*');
        $this->db->from('bengkel');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getbyId($bengkel_id)
    {
        $this->db->select('*');
        $this->db->from('bengkel');
        $this->db->where('bengkel_id', $bengkel_id);
        $query = $this->db->get();
        return $query->row_array();
    }

    //query untuk menyimpan data baru
    public function tambah($bengkel)
    {
        $this->db->insert('bengkel', $bengkel);
    }

    //query untuk menyimpan data yang dirubah (edit)
    public function edit($bengkel)
    {
        $this->db->where('bengkel_id', $bengkel['bengkel_id']);
        $this->db->update('bengkel', $bengkel);
    }

    //query untuk menghapus data
    public function delete($bengkel)
    {
        $this->db->where('bengkel_id', $bengkel['bengkel_id']);
        $this->db->delete('bengkel', $bengkel);
    }
}
