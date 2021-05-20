<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Pelanggan_Model extends CI_Model
{

    public function __construct()
    {
        $this->load->database();
    }

    //query untuk menampilkan daftar pelanggan
    public function master()
    {
        $this->db->select('*');
        $this->db->from('pelanggan');
        $this->db->join('bengkel', 'pelanggan.pelanggan_bengkel = bengkel.bengkel_id');
        $query = $this->db->get();
        return $query->result_array();
    }
    
    public function detailmaster($bengkel_id)
    {
        $this->db->select('*');
        $this->db->from('pelanggan');
        $this->db->join('bengkel', 'pelanggan.pelanggan_bengkel = bengkel.bengkel_id');
        $this->db->where('pelanggan_bengkel', $bengkel_id);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function listing()
    {
        $this->db->select('*');
        $this->db->from('pelanggan');
        $this->db->where('pelanggan_bengkel', $this->session->userdata('bengkel'));
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getbyId($pelanggan_id)
    {
        $this->db->select('*');
        $this->db->from('pelanggan');
        $this->db->where('pelanggan_bengkel', $this->session->userdata('bengkel'));
        $this->db->where('pelanggan_id', $pelanggan_id);
        $query = $this->db->get();
        return $query->row_array();
    }

    //query untuk menyimpan data baru
    public function tambah($pelanggan)
    {
        $this->db->insert('pelanggan', $pelanggan);
    }

    //query untuk menyimpan data yang dirubah (edit)
    public function edit($pelanggan)
    {
        $this->db->where('pelanggan_id', $pelanggan['pelanggan_id']);
        $this->db->update('pelanggan', $pelanggan);
    }

    //query untuk menghapus data
    public function delete($pelanggan)
    {
        $this->db->where('pelanggan_id', $pelanggan['pelanggan_id']);
        $this->db->delete('pelanggan', $pelanggan);
    }
}
