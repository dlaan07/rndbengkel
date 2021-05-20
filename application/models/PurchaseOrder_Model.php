<?php

defined('BASEPATH') or exit('No direct script access allowed');

class PurchaseOrder_Model extends CI_Model
{

    public function __construct()
    {
        $this->load->database();
    }

    //query untuk menampilkan daftar purchaseorder
    public function master()
    {
        $this->db->select('*');
        $this->db->from('purchaseorder');
        $this->db->join('parts', 'purchaseorder.po_part_id = parts.part_id');
        $this->db->join('partmaster', 'parts.part_partMaster_id = partmaster.partMaster_id');
        $this->db->join('repair_order', 'parts.part_order_id = repair_order.order_id');
        $this->db->join('pelanggan', 'repair_order.order_pelanggan_id = pelanggan.pelanggan_id');
        $this->db->join('bengkel', 'repair_order.order_bengkel = bengkel.bengkel_id');
        $this->db->group_by('part_order_id');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function listing()
    {
        $this->db->select('*');
        $this->db->from('purchaseorder');
        $this->db->join('parts', 'purchaseorder.po_part_id = parts.part_id');
        $this->db->join('partmaster', 'parts.part_partMaster_id = partmaster.partMaster_id');
        $this->db->join('repair_order', 'parts.part_order_id = repair_order.order_id');
        $this->db->join('pelanggan', 'repair_order.order_pelanggan_id = pelanggan.pelanggan_id');
        $this->db->where('part_bengkel', $this->session->userdata('bengkel'));
        $this->db->group_by('part_order_id');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getbyId($po_id)
    {
        $this->db->select('*');
        $this->db->from('parts');
        $this->db->join('partmaster', 'parts.part_partMaster_id = partmaster.partMaster_id');
        $this->db->join('purchaseorder', 'parts.part_id = purchaseorder.po_part_id');
        $this->db->where('part_bengkel', $this->session->userdata('bengkel'));
        $this->db->where('po_id', $po_id);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function getbyPO($order_id)
    {
        $this->db->select('*');
        $this->db->from('parts');
        $this->db->join('partmaster', 'parts.part_partMaster_id = partmaster.partMaster_id');
        $this->db->join('purchaseorder', 'parts.part_id = purchaseorder.po_part_id');
        $this->db->where('part_bengkel', $this->session->userdata('bengkel'));
        $this->db->where('part_order_id', $order_id);
        $query = $this->db->get();
        return $query->result_array();
    }

    //query untuk menyimpan data baru
    public function tambah($purchaseorder)
    {
        $this->db->insert('purchaseorder', $purchaseorder);
    }

    //query untuk menyimpan data yang dirubah (edit)
    public function edit($purchaseorder)
    {
        $this->db->where('po_id', $purchaseorder['po_id']);
        $this->db->update('purchaseorder', $purchaseorder);
    }

    //query untuk menghapus data
    public function delete($purchaseorder)
    {
        $this->db->where('po_id', $purchaseorder['po_id']);
        $this->db->delete('purchaseorder', $purchaseorder);
    }
}
