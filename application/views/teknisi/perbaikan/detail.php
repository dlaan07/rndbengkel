<?php
if ($this->session->flashdata('gagal')) {
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">';
    echo $this->session->flashdata('gagal');
    echo ' <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>
    </button>', '</div>';
}
?>
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Detail Pengecekan</h3>
    </div>
    <div class="card-body">
        <form action="<?= base_url('Teknisi/Perbaikan/edit') ?>" method="POST">
            <input type="text" name="idorder" value="<?= $order['order_id'] ?>" hidden>
            <div class="form-group">
                <label for="exampleInputEmail1">Nama Pelanggan</label>
                <input type="text" class="form-control" name="pelanggan" value="<?= $order['pelanggan_nama'] ?>" readonly>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Alamat Pelanggan</label>
                <input type="text" class="form-control" value="<?= $order['pelanggan_alamat'] ?>" readonly>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Kontak Pelanggan</label>
                <input type="text" class="form-control" value="<?= $order['pelanggan_hp'] ?>" readonly>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Email Pelanggan</label>
                <input type="text" class="form-control" value="<?= $order['pelanggan_email'] ?>" readonly>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Jenis Sepeda</label>
                <input type="text" class="form-control" value="<?= $order['order_jenisSepeda'] ?>" readonly>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Warna Sepeda</label>
                <input type="text" class="form-control" value="<?= $order['order_warnaSepeda'] ?>" readonly>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Jenis Perbaikan</label>
                <input type="text" class="form-control" value="<?= $order['order_jenisPerbaikan'] ?>" readonly>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Keterangan</label>
                <textarea name="keterangan" class="form-control" cols="10" rows="5" readonly><?= $order['order_keterangan'] ?></textarea>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Estimasi Jasa Harga</label>
                <input type="text" class="form-control" value="Rp <?= number_format($order['order_estimasiJasaHarga'], 0, "", ".") ?>" readonly>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Status Perbaikan</label>
                <input type="text" class="form-control" value="<?php if ($order['order_status'] == 8) {
                                                                    echo "Dalam Pengerjaan";
                                                                } else if ($order['order_status'] == 9) {
                                                                    echo "Perbaikan Selesai";
                                                                }  ?>" readonly>
            </div>
            <div class="form-group" <?php if ($order['order_status'] == 9) {
                                        echo "hidden";
                                    } ?>> <label for="exampleInputEmail1">Update Status Pekerjaan</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="cek" value="9">
                    <label class="form-check-label text-bold">Perbaikan Selesai</label>
                </div>
            </div>
            <div class="form-group" <?php if ($order['order_status'] == 9) {
                                        echo "hidden";
                                    } ?>>
                <label for="exampleInputEmail1">Total Jasa Harga</label>
                <input type="text" class="form-control" name="total" cols="10" rows="5">
            </div>
    </div>

    <div class="card-footer">
        <button type="submit" class="btn btn-primary" <?php if ($order['order_status'] == 9) {
                                                            echo "hidden";
                                                        } ?>>SIMPAN</button>
        <button type="button" class="btn btn-warning" onclick="history.back();">KEMBALI</button>
    </div>
    </form>
</div>