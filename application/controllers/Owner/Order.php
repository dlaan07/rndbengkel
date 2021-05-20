<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Order extends CI_Controller
{
    public function index()
    {
        $data = array(
            'title'         => 'Daftar Order',
            'link'          => 'Order',
            'configurasi'   => $this->Konfigurasi_Model->listing(),
            // 'pelanggan'     => $this->Pelanggan_Model->listing(),
            'order'         => $this->Order_Model->listing(),
            'isi'           => 'owner/order/index'
        );
        $this->load->view('owner/layout/wrapper', $data);
    }
}
