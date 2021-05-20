<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Perbaikan extends CI_Controller
{
    public function index()
    {
        $data = array(
            'title'         => 'Daftar Perbaikan',
            'link'          => 'Perbaikan',
            'configurasi'   => $this->Konfigurasi_Model->listing(),
            'order'         => $this->Order_Model->listing(),
            'isi'           => 'admin/perbaikan/index'
        );
        $this->load->view('admin/layout/wrapper', $data);
    }

    public function detail($order_id)
    {
        $data = array(
            'title'         => 'Detail Perbaikan',
            'link'          => 'Perbaikan',
            'configurasi'   => $this->Konfigurasi_Model->listing(),
            'order'         => $this->Order_Model->getbyId($order_id),
            'isi'           => 'admin/perbaikan/detail'
        );

        $this->load->view('admin/layout/wrapper', $data);
    }
}
