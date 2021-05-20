<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jasa extends CI_Controller
{
    public function index()
    {
        $data = array(
            'title'         => 'Daftar Jasa',
            'link'          => 'Jasa',
            'configurasi'   => $this->Konfigurasi_Model->listing(),
            'jasa'          => $this->Jasa_Model->listing(), //untuk menampilkan daftar Jasa. 
            //Jasa_Model dari folder model, nama file Jasa_Model function listing.
            'isi'           => 'owner/jasa/index'
        );

        $this->load->view('owner/layout/wrapper', $data);
    }

    public function detailbyId($jasa_id)
    {
        $data = array(
            'title'         => 'Edit Jasa',
            'link'          => 'Jasa',
            'configurasi'   => $this->Konfigurasi_Model->listing(),
            'jasa'          => $this->Jasa_Model->getbyId($jasa_id), //untuk menampilkan daftar Jasa. 
            //Jasa_Model dari folder model, nama file Jasa_Model function listing.
            'isi'           => 'owner/jasa/edit'
        );

        $this->load->view('owner/layout/wrapper', $data);
    }

    public function tambah()
    {
        $valid = $this->form_validation;
        $valid->set_rules('nama', 'Nama Jasa', 'required');
        $valid->set_rules('harga', 'Harga Jasa', 'required');

        if ($valid->run() === FALSE) {
            redirect(base_url('Owner/Jasa'));
        } else {
            $i = $this->input;
            $jasa = array(
                'jasa_nama'    => $i->post('nama'),
                'jasa_harga'   => $i->post('harga'),
                'jasa_bengkel' => $this->session->userdata('bengkel')
            );
            $this->Jasa_Model->tambah($jasa);

            $this->session->set_flashdata('sukses', 'Jasa berhasil ditambah');
            redirect(base_url('Owner/Jasa'));
        }
    }

    public function edit()
    {

        $valid = $this->form_validation;
        $valid->set_rules('nama', 'Nama Jasa', 'required');
        $valid->set_rules('harga', 'Harga Jasa', 'required');

        if ($valid->run() === FALSE) {
            redirect(base_url('Owner/Jasa'));
        } else {
            $i = $this->input;

            $jasa = array(
                'jasa_id'       => $i->post('id'),
                'jasa_nama'     => $i->post('nama'),
                'jasa_harga'    => $i->post('harga')
            );
            $this->Jasa_Model->edit($jasa);

            $this->session->set_flashdata('sukses', 'Jasa berhasil diedit');
            redirect(base_url('Owner/Jasa'));
        }
    }

    public function delete()
    {
        $i = $this->input;

        $jasa = array(
            'jasa_id'          => $i->post('id')
        );
        $this->Jasa_Model->delete($jasa);

        $this->session->set_flashdata('sukses', 'Jasa berhasil dihapus');
        redirect(base_url('Owner/Jasa'));
    }
}
