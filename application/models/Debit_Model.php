<?php
/**
 *
 */
class Debit_Model extends CI_Model
{

  function __construct()
  {
    $this->load->database();
  }

  public function listing()
  {
    $this->db->select("order_id, pelanggan_id, pelanggan_nama, debit_bayar, debit_status, debit_catatan");
    $this->db->from("debit");
    $this->db->join("repair_order", "debit.debit_order_id = repair_order.order_id");
    $this->db->join("pelanggan", "pelanggan.pelanggan_id = repair_order.order_pelanggan_id");
    $query = $this->db->get();
    return $query->result_array();
  }
}
