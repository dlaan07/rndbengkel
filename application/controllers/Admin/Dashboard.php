<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    public function index()
    {
        $data = array(
            'title'         => 'Dashboard',
            'link'          => 'Dashboard',
            'configurasi'   => $this->Konfigurasi_Model->listing(),
            'pelanggan'     => $this->Dashboard_Model->pelanggan(),
            'order'         => $this->Dashboard_Model->order(),
            'perbaikan'     => $this->Dashboard_Model->perbaikan(),
            'parts'         => $this->Dashboard_Model->parts(),
            // 'bill'          => $this->Dashboard_Model->bill(),
            'isi'           => 'admin/dashboard/index'
        );
        $this->load->view('admin/layout/wrapper', $data);
    }
}
