<?php
/**
 * halaman pembayaran / cicilan / pelunasan
 */

$idorder = $order['order_id'];
$queryPart = $this->db->query("SELECT * FROM parts WHERE part_order_id = $idorder");
$jmlPart = $queryPart->num_rows();
// echo $jmlPart;
?>

<div class="row">
    <div class="col-md-5 col-sm-12">
        <div class="card card-primary elevation-5">
            <div class="card-header">
                <h3 class="card-title">Detail Pelanggan</h3>
            </div>
            <div class="card-body">
                <table class="table">
                    <tbody>
                        <tr>
                            <td class="text-bold">
                                ID Pelanggan
                            </td>
                            <td>
                                PLGN-00<?= $order['pelanggan_id'] ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-bold">
                                ID Order
                            </td>
                            <td>
                                ORDER-00<?= $order['order_id'] ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-bold">
                                Nama Pelanggan
                            </td>
                            <td>
                                <?= $order['pelanggan_nama'] ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-bold">
                                Alamat Pelanggan
                            </td>
                            <td>
                                <?= $order['pelanggan_alamat'] ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-bold">
                                Telp Pelanggan
                            </td>
                            <td>
                                <?= $order['pelanggan_hp'] ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-bold">
                                Email Pelanggan
                            </td>
                            <td>
                                <?= $order['pelanggan_email'] ?>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-7 col-sm-12">
        <div class="card card-info elevation-5">
            <div class="card-header">
                <h3 class="card-title">Detail Order</h3>
            </div>
            <div class="card-body">
                <div class="card">
                    <div class="card-body">
                        <h6>Data Sepedah</h6>
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td class="text-bold">Jenis Sepeda</td>
                                    <td><?= $order['order_jenisSepeda'] ?></td>
                                </tr>
                                <tr>
                                    <td class="text-bold">Warna Sepeda</td>
                                    <td><?= $order['order_warnaSepeda'] ?></td>
                                </tr>
                                <tr>
                                    <td class="text-bold">Layanan Perbaikan</td>
                                    <td><?= $order['order_jenisPerbaikan'] ?></td>
                                </tr>
                                <tr>
                                    <td class="text-bold">Keterangan</td>
                                    <td><?= $order['order_keterangan'] ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <?php
                if ($jmlPart > 0) {
                ?>
                    <div class="card">
                        <div class="card-body">
                            <h6>Data Parts</h6>
                            <hr>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Nama Part</th>
                                        <th>Qty</th>
                                        <th>Harga Satuan</th>
                                        <th>Jumlah</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $total = 0;
                                    foreach ($part as $p) {
                                        $idpart = $p['part_id'];
                                        $queryPo = $this->db->query("SELECT * FROM purchaseorder where po_part_id = $idpart");
                                        $data = $queryPo->row_array();

                                        if ($p['part_harga'] == 0) {
                                            $harga = $data['po_hargaReq'];
                                        } else {
                                            if ($p['part_harga'] > $data['po_hargaReq']) {
                                                $harga = $p['part_harga'];
                                            } else {
                                                $harga = $data['po_hargaReq'];
                                            }
                                        }
                                    ?>
                                        <tr>
                                            <td><?= $p['partMaster_nama'] ?></td>
                                            <td><?= $p['part_qtyDibutuhkan'] ?></td>
                                            <td><?= number_format($harga, 0, "", ".") ?></td>
                                            <td><?= number_format($sub = $harga * $p['part_qtyDibutuhkan'], 0, "", ".") ?></td>
                                        </tr>
                                    <?php
                                        $total += $sub;
                                    }
                                    // echo $jPart;
                                    ?>
                                    <tr>
                                        <td colspan="3" class="text-bold text-center"> Total </td>
                                        <td><?= number_format($total, 0, "", ".") ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                <?php
                }
                ?>
                <div class="card">
                    <div class="card-body">
                        <h6>Data Pembayaran</h6>
                        <hr>
                        <form action="<?= base_url('Admin/Bill/simpanPembayaran') ?>" method="POST">
                            <input type="text" name="idorder" value="<?= $bill['bill_id'] ?>" hidden>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Total Biaya</label>
                                <input type="text" class="form-control" value="<?= number_format($bill['bill_total'], 0, "", ".") ?>" readonly>
                            </div>
                            <?php if($bill['bill_dp'] != "") { ?>
                            <div class="form-group">
                                <label for="exampleInputEmail1">DP</label>
                                <input type="text" class="form-control" value="<?= number_format($bill['bill_dp'], 0, "", ".") ?>" readonly>
                            </div>
                            <?php } ?>
                            <?php
                            $id = $order['order_id'];
                            $query = $this->db->query("SELECT * FROM kredit join bill on kredit.kredit_bill_id = bill.bill_id where bill_order_id = $id and kredit_metode != 'DP'");
                            $kt = $query->num_rows();
                            $cicil = 0;
                            if ($kt > 0) {
                            ?>
                                <div class="form-group">
                                    <table class="table">
                                        <tr>
                                            <th>Jumlah Bayar</th>
                                            <th>Tanggal Bayar</th>
                                            <th></th>
                                        </tr>
                                        <?php
                                        foreach ($kredit as $deb) {
                                            if ($deb['kredit_bill_id'] == $bill['bill_id'] && $deb['kredit_metode'] != "DP") {
                                            $cicil += $deb['kredit_bayar'];
                                        ?>
                                            <tr>
                                                <td>Rp. <?= number_format($deb['kredit_bayar'], 0, "", ".") ?></td>
                                                <td><?= $deb['kredit_tgl'] ?></td>
                                                <td>
                                                    <a href="<?= base_url('Admin/Bill/printKt?k=') . $deb['kredit_id'].'&b='.$bill['bill_order_id'] ?>" target="_blank" class="btn btn-sm btn-primary">
                                                        <li class="fas fa-print"></li>
                                                    </a>
                                                    <!-- <a href="#" class="btn btn-sm btn-warning">
                                                        <li class="fas fa-edit"></li>
                                                    </a> -->
                                                    <a href="<?= base_url('Admin/Bill/hapusKredit/') . $deb['kredit_id'] ?>" class="btn btn-sm btn-danger">
                                                        <li class="fas fa-trash"></li>
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php
                                            }
                                        }
                                        ?>
                                        <tr>
                                            <td colspan="3" class="text-bold text-center">Total Bayar Rp. <?= number_format($cicil + $bill['bill_dp'], 0, "", ".") ?></td>
                                        </tr>
                                    </table>
                                    <hr>
                                </div>
                            <?php
                            }
                            ?>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tanggal Pembayaran</label>
                                <input type="date" class="form-control" name="tgl" value="<?= date('Y-m-d') ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Jumlah yang Dibayarkan <small class="text-info"> (Kurang <?= number_format($bill['bill_total'] - $cicil - $bill['bill_dp'], 0, "", ".") ?>) </small> </label>
                                <input type="text" class="form-control" name="bayar" placeholder="Jumlah yang dibayarkan" value="<?= $bill['bill_yangDibayar'] ?>" maxlength="12" onkeypress="return Angkasaja(event)">
                            </div>
                            <input type="text" value="<?= $bill['bill_total'] - $cicil - $bill['bill_dp'] ?>" name="batas" hidden>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Metode Pembayaran</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="Credit Card" name="metode" <?php if ($bill['bill_jenisPembayaran'] == "Credit Card") {
                                                                                                                        echo "checked";
                                                                                                                    }  ?>>
                                    <label class="form-check-label">Credit Card</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="Transfer" name="metode" <?php if ($bill['bill_jenisPembayaran'] == "Transfer") {
                                                                                                                    echo "checked";
                                                                                                                }  ?>>
                                    <label class="form-check-label">Transfer</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="Debit Card" name="metode" <?php if ($bill['bill_jenisPembayaran'] == "Debit Card") {
                                                                                                                        echo "checked";
                                                                                                                    }  ?>>
                                    <label class="form-check-label">Debit Card</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="Cash" name="metode" <?php if ($bill['bill_jenisPembayaran'] == "Cash") {
                                                                                                                echo "checked";
                                                                                                            }  ?>>
                                    <label class="form-check-label">Cash</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="Check" name="metode" <?php if ($bill['bill_jenisPembayaran'] == "Check") {
                                                                                                                    echo "checked";
                                                                                                                }  ?>>
                                    <label class="form-check-label">Check</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Keterangan</label>
                                <input type="text" class="form-control" name="ket" placeholder="Keterangan" value="<?= $bill['bill_keterangan'] ?>">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">SIMPAN</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
