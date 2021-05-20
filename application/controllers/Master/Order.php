<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Order extends CI_Controller
{
    public function index()
    {
        $data = array(
            'title'         => 'Daftar Order',
            'link'          => 'Order',
            'configurasi'   => $this->Konfigurasi_Model->master(),
            // 'pelanggan'     => $this->Pelanggan_Model->master(),
            'order'         => $this->Order_Model->master(),
            'bengkel'       => $this->Bengkel_Model->master(),
            'isi'           => 'Master/order/index'
        );
        $this->load->view('Master/layout/wrapper', $data);
    }
}
