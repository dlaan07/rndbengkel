<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Tracking extends CI_Controller
{
    public function index()
    {
        $data = array(
            'title'         => 'Daftar Tracking',
            'link'          => 'Daftar Tracking',
            'configurasi'   => $this->Konfigurasi_Model->listing(),
            'order'         => $this->PurchaseOrder_Model->listing(),
            'isi'           => 'gudang/tracking/index'
        );
        $this->load->view('gudang/layout/wrapper', $data);
    }

    public function detail($idorder)
    {
        $data = array(
            'title'         => 'Detail Part',
            'link'          => 'Detail Part',
            'configurasi'   => $this->Konfigurasi_Model->listing(),
            'partOrder'     => $this->PurchaseOrder_Model->getbyPO($idorder),
            'isi'           => 'gudang/tracking/detail'
        );
        $this->load->view('gudang/layout/wrapper', $data);
    }

    public function updateTracking()
    {
        $po_id = $this->input->post('idpo');
        $data = array(
            'title'         => 'Update Tracking',
            'link'          => 'Update Tracking',
            'configurasi'   => $this->Konfigurasi_Model->listing(),
            'part'          => $this->PurchaseOrder_Model->getbyId($po_id),
            'isi'           => 'gudang/tracking/update'
        );
        $this->load->view('gudang/layout/wrapper', $data);
    }

    public function simpan()
    {
        $i = $this->input;

        $idpo = $i->post('idpo');
        $tracking = $this->db->query("SELECT * FROM purchaseorder where po_id = $idpo");
        $po = $tracking->row_array();

        $po_id = $i->post('idorder');
        $cek = $i->post('cek');
        $purchaseorder = array(
            'po_id'                 => $idpo,
            'po_tracking'           => $cek
        );
        $this->PurchaseOrder_Model->edit($purchaseorder);

        if ($po['po_tracking'] < 3 && $cek == 3) {
            // if ()
            $partmaster = array(
                'partMaster_id'      => $i->post('idmaster'),
                'partMaster_harga'   => $i->post('harga'),
                'partMaster_stok'    => $i->post('stok')
            );
            $this->PartMaster_Model->edit($partmaster);
        }

        if ($po['po_tracking'] < 4 && $cek == 4) {
            // if ($cek == 3) {
            $partmaster = array(
                'partMaster_id'      => $i->post('idmaster'),
                'partMaster_stok'    => $i->post('outstok')
            );
            $this->PartMaster_Model->edit($partmaster);
            // }
        }

        redirect(base_url('Gudang/Tracking/Detail/') . $po_id);
    }
}
