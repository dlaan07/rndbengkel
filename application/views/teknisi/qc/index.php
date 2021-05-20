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
                        <th>Keterangan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 0;
                    foreach ($order as $data) { //$order di ambil dari controller Admin nama file order nama function index
                    $idorder = $data['order_id'];
                    $query = $this->db->query("SELECT * FROM bill WHERE bill_order_id = $idorder");
                    $bill = $query->row_array();
                        if ($data['order_status'] == 9 && $bill['bill_qc'] == "Service Ulang") {
                            $no++;
                    ?>
                            <tr>
                                <td><?= $no ?></td>
                                <td>PLGN-00<?= $data['pelanggan_id'] ?></td>
                                <td>ORDER-00<?= $data['order_id'] ?></td>
                                <td><?= $data['pelanggan_nama'] ?></td>
                                <td><?= $bill['bill_qc'] ?></td>
                                <td><?= $bill['bill_qcKet'] ?></td>
                                <td class="content-center">
                                    <a href="<?= base_url('Teknisi/PerbaikanUlang/qc/') . $data['order_id'] ?>" class="btn btn-warning btn-sm text-bold">
                                        <!-- <li class="fas fa fa-file-invoice-dollar"></li> -->PERBAIKAN ULANG
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