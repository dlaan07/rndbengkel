<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{
    public function index()
    {
        $data = array(
            'title'                => 'Login',
            'configurasi'          => $this->Konfigurasi_Model->listing(),
        );
        $this->load->view('login', $data);
    }

    public function masuk()
    {
        // Validasi
        $valid         = $this->form_validation;
        $valid->set_rules('email', 'email', 'required');
        $valid->set_rules('password', 'Password', 'required');
        if ($valid->run()) {
            $email         = $this->input->post('email');
            $password      = $this->input->post('password');
            $this->user_login->login($email, $password);
        }
        $this->session->set_flashdata('sukses', 'Email atau Password Salah');
        redirect(base_url('Auth/Login'));
    }

    public function logout()
    {
        $this->user_login->logout();
    }
}
