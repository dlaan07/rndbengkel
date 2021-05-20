<?php
if ($this->session->flashdata('gagal')) {
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">';
    echo $this->session->flashdata('gagal');
    echo ' <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>
    </button>', '</div>';
}
?>

<div class="row">
    <div class="col-md-6">
        <div class="row">
            <div class="col-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Detail Part Order</h3>
                    </div>
                    <div class="card-body" style="background-color: silver;">
                        <table class=" table-borderless">
                            <thead>
                                <tr>
                                    <th>ID Part</th>
                                    <td>: <?= $part['partMaster_id'] ?></td>
                                </tr>
                                <tr>
                                    <th>ID PO</th>
                                    <td>: <?= $part['po_id'] ?></td>
                                </tr>
                                <tr>
                                    <th>Nama Part</th>
                                    <td>: <?= $part['partMaster_nama'] ?></td>
                                </tr>
                                <tr>
                                    <th>Qty</th>
                                    <td>: <?= $part['part_qtyDibutuhkan'] ?></td>
                                </tr>
                                <tr>
                                    <th>Status</th>
                                    <td>:
                                        <?php
                                        if ($part['po_tracking'] == 1) {
                                            echo "Barang masih pada seller";
                                        } else if ($part['po_tracking'] == 2) {
                                            echo "Barang ada dikurir, menuju gudang";
                                        } else if ($part['po_tracking'] == 3) {
                                            echo "Barang ada digudang";
                                        } else if ($part['po_tracking'] == 4) {
                                            echo "Barang ada dikurir, menuju bengkel";
                                        }
                                        ?>
                                    </td>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Update Tracking Barang</h3>
            </div>
            <div class="card-body">
                <form action="<?= base_url('Gudang/Tracking/simpan') ?>" method="POST">

                    <?php
                    // if($part['partMaster_stok'] < 0){
                    //     $stok = $part['part_qtyDibutuhkan'];
                    //     $outstok = $stok - $part['part_qtyDibutuhkan'];
                    // } else {
                    //     $stok = $part['partMaster_stok'] + $part['po_qty'];
                    //     $outstok = $part['partMaster_stok'] - $part['part_qtyDibutuhkan'];
                    // }

                    // if($part['partMaster_stok'] == 0){
                    //     $stok = $part['part_qtyDibutuhkan'];
                    // } else {
                    //     $stok = $part['partMaster_stok'] + $part['po_qty'];
                    // }
                    ?>

                    <input type="text" name="idpo" value="<?= $part['po_id'] ?>" id="" hidden>
                    <input type="text" name="idorder" value="<?= $part['part_order_id'] ?>" id="" hidden>
                    <input type="text" name="idmaster" value="<?= $part['partMaster_id'] ?>" hidden>
                    <input type="text" name="harga" value="<?= $part['po_hargaReq'] ?>" hidden>
                    <input type="text" name="stok" value="<?= $part['partMaster_stok'] + $part['po_qty'] + $part['po_qtyStok']  ?>" hidden>
                    <input type="text" name="outstok" value="<?= $part['partMaster_stok'] - $part['part_qtyDibutuhkan'] ?>" hidden>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Tanggal</label>
                        <input type="text" value="<?php echo date('Y-m-d') ?>" class="form-control" readonly>
                    </div>
                    <h5>
                        <div class="form-group">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="cek" value="1" <?php if ($part['po_tracking'] == 1) {
                                                                                                        echo "checked";
                                                                                                    } if ($part['po_tracking'] > 1) {echo "disabled";} ?>>
                                <label class="form-check-label text-bold">Barang masih pada seller</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="cek" value="2" <?php if ($part['po_tracking'] == 2) {
                                                                                                        echo "checked";
                                                                                                    } if ($part['po_tracking'] > 2) {echo "disabled";} ?>>
                                <label class="form-check-label text-bold">Barang ada di kurir, menuju gudang</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="cek" value="3" <?php if ($part['po_tracking'] == 3) {
                                                                                                        echo "checked";
                                                                                                    } if ($part['po_tracking'] > 3) {echo "disabled";} ?>>
                                <label class="form-check-label text-bold">Barang ada di gudang</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="cek" value="4" <?php if ($part['po_tracking'] == 4) {
                                                                                                        echo "checked";
                                                                                                    } if ($part['po_tracking'] > 4) {echo "disabled";} ?>>
                                <label class="form-check-label text-bold">Barang ada di kurir, menuju bengkel</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">UPDATE</button>
                        </div>
                    </h5>
                </form>
            </div>
        </div>
    </div>
</div>