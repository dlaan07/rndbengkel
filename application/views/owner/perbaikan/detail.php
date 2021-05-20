<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Detail Pengecekan</h3>
    </div>
    <div class="card-body">
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
            <label for="exampleInputEmail1">Status Perbaikan</label>
            <input type="text" class="form-control" value="<?php if ($order['order_status'] == 8) {
                                                                echo "Dalam Pengerjaan";
                                                            } else if ($order['order_status'] == 9) {
                                                                echo "Perbaikan Selesai";
                                                            }  ?>" readonly>
        </div>
    </div>

    <div class="card-footer">
        <button type="button" class="btn btn-warning" onclick="history.back();">KEMBALI</button>
    </div>
</div>