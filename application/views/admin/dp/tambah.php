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
        <h3 class="card-title">Form DP</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form action="<?= base_url('Admin/Dp/simpanTambah') ?>" method="POST">
        <!-- <form role="form" method="get"> -->
        <div class="card-body">
            <div class="form-group">
                <label>Nama Pelanggan</label>
                <select name="pelanggan" class="form_control select2 mb-3" style="width: 100%;">
                    <!-- <option selected="selected">--Pilih Nama Pelanggan--</option> -->
                    <option>--Pilih Nama Pelanggan--</option>
                    <?php foreach ($order as $plgn) {
                        if ($plgn['order_status'] == 5) {
                    ?>
                            <option value="<?= $plgn['order_id'] ?>">ORDER-00<?= $plgn['order_id'] ?> || <?= $plgn['pelanggan_nama'] ?></option>
                    <?php
                        }
                    }
                    ?>
                </select>
                <?= form_error('pelanggan', '<small class="text-danger ">', '</small>') ?>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">DP yang Dibayarkan</label>
                <input type="number" name="dp" class="form-control" placeholder="Masukan Jumlah DP" maxlength="12" onkeypress="return Angkasaja(event)">
                <?= form_error('dp', '<small class="text-danger ">', '</small>') ?>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Keterangan</label>
                <textarea name="keterangan" class="form-control" cols="10" rows="5"></textarea>
            </div>
        </div>
        <!-- /.card-body -->

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">SIMPAN</button>
        </div>
    </form>
</div