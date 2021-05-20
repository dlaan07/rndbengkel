<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Tracking extends CI_Controller
{
    public function index()
    {
        $data = array(
            'title'         => 'Daftar Tracking',
            'link'          => 'Tracking',
            'configurasi'   => $this->Konfigurasi_Model->listing(),
            'order'         => $this->PurchaseOrder_Model->listing(),
            'isi'           => 'teknisi/tracking/index'
        );
        $this->load->view('teknisi/layout/wrapper', $data);
    }

    public function detail($idorder)
    {
        $data = array(
            'title'         => 'Daftar Tracking',
            'link'          => 'Tracking',
            'configurasi'   => $this->Konfigurasi_Model->listing(),
            'partOrder'     => $this->PurchaseOrder_Model->getbyPO($idorder),
            'isi'           => 'teknisi/tracking/detail'
        );
        $this->load->view('teknisi/layout/wrapper', $data);
    }
}
