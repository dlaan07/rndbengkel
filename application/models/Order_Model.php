<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Order_Model extends CI_Model
{

    public function __construct()
    {
        $this->load->database();
    }

    //query untuk menampilkan daftar repair_order
    public function Master()
    {
        $this->db->select('*');
        $this->db->from('repair_order');
        $this->db->join('pelanggan', 'repair_order.order_pelanggan_id = pelanggan.pelanggan_id');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function listing()
    {
        $this->db->select('*');
        $this->db->from('repair_order');
        $this->db->join('pelanggan', 'repair_order.order_pelanggan_id = pelanggan.pelanggan_id');
        $this->db->where('pelanggan_bengkel', $this->session->userdata('bengkel'));
        $this->db->order_by('order_id', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getbyId($repair_order_id)
    {
        $this->db->select('*');
        $this->db->from('repair_order');
        $this->db->join('pelanggan', 'repair_order.order_pelanggan_id = pelanggan.pelanggan_id');
        // $this->db->where('order_bengkel', $this->session->userdata('bengkel'));
        $this->db->where('order_id', $repair_order_id);
        $query = $this->db->get();
        return $query->row_array();
    }

    //query untuk menyimpan data baru
    public function tambah($perbaikan)
    {
        $this->db->insert('repair_order', $perbaikan);
    }

    //query untuk menyimpan data yang dirubah (edit)
    public function edit($perbaikan)
    {
        $this->db->where('order_id', $perbaikan['order_id']);
        $this->db->update('repair_order', $perbaikan);
    }

    //query untuk menghapus data
    public function delete($perbaikan)
    {
        $this->db->where('order_id', $perbaikan['order_id']);
        $this->db->delete('repair_order', $perbaikan);
    }
}
