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
        <!-- <a href="#" data-toggle="modal" data-target="#tambah" class="btn btn-primary btn-sm elevation-5 mb-3">Tambah config</a> -->
        <!-- Tabel daftar pelanggan  -->
        <table id="example1" class="table table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Bengkel</th>
                    <th>Alamat</th>
                    <th>Telepon</th>
                    <th>Icon</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 0;
                foreach ($configurasi as $data) { //$pelanggan di ambil dari controller Admin nama file pelanggan nama function index
                    $no++;
                ?>
                    <tr>
                        <td><?= $no ?></td>
                        <td><?= $data['config_namaBengkel'] ?></td>
                        <td><?= $data['config_alamat'] ?></td>
                        <td><?= $data['config_telp'] ?></td>
                        <td><?= $data['config_icon'] ?></td>
                        <td>
                            <a href="<?= base_url('Master/konfigurasi/detailbyId/') . $data['config_id'] ?>" class="btn btn-info btn-sm">
                                <li class="fas fa fa-edit"></li>
                            </a>
                            <!-- <a href="#" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus<?= $data['config_id'] ?>">
                                <li class="fas fa fa-trash"></li>
                            </a> -->
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