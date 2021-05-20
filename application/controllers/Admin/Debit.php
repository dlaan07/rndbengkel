<?php
/**
 *
 */
class Debit extends CI_Controller
{

  public function index()
  {
    $data = array(
        'title'         => 'Daftar Debit',
        'configurasi'   => $this->Konfigurasi_Model->listing(),
        'link'          => 'Validasi',
        'debit'         => $this->Debit_Model->listing(),
        'isi'           => 'admin/debit/index'
    );

    $this->load->view('admin/layout/wrapper', $data);
  }
}
