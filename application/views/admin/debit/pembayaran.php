<?php
/**
 * halaman pembayaran / cicilan / pelunasan
 */

$idorder = $order['order_id'];
$queryPart = $this->db->query("SELECT * FROM parts WHERE part_order_id = $idorder");
$jmlPart = $queryPart->num_rows();
// echo $jmlPart;
?>
<!-- <?php foreach ($debit as $data): ?> -->
  <!-- <?php echo $data["debit_bayar"];?> -->
<!-- <?php endforeach; ?> -->
<?php echo $debit["debit_bayar"];?>
<!-- <?php print_r($order) ?> -->
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

                <div class="card">
                    <div class="card-body">
                        <h6>Data Pembayaran</h6>
                        <hr>
                        <form action="<?= base_url('Admin/Debit/simpanPembayaran') ?>" method="POST">
                            <input type="text" name="debitid" value="<?= $debit['debit_id'] ?>" hidden>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Total Debit</label>
                                <input type="text" class="form-control" value="<?= number_format($debit['debit_bayar'], 0, "", ".") ?>" readonly>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Tanggal Pembayaran</label>
                                <input type="date" class="form-control" name="tgl" value="<?= date('Y-m-d') ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Jumlah yang Dibayarkan</label>
                                <input type="text" class="form-control" name="bayar" placeholder="Jumlah yang dibayarkan" value="<?= number_format($debit['debit_bayar'], 0, "", ".") ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Metode Pembayaran</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="Credit Card" name="metode" <?php echo $debit['debit_metode'] == "Credit Card" ? "checked" : "" ?>>
                                    <label class="form-check-label">Credit Card</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="Transfer" name="metode" <?php echo $debit['debit_metode'] == "Transfer" ? "checked" : "" ?>>
                                    <label class="form-check-label">Transfer</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="Debit Card" name="metode" <?php echo $debit['debit_metode'] == "Debit Card" ? "checked" : "" ?>>
                                    <label class="form-check-label">Debit Card</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="Cash" name="metode" <?php echo $debit['debit_metode'] == "Cash" ? "checked" : "" ?>>
                                    <label class="form-check-label">Cash</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="Check" name="metode" <?php echo $debit['debit_metode'] == "Check" ? "checked" : "" ?>>
                                    <label class="form-check-label">Check</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Keterangan</label>
                                <input type="text" class="form-control" name="ket" placeholder="Keterangan" value="<?= $debit['debit_keterangan'] ?>">
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
