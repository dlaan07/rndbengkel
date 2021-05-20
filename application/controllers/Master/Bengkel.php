<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Bengkel extends CI_Controller
{
    public function index()
    {
        $data = array(
            'title'         => 'Daftar Bengkel',
            'link'          => 'Bengkel',
            'configurasi'   => $this->Konfigurasi_Model->listing(),
            'bengkel'       => $this->Bengkel_Model->master(), //untuk menampilkan daftar bengkel. 
            //Bengkel_Model dari folder model, nama file Bengkel_Model function listing.
            'isi'           => 'Master/bengkel/index'
        );

        $this->load->view('Master/layout/wrapper', $data);
    }

    public function detailbyId($bengkel_id)
    {
        $data = array(
            'title'         => 'Edit bengkel',
            'link'          => 'Bengkel',
            'configurasi'   => $this->Konfigurasi_Model->listing(),
            'bengkel'     => $this->Bengkel_Model->getbyId($bengkel_id), //untuk menampilkan daftar bengkel. 
            //Bengkel_Model dari folder model, nama file Bengkel_Model function listing.
            'isi'           => 'Master/bengkel/edit'
        );

        $this->load->view('Master/layout/wrapper', $data);
    }

    public function tambah()
    {
        $valid = $this->form_validation;
        $valid->set_rules('nama', 'Nama bengkel', 'required');
        $valid->set_rules('alamat', 'Alamat', 'required');
        $valid->set_rules('hp', 'Nomor HP', 'required');
        $valid->set_rules('owner', 'Owner', 'required');

        if ($valid->run() === FALSE) {
            redirect(base_url('Master/bengkel'));
        } else {
            $i = $this->input;
            $bengkel = array(
                'bengkel_nama'      => $i->post('nama'),
                'bengkel_alamat'    => $i->post('alamat'),
                'bengkel_tlp'       => $i->post('hp'),
                'bengkel_owner'     => $i->post('owner'),
                'bengkel_join'      => date('Y-m-d')
            );
            $this->Bengkel_Model->tambah($bengkel);
            $this->konfigurasi($bengkel);
            $this->session->set_flashdata('sukses', 'Selamat bengkel berhasil ditambah');
            redirect(base_url('Master/bengkel'));
        }
    }

    public function konfigurasi($bengkel)
    {
        $query = $this->db->query("SELECT bengkel_id from bengkel order by bengkel_id DESC LIMIT 1");
        $idbengkel = $query->row_array();

        $konfigurasi = array(
            'config_namaBengkel'       => $bengkel['bengkel_nama'],
            'config_alamat'            => $bengkel['bengkel_alamat'],
            'config_telp'              => $bengkel['bengkel_tlp'],
            'conf_bengkel'             => $idbengkel['bengkel_id']
        );
        $this->Konfigurasi_Model->tambah($konfigurasi);
    }

    public function edit()
    {

        $valid = $this->form_validation;
        $valid->set_rules('nama', 'Nama bengkel', 'required');
        $valid->set_rules('alamat', 'Alamat', 'required');
        $valid->set_rules('hp', 'Nomor HP', 'required');
        $valid->set_rules('owner', 'Owner', 'required');

        if ($valid->run() === FALSE) {
            redirect(base_url('Master/bengkel'));
        } else {
            $i = $this->input;
            $bengkel = array(
                'bengkel_id'        => $i->post('id'),
                'bengkel_nama'      => $i->post('nama'),
                'bengkel_alamat'    => $i->post('alamat'),
                'bengkel_tlp'       => $i->post('hp'),
                'bengkel_owner'     => $i->post('owner'),
                'bengkel_join'      => date('Y-m-d')
            );
            $this->Bengkel_Model->edit($bengkel);

            $idbengkel = $i->post('id');
            $sett = $this->db->query("Select * from konfigurasi where conf_bengkel = $idbengkel");
            $idcon = $sett->row_array();

            $konfigurasi = array(
                'config_id'             => $idcon['config_id'],
                'config_namaBengkel'    => $i->post('nama'),
                'config_alamat'         => $i->post('alamat'),
                'config_telp'           => $i->post('hp')
            );
            $this->Konfigurasi_Model->edit($konfigurasi);
            
            $this->session->set_flashdata('sukses', 'Selamat bengkel berhasil edit');
            redirect(base_url('Master/bengkel'));
        }
    }

    public function delete()
    {
        $i = $this->input;

        $bengkel = array(
            'bengkel_id'          => $i->post('id')
        );
        $this->Bengkel_Model->delete($bengkel);

        $this->session->set_flashdata('sukses', 'bengkel berhasil dihapus');
        redirect(base_url('Master/bengkel'));
    }
}
