<?php
if ($this->session->flashdata('gagal')) {
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">';
    echo $this->session->flashdata('gagal');
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
                        <th>ID Pelanggan</th>
                        <th>ID Order</th>
                        <th>Nama Pelanggan</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 0;
                    foreach ($order as $data) {
                        if ($data['order_status'] < 8 && $data['order_status'] != 2 && $data['order_status'] != 5) {
                            $no++;
                    ?>
                            <tr>
                                <td><?= $no ?></td>
                                <td>PLG-00<?= $data['pelanggan_id'] ?></td>
                                <td>ORDER-00<?= $data['order_id'] ?></td>
                                <td><?= $data['pelanggan_nama'] ?></td>
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
                                <td>
                                    <a href="#" class="btn btn-info btn-sm btn-block  <?php if ($data['order_status'] == 4 or $data['order_status'] == 7) {
                                                                                            echo "disabled";
                                                                                        } ?>" data-toggle="modal" data-target="#rfp<?= $data['order_id'] ?>">
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

<?php
foreach ($order as $p) {
?>
    <form action="<?= base_url('Gudang/Rfp/detailRfp') ?>" method="POST">
        <div class="modal fade1 bs-example-modal-lg" id="rfp<?= $p['order_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-md modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myLargeModalLabel">Lakukan RFP</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                        <input type="text" name="id" value="<?= $p['order_id'] ?>" hidden>
                        <p>Jika anda klik Ya, maka status order <b><?= $p['pelanggan_nama'] ?></b> akan berubah menjadi Menunggu RFP.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">
                            YA
                        </button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
<?php
}
?>