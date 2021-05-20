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
    $this->db->select("*");
    $this->db->from("debit");
    $query = $this->db->get();
    return $query->result_array();
  }
}
