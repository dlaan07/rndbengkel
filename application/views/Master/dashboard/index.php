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
                <h3><?php 
                    $bengkel = $this->db->query("select * from bengkel");
                    $num = $bengkel->num_rows();
                    echo $num;
                ?></h3>

                <p>Bengkel</p>
            </div>
            <div class="icon">
                <i class="fas fa-warehouse"></i>
            </div>
            <a href="<?= base_url('Master/Bengkel') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
</div>
<!-- ./col -->