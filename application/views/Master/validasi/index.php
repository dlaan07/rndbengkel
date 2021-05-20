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
                    foreach ($order as $data) { //$order di ambil dari controller Master nama file order nama function index
                        if ($data['order_status'] == 2 or $data['order_status'] == 4 or $data['order_status'] == 5 or $data['order_status'] == 6) {
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
                                    if ($data['order_status'] == 1) {
                                        echo "Dalam Pengecekan";
                                    } else if ($data['order_status'] == 2) {
                                        echo "Selesai Pengecekan";
                                    } else if ($data['order_status'] == 3) {
                                        echo "Menunggu RFP";
                                    } else if ($data['order_status'] == 4) {
                                        echo "Selesai Pengecekan RFP";
                                    } else if ($data['order_status'] == 5) {
                                        echo "Pelanggan Setuju";
                                    } else if ($data['order_status'] == 6) {
                                        echo "Pelanggan Tidak Setuju";
                                    } else if ($data['order_status'] == 7) {
                                        echo "Menunggu Barang";
                                    }
                                    ?>
                                </td>
                                <td class="content-center">
                                    <a href="<?= base_url('Master/Validasi/getbyOrder/') . $data['order_id'] ?>" class="btn btn-info btn-sm btn-block">
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