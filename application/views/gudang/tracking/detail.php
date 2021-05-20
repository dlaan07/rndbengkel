<?php
if ($this->session->flashdata('gagal')) {
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">';
    echo $this->session->flashdata('gagal');
    echo ' <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>
    </button>', '</div>';
}
?>

<div class="row">
    <div class="col-md-12">
        <div class="row">
            <?php
            foreach ($partOrder as $data) {
            ?>
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
                                        <td>: <?= $data['partMaster_id'] ?></td>
                                    </tr>
                                    <tr>
                                        <th>ID PO</th>
                                        <td>: <?= $data['po_id'] ?></td>
                                    </tr>
                                    <tr>
                                        <th>Nama Part</th>
                                        <td>: <?= $data['partMaster_nama'] ?></td>
                                    </tr>
                                    <tr>
                                        <th>Qty</th>
                                        <td>: <?= $data['part_qtyDibutuhkan'] ?></td>
                                    </tr>
                                    <tr>
                                        <th>Status</th>
                                        <td>:
                                            <?php
                                            if ($data['po_tracking'] == 1) {
                                                echo "Barang masih pada seller";
                                            } else if ($data['po_tracking'] == 2) {
                                                echo "Barang ada dikurir, menuju gudang";
                                            } else if ($data['po_tracking'] == 3) {
                                                echo "Barang ada digudang";
                                            } else if ($data['po_tracking'] == 4) {
                                                echo "Barang ada dikurir, menuju bengkel";
                                            }
                                            ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="text-right">
                                            <form action="<?= base_url('Gudang/Tracking/updateTracking') ?>" method="POST">
                                                <input type="text" name="idpo" value="<?= $data['po_id'] ?>" hidden>
                                                <button type="submit" class="btn btn-primary btn-sm btn-block" <?php if($data['po_tracking'] == 4){echo "hidden";} ?>>EDIT</button>
                                            </form>
                                        </th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            <?php
            }
            // echo $total;
            ?>
        </div>
    </div>
</div>