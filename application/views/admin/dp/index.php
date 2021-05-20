<?php
if ($this->session->flashdata('sukses')) {
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">';
    echo $this->session->flashdata('sukses');
    echo ' <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>
    </button>', '</div>';
}
?>

<div class="card elevation-5">
    <div class="card-body">
        <!-- Tabel daftar order  -->
        <a href="<?= base_url('Admin/Dp/tambah') ?>" class="btn btn-sm btn-primary mb-3 elevation-5">Tambah DP</a>
        <div class="table-responsive">
            <table id="example1" class="table table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>ID Pelanggan</th>
                        <th>ID Order</th>
                        <th>Nama</th>
                        <th>Estimasi Biaya Jasa</th>
                        <th>Estimasi Biaya Parts</th>
                        <th>Total Estimasi</th>
                        <th>Total DP</th>
                        <th>Keterangan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 0;
                    foreach ($order as $data) { //$order di ambil dari controller Admin nama file order nama function index
                        if ($data['order_status'] >= 5 && $data['bill_dp'] != "") {
                            $no++;
                    ?>
                            <tr>
                                <td><?= $no ?></td>
                                <td>PLGN-00<?= $data['pelanggan_id'] ?></td>
                                <td>ORDER-00<?= $data['order_id'] ?></td>
                                <td><?= $data['pelanggan_nama'] ?></td>
                                <td>Rp <?= number_format($data['order_estimasiJasaHarga'], 0, "", ".") ?></td>
                                <td>Rp <?= number_format($data['order_estimasiPartsHarga'], 0, "", ".") ?></td>
                                <td>Rp <?= number_format($data['order_estimasiJasaHarga'] + $data['order_estimasiPartsHarga'], 0, "", ".") ?></td>
                                <td>Rp <?= number_format($data['bill_dp'], 0, "", ".") ?></td>
                                <td><?= $data['bill_dpKet'] ?></td>
                                <td class="content-center">
                                    <a href="<?= base_url('Admin/Dp/edit/') . $data['bill_id'] ?>" class="btn btn-warning btn-sm text-bold">
                                        <li class="fas fa fa-edit"></li>
                                    </a>
                                    <a href="<?= base_url('Admin/Dp/cetak/') . $data['bill_id'] ?>" class="btn btn-default btn-sm text-bold">
                                        <li class="fas fa fa-print"></li>
                                    </a>
                                </td>
                            </tr>
                    <?php
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <!-- Batas akhir tabel order  -->
    </div>
</div>