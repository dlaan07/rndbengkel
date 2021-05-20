<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pelanggan extends CI_Controller
{
    public function index()
    {
        $data = array(
            'title'         => 'Daftar Pelanggan',
            'link'          => 'Pelanggan',
            'configurasi'   => $this->Konfigurasi_Model->listing(),
            'pelanggan'     => $this->Pelanggan_Model->listing(), //untuk menampilkan daftar pelanggan. 
            //Pelanggan_Model dari folder model, nama file Pelanggan_Model function listing.
            'isi'           => 'owner/pelanggan/index'
        );

        $this->load->view('owner/layout/wrapper', $data);
    }
}
