<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PerbaikanUlang extends CI_Controller
{
    public function index()
    {
        $data = array(
            'title'         => 'Daftar Perbaikan Ulang',
            'configurasi'   => $this->Konfigurasi_Model->listing(),
            'link'          => 'Validasi',
            'order'         => $this->Order_Model->listing(),
            'isi'           => 'teknisi/qc/index'
        );

        $this->load->view('teknisi/layout/wrapper', $data);
    }
    
     public function qc($order_id)
    {
        $data = array(
            'title'         => 'Form Perbaikan Ulang',
            'link'          => 'Perbaikan Ulang',
            'configurasi'   => $this->Konfigurasi_Model->listing(),
            'order'         => $this->Order_Model->getbyId($order_id),
            'part'          => $this->Part_Model->getbyId($order_id),
            'bill'          => $this->Bill_Model->getbyId($order_id),
            'isi'           => 'teknisi/qc/qc'
        );

        $this->load->view('teknisi/layout/wrapper', $data);
    }
    
     public function simpanQc()
    {
        $valid = $this->form_validation;
        $valid->set_rules('qc', 'Status Perbaikan Ulang', 'required');

        if ($valid->run() === FALSE) {
            redirect(base_url('Teknisi/PerbaikanUlang'));
        } else {
            
            $i = $this->input;
            $idbill = $i->post('idorder');
            $bill = array(
                'bill_id'           => $idbill,
                'bill_qc'           => $i->post('qc'),
                'bill_qcKet'        => $i->post('ket')
            );
            $this->Bill_Model->edit($bill);
            $this->session->set_flashdata('sukses', 'Perbaikan Ulang berhasil dilakukan');
            redirect('Teknisi/PerbaikanUlang');
        }
    }
}
