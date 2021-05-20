<?php

defined('BASEPATH') or exit('No direct script access allowed');

class PartsRequired_Model extends CI_Model
{

    public function __construct()
    {
        $this->load->database();
    }

    public function listing()
    {
        $this->db->select('*');
        $this->db->from('repair_parts');
        $this->db->join('repair_order', 'repair_parts.parts_orderID = repair_order.order_id');
        $this->db->join('repair_partsmaster', 'repair_parts.parts_masterId = repair_partsmaster.pm_id');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function tambah($parts)
    {
        $this->db->insert('repair_parts', $parts);
    }

    public function edit($parts)
    {
        $this->db->where('parts_id', $parts['parts_id']);
        $this->db->update('repair_parts', $parts);
    }

    public function delete($parts)
    {
        $this->db->where('parts_id', $parts['parts_id']);
        $this->db->delete('repair_parts', $parts);
    }
}
