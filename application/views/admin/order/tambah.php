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
        <h3 class="card-title">Form Tambah Order</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form action="<?= base_url('Admin/Order/tambah') ?>" method="POST">
        <!-- <form role="form" method="get"> -->
        <div class="card-body">
            <div class="form-group">
                <label>Nama Pelanggan</label>
                <div class="row">
                    <div class="col-md-8">
                        <select name="pelanggan" class="form_control select2 mb-3" style="width: 100%;">
                            <!-- <option selected="selected">--Pilih Nama Pelanggan--</option> -->
                            <option>--Pilih Nama Pelanggan--</option>
                            <?php foreach ($pelanggan as $plgn) {
                            ?>
                                <option value="<?= $plgn['pelanggan_id'] ?>" <?php if (set_value('pelanggan') == $plgn['pelanggan_id']) {
                                                                                    echo "selected";
                                                                                } ?>><?= $plgn['pelanggan_id'] ?> || <?= $plgn['pelanggan_nama'] ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div><div class="col-md-1">&nbsp</div>
                    <div class="col-md-3">
                        <a href="#" data-toggle="modal" data-target="#tambah" class="btn btn-primary btn-block">Tambah Pelanggan</a>
                    </div>
                </div>
                <?= form_error('pelanggan', '<small class="text-danger ">', '</small>') ?>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Jenis Sepeda</label>
                <input type="text" name="jenis_sepeda" value="<?= set_value('jenis_sepeda') ?>" class="form-control" placeholder="Masukan Jenis Sepeda">
                <?= form_error('jenis_sepeda', '<small class="text-danger ">', '</small>') ?>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Warna Sepeda</label>
                <input type="text" name="warna_sepeda" value="<?= set_value('warna_sepeda') ?>" class="form-control" placeholder="Masukan Warna Sepeda">
                <?= form_error('warna_sepeda', '<small class="text-danger ">', '</small>') ?>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Jenis Perbaikan</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" value="Umum" name="jenis_perbaikan" checked>
                    <label class="form-check-label">Umum</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" value="Spesifik" name="jenis_perbaikan">
                    <label class="form-check-label">Spesifik</label>
                </div>
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
</div>

<!-- Kirim data ke controler admin file pelanggan function tambah -->
<form action="<?= base_url('Admin/Pelanggan/tambah') ?>" method="POST">
    <!-- Modal tambah pelanggan  -->
    <div class="modal fade1 bs-example-modal-lg" id="tambah" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">Form Tambah Pelanggan</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <!-- Kumpulan form -->
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nama Lengkap</label>
                        <input type="text" name="nama" class="form-control" placeholder="Masukan Nama Lengkap">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Alamat</label>
                        <input type="text" name="alamat" class="form-control" placeholder="Masukan Alamat Lengkap">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Hp</label>
                        <input type="number" name="hp" class="form-control" placeholder="Masukan Nomor Hp">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email</label>
                        <input type="email" name="email" class="form-control" placeholder="Masukan Email Yang Aktif">
                    </div>
                    <!-- Batas akhir Kumpulan Form  -->
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">
                        SIMPAN
                    </button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Batas Akhir modal tambah pelanggan  -->
</form>
