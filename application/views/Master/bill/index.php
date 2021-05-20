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
                        <th>ID Pelanggan</th>
                        <th>Nama</th>
                        <th>Status</th>
                        <th>Yang Harus Dibayar</th>
                        <th>Yang Sudah Dibayar</th>
                        <th>Detail</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 0;
                    foreach ($order as $data) { //$order di ambil dari controller Master nama file order nama function index
                        if ($data['order_status'] == 9) {
                            $no++;
                    ?>
                            <tr>
                                <td><?= $no ?></td>
                                <td>PLGN-00<?= $data['pelanggan_id'] ?></td>
                                <td>ORDER-00<?= $data['order_id'] ?></td>
                                <td><?= $data['pelanggan_nama'] ?></td>
                                <td>
                                    <?php
                                    $idorder = $data['order_id'];
                                    $query = $this->db->query("SELECT * FROM bill WHERE bill_order_id = $idorder");
                                    $bill = $query->row_array();
                                    if ($bill['bill_status'] == 1) {
                                        echo "Belum Bayar";
                                    } else if ($bill['bill_status'] == 2) {
                                        echo "Terbayar";
                                    } else if ($bill['bill_status'] == 3) {
                                        echo "Sebagian Terbayar";
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?= number_format($bill['bill_total'], 0, "", ".") ?>
                                </td>
                                <td>
                                    <?= number_format($bill['bill_yangDibayar'], 0, "", ".") ?>
                                </td>
                                <td>
                                    <a href="<?= base_url('Master/Bill/penagihan/') . $data['order_id'] ?>" class="btn btn-warning btn-sm text-bold">
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