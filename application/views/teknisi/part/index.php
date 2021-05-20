<?php
if ($this->session->flashdata('sukses')) {
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">';
    echo $this->session->flashdata('sukses');
    echo ' <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>
    </button>', '</div>';
}
?>

<div class="row">
    <div class="col-md-3 col-sm-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Tambah Part Baru</h3>
            </div>
            <div class="card-body">
                <form action="<?= base_url('Teknisi/PartOrder/simpanPart') ?>" method="POST">
                    <input type="text" value="<?= $order['order_id'] ?>" name="idorder" hidden>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nama Part</label>
                        <input type="text" name="part" class="form-control" placeholder="Nama Part">
                        <?= form_error('part', '<small class="text-danger ">', '</small>') ?>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Stok</label>
                        <input type="text" name="stok" value="0" class="form-control" readonly>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Harga</label>
                        <input type="text" name="harga" value="0" class="form-control" readonly>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block">SIMPAN</button>
                        <a href="<?= base_url('Teknisi/Order/pengecekan/') . $order['order_id'] ?>" class="btn btn-warning btn-block">KEMBALI</a>
                        <!--<a href="<?= base_url('Teknisi/Order/pengecekan/') . $order['order_id'] ?>" class="btn btn-warning btn-block">KEMBALI PENGECEKAN</a>-->
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-9 col-sm-12">
        <div class="card elevation-5">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example1" class="table table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>ID Part</th>
                                <th>Nama Part</th>
                                <th>Harga</th>
                                <th>Stok</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 0;
                            foreach ($part as $data) { //$order di ambil dari controller Admin nama file order nama function index

                                $no++;
                            ?>
                                <tr>
                                    <td><?= $no ?></td>
                                    <td>PART-00<?= $data['partMaster_id'] ?></td>
                                    <td><?= $data['partMaster_nama'] ?></td>
                                    <td><?= $data['partMaster_harga'] ?></td>
                                    <td><?= $data['partMaster_stok'] ?></td>
                                </tr>
                            <?php

                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <!-- Batas akhir tabel order  -->
            </div>
        </div>
    </div>
</div>