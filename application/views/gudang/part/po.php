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
                        <th>ID Part</th>
                        <th>Nama Part</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th>Par</th>
                        <th>Profit</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 0;
                    foreach ($part as $data) {
                        if ($data['partMaster_stok'] <= $data['partMaster_par']) {
                        $no++;
                    ?>
                        <tr>
                            <td><?= $no ?></td>
                            <td>PART-00<?= $data['partMaster_id'] ?></td>
                            <td><?= $data['partMaster_nama'] ?></td>
                            <td>Rp <?= number_format($data['partMaster_harga'], 0, "", ".") ?></td>
                            <td><?php if($data['partMaster_stok'] <= 0) { echo '<span class="badge badge-danger">Out Of Stok</span>';} else { echo $data['partMaster_stok']; } ?></td>
                            <td><?= $data['partMaster_par'] ?></td>
                            <td><?= $data['partMaster_profit'] ?></td>
                            <td>
                                <a href="<?= base_url('Gudang/Parts/getbyId/') . $data['partMaster_id'] ?>" class="btn btn-info btn-sm">
                                    <li class="fas fa fa-edit"></li>
                                </a>
                                <a href="#" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus<?= $data['partMaster_id'] ?>">
                                    <li class="fas fa fa-trash"></li>
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


<!-- POPUP hapus data  -->
<?php
foreach ($part as $p) {
?>
    <form action="<?= base_url('Gudang/Parts/delete') ?>" method="POST">
        <div class="modal fade1 bs-example-modal-lg" id="hapus<?= $p['partMaster_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-md modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myLargeModalLabel">Hapus Part</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                        <input type="text" name="id" value="<?= $p['partMaster_id'] ?>" hidden>
                        Anda yakin ingin menghapus data <?= $p['partMaster_nama'] ?>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">
                            HAPUS
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