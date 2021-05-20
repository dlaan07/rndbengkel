<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PartOrder extends CI_Controller
{
    // public function __construct() {
    //   parent::__construct();
    //   ob_start();
    //  }
    public function tambahPengecekan()
    {
        $valid = $this->form_validation;
        $valid->set_rules('cek', 'Keperluan Suku Cadang', 'required');
        $valid->set_rules('jasa', 'Estimasi Biaya Jasa', 'required');
        $valid->set_rules('waktu', 'Estimasi Waktu Pengerjaan', 'required');
        $order_id = $this->input->post('idorder');
        if ($valid->run() === FALSE) {
            $data = array(
                'title'         => 'Pengecekan',
                'link'          => 'Pengecekan',
                'configurasi'   => $this->Konfigurasi_Model->listing(),
                'order'         => $this->Order_Model->getbyId($order_id),
                'part'          => $this->PartMaster_Model->listing(),
                'jasa'          => $this->Jasa_Model->listing(),
                'partOrder'     => $this->Part_Model->getbyId($order_id),
                'isi'           => 'teknisi/pengecekan/index'
            );
            $this->session->set_flashdata('gagal', 'Data pengecekan gagal disimpan');
            $this->load->view('teknisi/layout/wrapper', $data);
        } else {
            $i = $this->input;
            $cek = $i->post('cek');
            if ($cek == 1) {
                $perbaikan = array(
                    'order_id'                  => $order_id,
                    'order_estimasiJasaWaktu'   => $i->post('waktu'),
                    'order_estimasiJasaHarga'   => $i->post('jasa')
                );

                $this->Order_Model->edit($perbaikan);
            } else {
                
                $idbengkel = $this->session->userdata('bengkel');
                $bengkel = $this->db->query("SELECT * FROM bengkel where bengkel_id = $idbengkel");
                $nBengkel = $bengkel->row_array();
                $namaBengkel = $nBengkel['bengkel_nama'];
                
                $email = $i->post('emailpel');
                $perbaikan = array(
                    'order_id'                  => $order_id,
                    'order_estimasiWaktu'       => $i->post('waktu'),
                    'order_estimasiJasaWaktu'   => $i->post('waktu'),
                    'order_estimasiJasaHarga'   => $i->post('jasa'),
                    'order_status'              => 2
                );

                $this->Order_Model->edit($perbaikan);
                $this->_sendMail($email, $order_id, $namaBengkel);
            }

            redirect(base_url('Teknisi/Order/'));
        }
    }

    public function _sendMail($email, $order_id, $namaBengkel)
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
        $data = array(
            'title'         => 'Daftar Validasi',
            'link'          => 'Validasi',
            'configurasi'   => $this->Konfigurasi_Model->listing(),
            'order'         => $this->Order_Model->getbyId($order_id),
            'part'          => $this->Part_Model->getbyId($order_id),
            'po'            => $this->PurchaseOrder_Model->listing()
        );

        $harga = $this->load->view('konfirmasi', $data, TRUE);

        $this->email->message($harga);

        // Tampilkan pesan sukses atau error
        if ($this->email->send()) {

            // redirect(base_url('Teknisi/Order'));
            echo 'Sukses! email berhasil dikirim.';
        } else {

            // redirect(base_url('Teknisi/Dashboard'));
            // echo 'Error! email tidak dapat dikirim.';
        }
    }


    public function tambahPartOrder()
    {
        $valid = $this->form_validation;
        $valid->set_rules('part', 'Nama Part', 'required');
        $valid->set_rules('qty', 'Qty', 'required');
        $order_id = $this->input->post('id');
        if ($valid->run() === FALSE) {
            $data = array(
                'title'         => 'Daftar Order',
                'link'          => 'Order',
                'configurasi'   => $this->Konfigurasi_Model->listing(),
                'order'         => $this->Order_Model->getbyId($order_id),
                'part'          => $this->PartMaster_Model->listing(),
                'partOrder'     => $this->Part_Model->getbyId($order_id),
                'isi'           => 'teknisi/pengecekan/index'
            );
            // redirect(base_url('teknisi/order/pengecekan/') . $order_id);
            $this->session->set_flashdata('gagal', 'Kebutuhan part gagal disimpan');
            $this->load->view('teknisi/layout/wrapper', $data);
        } else {
            $i = $this->input;
            $partMaster = $i->post('part');
            $qty = $i->post('qty');
            $query = $this->db->query("SELECT * FROM partmaster WHERE partMaster_id = $partMaster");
            $data = $query->row_array();

            $stok = $data['partMaster_stok'] - $qty;

            $harga = $data['partMaster_harga'];
            $partOrder = array(
                'part_qtyDibutuhkan'    => $qty,
                'part_tgl'              => date('Y-m-d'),
                'part_order_id'         => $i->post('id'),
                'part_partMaster_id'    => $partMaster,
                'part_harga'            => $harga,
                'part_bengkel'          => $this->session->userdata('bengkel')
            );
            $this->Part_Model->tambah($partOrder);

            // if ($data['partMaster_harga'] > 0) {
            //     // $berkurang = $
            //     $partmaster = array(
            //         'partMaster_id'     => $partMaster,
            //         'partMaster_stok'   => $stok
            //     );
            //     $this->PartMaster_Model->edit($partmaster);
            // }
            redirect(base_url('Teknisi/Order/Pengecekan/') . $order_id);
        }
    }

    public function partBaru($order_id)
    {
        $data = array(
            'title'         => 'Daftar Part Master',
            'link'          => 'Part Master',
            'configurasi'   => $this->Konfigurasi_Model->listing(),
            'part'          => $this->PartMaster_Model->listing(),
            'order'         => $this->Order_Model->getbyId($order_id),
            'isi'           => 'teknisi/part/index'
        );
        $this->load->view('teknisi/layout/wrapper', $data);
    }

    public function simpanPart()
    {
        $valid = $this->form_validation;
        $valid->set_rules('part', 'Nama Part', 'required');

        $i = $this->input;
        $order_id = $i->post('idorder');
        if ($valid->run() === FALSE) {
            redirect(base_url('Teknisi/PartOrder/PartBaru/'));
            $this->session->set_flashdata('gagal', 'Kebutuhan part gagal disimpan');
        } else {
            $partmaster = array(
                'partMaster_nama'    => $i->post('part'),
                'partMaster_harga'   => $i->post('harga'),
                'partMaster_stok'    => $i->post('stok'),
                'partMaster_tgl'     => date('Y-m-d'),
                'partMaster_bengkel' => $this->session->userdata('bengkel')
            );
            $this->PartMaster_Model->tambah($partmaster);
            $this->session->set_flashdata('sukses', 'Part baru berhasil disimpan');
            redirect(base_url('Teknisi/PartOrder/partBaru/') . $order_id);
        }
    }

    public function hapus()
    {
        $i = $this->input;

        $partMaster = $i->post('part');
        $qty = $i->post('qty');
        // $query = $this->db->query("SELECT * FROM partmaster join parts on partmaster.partMaster_id = parts.part_partMaster_id WHERE partMaster_id = $partMaster");
        // $data = $query->row_array();
        $part = array(
            'part_id'          => $i->post('idpart')
        );

        // if ($data['partMaster_harga'] != 0) {
        //     $stok = $data['partMaster_stok'] + $qty;
        //     $partmaster = array(
        //         'partMaster_id'      => $partMaster,
        //         'partMaster_stok'    => $stok
        //     );
        //     $this->PartMaster_Model->edit($partmaster);
        // }
        $this->Part_Model->delete($part);
        redirect(base_url('Teknisi/Order/Pengecekan/') . $i->post('idorder'));
    }
}
