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
            'isi'           => 'teknisi/perbaikan/index'
        );
        $this->load->view('teknisi/layout/wrapper', $data);
    }

    public function detail($order_id)
    {
        $data = array(
            'title'         => 'Detail Perbaikan',
            'link'          => 'Perbaikan',
            'configurasi'   => $this->Konfigurasi_Model->listing(),
            'order'         => $this->Order_Model->getbyId($order_id),
            'isi'           => 'teknisi/perbaikan/detail'
        );

        $this->load->view('teknisi/layout/wrapper', $data);
    }

    public function edit()
    {
        $valid = $this->form_validation;
        $valid->set_rules('cek', 'Status Pekerjaan', 'required');
        $valid->set_rules('total', 'Total Jasa Harga', 'required');
        $i = $this->input;
        if ($valid->run() === FALSE) {
            $this->session->set_flashdata('gagal', 'Update status pekerjaan gagal disimpan');
            redirect(base_url('Teknisi/Perbaikan/Detail/') . $i->post('idorder'));
        } else {
            $perbaikan = array(
                'order_id'              => $i->post('idorder'),
                'order_totalJasaHarga'  => $i->post('total'),
                'order_status'          => $i->post('cek')
            );
            $this->Order_Model->edit($perbaikan);
            $pelanggan = $i->post('pelanggan');
            // $this->session->set_flashdata('sukses', 'Order atas nama <b>' . $pelanggan . '</b> selesai diperbaiki');
            // redirect(base_url('teknisi/perbaikan'));
            $this->bill($perbaikan, $pelanggan);
        }
    }

    public function bill($perbaikan, $pelanggan)
    {
        $status = $perbaikan['order_id'];
        $query = $this->db->query("SELECT * FROM bill WHERE bill_order_id = $status");
        $dataBill = $query->row_array();
        $bill = array(
            'bill_id'       => $dataBill['bill_id'],
            'bill_status'   => 1,
            'bill_order_id' => $status
        );
        $this->Bill_Model->edit($bill);
        $this->session->set_flashdata('sukses', 'Order atas nama <b>' . $pelanggan . '</b> selesai diperbaiki');
        redirect(base_url('Teknisi/Perbaikan'));
    }
}
