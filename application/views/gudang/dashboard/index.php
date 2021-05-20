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
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-warning">
            <div class="inner">
                <h3><?= $parts ?></h3>

                <p>Parts</p>
            </div>
            <div class="icon">
                <i class="fas fa-toolbox"></i>
            </div>
            <a href="<?= base_url('Gudang/Parts') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-info">
            <div class="inner">
                <h3>
                    <?php
                    $selesai = $this->db->query("SELECT * from repair_order where order_status != 2 and order_status < 5 and order_bengkel = $nama and order_estimasiJasaHarga != '' ");
                    // $this->db->select('*');
                    // $this->db->from('repair_order');
                    // $this->db->where('order_status', 1);
                    // $this->db->where('order_status', 3);
                    // $this->db->where('order_status', 4);
                    // $this->db->where('order_bengkel', $nama);
                    // $selesai = $this->db->get();
                    $ps = $selesai->num_rows();
                    echo $ps;
                    ?>
                </h3>

                <p>RFP</p>
            </div>
            <div class="icon">
                <i class="fas fa-file-invoice-dollar"></i>
            </div>
            <a href="<?= base_url('Gudang/Rfp') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-success">
            <div class="inner">
                <h3>
                    <?php
                    $this->db->select('*');
                    $this->db->from('purchaseorder');
                    $this->db->join('parts', 'purchaseorder.po_part_id = parts.part_id');
                    $this->db->join('partmaster', 'parts.part_partMaster_id = partmaster.partMaster_id');
                    $this->db->join('repair_order', 'parts.part_order_id = repair_order.order_id');
                    // $this->db->join('pelanggan', 'repair_order.order_pelanggan_id = pelanggan.pelanggan_id');
                    $this->db->where('order_status', 5);
                    $this->db->where('part_bengkel', $nama);
                    $this->db->group_by('part_order_id');
                    $query = $this->db->get();
                    echo $query->num_rows();
                    ?>
                </h3>

                <p>Purchase Order</p>
            </div>
            <div class="icon">
                <i class="fas fa-cart-arrow-down"></i>
            </div>
            <a href="<?= base_url('Gudang/Purchaseorder') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-danger">
            <div class="inner">
                <h3>
                    <?php
                    $query = $this->db->query(" SELECT * FROM purchaseorder 
                    join parts on purchaseorder.po_part_id = parts.part_id
                    join partmaster on parts.part_partMaster_id = partmaster.partMaster_id
                    join repair_order on parts.part_order_id = repair_order.order_id
                    where po_tracking != 4 and po_bengkel = $nama
                    ");
                    echo $query->num_rows();
                    ?>
                </h3>

                <p>Tracking</p>
            </div>
            <div class="icon">
                <i class="fas fa-map-marked-alt"></i>
            </div>
            <a href="<?= base_url('Gudang/Tracking') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-purple">
            <div class="inner">
                <h3>
                    <?php
                    $query = $this->db->query("SELECT * FROM partmaster where partMaster_stok <= partMaster_par and partMaster_bengkel = $nama");
                    echo $query->num_rows();
                    ?>
                </h3>

                <p>PO Restock</p>
            </div>
            <div class="icon">
                <i class="fas fa-cart-plus"></i>
            </div>
            <a href="<?= base_url('Gudang/Parts/po') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
</div>