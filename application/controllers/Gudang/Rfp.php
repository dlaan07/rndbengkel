<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Rfp extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        header('Cache-Control: no-cache, must-revalidate, max-age=0');
        header('Cache-Control: post-check=0, pre-check=0', false);
        header('Pragma: no-cache');
    }

    public function index()
    {
        $data = array(
            'title'         => 'Daftar Request Parts',
            'link'          => 'Request Parts',
            'configurasi'   => $this->Konfigurasi_Model->listing(),
            'order'         => $this->Part_Model->listingRfp(),
            'isi'           => 'gudang/rfp/index'
        );
        $this->load->view('gudang/layout/wrapper', $data);
    }

    public function detailRfp()
    {
        $idorder = $this->input->post('id');
        $perbaikan = array(
            'order_id'                  => $idorder,
            'order_status'              => 3
        );
        $this->Order_Model->edit($perbaikan);
        $this->detail($idorder);
    }

    public function detail($idorder)
    {
        $data = array(
            'title'         => 'Detail RFP',
            'link'          => 'RFP',
            'configurasi'   => $this->Konfigurasi_Model->listing(),
            'partOrder'     => $this->Part_Model->getbyId($idorder),
            'order'         => $this->Order_Model->getbyId($idorder),
            'isi'           => 'gudang/rfp/detail'
        );
        $this->load->view('gudang/layout/wrapper', $data);
    }

    public function hargaReq($part_id)
    {
        // $part_id = $this->input->post('idpart');
        $data = array(
            'title'         => 'Proses RFP',
            'link'          => 'Proses RFP',
            'configurasi'   => $this->Konfigurasi_Model->listing(),
            'part'          => $this->Part_Model->getbyRow($part_id),
            'isi'           => 'gudang/rfp/proses'
        );
        $this->load->view('gudang/layout/wrapper', $data);
    }

    public function estimasiParts()
    {
        $i = $this->input;
        $order_id = $i->post('idorder');
        $email = $i->post('email');
        $idbengkel = $this->session->userdata('bengkel');
        $bengkel = $this->db->query("SELECT * FROM bengkel where bengkel_id = $idbengkel");
        $nBengkel = $bengkel->row_array();
        $namaBengkel = $nBengkel['bengkel_nama'];

        $data = array(
            'title'         => 'Daftar Validasi',
            'link'          => 'Validasi',
            'configurasi'   => $this->Konfigurasi_Model->listing(),
            'order'         => $this->Order_Model->getbyId($order_id),
            'part'          => $this->Part_Model->getbyId($order_id),
            'po'            => $this->PurchaseOrder_Model->listing()
        );

        $perbaikan = array(
            'order_id'                  => $order_id,
            'order_estimasiWaktu'       => $i->post('perbaikanSelesai'),
            'order_estimasiPartsHarga'  => $i->post('part'),
            'order_status'              => 4
        );

        $this->Order_Model->edit($perbaikan);
        $this->session->set_flashdata('sukses', 'Part baru berhasil disimpan');
        $this->_sendMail($email, $order_id, $data, $namaBengkel);
        // redirect(base_url('Gudang/Rfp'));
    }

    public function tambahRfp()
    {
        $valid = $this->form_validation;
        $valid->set_rules('toko', 'Nama Toko', 'required');
        $valid->set_rules('alamat', 'Alamat Toko', 'required');
        $valid->set_rules('tlp', 'Telpon Toko', 'required');
        $valid->set_rules('harga', 'Harga', 'required');
        $valid->set_rules('profit', 'Profit', 'required');
        $valid->set_rules('tglPart', 'Estimasi Part Waktu', 'required');
        $i = $this->input;
        $idorder = $i->post('idorder');
        $part_id = $i->post('idpart');
        if ($valid->run() === FALSE) {
            $data = array(
                'title'         => 'Proses RFP',
                'link'          => 'Proses RFP',
                'configurasi'   => $this->Konfigurasi_Model->listing(),
                'part'          => $this->Part_Model->getbyRow($part_id),
                'isi'           => 'gudang/rfp/proses'
            );

            $this->session->set_flashdata('gagal', 'RFP gagal disimpan');
            $this->load->view('gudang/layout/wrapper', $data);

            // redirect(base_url('Gudang/Rfp/hargaReq/').$idorder);
        } else {
            $purchaseorder = array(
                'po_hargaReq'           => $i->post('satuanrfp'),
                'po_qty'                => $i->post('qty'),
                'po_namaToko'           => $i->post('toko'),
                'po_alamatToko'         => $i->post('alamat'),
                'po_contactToko'        => $i->post('tlp'),
                'po_harga'              => $i->post('harga'),
                'po_estimasiPartsWaktu' => $i->post('tglPart'),
                'po_part_id'            => $part_id,
                'po_bengkel'            => $this->session->userdata('bengkel')
            );
            $this->PurchaseOrder_Model->tambah($purchaseorder);

            $partmaster = array(
                'partMaster_id'      => $i->post('idpartmaster'),
                'partMaster_profit'  => $i->post('profit')
            );
            $this->PartMaster_Model->edit($partmaster);

            $this->session->set_flashdata('sukses', 'Part baru berhasil disimpan');
            // redirect($this->detail($idorder));
            redirect(base_url('Gudang/Rfp/Detail/') . $idorder);
        }
    }

    public function _sendMail($email, $order_id, $data, $namaBengkel)
    {
        // Konfigurasi email
        $config = [
            // 'mailtype'  => 'html',
            // 'set_mailtype' => 'html',
            'charset'      => 'utf-8',
            'protocol'  => 'smtp',
            'smtp_host' => 'bengkel.intala.com',
            'smtp_user' => 'info@bengkel.intala.com',  // Email gmail
            'smtp_pass'   => 'bengkel2021',  // Password gmail
            'smtp_crypto' => 'ssl',
            'smtp_port'   => 465,
            'crlf'    => "\r\n",
            // 'set_newline' => "\r\n"
            // 'newline' => "\r\n"
        ];

        // Load library email dan konfigurasinya
        $this->load->library('email', $config);

        $this->email->set_newline("\r\n");
        $this->email->set_mailtype("html");
        // Email dan nama pengirim
        $this->email->from('info@bengkel.intala.com', $namaBengkel);

        // Email penerima
        $this->email->to($email); // Ganti dengan email tujuan

        // Lampiran email, isi dengan url/path file
        // $this->email->attach(base_url('assets/vendors/images/login-img.png'));

        // Subject email
        $this->email->subject("Konfirmasi Estimasi Perbaikan Sepeda");

        // Isi email
        $order = $this->Order_Model->getbyId($order_id);
        $part  = $this->Part_Model->getbyId($order_id);
        $configurasi = $this->Konfigurasi_Model->listing();

        $harga = $this->load->view('konfirmasi', $data, TRUE);

        $this->email->message($harga);

        // Tampilkan pesan sukses atau error
        if ($this->email->send()) {

            redirect(base_url('Gudang/Rfp'));
            // echo 'Sukses! email berhasil dikirim.';
        } else {

            redirect(base_url('Gudang/Dashboard'));
            // echo 'Error! email tidak dapat dikirim.';
        }
    }
}
