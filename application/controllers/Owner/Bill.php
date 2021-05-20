<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Bill extends CI_Controller
{
    public function index()
    {
        $data = array(
            'title'         => 'Daftar Bill',
            'link'          => 'Validasi',
            'configurasi'         => $this->Konfigurasi_Model->listing(),
            'order'         => $this->Order_Model->listing(),
            'isi'           => 'owner/bill/index'
        );

        $this->load->view('owner/layout/wrapper', $data);
    }
    public function penagihan($order_id)
    {
        $data = array(
            'title'         => 'Form Penagihan',
            'link'          => 'Penaghian',
            'configurasi'         => $this->Konfigurasi_Model->listing(),
            'order'         => $this->Order_Model->getbyId($order_id),
            'part'          => $this->Part_Model->getbyId($order_id),
            // 'po'            => $this->PurchaseOrder_Model->listing(),
            'bill'          => $this->Bill_Model->getbyId($order_id),
            'isi'           => 'owner/bill/penagihan'
        );

        $this->load->view('owner/layout/wrapper', $data);
    }
}
