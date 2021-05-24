<?php
if ($this->session->flashdata('sukses')) {
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">';
    echo $this->session->flashdata('sukses');
    echo ' <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>
    </button>', '</div>';
}
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
                <i class="fas fa-users"></i>
            </div>
            <a href="<?= base_url('Admin/Pelanggan') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-info">
            <div class="inner">
                <h3><?= $order ?></h3>

                <p>Orders</p>
            </div>
            <div class="icon">
                <i class="fas fa-clipboard-list"></i>
            </div>
            <a href="<?= base_url('Admin/Order') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-success">
            <div class="inner">
                <h3><?= $perbaikan ?></h3>

                <p>Perbaikan</p>
            </div>
            <div class="icon">
                <i class="ion ion-bag"></i>
            </div>
            <a href="<?= base_url('Admin/Perbaikan') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    
        <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-pink">
            <div class="inner">
                <h3>
                    <?php
                        $validasi = $this->db->query("select * from repair_order where order_status = 2 or order_status = 4 or order_status = 5 or order_status = 6");
                        $dValid = $validasi->num_rows();
                        echo $dValid;
                    ?>
                </h3>

                <p>Validasi Pelanggan</p>
            </div>
            <div class="icon">
                <i class="fas fa-paper-plane"></i>
            </div>
            <a href="<?= base_url('Admin/Validasi') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <!--<div class="col-lg-6 col-6">-->
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
    <!--            </h3>-->

    <!--            <p>Total Tagihan</p>-->
    <!--        </div>-->
    <!--        <div class="icon">-->
    <!--            <i class="fas fa-cash-register"></i>-->
    <!--        </div>-->
    <!--        <a href="#" class="small-box-footer">&nbsp</a>-->
    <!--    </div>-->
    <!--</div>-->
    <!-- ./col -->
    <!--<div class="col-lg-6 col-6">-->
        <!-- small box -->
    <!--    <div class="small-box bg-primary">-->
    <!--        <div class="inner">-->
    <!--            <h3>-->
                    <?php
                    // $harga = 0;
                    // foreach ($bill as $key) {
                    //     $total = $key['bill_yangDibayar'];
                    //     $harga += $total;
                    // }
                    // echo "Rp " . number_format($harga, 0, "", ".");
                    ?>
    <!--            </h3>-->

    <!--            <p>Total Pembayaran</p>-->
    <!--        </div>-->
    <!--        <div class="icon">-->
    <!--            <i class="fas fa-dollar-sign"></i>-->
    <!--        </div>-->
    <!--        <a href="#" class="small-box-footer">&nbsp</a>-->
    <!--    </div>-->
    <!--</div>-->
    <!-- ./col -->
</div>