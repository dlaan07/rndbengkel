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
        <a href="#" data-toggle="modal" data-target="#tambah" class="btn btn-primary btn-sm elevation-5 mb-3">Tambah Bengkel</a>
        <!-- Tabel daftar pelanggan  -->
        <table id="example1" class="table table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Bengkel</th>
                    <th>Alamat</th>
                    <th>Telepon</th>
                    <th>Owner</th>
                    <th>Tanggal Bergabung</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 0;
                foreach ($bengkel as $data) { //$pelanggan di ambil dari controller Admin nama file pelanggan nama function index
                    $no++;
                ?>
                    <tr>
                        <td><?= $no ?></td>
                        <td><?= $data['bengkel_nama'] ?></td>
                        <td><?= $data['bengkel_alamat'] ?></td>
                        <td><?= $data['bengkel_tlp'] ?></td>
                        <td><?= $data['bengkel_owner'] ?></td>
                        <td><?= $data['bengkel_join'] ?></td>
                        <td>
                            <a href="<?= base_url('Master/Bengkel/detailbyId/') . $data['bengkel_id'] ?>" class="btn btn-info btn-sm">
                                <li class="fas fa fa-edit"></li>
                            </a>
                            <a href="#" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus<?= $data['bengkel_id'] ?>">
                                <li class="fas fa fa-trash"></li>
                            </a>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
        <!-- Batas akhir tabel pelanggan  -->
    </div>
</div>

<form action="<?= base_url('Master/Bengkel/tambah') ?>" method="POST">
    <!-- Modal tambah pelanggan  -->
    <div class="modal fade1 bs-example-modal-lg" id="tambah" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">Form Tambah Bengkel</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <!-- Kumpulan form -->
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nama Bengkel</label>
                        <input type="text" name="nama" class="form-control" placeholder="Masukan Nama Bengkel">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Alamat</label>
                        <input type="text" name="alamat" class="form-control" placeholder="Masukan Alamat Lengkap">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">No. Telepon</label>
                        <input type="text" name="hp" class="form-control" placeholder="Masukan Nomor Hp" maxlength="12" onkeypress="return Angkasaja(event)">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nama Owner</label>
                        <input type="text" name="owner" class="form-control" placeholder="Masukan Nama Owner">
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

<!-- POPUP hapus data  -->
<?php
foreach ($bengkel as $p) {
?>
    <form action="<?= base_url('Master/Bengkel/delete') ?>" method="POST">
        <div class="modal fade1 bs-example-modal-lg" id="hapus<?= $p['bengkel_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-md modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myLargeModalLabel">Hapus Bengkel</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                        <input type="text" name="id" value="<?= $p['bengkel_id'] ?>" hidden>
                        Anda yakin ingin menghapus data <?= $p['bengkel_nama'] ?>
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