<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Validasi extends CI_Controller{
    
    public function index($bengkel)
    {
        $data = array(
            'title'                => 'Validasi',
            'configurasi'          => $this->Konfigurasi_Model->konfig($bengkel),
        );
        $this->load->view('validasi', $data);
    }
    
    //  public function detail()
    // {
    //     $order_id = $this->input->get('token');

    //     $data = array(
    //         'title'         => 'Daftar Validasi',
    //         'link'          => 'Validasi',
    //         'configurasi'   => $this->Konfigurasi_Model->listing(),
    //         'order'         => $this->Order_Model->getbyId($order_id),
    //         'part'          => $this->Part_Model->getbyId($order_id),
    //         'po'            => $this->PurchaseOrder_Model->listing()
    //     );

    //     $this->load->view('validasiTemplate', $data);
    // }
    
    public function validasiSetuju()
    {
        
        $i = $this->input;
        $id = $i->get('token');
        $bengkel = $i->get('bengkel');
        
        $query = $this->db->query("SELECT * FROM repair_order WHERE order_id = $id");
        $hasil = $query->row_array();
        
        if($hasil['order_status'] > 4){
            
            $data = array(
                    'title'             => 'Validasi',
                    'configurasi'       => $this->Konfigurasi_Model->konfig($bengkel),
                    'isi'               => "Konfirmasi Gagal"
                    );
            $this->load->view('validasi', $data);
        } else {
            
            $idorder = $i->get('token');
            if ($hasil['order_status'] == 4) {
                $part = $this->db->query("SELECT * from parts join partmaster on parts.part_partMaster_id = partmaster.partMaster_id WHERE part_order_id = $idorder");
                $dataPart = $part->result_array();
    
                $data = array();
                
                foreach($dataPart as $bparts ){
                    
                    if($bparts['partMaster_harga'] > 0 ) {
                        $karung = array(
                            'partMaster_id'     => $bparts['partMaster_id'],
                            'partMaster_stok'   => $bparts['partMaster_stok'] - $bparts['part_qtyDibutuhkan'],
                            
                        );
                    $data [] = $karung;
                    }
                }
    
                $this->db->update_batch('partmaster', $data, 'partMaster_id');
            
            }
            
            $order = array(
                'order_id'      => $idorder,
                'order_status'  => 5
            );
            $this->Order_Model->edit($order);
            $this->index($bengkel);
        }
    }

    public function validasiCancel()
    {
        $i = $this->input;
        $id = $i->get('token');
        $bengkel = $i->get('bengkel');
        
        $query = $this->db->query("SELECT * FROM repair_order WHERE order_id = $id");
        $hasil = $query->row_array();
        
        if($hasil['order_status'] > 4){
            
            $data = array(
                    'title'                => 'Validasi',
                    'configurasi'          => $this->Konfigurasi_Model->konfig($bengkel),
                    'isi'               => "Konfirmasi Gagal"
                    );
            $this->load->view('validasi', $data);
        } else {
            
            $order = array(
                'order_id'      => $i->get('token'),
                'order_status'  => 6
            );
            $this->Order_Model->edit($order);
            // redirect(base_url('Validasi/').$bengkel);
            
            $this->index($bengkel);
        }
    }
}
