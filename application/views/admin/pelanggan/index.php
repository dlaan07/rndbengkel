<?php
if ($this->session->flashdata('sukses')) {
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">';
    echo $this->session->flashdata('sukses');
    echo ' <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>
    </button>', '</div>';
}

if ($this->session->flashdata('gagal')) {
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">';
    echo $this->session->flashdata('gagal');
    echo ' <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>
    </button>', '</div>';
}
?>

<div class="card elevation-5">
    <div class="card-body">
        <!-- Button Tambah Pelanggan  -->
        <a href="#" data-toggle="modal" data-target="#tambah" class="btn btn-sm btn-primary mb-3">Tambah Pelanggan</a>
        <!-- Tabel daftar pelanggan  -->
        <table id="example1" class="table table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>ID Pelanggan</th>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>Email</th>
                    <th>HP</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 0;
                foreach ($pelanggan as $data) { //$pelanggan di ambil dari controller Admin nama file pelanggan nama function index
                    $no++;
                ?>
                    <tr>
                        <td><?= $no ?></td>
                        <td>PLGN-00<?= $data['pelanggan_id'] ?></td>
                        <td><?= $data['pelanggan_nama'] ?></td>
                        <td><?= $data['pelanggan_alamat'] ?></td>
                        <td><?= $data['pelanggan_email'] ?></td>
                        <td><?= $data['pelanggan_hp'] ?></td>
                        <td class="content-center">
                            <a href="<?= base_url('Admin/Pelanggan/detailbyId/') . $data['pelanggan_id'] ?>" class="btn btn-info btn-sm">
                                <li class="fas fa fa-edit"></li>
                            </a>
                            <a href="#" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus<?= $data['pelanggan_id'] ?>">
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
<form action="<?= base_url('Admin/Pelanggan/tambah') ?>" method="POST">
    <!-- Modal tambah pelanggan  -->
    <div class="modal fade1 bs-example-modal-lg" id="tambah" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">Form Tambah Pelanggan</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <!-- Kumpulan form -->
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nama Lengkap</label>
                        <input type="text" name="nama" class="form-control" placeholder="Masukan Nama Lengkap">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Alamat</label>
                        <input type="text" name="alamat" class="form-control" placeholder="Masukan Alamat Lengkap">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Hp</label>
                        <input type="text" name="hp" class="form-control" placeholder="Masukan Nomor Hp" maxlength="12" onkeypress="return Angkasaja(event)">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email</label>
                        <input type="email" name="email" class="form-control" placeholder="Masukan Email Yang Aktif">
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
foreach ($pelanggan as $p) {
?>
    <form action="<?= base_url('Admin/Pelanggan/delete') ?>" method="POST">
        <div class="modal fade1 bs-example-modal-lg" id="hapus<?= $p['pelanggan_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-md modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myLargeModalLabel">Hapus Pelanggan</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                        <input type="text" name="id" value="<?= $p['pelanggan_id'] ?>" hidden>
                        Anda yakin ingin menghapus data <?= $p['pelanggan_nama'] ?>
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
