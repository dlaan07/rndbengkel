<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Part_Model extends CI_Model
{

    public function __construct()
    {
        $this->load->database();
    }

    //query untuk menampilkan daftar part
    public function master()
    {
        $this->db->select('*');
        $this->db->from('parts');
        $this->db->join('bengkel', 'parts.part_bengkel = bengkel.bengkel_id');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function listing()
    {
        $this->db->select('*');
        $this->db->from('parts');
        $this->db->where('part_bengkel', $this->session->userdata('bengkel'));
        $query = $this->db->get();
        return $query->result_array();
    }

    public function masterRfp()
    {
        $this->db->select('*');
        $this->db->from('parts');
        $this->db->join('partmaster', 'parts.part_partMaster_id = partmaster.partMaster_id');
        $this->db->join('repair_order', 'parts.part_order_id = repair_order.order_id');
        $this->db->join('pelanggan', 'repair_order.order_pelanggan_id = pelanggan.pelanggan_id');
        $this->db->where('part_bengkel', $this->session->userdata('bengkel'));
        $this->db->group_by('part_order_id');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function listingRfp()
    {
        $this->db->select('*');
        $this->db->from('parts');
        $this->db->join('partmaster', 'parts.part_partMaster_id = partmaster.partMaster_id');
        $this->db->join('repair_order', 'parts.part_order_id = repair_order.order_id');
        $this->db->join('pelanggan', 'repair_order.order_pelanggan_id = pelanggan.pelanggan_id');
        $this->db->where('part_bengkel', $this->session->userdata('bengkel'));
        $this->db->group_by('part_order_id');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getbyId($order_id)
    {
        $this->db->select('*');
        $this->db->from('parts');
        $this->db->join('partmaster', 'parts.part_partMaster_id = partmaster.partMaster_id');
        $this->db->join('repair_order', 'parts.part_order_id= repair_order.order_id');
        $this->db->where('part_order_id', $order_id);
        $this->db->where('part_bengkel', $this->session->userdata('bengkel'));
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getbyRow($part_id)
    {
        $this->db->select('*');
        $this->db->from('parts');
        $this->db->join('partmaster', 'parts.part_partMaster_id = partmaster.partMaster_id');
        // $this->db->join('purchaseorder', 'parts.part_id = purchaseorder.po_part_id');
        $this->db->where('part_id', $part_id);
        $this->db->where('part_bengkel', $this->session->userdata('bengkel'));
        $query = $this->db->get();
        return $query->row_array();
    }

    //query untuk menyimpan data baru
    public function tambah($partOrder)
    {
        $this->db->insert('parts', $partOrder);
    }

    //query untuk menyimpan data yang dirubah (edit)
    public function edit($part)
    {
        $this->db->where('part_id', $part['part_id']);
        $this->db->update('part', $part);
    }

    //query untuk menghapus data
    public function delete($part)
    {
        $this->db->where('part_id', $part['part_id']);
        $this->db->delete('parts', $part);
    }
}
