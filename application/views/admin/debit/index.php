<?php
/**
 * halaman daftar bill
 */

if ($this->session->flashdata('sukses')) {
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">';
    echo $this->session->flashdata('sukses');
    echo ' <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>
    </button>', '</div>';
}
?>
<a href="<?= base_url('Admin/Debit/tambah') ?>" class="btn btn-sm btn-primary mb-3 elevation-5">Tambah Debit</a>
<div class="card elevation-5">
    <div class="card-body">
        <!-- Tabel daftar order  -->
        <div class="table-responsive">
            <table id="example1" class="table table-striped">
                <!-- <?php print_r($debit) ?> -->
                <thead>
                    <tr>
                        <th>No</th>
                        <th>ID</th>
                        <th>Total Debit</th>
                        <th>Status</th>
                        <th>Keterangan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                  <?php foreach ($debit as $no => $data): ?>
                    <tr>
                      <td><?php echo $no+1 ?></td>
                      <td><?php echo str_pad($data['debit_id'], 4, "0", STR_PAD_LEFT); ?></td>
                      <td><?php echo $data['debit_bayar'] ?></td>
                      <td><?php echo $data['debit_status'] ?  "<span class='badge badge-primary'>Lunas</span>" :
                                                              "<span class='badge badge-danger'>Belum bayar</span>" ?>
                      </td>
                      <td><?php echo $data['debit_catatan'] ?></td>
                      <td>
                        <?php if ($data['debit_status']): ?>
                          <a href="<?php echo base_url('Admin/Debit/cetak') ?>" class="btn btn-sm btn-default text-bold">Print</a>
                        <?php else: ?>
                          <a href="<?php echo base_url('Admin/Debit/pembayaran') ?>" class="btn btn-sm btn-info text-bold">Pembayaran</a>
                        <?php endif; ?>
                      </td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <!-- Batas akhir tabel order  -->
    </div>
</div>
