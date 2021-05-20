<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Edit Pelanggan <?= $pelanggan['pelanggan_nama'] ?></h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form role="form" action="<?= base_url('Admin/Pelanggan/edit') ?>" method="POST">
        <div class="card-body">
            <div class="form-group" hidden>
                <label for="exampleInputEmail1">ID Pelanggan</label>
                <input type="text" name="id" class="form-control" value="<?= $pelanggan['pelanggan_id'] ?>">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Nama Lengkap</label>
                <input type="text" name="nama" class="form-control" value="<?= $pelanggan['pelanggan_nama'] ?>">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Alamat</label>
                <input type="text" name="alamat" class="form-control" value="<?= $pelanggan['pelanggan_alamat'] ?>">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Hp</label>
                <input type="text" name="hp" class="form-control" value="<?= $pelanggan['pelanggan_hp'] ?>" maxlength="12" onkeypress="return Angkasaja(event)">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Email</label>
                <input type="email" name="email" class="form-control" value="<?= $pelanggan['pelanggan_email'] ?>">
            </div>
        </div>
        <!-- /.card-body -->

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">UPDATE</button>
        </div>
    </form>
</div>