<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pelanggan extends CI_Controller
{
    public function index()
    {
        $data = array(
            'title'         => 'Daftar Pelanggan',
            'link'          => 'Pelanggan',
            'configurasi'         => $this->Konfigurasi_Model->listing(),
            'pelanggan'     => $this->Pelanggan_Model->listing(), //untuk menampilkan daftar pelanggan. 
            //Pelanggan_Model dari folder model, nama file Pelanggan_Model function listing.
            'isi'           => 'admin/pelanggan/index'
        );

        $this->load->view('admin/layout/wrapper', $data);
    }

    public function detailbyId($pelanggan_id)
    {
        $data = array(
            'title'         => 'Edit Pelanggan',
            'link'          => 'Edit',
            'configurasi'   => $this->Konfigurasi_Model->listing(),
            'pelanggan'     => $this->Pelanggan_Model->getbyId($pelanggan_id), //untuk menampilkan daftar pelanggan. 
            //Pelanggan_Model dari folder model, nama file Pelanggan_Model function listing.
            'isi'           => 'admin/pelanggan/edit'
        );

        $this->load->view('admin/layout/wrapper', $data);
    }

    public function tambah()
    {
        $valid = $this->form_validation;
        $valid->set_rules('nama', 'Nama pelanggan', 'required');
        $valid->set_rules('alamat', 'Alamat', 'required');
        $valid->set_rules('hp', 'Nomor HP', 'required');
        $valid->set_rules('email', 'Email', 'required');

        if ($valid->run() === FALSE) {
            $this->session->set_flashdata('gagal', 'Pelanggan gagal disimpan');
            redirect(base_url('Admin/Pelanggan'));
        } else {
            $i = $this->input;
            $pelanggan = array(
                'pelanggan_nama'      => $i->post('nama'),
                'pelanggan_alamat'    => $i->post('alamat'),
                'pelanggan_hp'        => $i->post('hp'),
                'pelanggan_email'     => $i->post('email'),
                'pelanggan_tglCreate' => date('Y-m-d'),
                'pelanggan_bengkel'   => $this->session->userdata('bengkel')
            );
            $this->Pelanggan_Model->tambah($pelanggan);

            $this->session->set_flashdata('sukses', 'Pelanggan berhasil di simpan');
            redirect(base_url('Admin/Pelanggan'));
        }
    }

    public function edit()
    {

        $valid = $this->form_validation;
        $valid->set_rules('nama', 'Nama pelanggan', 'required');
        $valid->set_rules('alamat', 'Alamat', 'required');
        $valid->set_rules('hp', 'Nomor HP', 'required');
        $valid->set_rules('email', 'Email', 'required');

        if ($valid->run() === FALSE) {
            redirect(base_url('Admin/Pelanggan'));
        } else {
            $i = $this->input;

            $pelanggan = array(
                'pelanggan_id'        => $i->post('id'),
                'pelanggan_nama'      => $i->post('nama'),
                'pelanggan_alamat'    => $i->post('alamat'),
                'pelanggan_hp'        => $i->post('hp'),
                'pelanggan_email'     => $i->post('email'),
            );
            $this->Pelanggan_Model->edit($pelanggan);

            $this->session->set_flashdata('sukses', 'Selamat pelanggan berhasil edit');
            redirect(base_url('Admin/Pelanggan'));
        }
    }

    public function delete()
    {
        $i = $this->input;

        $pelanggan = array(
            'pelanggan_id'          => $i->post('id')
        );
        $this->Pelanggan_Model->delete($pelanggan);

        $this->session->set_flashdata('sukses', 'Pelanggan berhasil dihapus');
        redirect(base_url('Admin/Pelanggan'));
    }
}
