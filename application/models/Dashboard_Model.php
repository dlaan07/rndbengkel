<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard_Model extends CI_Model
{

    public function __construct()
    {
        $this->load->database();
    }

    //query untuk menampilkan daftar pelanggan
    public function pelanggan()
    {
        $this->db->select('*');
        $this->db->from('pelanggan');
        $this->db->where('pelanggan_bengkel', $this->session->userdata('bengkel'));
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function order()
    {
        $id = $this->session->userdata('bengkel');
        // $this->db->select('*');
        // $this->db->from('repair_order');
        // $this->db->where('order_status', '<7');
        $query = $this->db->query("SELECT * FROM repair_order join pelanggan on repair_order.order_pelanggan_id = pelanggan.pelanggan_id where order_status < 8 and order_bengkel = $id");
        return $query->num_rows();
    }

    public function perbaikan()
    {
        $id = $this->session->userdata('bengkel');
        // $this->db->select('*');
        // $this->db->from('repair_order');
        // $this->db->where('order_status', '>7');
        $query = $this->db->query("SELECT * FROM repair_order join pelanggan on repair_order.order_pelanggan_id = pelanggan.pelanggan_id where order_status > 7 and order_bengkel = $id");
        return $query->num_rows();
    }

    public function parts()
    {
        $this->db->select('*');
        $this->db->from('partmaster');
        $this->db->where('partMaster_bengkel', $this->session->userdata('bengkel'));
        $query = $this->db->get();
        return $query->num_rows();
    }

    // public function bill()
    // {
    //     $id = $this->session->userdata('bengkel');
    //     $query = $this->db->query("SELECT * from bill where bill_bengkel = $id)");
    //     return $query->result_array();
    // }
}
