<?php
if ($this->session->flashdata('gagal')) {
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">';
    echo $this->session->flashdata('gagal');
    echo ' <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>
    </button>', '</div>';
}
?>
<div class="card elevation-5">
    <div class="card-body">
        <div class="table-responsive">
            <table id="example1" class="table table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>ID Pelanggan</th>
                        <th>ID Order</th>
                        <th>Nama Pelanggan</th>
                        <th>Jumlah PO</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 0;
                    foreach ($order as $data) {
                        if ($data['order_status'] > 4) {
                            $no++;
                    ?>
                            <tr>
                                <td><?= $no ?></td>
                                <td>PLG-00<?= $data['pelanggan_id'] ?></td>
                                <td>ORDER-00<?= $data['order_id'] ?></td>
                                <td><?= $data['pelanggan_nama'] ?></td>
                                <td>
                                    <?php
                                    $this->db->select('*');
                                    $this->db->from('purchaseorder');
                                    $this->db->join('parts', 'purchaseorder.po_part_id = parts.part_id');
                                    $this->db->where('part_order_id', $data['order_id']);
                                    $query = $this->db->get();
                                    echo $query->num_rows();
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    if ($data['order_status'] == 5) {
                                        echo "Pelanggan Setuju";
                                    } else if ($data['order_status'] == 6) {
                                        echo "Pelanggan Tidak Setuju";
                                    } else if ($data['order_status'] == 7) {
                                        echo "Menunggu Barang";
                                    } else if ($data['order_status'] == 8) {
                                        echo "Dalam Pengerjaan";
                                    } else if ($data['order_status'] == 9) {
                                        echo "Perbaikan Selesai";
                                    }
                                    ?>
                                </td>
                                <td>
                                    <a href="<?= base_url('Gudang/Purchaseorder/detail/') . $data['order_id'] ?>" class="btn btn-info btn-sm btn-block <?php if ($data['order_status'] != 5) {
                                                                                                                                                            echo "disabled";
                                                                                                                                                        } ?>">
                                        <!-- <li class="fas fa fa-eye"></li> -->
                                        LAKUKAN PO
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
        <!-- Batas akhir tabel order  -->
    </div>
</div>