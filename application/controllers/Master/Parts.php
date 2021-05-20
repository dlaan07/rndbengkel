<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Parts extends CI_Controller
{
    public function index()
    {
        $data = array(
            'title'         => 'Daftar Part Master',
            'link'          => 'Parts',
            'configurasi'   => $this->Konfigurasi_Model->master(),
            'bengkel'       => $this->Bengkel_Model->master(),
            'isi'           => 'Master/part/index'
        );
        $this->load->view('Master/layout/wrapper', $data);
    }

    public function detail($bengkel_id)
    {
        $data = array(
            'title'         => 'Daftar Part Master',
            'link'          => 'Parts',
            'configurasi'   => $this->Konfigurasi_Model->master(),
            'bengkel'       => $this->Bengkel_Model->getbyId($bengkel_id),
            'parts'         => $this->PartMaster_Model->detailMaster($bengkel_id),
            'isi'           => 'Master/part/detail'
        );
        $this->load->view('Master/layout/wrapper', $data);
    }
}
