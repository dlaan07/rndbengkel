<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Konfigurasi_Model extends CI_Model
{

    public function __construct()
    {
        $this->load->database();
    }

    //query untuk menampilkan daftar pelanggan
    public function master()
    {
        $this->db->select('*');
        $this->db->from('konfigurasi');
        $this->db->join('bengkel', 'konfigurasi.conf_bengkel = bengkel.bengkel_id');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function detail($config_id)
    {
        $this->db->select('*');
        $this->db->from('konfigurasi');
        $this->db->where('config_id', $config_id);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function listing()
    {
        $this->db->select('*');
        $this->db->from('konfigurasi');
        $this->db->where('conf_bengkel', $this->session->userdata('bengkel'));
        $query = $this->db->get();
        return $query->row_array();
    }
    
    public function konfig($bengkel)
    {
        $this->db->select('*');
        $this->db->from('konfigurasi');
        $this->db->where('conf_bengkel', $bengkel);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function tambah($konfigurasi)
    {
        $this->db->insert('konfigurasi', $konfigurasi);
    }

    //query untuk menyimpan data yang dirubah (edit)
    public function edit($konfigurasi)
    {
        $this->db->where('config_id', $konfigurasi['config_id']);
        $this->db->update('konfigurasi', $konfigurasi);
    }
}
