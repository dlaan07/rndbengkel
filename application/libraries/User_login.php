<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_login
{

    // SET SUPER GLOBAL
    var $CI = NULL;
    public function __construct()
    {
        $this->CI = &get_instance();
    }

    // Login
    public function login($email, $password)
    {
        // Query untuk pencocokan data
        $query = $this->CI->db->get_where("user", array(
            'user_email'     => $email,
            'user_password'  => sha1($password)
        ));
        // Jika ada hasilnya
        if ($query->num_rows() == 1) {
            $row        = $this->CI->db->query('SELECT * FROM user WHERE user_email = "' . $email . '"');
            // $row        = $this->CI->db->query('SELECT * FROM user JOIN bengkel ON user.user_bengkel = bengkel.bengkel_id WHERE user_email = "' . $email . '"');
            $data       = $row->row();

            if ($data->user_bengkel == 0) {
                $qmaster    = $this->CI->db->query('SELECT * FROM user WHERE user_email = "' . $email . '"');
                $master     = $qmaster->row();
                $id         = $master->user_id;
                $email      = $master->user_email;
                $nama       = $master->user_nama;
                $level      = $master->user_role;
                $bengkel    = $master->user_bengkel;
            } else {
                $quser      = $this->CI->db->query('SELECT * FROM user JOIN bengkel ON user.user_bengkel = bengkel.bengkel_id WHERE user_email = "' . $email . '"');
                $user       = $quser->row();
                $id         = $user->user_id;
                $email      = $user->user_email;
                $nama       = $user->user_nama;
                $level      = $user->user_role;
                $bengkel    = $user->bengkel_id;
            }
            $this->CI->session->set_userdata('username', $nama);
            $this->CI->session->set_userdata('nama', $nama);
            $this->CI->session->set_userdata('email', $email);
            $this->CI->session->set_userdata('id', $id);
            $this->CI->session->set_userdata('level', $level);
            $this->CI->session->set_userdata('bengkel', $bengkel);

            if ($this->CI->session->userdata('level') == 99) {
                redirect(base_url('Master/Dashboard'));
            } else if ($this->CI->session->userdata('level') == 1) {
                redirect(base_url('Owner/Dashboard'));
            } else if ($this->CI->session->userdata('level') == 2) {
                redirect(base_url('Admin/Dashboard'));
            } else if ($this->CI->session->userdata('level') == 3) {
                redirect(base_url('Teknisi/Dashboard'));
            } else if ($this->CI->session->userdata('level') == 4) {
                redirect(base_url('Gudang/Dashboard'));
            } else {
                $this->CI->session->set_flashdata('sukses', 'Maaf, Username/password salah');
                redirect(base_url('Auth/Login'));
            }
            return false;
        }
        // else {
        //     $this->CI->session->set_flashdata('sukses', 'Oopss.. Username/password salah');
        //     redirect(base_url());
        // }
    }

    // Cek login
    public function cek_login_master()
    {
        if ($this->CI->session->userdata('username') == '') {
            $this->CI->session->set_flashdata('sukses', 'Maaf, silakan login dulu');
            redirect(base_url('Auth/Login'));
        } elseif ($this->CI->session->userdata('level') == 1) {
            $this->CI->session->set_flashdata('sukses', 'Maaf, akeses terlarang');
            redirect(base_url('Owner/Dashboard'));
        } elseif ($this->CI->session->userdata('level') == 2) {
            $this->CI->session->set_flashdata('sukses', 'Maaf, akeses terlarang');
            redirect(base_url('Admin/Dashboard'));
        } elseif ($this->CI->session->userdata('level') == 3) {
            $this->CI->session->set_flashdata('sukses', 'Maaf, akeses terlarang');
            redirect(base_url('Teknisi/Dashboard'));
        } elseif ($this->CI->session->userdata('level') == 4) {
            $this->CI->session->set_flashdata('sukses', 'Maaf, akeses terlarang');
            redirect(base_url('Gudang/Dashboard'));
        }
    }
    // Cek login
    public function cek_login_owner()
    {
        if ($this->CI->session->userdata('username') == '') {
            $this->CI->session->set_flashdata('sukses', 'Maaf, silakan login dulu');
            redirect(base_url('Auth/Login'));
        } elseif ($this->CI->session->userdata('level') == 99) {
            $this->CI->session->set_flashdata('sukses', 'Maaf, akeses terlarang');
            redirect(base_url('Master/Dashboard'));
        } elseif ($this->CI->session->userdata('level') == 2) {
            $this->CI->session->set_flashdata('sukses', 'Maaf, akeses terlarang');
            redirect(base_url('Admin/Dashboard'));
        } elseif ($this->CI->session->userdata('level') == 3) {
            $this->CI->session->set_flashdata('sukses', 'Maaf, akeses terlarang');
            redirect(base_url('Teknisi/Dashboard'));
        } elseif ($this->CI->session->userdata('level') == 4) {
            $this->CI->session->set_flashdata('sukses', 'Maaf, akeses terlarang');
            redirect(base_url('Gudang/Dashboard'));
        }
    }

    public function cek_login_admin()
    {
        if ($this->CI->session->userdata('username') == '') {
            $this->CI->session->set_flashdata('sukses', 'Maaf, silakan login dulu');
            redirect(base_url('Auth/Login'));
        } elseif ($this->CI->session->userdata('level') == 99) {
            $this->CI->session->set_flashdata('sukses', 'Maaf, akeses terlarang');
            redirect(base_url('Master/Dashboard'));
        } elseif ($this->CI->session->userdata('level') == 1) {
            $this->CI->session->set_flashdata('sukses', 'Maaf, akeses terlarang');
            redirect(base_url('Owner/Dashboard'));
        } elseif ($this->CI->session->userdata('level') == 3) {
            $this->CI->session->set_flashdata('sukses', 'Maaf, akeses terlarang');
            redirect(base_url('Teknisi/Dashboard'));
        } elseif ($this->CI->session->userdata('level') == 4) {
            $this->CI->session->set_flashdata('sukses', 'Maaf, akeses terlarang');
            redirect(base_url('Gudang/Dashboard'));
        }
    }

    public function cek_login_teknisi()
    {
        if ($this->CI->session->userdata('username') == '') {
            $this->CI->session->set_flashdata('sukses', 'Maaf, silakan login dulu');
            redirect(base_url('Auth/Login'));
        } elseif ($this->CI->session->userdata('level') == 99) {
            $this->CI->session->set_flashdata('sukses', 'Maaf, akeses terlarang');
            redirect(base_url('Master/Dashboard'));
        } elseif ($this->CI->session->userdata('level') == 1) {
            $this->CI->session->set_flashdata('sukses', 'Maaf, akeses terlarang');
            redirect(base_url('Owner/Dashboard'));
        } elseif ($this->CI->session->userdata('level') == 2) {
            $this->CI->session->set_flashdata('sukses', 'Maaf, akeses terlarang');
            redirect(base_url('Admin/Dashboard'));
        } elseif ($this->CI->session->userdata('level') == 4) {
            $this->CI->session->set_flashdata('sukses', 'Maaf, akeses terlarang');
            redirect(base_url('Gudang/Dashboard'));
        }
    }

    public function cek_login_gudang()
    {
        if ($this->CI->session->userdata('username') == '') {
            $this->CI->session->set_flashdata('sukses', 'Maaf, silakan login dulu');
            redirect(base_url('Auth/Login'));
        } elseif ($this->CI->session->userdata('level') == 99) {
            $this->CI->session->set_flashdata('sukses', 'Maaf, akeses terlarang');
            redirect(base_url('Master/Dashboard'));
        } elseif ($this->CI->session->userdata('level') == 1) {
            $this->CI->session->set_flashdata('sukses', 'Maaf, akeses terlarang');
            redirect(base_url('Owner/Dashboard'));
        } elseif ($this->CI->session->userdata('level') == 2) {
            $this->CI->session->set_flashdata('sukses', 'Maaf, akeses terlarang');
            redirect(base_url('Admin/Dashboard'));
        } elseif ($this->CI->session->userdata('level') == 3) {
            $this->CI->session->set_flashdata('sukses', 'Maaf, akeses terlarang');
            redirect(base_url('Teknisi/Dashboard'));
        }
    }


    // Logout
    public function logout()
    {
        $this->CI->session->unset_userdata('nama');
        //$this->CI->session->unset_userdata('akses_level');
        $this->CI->session->unset_userdata('email');
        // $this->CI->session->unset_userdata('id_login');
        // $this->CI->session->unset_userdata('id');
        session_destroy();
        $this->CI->session->set_flashdata('sukses', 'Terimakasih, Anda berhasil logout');
        redirect(base_url('Auth/Login'));
    }

    public function logout_block()
    {
        $this->CI->session->unset_userdata('username');
        //$this->CI->session->unset_userdata('akses_level');
        $this->CI->session->unset_userdata('level');
        $this->CI->session->unset_userdata('id_login');
        $this->CI->session->unset_userdata('id');
        // session_destroy();
        $this->CI->session->set_flashdata('blokir', 'Akun anda diblokir, anda belum upload bukti pembayaran Biaya Masuk Tahap 1. Silahkan hubungi admin jika sudah melakukan pembayaran');
        redirect(base_url());
    }
    public function logout_admin()
    {
        $this->CI->session->unset_userdata('username');
        //$this->CI->session->unset_userdata('akses_level');
        $this->CI->session->unset_userdata('level');
        $this->CI->session->unset_userdata('id_login');
        $this->CI->session->unset_userdata('id');
        session_destroy();
        $this->CI->session->set_flashdata('sukses', 'Terimakasih, Anda berhasil logout');
        redirect(base_url('admin/login'));
    }
}
