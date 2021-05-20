<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function index()
    {
        $data = array(
            'title'               => 'Konfigurasi User', //.$site['nama_web'],
            'link'                => 'User',
            'configurasi'         => $this->Konfigurasi_Model->listing(),
            'admin'               => $this->User_Model->master(),
            'bengkel'             => $this->Bengkel_Model->master(),
            'role'                => $this->User_Model->role(),
            'isi'                 => 'Master/user/index'
        );

        $this->load->view('Master/layout/wrapper', $data);
    }

    public function tambah_owner()
    {
        $valid = $this->form_validation;

        $valid->set_rules('nama', 'Nama Owner', 'required');
        $valid->set_rules('email', 'Email', 'required');
        $valid->set_rules('tlp', 'Telpon/Hp', 'required');
        $valid->set_rules('password', 'Password', 'required');
        $valid->set_rules('bengkel', 'Bengkel', 'required');

        if ($valid->run() === FALSE) {
            $data = array(
                'title'               => 'Konfigurasi User', //.$site['nama_web'],
                'link'                => 'User',
                'configurasi'         => $this->Konfigurasi_Model->listing(),
                'admin'               => $this->User_Model->master(),
                'role'                => $this->User_Model->role(),
                'isi'                 => 'Master/user/admin'
            );
            $this->session->set_flashdata('gagal', 'User gagal disimpan');
            $this->load->view('Master/layout/wrapper', $data);
        } else {
            $i = $this->input;

            $user = array(
                'user_nama'      => $i->post('nama'),
                'user_email'     => $i->post('email'),
                'user_telp'      => $i->post('tlp'),
                'user_password'  => sha1($i->post('password')),
                'user_role'      => 1,
                'user_bengkel'   => $i->post('bengkel')
            );
            $this->User_Model->tambah($user);

            $this->session->set_flashdata('sukses', 'User berhasil disimpan');
            redirect(base_url('Master/User'));
        }
    }

    public function edit_admin()
    {

        $valid = $this->form_validation;

        $valid->set_rules('nama', 'Nama User', 'required');
        $valid->set_rules('email', 'Email User', 'required');
        $valid->set_rules('tlp', 'Telpon/Hp User', 'required');
        $valid->set_rules('password', 'Password', 'required');

        if ($valid->run() === FALSE) {
            $data = array(
                'title'               => 'Konfigurasi User', //.$site['nama_web'],
                'link'                => 'User',
                'configurasi'         => $this->Konfigurasi_Model->listing(),
                'admin'               => $this->User_Model->master(),
                'role'                => $this->User_Model->role(),
                'isi'                 => 'Master/user/admin'
            );
            $this->session->set_flashdata('gagal', 'user gagal disimpan');
            $this->load->view('Master/layout/wrapper', $data);
        } else {
            $i = $this->input;

            $user = array(
                'user_id'        => $i->post('id'),
                'user_nama'      => $i->post('nama'),
                'user_email'     => $i->post('email'),
                'user_password'  => sha1($i->post('password')),
                'user_telp'      => $i->post('tlp'),
                'user_bengkel'   => $i->post('bengkel')
            );
            $this->User_Model->edit($user);

            $this->session->set_flashdata('sukses', 'Selamat user berhasil diupdate');
            redirect(base_url('Master/User'));
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
        redirect(base_url('Master/User'));
    }
}
