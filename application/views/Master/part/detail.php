<?php
if ($this->session->flashdata('sukses')) {
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">';
    echo $this->session->flashdata('sukses');
    echo ' <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>
    </button>', '</div>';
}
?>

<div class="row">
    <div class="col-md-5 col-sm-12">
        <div class="row">
            <div class="col-12">
                <div class="card card-primary elevation-5">
                    <div class="card-header">
                        <h3 class="card-title text-bold">Detail Bengkel</h3>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <td class="text-bold">Nama Bengkel</td>
                                    <td>: <?= $bengkel['bengkel_nama'] ?></td>
                                </tr>
                                <tr>
                                    <td class="text-bold">Alamat Bengkel</td>
                                    <td>: <?= $bengkel['bengkel_alamat'] ?></td>
                                </tr>
                                <tr>
                                    <td class="text-bold">Telepon Bengkel</td>
                                    <td>: <?= $bengkel['bengkel_tlp'] ?></td>
                                </tr>
                                <tr>
                                    <td class="text-bold">Nama Pemilik</td>
                                    <td>: <?= $bengkel['bengkel_owner'] ?></td>
                                </tr>
                                <tr>
                                    <td class="text-bold">Tanggal Bergabung</td>
                                    <td>: <?= $bengkel['bengkel_join'] ?></td>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="card card-primary elevation-5">
                    <div class="card-header">
                        <h3 class="card-title text-bold">Statistik Parts</h3>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <td class="text-bold">Sering Digunakan</td>
                                    <td>:
                                        <?php
                                        $idbengkel = $bengkel['bengkel_id'];
                                        $penggunaan = $this->db->query("SELECT part_qtyDibutuhkan, part_partMaster_id, part_bengkel, count(part_partMaster_id) as jml FROM parts where part_bengkel = $idbengkel group by part_partMaster_id order by jml desc");
                                        if ($penggunaan->num_rows() > 0) {
                                            $result = $penggunaan->row_array();
                                            $idmaster = $result['part_partMaster_id'];
                                            $master = $this->db->query("SELECT * FROM partmaster WHERE partMaster_id = $idmaster");
                                            $namaMaster = $master->row_array();
                                            echo $namaMaster['partMaster_nama'];
                                        } else {
                                            echo "Bengkel belum memiliki data pergantian parts";
                                        }
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-bold">Sering di PO</td>
                                    <td>:
                                        <?php
                                        $idbengkel = $bengkel['bengkel_id'];
                                        $po = $this->db->query("SELECT *, count(part_partMaster_id) as jml FROM parts join purchaseorder on parts.part_id = purchaseorder.po_part_id where part_bengkel = $idbengkel group by part_partMaster_id order by jml desc");

                                        if ($po->num_rows() > 0) {
                                            $result = $po->row_array();
                                            $idpo = $result['part_partMaster_id'];
                                            $datapo = $this->db->query("SELECT * FROM partmaster WHERE partMaster_id = $idpo");
                                            $namapo = $datapo->row_array();
                                            echo $namapo['partMaster_nama'];
                                        } else {
                                            echo "Bengkel belum pernah melakukan PO";
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
    <div class="col-md-7 col-sm-12">
        <div class="card elevation-5">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example1" class="table table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Part</th>
                                <th>Harga</th>
                                <th>Stok</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 0;
                            foreach ($parts as $data) { //$order di ambil dari controller Admin nama file order nama function index

                                $no++;
                            ?>
                                <tr>
                                    <td><?= $no ?></td>
                                    <td><?= $data['partMaster_nama'] ?></td>
                                    <td><?= $data['partMaster_harga'] ?></td>
                                    <td><?php if($data['partMaster_stok'] <= 0) { echo '<span class="badge badge-danger">Out Of Stok</span>';} else { echo $data['partMaster_stok']; } ?></td>
                                </tr>
                            <?php

                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <!-- Batas akhir tabel order  -->
            </div>
        </div>
    </div>
</div>