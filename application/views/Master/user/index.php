<?php

$id = $this->session->userdata('id');
$nama = $this->session->userdata('nama');
$email = $this->session->userdata('email');
$username = $this->session->userdata('username');

if ($this->session->flashdata('sukses')) {
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">';
    echo $this->session->flashdata('sukses');
    echo ' <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>
    </button>', '</div>';
}

?>

<div class="card card-default">
    <div class="card-body elevation-5">
        <div class="card-box mb-30">
            <div class="pd-20 pb-3">
                <h4 class="text-blue h4">Daftar User</h4>
                <hr>
                <a href="#" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#tambah">Tambah User</a>
            </div>
            <div class="pb-20">
                <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama User</th>
                                <th>Email</th>
                                <th>Telepon/Hp</th>
                                <th>Role</th>
                                <th>Nama Bengkel</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($admin as $b) {
                                if ($b['user_id'] !== $id && $b['user_role'] == 1) {
                                    $nmr = $no++;
                            ?>
                                    <tr>
                                        <td><?= $nmr ?></td>
                                        <td><?= $b['user_nama'] ?></td>
                                        <td><?= $b['user_email'] ?></td>
                                        <td><?= $b['user_telp'] ?></td>
                                        <td><?= $b['role_nama'] ?></td>
                                        <td><?= $b['bengkel_nama'] ?></td>
                                        <td>
                                            <a href="#" class="btn btn-info btn-sm" data-toggle="modal" data-target="#edit<?= $b['user_id'] ?>">
                                                Edit
                                            </a>
                                            <a href="#" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus<?= $b['user_id'] ?>">
                                                Hapus
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
            </div>
        </div>
    </div>
</div>

<!-- Tambah Admin -->
<form action="<?= base_url('Master/User/tambah_owner') ?>" method="POST">
    <div class="modal fade1 bs-example-modal-lg" id="tambah" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">Tambah user</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>

                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 mb-30">
                            <div class="form-group row">
                                <label class="col-sm-12 col-md-4 col-form-label">Nama</label>
                                <div class="col-sm-12 col-md-8">
                                    <input class="form-control" name="nama" type="text" placeholder="Nama Lengkap">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-12 col-md-4 col-form-label">Email</label>
                                <div class="col-sm-12 col-md-8">
                                    <input class="form-control" name="email" type="email" placeholder="Email User">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-12 col-md-4 col-form-label">Telepon/Hp</label>
                                <div class="col-sm-12 col-md-8">
                                    <input class="form-control" name="tlp" type="text" placeholder="No. Telepon/Hp" maxlength="12" onkeypress="return Angkasaja(event)">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-12 col-md-4 col-form-label">Password</label>
                                <div class="col-sm-12 col-md-8">
                                    <input class="form-control" name="password" type="password" placeholder="Password">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-12 col-md-4 col-form-label">Nama Bengkel</label>
                                <div class="col-sm-12 col-md-8">
                                    <select class="form-control" name="bengkel" style="width: 100%;">
                                        <option value="">Choose...</option>
                                        <?php
                                        foreach ($bengkel as $r) { ?>
                                            <option value="<?= $r['bengkel_id'] ?>">
                                                <?= $r['bengkel_nama'] ?>
                                            </option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">
                        Simpan
                    </button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</form>


<!-- Modal Edit admin -->
<?php
foreach ($admin as $b) { ?>
    <form action="<?= base_url('Master/User/edit_admin') ?>" method="POST">
        <div class="modal fade1 bs-example-modal-lg" id="edit<?= $b['user_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-md modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myLargeModalLabel">Edit user <?= $b['user_nama'] ?></h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>

                    <div class="modal-body">
                        <input type="text" name="id" value="<?= $b['user_id'] ?>" hidden>
                        <div class="row">
                            <div class="col-md-12 mb-30">
                                <div class="form-group row">
                                    <label class="col-sm-12 col-md-4 col-form-label">Nama</label>
                                    <div class="col-sm-12 col-md-8">
                                        <input class="form-control" name="nama" type="text" value="<?= $b['user_nama'];
                                                                                                    ?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-12 col-md-4 col-form-label">email</label>
                                    <div class="col-sm-12 col-md-8">
                                        <input class="form-control" name="email" type="email" value="<?= $b['user_email'];
                                                                                                        ?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-12 col-md-4 col-form-label">Telepon/Hp</label>
                                    <div class="col-sm-12 col-md-8">
                                        <input class="form-control" name="tlp" type="text" value="<?= $b['user_telp'];
                                                                                                    ?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-12 col-md-4 col-form-label">Password</label>
                                    <div class="col-sm-12 col-md-8">
                                        <input class="form-control" name="password" type="password" placeholder="Password">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-12 col-md-4 col-form-label">Nama Bengkel</label>
                                    <div class="col-sm-12 col-md-8">
                                        <select class="form-control" name="bengkel" style="width: 100%;">
                                            <option value="">Choose...</option>
                                            <?php
                                            foreach ($bengkel as $r) { ?>
                                                <option value="<?= $r['bengkel_id'] ?>" <?php if ($r['bengkel_id'] == $b['user_bengkel']) {
                                                                                            echo "selected";
                                                                                        } ?>>
                                                    <?= $r['bengkel_nama'] ?>
                                                </option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">
                            UPDATE
                        </button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
<?php }
?>

<!-- Modal Hapus admin -->
<?php
foreach ($admin as $b) { ?>
    <form action="<?= base_url('Master/User/hapus_admin') ?>" method="POST">
        <div class="modal fade1 bs-example-modal-lg" id="hapus<?= $b['user_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-md modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myLargeModalLabel">Hapus user <?= $b['user_nama'] ?></h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>

                    <div class="modal-body">
                        <input type="text" name="id" value="<?= $b['user_id'] ?>" hidden>
                        <p>
                            <h4>Yakin ingin menghapus user <strong><?= $b['user_nama'] ?></strong></h4>
                        </p>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">
                            Hapus
                        </button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
<?php }
?>