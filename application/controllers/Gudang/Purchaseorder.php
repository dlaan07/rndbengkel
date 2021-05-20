<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Purchaseorder extends CI_Controller
{
    public function index()
    {
        $data = array(
            'title'         => 'Daftar Purchase Order',
            'link'          => 'Purchase Order',
            'configurasi'   => $this->Konfigurasi_Model->listing(),
            'order'         => $this->Part_Model->listingRfp(),
            'isi'           => 'gudang/po/index'
        );
        $this->load->view('gudang/layout/wrapper', $data);
    }

    public function detail($idorder)
    {
        $data = array(
            'title'         => 'Detail PO',
            'link'          => 'Detail PO',
            'configurasi'   => $this->Konfigurasi_Model->listing(),
            'partOrder'     => $this->Part_Model->getbyId($idorder),
            'order'         => $this->Order_Model->getbyId($idorder),
            'isi'           => 'gudang/po/detail'
        );
        $this->load->view('gudang/layout/wrapper', $data);
    }

    public function prosesPO($po_id)
    {
        // $po_id = $this->input->post('idpo');
        $data = array(
            'title'         => 'Detail PO',
            'link'          => 'Detail PO',
            'configurasi'   => $this->Konfigurasi_Model->listing(),
            'part'          => $this->PurchaseOrder_Model->getbyId($po_id),
            'isi'           => 'gudang/po/proses'
        );
        $this->load->view('gudang/layout/wrapper', $data);
    }

    public function simpanPO()
    {
        $valid = $this->form_validation;
        $valid->set_rules('tglPesan', 'Tanggal Pesan', 'required');
        $valid->set_rules('harga', 'Harga', 'required');
        $i = $this->input;
        $idorder = $i->post('idorder');
        $po_id = $i->post('idpo');
        if ($valid->run() === FALSE) {
            $data = array(
                'title'         => 'Detail PO',
                'link'          => 'Detail PO',
                'configurasi'   => $this->Konfigurasi_Model->listing(),
                'part'          => $this->PurchaseOrder_Model->getbyId($po_id),
                'isi'           => 'gudang/po/proses'
            );
            $this->load->view('gudang/layout/wrapper', $data);
        } else {
            $purchaseorder = array(
                'po_id'                 => $po_id,
                'po_hargaReq'           => $i->post('satuanrfp'),
                'po_qtyStok'            => $i->post('QtyStok'),
                'po_harga'              => $i->post('harga'),
                'po_tglPesan'           => $i->post('tglPesan'),
                'po_tracking'           => 1,
            );
            $this->PurchaseOrder_Model->edit($purchaseorder);

            // $stokBaru = $i->post('qty') + $i->post('stok') + $i->post('QtyStok');
            // $partmaster = array(
            //     'partMaster_id'      => $i->post('idpartmaster'),
            //     'partMaster_harga'   => $i->post('satuanrfp'),
            //     'partMaster_stok'    => $stokBaru
            // );
            // $this->PartMaster_Model->edit($partmaster);

            $this->session->set_flashdata('sukses', 'Part baru berhasil disimpan');
            // redirect($this->detail($idorder));
            redirect(base_url('Gudang/Purchaseorder/Detail/') . $idorder);
        }
    }

    public function biayaPart()
    {
        $i = $this->input;
        $idorder = $this->input->post('idorder');
        $data = $this->db->query("SELECT * FROM bill where bill_order_id = $idorder");
        $ada = $data->row_array();
        $idbill = $ada['bill_id'];
        if (!empty($idbill)) {
            $bill = array(
                'bill_id'        => $idbill,
                'bill_parts'     => $i->post('part'),
                'bill_order_id'  => $i->post('idorder'),
                'bill_bengkel'   => $this->session->userdata('bengkel')
            );
            $this->Bill_Model->edit($bill);
        } else {
            $bill = array(
                'bill_parts'     => $i->post('part'),
                'bill_order_id'  => $i->post('idorder'),
                'bill_bengkel'   => $this->session->userdata('bengkel')
            );
            $this->Bill_Model->tambah($bill);
        }

        $perbaikan = array(
            'order_id'     => $i->post('idorder'),
            'order_status' => 7
        );
        $this->Order_Model->edit($perbaikan);


        $this->session->set_flashdata('sukses', 'Total Harga Parts Berhasil Disimpan');
        redirect(base_url('Gudang/Purchaseorder'));
    }
}
