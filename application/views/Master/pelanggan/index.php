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
        <!-- Tabel daftar pelanggan  -->
        <table id="example1" class="table table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Bengkel</th>
                    <th>Total Pelanggan</th>
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
                        <td><?php
                            $idbengkel = $data['bengkel_id'];
                            $jml_bengkel = $this->db->query("Select * from pelanggan where pelanggan_bengkel = $idbengkel");
                            $total = $jml_bengkel->num_rows();
                            echo $total;
                        ?> Pelanggan</td>
                        <td>
                            <a href="<?= base_url('Master/Pelanggan/detail/') . $data['bengkel_id'] ?>" class="btn btn-info btn-md">
                                    <li class="fas fa fa-eye"></li>
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