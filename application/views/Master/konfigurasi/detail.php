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

<div class="row">
    <div class="col-xl-6 col-md-6 mb-30">
        <div class="card card-default">
            <div class="card-body elevation-5">
                <form action="<?= base_url('Master/Konfigurasi/nama') ?>" method="POST">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nama Bengkel</label>
                        <input type="text" name="id" class="form-control" value="<?= $configurasi['config_id'] ?>" hidden>
                        <input type="text" name="nama" class="form-control" value="<?= $configurasi['config_namaBengkel'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Alamat</label>
                        <input type="text" name="alamat" class="form-control" value="<?= $configurasi['config_alamat'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Telepon</label>
                        <input type="text" name="tlp" class="form-control" value="<?= $configurasi['config_telp'] ?>" maxlength="12" onkeypress="return Angkasaja(event)">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">
                            Update
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- icon -->
    <div class="col-xl-6 col-md-6 mb-30">
        <div class="card card-default">
            <div class="card-body elevation-5">
                <div class="form-group row">
                    <label class="col-sm-12 col-md-9 col-form-label">Icon</label>
                    <div class="col-sm-12 col-md-3 nav justify-content-end">
                        <a href="" class="btn btn-primary" data-toggle="modal" data-target="#icon">
                            Change
                        </a>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-12 col-md-12 nav justify-content-center">
                        
                        <?php if($configurasi['config_icon'] == ""){ ?>
                            <h3 class="text-info"> Silahkan Upload Icon Bengkel</h3>
                        <?php }else { ?>
                            <img class="img-fluid" src="<?= base_url('assets/images/') . $configurasi['config_icon'] ?>" alt="icon" height="200">
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>


<!-- Modal Ganti Icon -->
<form action="<?= base_url('Master/Konfigurasi/icon') ?>" enctype="multipart/form-data" method="POST">
    <div class="modal fade1 bs-example-modal-lg" id="icon" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">Ganti Icon</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="custom-file">
                        <input class="form-control" name="id" value="<?= $configurasi['config_id'] ?>" type="text" hidden>
                        <input type="file" name="icon" class="custom-file-input" id="customFile">
                        <label class="custom-file-label" for="customFile">Choose file</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">
                        Save
                    </button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</form>