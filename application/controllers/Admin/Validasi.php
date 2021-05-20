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
            'isi'           => 'admin/validasi/index'
        );

        $this->load->view('admin/layout/wrapper', $data);
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
            'isi'           => 'admin/validasi/detail'
        );

        $this->load->view('admin/layout/wrapper', $data);
    }

    public function validasiSetuju()
    {
        $i = $this->input;
        $order = array(
            'order_id'      => $i->post('idorder'),
            'order_status'  => $i->post('setuju')
        );
        $this->Order_Model->edit($order);
        redirect(base_url('Admin/Validasi'));
    }

    public function validasiCancel()
    {
        $i = $this->input;
        $order = array(
            'order_id'      => $i->post('idorder'),
            'order_status'  => $i->post('tdksetuju')
        );
        $this->Order_Model->edit($order);
        redirect(base_url('Admin/Validasi'));
    }
}
