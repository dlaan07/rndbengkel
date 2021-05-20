<?php

defined('BASEPATH') or exit('No direct script access allowed');

class PartMaster_Model extends CI_Model
{

    public function __construct()
    {
        $this->load->database();
    }

    //query untuk menampilkan daftar partmaster
    public function master()
    {
        $this->db->select('*');
        $this->db->from('partmaster');
        $this->db->join('bengkel', 'partmaster.partMaster_bengkel = bengkel.bengkel_id');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function detailMaster($bengkel_id)
    {
        $this->db->select('*');
        $this->db->from('partmaster');
        $this->db->join('bengkel', 'partmaster.partMaster_bengkel = bengkel.bengkel_id');
        $this->db->where('partMaster_bengkel', $bengkel_id);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function listing()
    {
        $this->db->select('*');
        $this->db->from('partmaster');
        $this->db->where('partMaster_bengkel', $this->session->userdata('bengkel'));
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getbyId($partmaster_id)
    {
        $this->db->select('*');
        $this->db->from('partmaster');
        $this->db->where('partmaster_id', $partmaster_id);
        $this->db->where('partmaster_bengkel', $this->session->userdata('bengkel'));
        $query = $this->db->get();
        return $query->row_array();
    }

    //query untuk menyimpan data baru
    public function tambah($partmaster)
    {
        $this->db->insert('partmaster', $partmaster);
    }

    //query untuk menyimpan data yang dirubah (edit)
    public function edit($partmaster)
    {
        $this->db->where('partMaster_id', $partmaster['partMaster_id']);
        $this->db->update('partmaster', $partmaster);
    }

    //query untuk menghapus data
    public function delete($partmaster)
    {
        $this->db->where('partMaster_id', $partmaster['partMaster_id']);
        $this->db->delete('partmaster', $partmaster);
    }
}
