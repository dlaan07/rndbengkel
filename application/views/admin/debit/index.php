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
<?php print_r($debit); ?>
<div class="card elevation-5">
    <div class="card-body">
        <!-- Tabel daftar order  -->
        <div class="table-responsive">
            <table id="example1" class="table table-striped">
                <!-- <?php print_r($debit) ?> -->
                <thead>
                    <tr>
                        <th>No</th>
                        <th>ID Order</th>
                        <th>ID Pelanggan</th>
                        <th>Nama Pelanggan</th>
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
                      <td><?php echo "00".str_pad($data['order_id'], 4, "0", STR_PAD_LEFT); ?></td>
                      <td><?php echo "00".str_pad($data['pelanggan_id'], 4, "0", STR_PAD_LEFT); ?></td>
                      <td><?php echo $data['pelanggan_nama'] ?></td>
                      <td><?php echo $data['debit_bayar'] ?></td>
                      <td><?php echo $data['debit_status'] ?  "<span class='badge badge-primary'>Lunas</span>" :
                                                              "<span class='badge badge-danger'>Belum bayar</span>" ?>
                      </td>
                      <td><?php echo $data['debit_keterangan'] ?></td>
                      <td>
                        <?php if ($data['debit_status']): ?>
                          <a href="<?php echo base_url('Admin/Debit/cetak/'.$data['order_id']) ?>" class="btn btn-sm btn-default text-bold">Print</a>
                        <?php else: ?>
                          <a href="<?php echo base_url('Admin/Debit/pembayaran/'.$data['order_id']) ?>" class="btn btn-sm btn-info text-bold">Pembayaran</a>
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
