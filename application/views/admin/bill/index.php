<?php
/**
 * halaman daftar bill
 */

if ($this->session->flashdata('sukses')) {
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">';
    echo $this->session->flashdata('sukses');
    echo ' <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>
    </button>', '</div>';
}
?>
<?php
// date_default_timezone_set('Asia/Jakarta');
// echo date('Y-m-d H:i:s')
?>
<div class="card elevation-5">
    <div class="card-body">
        <!-- Tabel daftar order  -->
        <div class="table-responsive">
            <table id="example1" class="table table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>ID Order</th>
                        <th>ID Pelanggan</th>
                        <th>Nama</th>
                        <th>Total Tagihan</th>
                        <th>Total Pembayaran</th>
                        <th>Keterangan</th>
                        <th>Status Pembayaran</th>
                        <th>Status Test Drive</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 0;
                    foreach ($order as $data) { //$order di ambil dari controller Admin nama file order nama function index
                        $idorder = $data['order_id'];
                        $query = $this->db->query("SELECT * FROM bill WHERE bill_order_id = $idorder");
                        $bill = $query->row_array();
                        if ($data['order_status'] == 9) {
                            $no++;
                    ?>
                            <tr>
                                <td><?= $no ?></td>
                                <td>PLGN-00<?= $data['pelanggan_id'] ?></td>
                                <td>ORDER-00<?= $data['order_id'] ?></td>
                                <td><?= $data['pelanggan_nama'] ?></td>
                                <td>Rp <?= number_format($bill['bill_total'], 0, "", ".") ?></td>
                                <td>Rp
                                    <?php
                                    $idbill = $bill['bill_id'];

                                    $total = 0;
                                    if (!empty($idbill)) {
                                        $kredit = $this->db->query("SELECT * FROM kredit WHERE kredit_bill_id = $idbill && kredit_metode != 'DP'");
                                        $hkredit = $kredit->result_array();
                                        foreach ($hkredit as $bayar) {
                                            $cicil = $bayar['kredit_bayar'];
                                            $total += $cicil;
                                        }

                                        if ($bill['bill_dp'] != "")
                                        {
                                            $dp = $bill['bill_dp'];
                                            if($total > 0) {
                                            echo number_format($dp + $total, 0, "", ".");
                                            } else {
                                            echo number_format($dp, 0, "", ".") ." (DP)";
                                            }
                                        } else {
                                            $dp = 0;
                                        echo number_format($total, 0, "", ".");
                                        }
                                    } else {
                                        $dp = 0;
                                        echo 0;
                                    }
                                    ?>
                                </td>
                                <td><?= $bill['bill_keterangan'] ?></td>
                                <td>
                                    <?php
                                    $sisa = $bill['bill_total'] - $total - $dp;
                                    if ($bill['bill_yangDibayar'] == 0) {
                                        echo "<span class='badge badge-danger'>Belum Bayar</span>";
                                    } else if ($sisa == 0) {
                                        echo "<span class='badge badge-primary'>Lunas</span>";
                                    } else if ($sisa > 0) {
                                        echo "<span class='badge badge-warning'>Sebagian Terbayar</span><br>";
                                        echo "<span class='badge badge-info'>Sisa Rp. " . number_format($sisa, 0, "", ".") . "</span>";
                                    }
                                    ?>
                                </td>
                                <td><?= $bill['bill_qc'] ?></td>
                                <td class="content-center">
                                    <a href="<?= base_url('Admin/Bill/penagihan/') . $data['order_id'] ?>" class="btn btn-warning btn-sm text-bold" <?php if ($bill['bill_total'] != "") {
                                                                                                                                                        echo "
                                                                                                                                                        hidden";
                                                                                                                                                    } ?>>
                                        <!-- <li class="fas fa fa-money-bill-alt"></li> -->PENAGIHAN
                                    </a>
                                    <a href="<?= base_url('Admin/Bill/qc/') . $data['order_id'] ?>" class="btn btn-warning btn-sm text-bold" <?php if ($bill['bill_tgl'] == "" or $bill['bill_order_id'] != $data['order_id'] or $bill['bill_qc'] == "Ok" or $bill['bill_qc'] == "Service Ulang") {
                                                                                                                                                    echo "hidden";
                                                                                                                                                } ?>>
                                        <!-- <li class="fas fa fa-file-invoice-dollar"></li> -->TEST DRIVE
                                    </a>
                                    <a href="<?= base_url('Admin/Bill/pembayaran/') . $data['order_id'] ?>" class="btn btn-info btn-sm text-bold" <?php if ($sisa == 0 or $bill['bill_order_id'] != $data['order_id']) {
                                                                                                                                                        echo "hidden";
                                                                                                                                                    } ?>>
                                        <!-- <li class="fas fa fa-file-invoice-dollar"></li> -->PEMBAYARAN
                                    </a>
                                    <a href="<?= base_url('Admin/Bill/cetak/') . $data['order_id'] ?>" target="_blank" class="btn btn-default" <?php if ($sisa > 0 or $bill['bill_total'] == "") {
                                                                                                                                                    echo "hidden";
                                                                                                                                                } ?>><i class="fas fa-print"></i> Print</a>
                                </td>
                            </tr>
                    <?php
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <!-- Batas akhir tabel order  -->
    </div>
</div>
