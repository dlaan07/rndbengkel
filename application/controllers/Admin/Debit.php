<?php
/**
 * Controller Debit:
 *
 * Mengambil data dari Debit_Model dan melakukan manipulasi data untuk dikirim ke view views\debit\
 */
class Debit extends CI_Controller
{

  public function index()
  {
    $data = array(
        'title'         => 'Daftar Debit',
        'configurasi'   => $this->Konfigurasi_Model->listing(),
        'link'          => 'Debit',
        'debit'         => $this->Debit_Model->listing(),
        'isi'           => 'admin/debit/index'
    );

    $this->load->view('admin/layout/wrapper', $data);
  }


}
