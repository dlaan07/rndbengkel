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
        <div class="table-responsive">
            <table id="example1" class="table table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>ID Order</th>
                        <th>Nama Pelanggan</th>
                        <th>Jenis Sepeda</th>
                        <th>Warna Sepeda</th>
                        <th>Jenis Perbaikan</th>
                        <th>Keterangan</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 0;
                    foreach ($order as $data) { //$order di ambil dari controller Admin nama file order nama function index
                        if ($data['order_status'] >= 8) {
                            $no++;
                    ?>
                            <tr>
                                <td><?= $no ?></td>
                                <td>ORDER-00<?= $data['order_id'] ?></td>
                                <td><?= $data['pelanggan_nama'] ?></td>
                                <td><?= $data['order_jenisSepeda'] ?></td>
                                <td><?= $data['order_warnaSepeda'] ?></td>
                                <td><?= $data['order_jenisPerbaikan'] ?></td>
                                <td><?= $data['order_keterangan'] ?></td>
                                <td>
                                    <?php
                                    if ($data['order_status'] == 8) {
                                        echo "Dalam Pengerjaan";
                                    } else if ($data['order_status'] == 9) {
                                        echo "Perbaikan Selesai";
                                    }
                                    ?>
                                </td>
                                <td class="content-center">
                                    <a href="<?= base_url('Owner/Perbaikan/detail/') . $data['order_id'] ?>" class="btn btn-info btn-sm">
                                        <li class="fas fa fa-eye"></li>
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