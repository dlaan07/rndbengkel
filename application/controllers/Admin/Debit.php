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
        'link'          => 'Debit',
        'configurasi'   => $this->Konfigurasi_Model->listing(),
        'debit'         => $this->Debit_Model->listing(),
        'isi'           => 'admin/debit/index'
    );

    $this->load->view('admin/layout/wrapper', $data);
  }
  public function pembayaran($order_id)
  {
    $data = array(
        'title'         => 'Pembayaran Debit',
        'link'          => 'Debit',
        'configurasi'   => $this->Konfigurasi_Model->listing(),
        'debit'         => $this->Debit_Model->getbyId($order_id),
        'order'         => $this->Order_Model->getbyId($order_id),
        'isi'           => 'admin/debit/pembayaran'
    );

    $this->load->view('admin/layout/wrapper', $data);
  }

  public function simpanPembayaran()
  {
    $valid = $this->form_validation;
    $valid->set_rules('bayar', 'Jumlah yang Dibayarkan', 'required');
    $valid->set_rules('metode', 'Metode Pembayaran', 'required');

    if($valid->run()) {
      $input = $this->input;
      $debit = array(
          // 'debit_bayar'      => $input->post('bayar'),
          'debit_id'            => $input->post('debitid'),
          'debit_tgl'           => date('Y-m-d H:i:s'),
          'debit_metode'        => $input->post('metode'),
          'debit_keterangan'    => $input->post('ket'),
          'debit_status'        => 1,
      );
      $this->Debit_Model->edit($debit);
      $this->session->set_flashdata('sukses', 'Pembayaran berhasil dilakukan');
    }
    redirect('Admin/Debit');
  }

}
