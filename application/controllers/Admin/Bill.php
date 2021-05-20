<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Bill extends CI_Controller
{
    public function index()
    {
        $data = array(
            'title'         => 'Daftar Bill',
            'configurasi'   => $this->Konfigurasi_Model->listing(),
            'link'          => 'Validasi',
            'order'         => $this->Order_Model->listing(),
            'isi'           => 'admin/bill/index'
        );

        $this->load->view('admin/layout/wrapper', $data);
    }

    public function penagihan($order_id)
    {
        $data = array(
            'title'         => 'Form Penagihan',
            'link'          => 'Penaghian',
            'order'         => $this->Order_Model->getbyId($order_id),
            'configurasi'   => $this->Konfigurasi_Model->listing(),
            'part'          => $this->Part_Model->getbyId($order_id),
            // 'po'            => $this->PurchaseOrder_Model->listing(),
            'bill'          => $this->Bill_Model->getbyId($order_id),
            'isi'           => 'admin/bill/penagihan'
        );

        $this->load->view('admin/layout/wrapper', $data);
    }

    public function simpanPenagihan()
    {
        $i = $this->input;
        $email = $i->post('email');
        $order_id = $i->post('order');
        $bill_id = $i->post('idorder');


        $idbengkel = $this->session->userdata('bengkel');
        $bengkel = $this->db->query("SELECT * FROM bengkel where bengkel_id = $idbengkel");
        $nBengkel = $bengkel->row_array();
        $namaBengkel = $nBengkel['bengkel_nama'];

        if (!empty($bill_id)) {

            $bill = array(
                'bill_id'       => $bill_id,
                'bill_jasa'     => $i->post('jasa'),
                'bill_total'    => $i->post('total'),
                'bill_tgl'      => date('Y-m-d'),
                'bill_bengkel'  => $idbengkel
            );

            $this->Bill_Model->edit($bill);
        } else {
            $bill = array(
                'bill_jasa'     => $i->post('jasa'),
                'bill_parts'    => $i->post('parts'),
                'bill_total'    => $i->post('total'),
                'bill_tgl'      => date('Y-m-d'),
                'bill_order_id' => $order_id,
                'bill_bengkel'  => $idbengkel
            );

            $this->Bill_Model->tambah($bill);
        }
        // $this->session->set_flashdata('sukses', 'Penagihan berhasil dibuat');
        $this->_sendMail($email, $order_id, $namaBengkel);
    }


    public function pembayaran($order_id)
    {
        $data = array(
            'title'         => 'Form Penagihan',
            'link'          => 'Penaghian',
            'configurasi'   => $this->Konfigurasi_Model->listing(),
            'order'         => $this->Order_Model->getbyId($order_id),
            'part'          => $this->Part_Model->getbyId($order_id),
            'kredit'        => $this->Kredit_Model->listing(),
            'bill'          => $this->Bill_Model->getbyId($order_id),
            'isi'           => 'admin/bill/pembayaran'
        );

        $this->load->view('admin/layout/wrapper', $data);
    }


    public function simpanPembayaran()
    {
        $valid = $this->form_validation;
        $valid->set_rules('bayar', 'Jumlah yang Dibayarkan', 'required');
        $valid->set_rules('metode', 'Metode Pembayaran', 'required');
        // $valid->set_rules('ket', 'Keterangan', 'required');

        if ($valid->run() === FALSE) {
            redirect(base_url('Admin/Bill'));
        } else {

            $i = $this->input;
            $idbill = $i->post('idorder');
            $bayar = $this->db->query("SELECT * FROM bill where bill_id = $idbill");
            $total = $bayar->row_array();
            $sisa = $total['bill_total'] - $i->post('bayar');
            $validbayar = $i->post('batas');
            
            if ($sisa <= 0) {
                $status = 2;
            } else if ($sisa > 0) {
                $status = 3;
            }
            
            if ($i->post('bayar') <= $validbayar) {
                $bill = array(
                    'bill_id'               => $idbill,
                    'bill_tglPembayaran'    => $i->post('tgl'),
                    'bill_jenisPembayaran'  => $i->post('metode'),
                    'bill_yangDibayar'      => $i->post('bayar'),
                    'bill_keterangan'       => $i->post('ket'),
                    'bill_status'           => $status
                );
                $this->Bill_Model->edit($bill);
        
                if ($i->post('bayar') > 0) {
                    date_default_timezone_set('Asia/Jakarta');
                    $kredit = array(
                        'kredit_bayar'      => $i->post('bayar'),
                        'kredit_tgl'        => date('Y-m-d H:i:s'),
                        'kredit_metode'     => $i->post('metode'),
                        'kredit_catatan'    => $i->post('ket'),
                        'kredit_bill_id'    => $idbill,
                    );
                    $this->Kredit_Model->tambah($kredit);
                }
        
                $this->session->set_flashdata('sukses', 'Pembayaran berhasil dilakukan');
                redirect('Admin/Bill');
            } else {
                $this->session->set_flashdata('sukses', 'Total pembayaran melebihi total penagihan');
                redirect('Admin/Bill');
            }
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
        $this->email->subject("Informasi Perbaikan Sepeda Selesai");

        // Isi email
        $data = array(
            'order'         => $this->Order_Model->getbyId($order_id),
            'part'          => $this->Part_Model->getbyId($order_id),
            // 'po'            => $this->PurchaseOrder_Model->listing(),
            'bill'          => $this->Bill_Model->getbyId($order_id)
        );


        $harga = $this->load->view('penagihan', $data, TRUE);

        $this->email->message($harga);

        // Tampilkan pesan sukses atau error
        if ($this->email->send()) {

            redirect('Admin/Bill');
            // echo 'Sukses! email berhasil dikirim.';
        } else {

            redirect('Admin/Dashboard');
            // echo 'Error! email tidak dapat dikirim.';
        }
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
            'isi'           => 'admin/bill/qc'
        );

        $this->load->view('admin/layout/wrapper', $data);
    }

    public function simpanQc()
    {
        $valid = $this->form_validation;
        $valid->set_rules('qc', 'Status Perbaikan Ulang', 'required');

        if ($valid->run() === FALSE) {
            redirect(base_url('Admin/Bill'));
        } else {

            $i = $this->input;
            $idbill = $i->post('idorder');
            $bill = array(
                'bill_id'           => $idbill,
                'bill_qc'           => $i->post('qc'),
                'bill_qcKet'        => $i->post('ket')
            );
            $this->Bill_Model->edit($bill);
            $this->session->set_flashdata('sukses', 'Permintaan perbaikan ulang berhasil di kirim');
            redirect('Admin/Bill');
        }
    }
    
    public function invoice($order_id, $kredit_id){
        $idbengkel = $this->session->userdata('bengkel');
       
    //   echo $kredit_id;
    //   exit;
        $bill = $this->db->query("select * from bill where bill_order_id = $order_id");
        $noBill = $bill->row_array();
        $id_bill = $noBill['bill_id'];
       
        $newInvoice = $this->db->query("select * from invoice where invoice_bengkel = $idbengkel order by invoice_id desc limit 1");
        $invoice = $newInvoice->row_array();
        $nomor = $invoice['invoice_nomor']+1;
                // exit;
        
        $kredit = $this->db->query("select * from invoice where invoice_kredit = $kredit_id");
        $noKredit = $kredit->num_rows();
        // echo $noKredit;
        // exit;
        
        // foreach ($noKredit as $data) {
            if($noKredit < 1){
                if (!empty($invoice['invoice_bengkel'])){
                $data = array (            
                    'invoice_nomor'     => $nomor,
                    'invoice_bill'      => $noBill['bill_id'],
                    'invoice_bengkel'   => $idbengkel,
                    'invoice_kredit'    => $kredit_id
                    );
                    
                    $this->db->insert('invoice', $data);
                } else {
                    $data = array (
                    'invoice_nomor'     => 1,
                    'invoice_bill'      => $noBill['bill_id'],
                    'invoice_bengkel'   => $idbengkel,
                    'invoice_kredit'    => $kredit_id
                    );
                    
                    $this->db->insert('invoice', $data);
                }
            }
        // }
        
        
    }

    public function cetak($order_id)
    
    {
        $kredit = $this->db->query("select * from kredit join bill on kredit.kredit_bill_id = bill.bill_id where bill_order_id = $order_id order by kredit_id desc limit 1");
        $noKredit = $kredit->row_array();
        $kredit_id = $noKredit['kredit_id'];
        // if ($noKredit['kredit'])
        $this->invoice($order_id, $kredit_id);
        
        $data = array(
            'title'         => 'Print Bill',
            'configurasi'   => $this->Konfigurasi_Model->listing(),
            'order'         => $this->Order_Model->getbyId($order_id),
            'part'          => $this->Part_Model->getbyId($order_id),
            'bill'          => $this->Bill_Model->getbyId($order_id),
            'kredit'        => $this->Kredit_Model->listing(),
            'kredit_id'     => $kredit_id,
            'isi'           => 'admin/bill/print'
        );

        $this->load->view('admin/layout/wrapper', $data);
    }

    public function printKt()
    {
        $order_id = $this->input->get('b');
        $kredit_id = $this->input->get('k');
        
        $this->invoice($order_id, $kredit_id);
        
        // $invoicie = $this->db->get('invoice', 'invoice_bengkel');
        
        $data = array(
            'title'         => 'Print Bill',
            'configurasi'   => $this->Konfigurasi_Model->listing(),
            'kredit'        => $this->Kredit_Model->cetak($kredit_id),
            'kredit_id'     => $kredit_id,
            'isi'           => 'admin/bill/kredit'
        );

        $this->load->view('admin/layout/wrapper', $data);
    }

    public function hapusKredit($kredit_id)
    {
        $query = $this->db->query("select * from kredit where kredit_id = $kredit_id");
        $kredit = $query->row_array();
        $order_id = $kredit['kredit_bill_id'];

        $this->db->query("DELETE FROM kredit WHERE kredit_id = $kredit_id");

        // redirect(base_url('Admin/Bill/pembayaran/') . $order_id);
        redirect(base_url('Admin/Bill'));
    }
}
