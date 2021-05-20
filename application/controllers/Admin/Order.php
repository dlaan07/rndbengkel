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
            'isi'           => 'admin/order/index'
        );
        $this->load->view('admin/layout/wrapper', $data);
    }

    public function indexTambah()
    {
        $data = array(
            'title'         => 'Daftar Order',
            'link'          => 'Order',
            'configurasi'   => $this->Konfigurasi_Model->listing(),
            'pelanggan'     => $this->Pelanggan_Model->listing(),
            'isi'           => 'admin/order/tambah'
        );
        $this->load->view('admin/layout/wrapper', $data);
    }

    public function tambah()
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
                'isi'           => 'admin/order/tambah'
            );
            $this->session->set_flashdata('gagal', 'Data order gagal disimpan');
            $this->load->view('admin/layout/wrapper', $data);
        } else {
            $i = $this->input;
            $perbaikan = array(
                'order_jenisSepeda'     => $i->post('jenis_sepeda'),
                'order_warnaSepeda'     => $i->post('warna_sepeda'),
                'order_jenisPerbaikan'  => $i->post('jenis_perbaikan'),
                'order_keterangan'      => $i->post('keterangan'),
                'order_tgl'             => date('Y-m-d'),
                'order_status'          => 1,
                'order_pelanggan_id'    => $i->post('pelanggan'),
                'order_bengkel'         => $this->session->userdata('bengkel')
            );
            $this->Order_Model->tambah($perbaikan);
            $this->session->set_flashdata('sukses', 'Selamat Order berhasil ditambah');
            redirect(base_url('Admin/Order'));
        }
    }

    public function detailbyId($order_id)
    {
        $data = array(
            'title'         => 'Daftar Order',
            'link'          => 'Order',
            'configurasi'   => $this->Konfigurasi_Model->listing(),
            'order'         => $this->Order_Model->getbyId($order_id),
            'isi'           => 'admin/order/edit'
        );

        $this->load->view('admin/layout/wrapper', $data);
    }

    public function edit()
    {

        $valid = $this->form_validation;
        $valid->set_rules('jenis_sepeda', 'Jenis Sepeda', 'required');
        $valid->set_rules('warna_sepeda', 'Warna Sepeda', 'required');
        $valid->set_rules('jenis_perbaikan', 'Jenis Perbaikan', 'required');
        if ($valid->run() === FALSE) {
            $this->session->set_flashdata('sukses', 'Data order gagal disimpan');
            redirect(base_url('Admin/Order'));
        } else {
            $i = $this->input;

            $perbaikan = array(
                'order_id'              => $i->post('id'),
                'order_jenisSepeda'     => $i->post('jenis_sepeda'),
                'order_warnaSepeda'     => $i->post('warna_sepeda'),
                'order_jenisPerbaikan'  => $i->post('jenis_perbaikan'),
                'order_keterangan'      => $i->post('keterangan')
            );
            $this->Order_Model->edit($perbaikan);

            $this->session->set_flashdata('sukses', 'Data order berhasil diedit');
            redirect(base_url('Admin/Order'));
        }
    }

    public function delete()
    {
        $i = $this->input;

        $perbaikan = array(
            'order_id'          => $i->post('id')
        );
        $this->Order_Model->delete($perbaikan);

        $this->session->set_flashdata('sukses', 'Data order berhasil dihapus');
        redirect(base_url('Admin/Order'));
    }
}
