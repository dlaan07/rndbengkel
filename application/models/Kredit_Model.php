<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Kredit_Model extends CI_Model
{

    public function __construct()
    {
        $this->load->database();
    }

    //query untuk menampilkan daftar bill
    public function master()
    {
        $this->db->select('*');
        $this->db->from('kredit');
        $this->db->join('bill', 'kredit.kredit_bill_id = bill.bill_id');
        $this->db->join('repair_order', 'bill_bill_order_id = repair_order.order_id');
        $this->db->join('bengkel', 'bill.bill_bengkel = bengkel.bengkel_id');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function listing()
    {
        $this->db->select('*');
        $this->db->from('kredit');
        $this->db->join('bill', 'kredit.kredit_bill_id = bill.bill_id');
        $this->db->join('repair_order', 'bill.bill_order_id = repair_order.order_id');
        $this->db->join('bengkel', 'bill.bill_bengkel = bengkel.bengkel_id');
        $this->db->where('bill_bengkel', $this->session->userdata('bengkel'));
        $query = $this->db->get();
        return $query->result_array();
    }

    public function cetak($kredit_id)
    {
        $this->db->select('*');
        $this->db->from('kredit');
        $this->db->join('bill', 'kredit.kredit_bill_id = bill.bill_id');
        $this->db->join('repair_order', 'bill.bill_order_id = repair_order.order_id');
        $this->db->join('pelanggan', 'repair_order.order_pelanggan_id = pelanggan.pelanggan_id');
        $this->db->join('bengkel', 'bill.bill_bengkel = bengkel.bengkel_id');
        $this->db->where('kredit_id', $kredit_id);
        $this->db->where('bill_bengkel', $this->session->userdata('bengkel'));
        $query = $this->db->get();
        return $query->row_array();
    }

    //query untuk menyimpan data baru
    public function tambah($kredit)
    {
        $this->db->insert('kredit', $kredit);
    }
}
