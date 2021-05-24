<?php
if ($this->session->flashdata('sukses')) {
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">';
    echo $this->session->flashdata('sukses');
    echo ' <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>
    </button>', '</div>';
}
$bengkel = $this->session->userdata('bengkel');
?>
<div class="row">
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-warning">
            <div class="inner">
                <h3><?= $pelanggan ?></h3>

                <p>Pelanggan</p>
            </div>
            <div class="icon">
                <i class="ion ion-person-add"></i>
            </div>
            <a href="<?= base_url('Owner/Pelanggan') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-info">
            <div class="inner">
                <h3>
                    <?php
                    // $selesai = $this->db->query("SELECT * from repair_order  where order_status < 8 and order_bengkel = $bengkel");
                    // $ps = $selesai->num_rows();
                    echo $order;
                    ?>
                </h3>

                <p>Orders</p>
            </div>
            <div class="icon">
                <i class="ion ion-bag"></i>
            </div>
            <a href="<?= base_url('Owner/Order') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-primary">
            <div class="inner">
                <h3>
                    <?php
                    // $selesai = $this->db->query("SELECT * from repair_order where order_status > 7 and order_bengkel = $bengkel");
                    // $ps = $selesai->num_rows();
                    echo $perbaikan;
                    ?>
                </h3>
                <p>Perbaikan</p>
            </div>
            <div class="icon">
                <i class="fas fa-tools"></i>
            </div>
            <a href="<?= base_url('Owner/Perbaikan') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-success">
            <div class="inner">
                <h3><?= $parts ?></h3>

                <p>Parts</p>
            </div>
            <div class="icon">
                <i class="ion ion-stats-bars"></i>
            </div>
            <a href="<?= base_url('Owner/Parts') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-purple">
            <div class="inner">
                <h3>
                    <?php
                    $query = $this->db->query("SELECT * FROM partmaster where partMaster_stok <= partMaster_par and partMaster_bengkel = $bengkel");
                    echo $query->num_rows();
                    ?>
                </h3>

                <p>Parts Yang Harus di PO</p>
            </div>
            <div class="icon">
                <i class="fas fa-cart-plus"></i>
            </div>
            <a href="<?= base_url('Owner/Parts/po') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <!--<div class="col-lg-3 col-6">-->
    <!-- small box -->
    <!--    <div class="small-box bg-danger">-->
    <!--        <div class="inner">-->
    <!--            <h3>-->
    <?php
    // $harga = 0;
    // foreach ($bill as $key) {
    //     $total = $key['bill_total'];
    //     $harga += $total;
    // }
    // echo "Rp " . number_format($harga, 0, "", ".");
    ?>
    <!--        </h3>-->

    <!--        <p>Total Tagihan</p>-->
    <!--    </div>-->
    <!--    <div class="icon">-->
    <!--        <i class="ion ion-pie-graph"></i>-->
    <!--    </div>-->
    <!--    <a href="#" class="small-box-footer">&nbsp</a>-->
    <!--</div>-->
</div>
<!-- ./col -->
</div>