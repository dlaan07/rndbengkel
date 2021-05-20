<?php
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
                        <h6>Data Estimasi</h6>
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td class="text-bold">Estimasi Harga Jasa</td>
                                    <td><?= number_format($order['order_estimasiJasaHarga'], 0, "", ".") ?></td>
                                </tr>
                                <tr>
                                    <td class="text-bold">Estimasi Harga Jasa</td>
                                    <td><?= number_format($order['order_estimasiPartsHarga'], 0, "", ".") ?></td>
                                </tr>
                                <tr>
                                    <td class="text-bold">Total Estimasi</td>
                                    <td><?= number_format($order['order_estimasiJasaHarga'] + $order['order_estimasiPartsHarga'], 0, "", ".") ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <a href="<?= base_url('Owner/Validasi') ?>" class="btn btn-warning">KEMBALI</a>
            </div>
        </div>
    </div>
</div>