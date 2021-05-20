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
        <h3 class="card-title">Form Edit Order <?= $order['pelanggan_nama'] ?></h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form action="<?= base_url('Admin/Order/edit') ?>" method="POST">
        <!-- <form role="form" method="get"> -->
        <div class="card-body">
            <div class="form-group" hidden>
                <label for="exampleInputEmail1">Nama Pelanggan</label>
                <input type="text" name="id" value="<?= $order['order_id'] ?>" class="form-control">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Nama Pelanggan</label>
                <input type="text" value="<?= $order['pelanggan_nama'] ?>" class="form-control" placeholder="Masukan Jenis Sepeda" readonly>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Jenis Sepeda</label>
                <input type="text" name="jenis_sepeda" value="<?= $order['order_jenisSepeda'] ?>" class="form-control" placeholder="Masukan Jenis Sepeda">
                <?= form_error('jenis_sepeda', '<small class="text-danger ">', '</small>') ?>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Warna Sepeda</label>
                <input type="text" name="warna_sepeda" value="<?= $order['order_warnaSepeda'] ?>" class="form-control" placeholder="Masukan Warna Sepeda">
                <?= form_error('warna_sepeda', '<small class="text-danger ">', '</small>') ?>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Jenis Perbaikan</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" value="Umum" name="jenis_perbaikan" <?php if ($order['order_jenisPerbaikan'] == "Umum") {
                                                                                                            echo "checked";
                                                                                                        } ?>>
                    <label class="form-check-label">Umum</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" value="Spesifik" name="jenis_perbaikan" <?php if ($order['order_jenisPerbaikan'] == "Spesifik") {
                                                                                                                echo "checked";
                                                                                                            } ?>>
                    <label class="form-check-label">Spesifik</label>
                </div>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Keterangan</label>
                <textarea name="keterangan" class="form-control" cols="10" rows="5"><?= $order['order_keterangan'] ?></textarea>
            </div>
        </div>
        <!-- /.card-body -->

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">UPDATE</button>
        </div>
    </form>
</div>