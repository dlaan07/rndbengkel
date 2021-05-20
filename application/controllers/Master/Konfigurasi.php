<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Konfigurasi extends CI_Controller
{

    // Index Page
    public function index()
    {
        $data = array(
            'title'               => 'Konfigurasi Website', //.$site['nama_web'],
            'link'                => 'Konfigurasi',
            'configurasi'         => $this->Konfigurasi_Model->master(),
            'isi'                 => 'Master/konfigurasi/index'
        );

        $this->load->view('Master/layout/wrapper', $data);
    }

    public function detailbyId($config_id)
    {
        $data = array(
            'title'               => 'Konfigurasi Website', //.$site['nama_web'],
            'link'                => 'Konfigurasi',
            'configurasi'         => $this->Konfigurasi_Model->detail($config_id),
            'isi'                 => 'Master/konfigurasi/detail'
        );

        $this->load->view('Master/layout/wrapper', $data);
    }

    public function nama()
    {
        $valid = $this->form_validation;

        $valid->set_rules('nama', 'Nama Website', 'required');
        $valid->set_rules('alamat', 'Alamat Website', 'required');
        $valid->set_rules('tlp', 'Telpon Website', 'required');

        if ($valid->run() === FALSE) {
            $data = array(
                'title'               => 'Konfigurasi Website', //.$site['nama_web'],
                'link'                => 'Konfigurasi',
                'configurasi'         => $this->Konfigurasi_Model->listing(),
                'isi'                 => 'Master/konfigurasi/index'
            );
            $this->session->set_flashdata('sukses', 'Nama website gagal diupdate');
            $this->load->view('Master/layout/wrapper', $data);
        } else {
            $i = $this->input;

            $konfigurasi = array(
                'config_id'             => $i->post('id'),
                'config_namaBengkel'    => $i->post('nama'),
                'config_alamat'         => $i->post('alamat'),
                'config_telp'           => $i->post('tlp')
            );
            $this->Konfigurasi_Model->edit($konfigurasi);
            
            $confbengkel = $i->post('id');
            $bengkel = $this->db->query("select * from konfigurasi where config_id = $confbengkel");
            $idbengkel = $bengkel->row_array();
            
            $bengkel = array(
                'bengkel_id'        => $idbengkel['conf_bengkel'],
                'bengkel_nama'      => $i->post('nama'),
                'bengkel_alamat'    => $i->post('alamat'),
                'bengkel_tlp'       => $i->post('hp')
            );
            $this->Bengkel_Model->edit($bengkel);

            $this->session->set_flashdata('sukses', 'Nama bengkel berhasil diupdate');
            redirect(base_url('Master/Konfigurasi'));
        }
    }

    public function icon()
    {
        $config['upload_path']          = './assets/images/';
        $config['allowed_types']        = 'gif|jpg|png|jpeg';
        $config['max_size']             = 2000;
        $this->load->library('upload', $config);
        if (!$this->upload->do_upload('icon')) {
            $error = array('error' => $this->upload->display_errors());
            $data = array(
                'title'               => 'Konfigurasi Website', //.$site['nama_web'],
                'link'                => 'Konfigurasi',
                'configurasi'         => $this->Konfigurasi_Model->listing(),
                'isi'                 => 'Master/konfigurasi/index'
            );

            $this->load->view('Master/layout/wrapper', $data, $error);
        } else {
            $data['config_id']      = $this->input->post('id');
            $data['config_icon']    = $this->upload->data("file_name");
            $this->Konfigurasi_Model->edit($data);

            $this->session->set_flashdata('sukses', 'Icon berhasil diganti');
            redirect('Master/Konfigurasi');
        }
    }
}
