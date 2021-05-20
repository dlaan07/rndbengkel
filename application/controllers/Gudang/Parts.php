<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Parts extends CI_Controller
{
    public function index()
    {
        $data = array(
            'title'         => 'Daftar Part Master',
            'link'          => 'Parts',
            'configurasi'   => $this->Konfigurasi_Model->listing(),
            'part'          => $this->PartMaster_Model->listing(),
            'order'         => $this->Order_Model->getbyId($this->input->post('idorder')),
            'isi'           => 'gudang/part/index'
        );
        $this->load->view('gudang/layout/wrapper', $data);
    }

    public function tambah()
    {
        $valid = $this->form_validation;
        $valid->set_rules('part', 'Nama Part', 'required');
        $valid->set_rules('stok', 'Jumlah Stok', 'required');
        $valid->set_rules('harga', 'Harga', 'required');
        $valid->set_rules('par', 'Par', 'required');
        $valid->set_rules('profit', 'Profit', 'required');

        if ($valid->run() === FALSE) {
            $this->session->set_flashdata('gagal', 'Part gagal tersimpan');
            redirect(base_url('Gudang/Parts'));
        } else {
            $i = $this->input;
            $harga = $i->post('harga');
            $profit = $i->post('profit');
            $hargaJual = $harga * (1 + ($profit / 100));
            $partmaster = array(
                'partMaster_nama'    => $i->post('part'),
                'partMaster_harga'   => $hargaJual,
                'partMaster_stok'    => $i->post('stok'),
                'partMaster_tgl'     => date('Y-m-d'),
                'partMaster_par'     => $i->post('par'),
                'partMaster_profit'  => $profit,
                'partMaster_bengkel' => $this->session->userdata('bengkel')
            );
            $this->PartMaster_Model->tambah($partmaster);

            $this->session->set_flashdata('sukses', 'Part baru berhasil disimpan');
            redirect(base_url('Gudang/Parts'));
        }
    }

    public function getbyId($partMaster_id)
    {
        $data = array(
            'title'         => 'Daftar Part Master',
            'link'          => 'Parts',
            'configurasi'   => $this->Konfigurasi_Model->listing(),
            'part'          => $this->PartMaster_Model->getbyId($partMaster_id),
            'isi'           => 'gudang/part/edit'
        );
        $this->load->view('gudang/layout/wrapper', $data);
    }

    public function edit()
    {

        $valid = $this->form_validation;
        $valid->set_rules('harga', 'Harga Master', 'required');
        $valid->set_rules('stok', 'Stok', 'required');
        $valid->set_rules('par', 'Par Stok', 'required');

        if ($valid->run() === FALSE) {
            redirect(base_url('Gudang/Parts'));
        } else {
            $i = $this->input;

            $partmaster = array(
                'partMaster_id'        => $i->post('id'),
                'partMaster_harga'        => $i->post('harga'),
                'partMaster_stok'        => $i->post('stok'),
                'partMaster_par'        => $i->post('par')
            );
            $this->PartMaster_Model->edit($partmaster);

            $this->session->set_flashdata('sukses', 'Selamat pelanggan berhasil edit');
            redirect(base_url('Gudang/Parts'));
        }
    }

    public function delete()
    {
        $i = $this->input;
        $partmaster = array(
            'partMaster_id'          => $i->post('id')
        );
        $this->PartMaster_Model->delete($partmaster);

        $this->session->set_flashdata('sukses', 'Parts berhasil dihapus');
        redirect(base_url('Gudang/Parts'));
    }
    
    public function po(){
        $data = array(
            'title'         => 'Daftar Part Master',
            'link'          => 'Parts',
            'configurasi'   => $this->Konfigurasi_Model->listing(),
            'part'          => $this->PartMaster_Model->listing(),
            'isi'           => 'gudang/part/po'
        );
        $this->load->view('gudang/layout/wrapper', $data);
    }
}
