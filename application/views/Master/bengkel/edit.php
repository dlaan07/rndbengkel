<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Edit bengkel <?= $bengkel['bengkel_nama'] ?></h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form role="form" action="<?= base_url('Master/bengkel/edit') ?>" method="POST">
        <div class="card-body">
            <div class="form-group" hidden>
                <label for="exampleInputEmail1">ID Bengkel</label>
                <input type="text" name="id" class="form-control" value="<?= $bengkel['bengkel_id'] ?>">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Nama Lengkap</label>
                <input type="text" name="nama" class="form-control" value="<?= $bengkel['bengkel_nama'] ?>">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Alamat</label>
                <input type="text" name="alamat" class="form-control" value="<?= $bengkel['bengkel_alamat'] ?>">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Hp</label>
                <input type="number" name="hp" class="form-control" value="<?= $bengkel['bengkel_tlp'] ?>" maxlength="12" onkeypress="return Angkasaja(event)">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Nama Owner</label>
                <input type="text" name="owner" class="form-control" value="<?= $bengkel['bengkel_owner'] ?>">
            </div>
        </div>
        <!-- /.card-body -->

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">UPDATE</button>
        </div>
    </form>
</div>