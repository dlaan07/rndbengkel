<?php
if ($this->session->flashdata('sukses')) {
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">';
    echo $this->session->flashdata('sukses');
    echo ' <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>
    </button>', '</div>';
}

//echo $this->session->userdata('bengkel');
?>

<div class="card elevation-5">
    <div class="card-body">
        <a href="#" data-toggle="modal" data-target="#tambah" class="btn btn-sm btn-primary mb-3 elevation-5">Tambah Jasa</a>

        <!-- Tabel daftar pelanggan  -->
        <table id="example1" class="table table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Harga</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 0;
                foreach ($jasa as $data) { //$pelanggan di ambil dari controller Admin nama file pelanggan nama function index
                    $no++;
                ?>
                    <tr>
                        <td><?= $no ?></td>
                        <td><?= $data['jasa_nama'] ?></td>
                        <td><?= number_format($data['jasa_harga'], 0, "", ".") ?></td>
                        <td>
                            <a href="#" class="btn btn-info btn-sm" data-toggle="modal" data-target="#edit<?= $data['jasa_id'] ?>">
                                <li class="fas fa fa-edit"></li>
                            </a>
                            <a href="#" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus<?= $data['jasa_id'] ?>">
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


<!-- Kirim data ke controler admin file pelanggan function tambah -->
<form action="<?= base_url('Owner/Jasa/tambah') ?>" method="POST">
    <!-- Modal tambah pelanggan  -->
    <div class="modal fade1 bs-example-modal-lg" id="tambah" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">Form Tambah Jasa</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <!-- Kumpulan form -->
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nama Jasa</label>
                        <input type="text" name="nama" class="form-control" placeholder="Masukan Nama Jasa">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Harga</label>
                        <input type="text" name="harga" class="form-control" placeholder="Harga Jasa" onkeypress="return Angkasaja(event)">
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
foreach ($jasa as $p) {
?>
    <form action="<?= base_url('Owner/Jasa/delete') ?>" method="POST">
        <div class="modal fade1 bs-example-modal-lg" id="hapus<?= $p['jasa_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-md modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myLargeModalLabel">Hapus Jasa</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                        <input type="text" name="id" value="<?= $p['jasa_id'] ?>" hidden>
                        Anda yakin ingin menghapus data <?= $p['jasa_nama'] ?>
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

<!-- POPUP edit data  -->
<?php
foreach ($jasa as $p) {
?>
    <form action="<?= base_url('Owner/Jasa/edit') ?>" method="POST">
        <div class="modal fade1 bs-example-modal-lg" id="edit<?= $p['jasa_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-md modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myLargeModalLabel">Edit Jasa</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                        <input type="text" name="id" value="<?= $p['jasa_id'] ?>" hidden>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nama Jasa</label>
                            <input type="text" name="nama" class="form-control" value="<?= $p['jasa_nama'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Harga</label>
                            <input type="number" name="harga" class="form-control" value="<?= $p['jasa_harga'] ?>"  onkeypress="return Angkasaja(event)">
                        </div>
                    </div>
                    <div class=" modal-footer">
                        <button type="submit" class="btn btn-primary">
                            UPDATE
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