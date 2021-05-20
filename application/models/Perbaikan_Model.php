<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Perbaikan_Model extends CI_Model
{

    public function __construct()
    {
        $this->load->database();
    }

    public function master()
    {
        $this->db->select('*');
        $this->db->from('repair_order');
        $this->db->join('bengkel', 'repair_order.order_bengkel = bengkel.bengkel_id');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function listing()
    {
        $this->db->select('*');
        $this->db->from('repair_order');
        $this->db->where('order_bengkel', $this->session->userdata('bengkel'));
        $query = $this->db->get();
        return $query->result_array();
    }

    public function tambah($order)
    {
        $this->db->insert('repair_order', $order);
    }

    public function edit($order)
    {
        $this->db->where('order_id', $order['order_id']);
        $this->db->update('repair_order', $order);
    }

    public function delete($order)
    {
        $this->db->where('order_id', $order['order_id']);
        $this->db->delete('repair_order', $order);
    }
}
