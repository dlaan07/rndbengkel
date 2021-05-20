<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Validasi extends CI_Controller
{
    public function index()
    {
        $data = array(
            'title'         => 'Daftar Validasi',
            'link'          => 'Validasi',
            'configurasi'   => $this->Konfigurasi_Model->listing(),
            'order'         => $this->Order_Model->listing(),
            'isi'           => 'owner/validasi/index'
        );

        $this->load->view('owner/layout/wrapper', $data);
    }

    public function getbyOrder($order_id)
    {
        $data = array(
            'title'         => 'Daftar Validasi',
            'link'          => 'Validasi',
            'configurasi'   => $this->Konfigurasi_Model->listing(),
            'order'         => $this->Order_Model->getbyId($order_id),
            'part'          => $this->Part_Model->getbyId($order_id),
            'po'            => $this->PurchaseOrder_Model->listing(),
            'isi'           => 'owner/validasi/detail'
        );

        $this->load->view('owner/layout/wrapper', $data);
    }
}
