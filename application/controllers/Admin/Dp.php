<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dp extends CI_Controller
{
    public function index()
    {
        $data = array(
            'title'         => 'Daftar DP',
            'link'          => 'DP',
            'configurasi'   => $this->Konfigurasi_Model->listing(),
            'order'         => $this->Bill_Model->dp(),
            'isi'           => 'admin/dp/index'
        );

        $this->load->view('admin/layout/wrapper', $data);
    }

    public function tambah()
    {
        $data = array(
            'title'         => 'Tambah DP',
            'link'          => 'DP',
            'configurasi'   => $this->Konfigurasi_Model->listing(),
            'order'         => $this->Order_Model->listing(),
            'isi'           => 'admin/dp/tambah'
        );

        $this->load->view('admin/layout/wrapper', $data);
    }

    public function simpanTambah()
    {
        $valid = $this->form_validation;
        $valid->set_rules('pelanggan', 'Pelanggan', 'required');
        $valid->set_rules('dp', 'Nilai DP', 'required');

        if ($valid->run() === FALSE) {
            $this->session->set_flashdata('gagal', 'DP gagal disimpan');
            redirect(base_url('Admin/Dp'));
        } else {
            $i = $this->input;
            $bill = array(
                'bill_order_id'     => $i->post('pelanggan'),
                'bill_dp'           => $i->post('dp'),
                'bill_dpKet'        => $i->post('keterangan'),
                'bill_bengkel'      => $this->session->userdata('bengkel'),
            );
            $this->Bill_Model->tambah($bill);

            $idbill = $this->db->insert_id();
            // exit;

            if ($i->post('dp') > 0) {
                date_default_timezone_set('Asia/Jakarta');
                $kredit = array(
                    'kredit_bayar'      => $i->post('dp'),
                    'kredit_tgl'        => date('Y-m-d H:i:s'),
                    'kredit_metode'     => "DP",
                    'kredit_catatan'    => $i->post('keterangan'),
                    'kredit_bill_id'    => $idbill,
                );
                $this->Kredit_Model->tambah($kredit);

                $kredit_id = $this->db->query(
                  "SELECT kredit_id FROM kredit
                  ORDER BY kredit_id DESC LIMIT 1")->row_array();

                $this->invoice($i->post('pelanggan'), $kredit_id['kredit_id']);
            }

            $this->session->set_flashdata('sukses', 'DP berhasil di simpan');
            redirect(base_url('Admin/Dp'));
        }
    }

    public function edit($order_id)
    {
        $data = array(
            'title'         => 'Daftar DP',
            'link'          => 'DP',
            'configurasi'   => $this->Konfigurasi_Model->listing(),
            'order'         => $this->Bill_Model->editDp($order_id),
            'isi'           => 'admin/dp/edit'
        );

        $this->load->view('admin/layout/wrapper', $data);
    }

    public function simpanEdit()
    {
        $valid = $this->form_validation;
        $valid->set_rules('dp', 'Nilai DP', 'required');

        if ($valid->run() === FALSE) {
            $this->session->set_flashdata('gagal', 'DP gagal disimpan');
            redirect(base_url('Admin/Dp'));
        } else {
            $i = $this->input;
            $bill = array(
                'bill_id'           => $i->post('idbill'),
                'bill_dp'           => $i->post('dp'),
                'bill_dpKet'        => $i->post('keterangan')
            );
            $this->Bill_Model->edit($bill);

            $this->session->set_flashdata('sukses', 'DP berhasil di simpan');
            redirect(base_url('Admin/Dp'));
        }
    }

    public function cetak($order_id)
    {
        $kredit = $this->db->query("select * from kredit where kredit_bill_id = $order_id and kredit_metode ='DP' ");
        $noKredit = $kredit->row_array();
        $kredit_id = $noKredit['kredit_id'];
        // echo $kredit_id;
        // exit;

        // $this->invoice($order_id, $kredit_id);

        $bill = $this->db->query("select * from bill where bill_id = $order_id");
        $order = $bill->row_array();
        $orderId = $order['bill_order_id'];

        $data = array(
            'title'         => 'Print DP',
            'configurasi'   => $this->Konfigurasi_Model->listing(),
            'order'         => $this->Order_Model->getbyId($orderId),
            'part'          => $this->Part_Model->getbyId($orderId),
            'bill'          => $this->Bill_Model->getbyId($order_id),
            'kredit'        => $noKredit,
            'isi'           => 'admin/dp/print'
        );

        $this->load->view('admin/layout/wrapper', $data);
    }

     public function invoice($order_id, $kredit_id){
        $idbengkel = $this->session->userdata('bengkel');

        // $bill = $this->db->query("select * from bill where bill_order_id = $order_id");
        // $noBill = $bill->row_array();
        // $id_bill = $noBill['bill_id'];

        $newInvoice = $this->db->query("select * from invoice where invoice_bengkel = $idbengkel order by invoice_id desc limit 1");
        $invoice = $newInvoice->row_array();
        $nomor = $invoice['invoice_nomor']+1;
                // exit;

        $kredit = $this->db->query("select * from invoice where invoice_kredit = $kredit_id");
        $noKredit = $kredit->num_rows();
        // exit;

        if($noKredit < 1){
            if (!empty($invoice['invoice_bengkel'])){
            $data = array (
                'invoice_nomor'     => $nomor,
                'invoice_bill'      => $order_id,
                'invoice_bengkel'   => $idbengkel,
                'invoice_kredit'    => $kredit_id
                );

                $this->db->insert('invoice', $data);
            } else {
                $data = array (
                'invoice_nomor'     => 1,
                'invoice_bill'      => $order_id,
                'invoice_bengkel'   => $idbengkel,
                'invoice_kredit'    => $kredit_id
                );

                $this->db->insert('invoice', $data);
            }
        }
    }
}
