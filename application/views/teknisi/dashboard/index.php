<?php
if ($this->session->flashdata('sukses')) {
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">';
    echo $this->session->flashdata('sukses');
    echo ' <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>
    </button>', '</div>';
}

$nama = $this->session->userdata('bengkel');
?>
<div class="row">
    <div class="col-lg-4 col-6">
        <!-- small box -->
        <div class="small-box bg-info">
            <div class="inner">
                <h3>
                    <?php
                    $selesai = $this->db->query("SELECT * from repair_order join pelanggan on repair_order.order_pelanggan_id = pelanggan.pelanggan_id where order_status < 8 and order_bengkel = $nama");
                    $ps = $selesai->num_rows(); 
                    echo $ps;
                    ?>
                </h3>

                <p>Orders</p>
            </div>
            <div class="icon">
                <i class="ion ion-bag"></i>
            </div>
            <a href="<?= base_url('Teknisi/Order') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-4 col-6">
        <!-- small box -->
        <div class="small-box bg-success">
            <div class="inner">
                <h3>
                    <?php
                    $selesai = $this->db->query("SELECT * from repair_order join pelanggan on repair_order.order_pelanggan_id = pelanggan.pelanggan_id where order_status > 7 and order_bengkel = $nama");
                    $ps = $selesai->num_rows();
                    echo $ps;
                    ?>
                </h3>
                <p>Perbaikan</p>
            </div>
            <div class="icon">
                <i class="fas fa-tools"></i>
            </div>
            <a href="<?= base_url('Teknisi/Perbaikan') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-4 col-6">
        <!-- small box -->
        <div class="small-box bg-danger">
            <div class="inner">
                <h3><?= $parts ?></h3>

                <p>Parts</p>
            </div>
            <div class="icon">
                <i class="fas fa-toolbox"></i>
            </div>
            <a href="<?= base_url('Teknisi/Parts') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
</div>