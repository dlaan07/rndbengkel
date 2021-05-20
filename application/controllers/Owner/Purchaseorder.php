<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Purchaseorder extends CI_Controller
{
    public function index()
    {
        $data = array(
            'title'         => 'Daftar Purchase Order',
            'link'          => 'Purchase Order',
            'configurasi'   => $this->Konfigurasi_Model->listing(),
            'order'         => $this->Part_Model->listingRfp(),
            'isi'           => 'owner/po/index'
        );
        $this->load->view('owner/layout/wrapper', $data);
    }

    public function detail($idorder)
    {
        $data = array(
            'title'         => 'Detail PO',
            'link'          => 'Detail PO',
            'configurasi'   => $this->Konfigurasi_Model->listing(),
            'partOrder'     => $this->Part_Model->getbyId($idorder),
            'order'         => $this->Order_Model->getbyId($idorder),
            'isi'           => 'owner/po/detail'
        );
        $this->load->view('owner/layout/wrapper', $data);
    }
}
