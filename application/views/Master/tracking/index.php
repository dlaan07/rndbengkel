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
                        <th>QTY Pesanan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 0;
                    foreach ($order as $data) {
                        if ($data['order_status'] > 6) {
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
                                    <a href="<?= base_url('Master/Tracking/detail/') . $data['order_id'] ?>" class="btn btn-info btn-sm btn-block">
                                        <!-- <li class="fas fa fa-eye"></li> -->
                                        DETAIL
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