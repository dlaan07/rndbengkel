<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Jasa_Model extends CI_Model
{

    public function __construct()
    {
        $this->load->database();
    }

    //query untuk menampilkan daftar pelanggan
    public function master()
    {
        $this->db->select('*');
        $this->db->from('master_jasa');
        $this->db->join('bengkel', 'master_jasa.jasa_bengkel = bengkel.bengkel_id');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function listing()
    {
        $this->db->select('*');
        $this->db->from('master_jasa');
        $this->db->where('jasa_bengkel', $this->session->userdata('bengkel'));
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getbyId($jasa_id)
    {
        $this->db->select('*');
        $this->db->from('master_jasa');
        $this->db->where('jasa_bengkel', $this->session->userdata('bengkel'));
        $this->db->where('jasa_id', $jasa_id);
        $query = $this->db->get();
        return $query->row_array();
    }

    //query untuk menyimpan data baru
    public function tambah($jasa)
    {
        $this->db->insert('master_jasa', $jasa);
    }

    //query untuk menyimpan data yang dirubah (edit)
    public function edit($jasa)
    {
        $this->db->where('jasa_id', $jasa['jasa_id']);
        $this->db->update('master_jasa', $jasa);
    }

    //query untuk menghapus data
    public function delete($jasa)
    {
        $this->db->where('jasa_id', $jasa['jasa_id']);
        $this->db->delete('master_jasa', $jasa);
    }
}
