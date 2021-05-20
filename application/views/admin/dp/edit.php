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
        <h3 class="card-title">Form Edit DP</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form action="<?= base_url('Admin/Dp/simpanEdit') ?>" method="POST">
        <!-- <form role="form" method="get"> -->
        <div class="card-body">
            <div class="form-group" hidden>
                <label for="exampleInputEmail1">ID Bill</label>
                <input type="text" name="idbill" class="form-control" value="<?= $order['bill_id'] ?>">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">ID Pelanggan</label>
                <input type="text" class="form-control" value="PLGN-<?= $order['pelanggan_id'] ?>">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">ID Order</label>
                <input type="text" class="form-control" value="ORDER-<?= $order['order_id'] ?>"">
            </div>
            <div class=" form-group">
                <label for="exampleInputEmail1">Nama Pelanggan</label>
                <input type="text" class="form-control" value="<?= $order['pelanggan_nama'] ?>">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">DP yang Dibayarkan</label>
                <input type="text" name="dp" class="form-control" value="<?= $order['bill_dp'] ?>" maxlength="12" onkeypress="return Angkasaja(event)">
                <?= form_error('dp', '<small class="text-danger ">', '</small>') ?>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Keterangan</label>
                <textarea name="keterangan" class="form-control" cols="10" rows="5"><?= $order['bill_dpKet'] ?></textarea>
            </div>
        </div>
        <!-- /.card-body -->

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">SIMPAN</button>
        </div>
    </form>
</div