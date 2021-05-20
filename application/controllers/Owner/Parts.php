<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Parts extends CI_Controller
{
    public function index()
    {
        $data = array(
            'title'         => 'Daftar Part Master',
            'link'          => 'Parts',
            'configurasi'   => $this->Konfigurasi_Model->listing(),
            'part'          => $this->PartMaster_Model->listing(),
            'order'         => $this->Order_Model->getbyId($this->input->post('idorder')),
            'isi'           => 'owner/part/index'
        );
        $this->load->view('owner/layout/wrapper', $data);
    }
    
    
    public function po()
    {
        $data = array(
            'title'         => 'Daftar Part Master',
            'link'          => 'Parts',
            'configurasi'   => $this->Konfigurasi_Model->listing(),
            'part'          => $this->PartMaster_Model->listing(),
            'isi'           => 'owner/part/po'
        );
        $this->load->view('owner/layout/wrapper', $data);
    }
}
