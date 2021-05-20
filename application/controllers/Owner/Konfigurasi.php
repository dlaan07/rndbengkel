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
            'configurasi'         => $this->Konfigurasi_Model->listing(),
            'isi'                 => 'owner/konfigurasi/index'
        );

        $this->load->view('owner/layout/wrapper', $data);
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
                'isi'                 => 'owner/konfigurasi/index'
            );
            $this->session->set_flashdata('sukses', 'Nama website gagal diupdate');
            $this->load->view('owner/layout/wrapper', $data);
        } else {
            $i = $this->input;

            $konfigurasi = array(
                'config_id'             => $i->post('id'),
                'config_namaBengkel'    => $i->post('nama'),
                'config_alamat'         => $i->post('alamat'),
                'config_telp'           => $i->post('tlp')
            );
            $this->Konfigurasi_Model->edit($konfigurasi);

            // $bengkel_id = $this->session->userdata('bengkel');
            $dbengkel   = $this->Konfigurasi_Model->listing();
            $bengkel    = array(
                        'bengkel_id'    => $dbengkel['conf_bengkel'],
                        'bengkel_nama'  => $i->post('nama'),
                        'bengkel_alamat'=> $i->post('alamat'),
                        'bengkel_tlp'   => $i->post('tlp')
                    );
            $this->Bengkel_Model->edit($bengkel);
            
            $this->session->set_flashdata('sukses', 'Selamat Nama Website berhasil diupdate');
            redirect(base_url('Owner/Konfigurasi'));
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
                'isi'                 => 'owner/konfigurasi/index'
            );

            $this->load->view('owner/layout/wrapper', $data, $error);
        } else {
            $data['config_id']      = $this->input->post('id');
            $data['config_icon']    = $this->upload->data("file_name");
            $this->Konfigurasi_Model->edit($data);

            $this->session->set_flashdata('sukses', 'Icon berhasil diganti');
            redirect('Owner/Konfigurasi');
        }
    }

    public function user()
    {
        $data = array(
            'title'               => 'Konfigurasi User', //.$site['nama_web'],
            'link'                => 'Admin',
            'configurasi'         => $this->Konfigurasi_Model->listing(),
            'admin'               => $this->User_Model->listing(),
            'role'                => $this->User_Model->role(),
            'isi'                 => 'owner/konfigurasi/admin'
        );

        $this->load->view('owner/layout/wrapper', $data);
    }

    public function tambah_admin()
    {
        $valid = $this->form_validation;

        $valid->set_rules('nama', 'Nama User', 'required');
        $valid->set_rules('email', 'Email User', 'required');
        $valid->set_rules('tlp', 'Telpon/Hp User', 'required');
        $valid->set_rules('password', 'Password User', 'required');
        $valid->set_rules('role', 'Role Akses', 'required');

        if ($valid->run() === FALSE) {
            $data = array(
                'title'               => 'Konfigurasi User', //.$site['nama_web'],
                'link'                => 'Admin',
                'configurasi'         => $this->Konfigurasi_Model->listing(),
                'admin'               => $this->User_Model->listing(),
                'role'                => $this->User_Model->role(),
                'isi'                 => 'owner/konfigurasi/admin'
            );
            $this->session->set_flashdata('gagal', 'User gagal disimpan');
            $this->load->view('owner/layout/wrapper', $data);
        } else {
            $i = $this->input;

            $user = array(
                'user_nama'      => $i->post('nama'),
                'user_email'     => $i->post('email'),
                'user_telp'      => $i->post('tlp'),
                'user_password'  => sha1($i->post('password')),
                'user_role'      => $i->post('role'),
                'user_create'    => date('Y-m-d'),
                'user_bengkel'   => $this->session->userdata('bengkel')
            );
            $this->User_Model->tambah($user);

            $this->session->set_flashdata('sukses', 'User berhasil disimpan');
            redirect(base_url('Owner/Konfigurasi/user'));
        }
    }

    public function edit_admin()
    {

        $valid = $this->form_validation;

        $valid->set_rules('nama', 'Nama User', 'required');
        $valid->set_rules('email', 'Email User', 'required');
        $valid->set_rules('password', 'Password User', 'required');
        $valid->set_rules('tlp', 'Telpon/Hp User', 'required');
        $valid->set_rules('role', 'Role Akses', 'required');

        if ($valid->run() === FALSE) {
            $data = array(
                'title'               => 'Konfigurasi User', //.$site['nama_web'],
                'link'                => 'Admin',
                'configurasi'         => $this->Konfigurasi_Model->listing(),
                'admin'               => $this->User_Model->listing(),
                'role'                => $this->User_Model->role(),
                'isi'                 => 'owner/konfigurasi/admin'
            );
            $this->session->set_flashdata('gagal', 'user gagal disimpan');
            $this->load->view('owner/layout/wrapper', $data);
        } else {
            $i = $this->input;

            $user = array(
                'user_id'        => $i->post('id'),
                'user_nama'      => $i->post('nama'),
                'user_email'     => $i->post('email'),
                'user_password'  => sha1($i->post('password')),
                'user_telp'      => $i->post('tlp'),
                'user_role'      => $i->post('role')
            );
            $this->User_Model->edit($user);

            $this->session->set_flashdata('sukses', 'Selamat user berhasil diupdate');
            redirect(base_url('Owner/Konfigurasi/user'));
        }
    }

    public function hapus_admin()
    {
        $i = $this->input;

        $user = array(
            'user_id'        => $i->post('id')
        );
        $this->User_Model->delete($user);

        $this->session->set_flashdata('sukses', 'Selamat user berhasil dihapus');
        redirect(base_url('Owner/Konfigurasi/user'));
    }
}
