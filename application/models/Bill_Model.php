<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Bill_Model extends CI_Model
{

    public function __construct()
    {
        $this->load->database();
    }

    //query untuk menampilkan daftar bill
    public function master()
    {
        $this->db->select('*');
        $this->db->from('bill');
        $this->db->join('bengkel', 'bill.bill_bengkel = bengkel.bengkel_id');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function listing()
    {
        $this->db->select('*');
        $this->db->from('bill');
        $this->db->where('bill_bengkel', $this->session->userdata('bengkel'));
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getbyId($order_id)
    {
        $this->db->select('*');
        $this->db->from('bill');
        $this->db->where('bill_order_id', $order_id);
        $this->db->where('bill_bengkel', $this->session->userdata('bengkel'));
        $query = $this->db->get();
        return $query->row_array();
    }

    //query untuk menyimpan data baru
    public function tambah($bill)
    {
        $this->db->insert('bill', $bill);
    }

    //query untuk menyimpan data yang dirubah (edit)
    public function edit($bill)
    {
        $this->db->where('bill_id', $bill['bill_id']);
        $this->db->update('bill', $bill);
    }

    //query untuk menghapus data
    public function delete($bill)
    {
        $this->db->where('bill_id', $bill['bill_id']);
        $this->db->delete('bill', $bill);
    }

    public function dp()
    {
        $this->db->select('*');
        $this->db->from('bill');
        $this->db->join('repair_order', 'bill.bill_order_id = repair_order.order_id');
        $this->db->join('pelanggan', 'repair_order.order_pelanggan_id = pelanggan.pelanggan_id');
        $this->db->where('bill_bengkel', $this->session->userdata('bengkel'));
        $query = $this->db->get();
        return $query->result_array();
    }

    public function simpanDp($bill)
    {
        $this->db->insert('bill', $bill);
    }

    public function editDp($order_id)
    {
        $this->db->select('*');
        $this->db->from('bill');
        $this->db->join('repair_order', 'bill.bill_order_id = repair_order.order_id');
        $this->db->join('pelanggan', 'repair_order.order_pelanggan_id = pelanggan.pelanggan_id');
        $this->db->where('bill_bengkel', $this->session->userdata('bengkel'));
        $this->db->where('bill_id', $order_id);
        $query = $this->db->get();
        return $query->row_array();
    }
}
