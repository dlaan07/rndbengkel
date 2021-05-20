<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pelanggan extends CI_Controller
{
    public function index()
    {
        $data = array(
            'title'         => 'Daftar Pelanggan',
            'link'          => 'Pelanggan',
            'configurasi'   => $this->Konfigurasi_Model->master(),
            'bengkel'       => $this->Bengkel_Model->master(), //untuk menampilkan daftar pelanggan. 
            //Pelanggan_Model dari folder model, nama file Pelanggan_Model function master.
            'isi'           => 'Master/pelanggan/index'
        );

        $this->load->view('Master/layout/wrapper', $data);
    }
    
    public function detail($bengkel_id)
    {
        $data = array(
            'title'         => 'Daftar Pelanggan',
            'link'          => 'Pelanggan',
            'configurasi'   => $this->Konfigurasi_Model->master(),
            'pelanggan'     => $this->Pelanggan_Model->detailmaster($bengkel_id), //untuk menampilkan daftar pelanggan. 
            //Pelanggan_Model dari folder model, nama file Pelanggan_Model function master.
            'isi'           => 'Master/pelanggan/detail'
        );

        $this->load->view('Master/layout/wrapper', $data);
    }
}
