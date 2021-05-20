<?php
if ($this->session->flashdata('gagal')) {
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">';
    echo $this->session->flashdata('gagal');
    echo ' <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>
    </button>', '</div>';
}
?>

<div class="row">
    <div class="col-md-7">
        <div class="row">
            <?php
            $totalTombol = 0;
            $total = 0;
            foreach ($partOrder as $data) {
            ?>
                <div class="col-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Detail Part Order</h3>
                        </div>
                        <div class="card-body" style="background-color: silver;">
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th>ID Part</th>
                                        <td>: <?= $data['partMaster_id'] ?></td>
                                        <th class="text-right" rowspan="2">
                                            <!-- <div class="card card-info" style="width: 100px;"> -->
                                            <label> Par Stok </label><br>
                                            <label> <?= $data['partMaster_par'] ?></label>
                                            <!-- </div> -->
                                        </th>
                                    </tr>
                                    <tr>
                                        <th>Nama Part</th>
                                        <td>: <?= $data['partMaster_nama'] ?></td>
                                    </tr>
                                    <tr>
                                        <th>Kebutuhan</th>
                                        <td>: <?= $data['part_qtyDibutuhkan'] ?></td>
                                    </tr>
                                    <tr>
                                        <th>Stok</th>
                                        <td>: <?= $data['partMaster_stok'] ?></td>
                                    </tr>
                                    <tr>
                                        <th>Harga Sebelumnya</th>
                                        <td>: Rp <?= number_format($data['part_harga'], 0, "", ".") ?></td>
                                    </tr>
                                    <tr>
                                        <th>Pemesanan</th>
                                        <td>:
                                            <?php
                                            $this->db->select('*');
                                            $this->db->from('purchaseorder');
                                            $this->db->where('po_part_id', $data['part_id']);
                                            $query = $this->db->get();
                                            $rfp = $query->row_array();
                                            if (isset($rfp['po_part_id']) == $data['part_id']) {
                                                echo $rfp['po_qty'] + $rfp['po_qtyStok'];
                                            } else {
                                                echo 0;
                                            }
                                            ?>
                                        </td>
                                        <th class="text-right" rowspan="3">
                                            <?php
                                            // $tombol = $data['partMaster_stok'] - $data['partMaster_par'] - $data['part_qtyDibutuhkan'] + $rfp['po_qty'];
                                            if ($rfp['po_part_id'] == $data['part_id'] && $rfp['po_tglPesan'] == "") {
                                                $simpan = 1;
                                            ?>
                                            <a href=" <?= base_url('Gudang/Purchaseorder/prosesPO/').$rfp['po_id']?> " class="btn btn-primary btn-sm">PO</a>
                                                <!--<form action="<?= base_url('Gudang/Purchaseorder/prosesPO') ?>" method="POST">-->
                                                <!--    <input type="text" name="idpo" value="<?= $rfp['po_id'] ?>" hidden>-->
                                                <!--    <button type="submit" class="btn btn-primary btn-sm">PO</button>-->
                                                <!--</form>-->
                                            <?php
                                            } else {
                                                $simpan = 0;
                                            }
                                            ?>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th>Harga Saat ini</th>
                                        <td>: Rp
                                            <?php
                                            $this->db->select('po_hargaReq, po_qty, po_part_id');
                                            $this->db->from('purchaseorder');
                                            $this->db->where('po_part_id', $data['part_id']);
                                            $query = $this->db->get();
                                            $rfp = $query->row_array();
                                            if (isset($rfp['po_part_id']) == $data['part_id']) {
                                                echo number_format($rfp['po_hargaReq'], 0, "", ".");
                                            } else {
                                                echo 0;
                                            }

                                            if ($rfp['po_hargaReq'] > $data['part_harga']) {
                                                $tertinggi = $rfp['po_hargaReq'];
                                            } else {
                                                $tertinggi = $data['part_harga'];
                                            }
                                            ?>
                                        </td>
                                    </tr>

                                    <tr style="background-color: yellow;">
                                        <th>Sub Total</th>
                                        <td>: Rp <?= number_format($tertinggi * $data['part_qtyDibutuhkan'], 0, "", ".") ?></td>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            <?php
                $harga = $data['part_qtyDibutuhkan'] * $tertinggi;
                $total += $harga;
                $totalTombol += $simpan;
            }
            // echo $total;
            ?>
        </div>
    </div>
    <div class="col-md-5">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Total Biaya Parts</h3>
            </div>
            <div class="card-body" style="background-color: white;">
                <form action="<?= base_url('Gudang/Purchaseorder/biayaPart') ?>" method="POST">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Total Biaya Parts</label>
                        <input type="text" name="part" class="form-control" value="<?= $total ?>" hidden>
                        <input type="text" class="form-control" value="Rp <?= number_format($total, 0, "", ".") ?>" readonly>
                        <input type="text" name="idorder" class="form-control" value="<?= $order['order_id'] ?>" hidden>
                    </div>
                    <?php
                    // echo $totalTombol;
                    if ($totalTombol == 0) {
                    ?>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">SIMPAN</button>
                        </div>
                    <?php } ?>
                </form>
            </div>
        </div>
    </div>
</div>