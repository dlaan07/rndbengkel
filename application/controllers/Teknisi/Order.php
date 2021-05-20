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
            'order'         => $this->Order_Model->listing(),
            'isi'           => 'teknisi/order/index'
        );
        $this->load->view('teknisi/layout/wrapper', $data);
    }

    public function pengecekan($order_id)
    {
        $data = array(
            'title'         => 'Pengecekan',
            'link'          => 'Pengecekan',
            'configurasi'   => $this->Konfigurasi_Model->listing(),
            'order'         => $this->Order_Model->getbyId($order_id),
            'part'          => $this->PartMaster_Model->listing(),
            'jasa'          => $this->Jasa_Model->listing(),
            'partOrder'     => $this->Part_Model->getbyId($order_id),
            'isi'           => 'teknisi/pengecekan/index'
        );
        $this->load->view('teknisi/layout/wrapper', $data);
    }

    public function editPengecekan($order_id)
    {
        $data = array(
            'title'         => 'Pengecekan',
            'link'          => 'Pengecekan',
            'configurasi'   => $this->Konfigurasi_Model->listing(),
            'order'         => $this->Order_Model->getbyId($order_id),
            'part'          => $this->PartMaster_Model->listing(),
            'jasa'          => $this->Jasa_Model->listing(),
            'partOrder'     => $this->Part_Model->getbyId($order_id),
            'isi'           => 'teknisi/pengecekan/edit'
        );
        $this->load->view('teknisi/layout/wrapper', $data);
    }

    public function tambahPengecekan()
    {
        $valid = $this->form_validation;
        $valid->set_rules('pelanggan', 'Nama pelanggan', 'required');
        $valid->set_rules('jenis_sepeda', 'Jenis Sepeda', 'required');
        $valid->set_rules('warna_sepeda', 'Warna Sepeda', 'required');
        $valid->set_rules('jenis_perbaikan', 'Jenis Perbaikan', 'required');

        if ($valid->run() === FALSE) {
            $data = array(
                'title'         => 'Daftar Order',
                'link'          => 'Order',
                'configurasi'   => $this->Konfigurasi_Model->listing(),
                'pelanggan'     => $this->Pelanggan_Model->listing(),
                'isi'           => 'teknisi/order/tambah'
            );
            $this->session->set_flashdata('gagal', 'Data order gagal disimpan');
            $this->load->view('teknisi/layout/wrapper', $data);
        } else {
            $i = $this->input;
            $perbaikan = array(
                'order_jenisSepeda'     => $i->post('jenis_sepeda'),
                'order_warnaSepeda'     => $i->post('warna_sepeda'),
                'order_jenisPerbaikan'  => $i->post('jenis_perbaikan'),
                'order_keterangan'      => $i->post('keterangan'),
                'order_tgl'             => date('Y-m-d'),
                'order_status'          => 1,
                'order_pelanggan_id'    => $i->post('pelanggan')
            );
            $this->Order_Model->tambah($perbaikan);
            $this->session->set_flashdata('sukses', 'Selamat Order berhasil ditambah');
            redirect(base_url('Teknisi/Order'));
        }
    }

    public function detailbyId($order_id)
    {
        $data = array(
            'title'         => 'Daftar Order',
            'link'          => 'Order',
            'configurasi'   => $this->Konfigurasi_Model->listing(),
            'order'         => $this->Order_Model->getbyId($order_id),
            'isi'           => 'teknisi/order/edit'
        );

        $this->load->view('teknisi/layout/wrapper', $data);
    }

    public function detail($order_id)
    {
        $data = array(
            'title'         => 'Detail Order',
            'link'          => 'Detail Order',
            'configurasi'   => $this->Konfigurasi_Model->listing(),
            'order'         => $this->Order_Model->getbyId($order_id),
            'isi'           => 'teknisi/order/detail'
        );

        $this->load->view('teknisi/layout/wrapper', $data);
    }

    public function edit()
    {

        $valid = $this->form_validation;
        $valid->set_rules('cek', 'Status Pekerjaan', 'required');
        $i = $this->input;
        if ($valid->run() === FALSE) {
            $this->session->set_flashdata('gagal', 'Update status pekerjaan gagal disimpan');
            redirect(base_url('teknisi/order/detail/') . $i->post('idorder'));
        } else {
            $perbaikan = array(
                'order_id'          => $i->post('idorder'),
                'order_status'      => $i->post('cek')
            );
            $this->Order_Model->edit($perbaikan);
            $pelanggan = $i->post('pelanggan');
            $this->session->set_flashdata('sukses', 'Order atas nama <b>' . $pelanggan . '</b> sedang dalam pengerjaan, silahkan masuk ke menu Perbaikan');
            redirect(base_url('Teknisi/Order'));
        }
    }
}
