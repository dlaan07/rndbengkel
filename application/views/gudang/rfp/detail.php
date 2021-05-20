<?php

if ($this->session->flashdata('sukses')) {
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">';
    echo $this->session->flashdata('sukses');
    echo ' <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>
    </button>', '</div>';
}
?>

<div class="row">
    <div class="col-md-7">
        <div class="row">
            <?php
            $totalRfp = 0;
            $total = 0;
            foreach ($partOrder as $data) {
            ?>
                <div class="col-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Detail Part Order</h3>
                        </div>
                        <div class="card-body" style="background-color: silver;">
                            <table border="0">
                                <thead>
                                    <tr>
                                        <th width=10%>ID Part</th>
                                        <td width=30%>: <?= $data['partMaster_id'] ?></td>
                                        <th class="text-right" width=60% rowspan="2">
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
                                        <td>: <?php //if ($data['partMaster_harga'] > 0) {
                                                   // echo $data['partMaster_stok'] + $data['part_qtyDibutuhkan'];
                                                //} else {
                                                    echo $data['partMaster_stok'];
                                               // } 
                                               ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Harga</th>
                                        <td>: Rp <?= number_format($data['partMaster_harga'], 0, "", ".") ?></td>
                                    </tr>
                                    <tr>
                                        <th>Pemesanan</th>
                                        <td>:
                                            <?php
                                            $this->db->select('po_hargaReq, po_qty, po_part_id');
                                            $this->db->from('purchaseorder');
                                            $this->db->where('po_part_id', $data['part_id']);
                                            $query = $this->db->get();
                                            $rfp = $query->row_array();
                                            if (isset($rfp['po_part_id']) == $data['part_id']) {
                                                $poqty = $rfp['po_qty'];
                                                echo $poqty;
                                            } else {
                                                $poqty = 0;
                                                echo $poqty;
                                            }
                                            ?>
                                        </td>
                                        <th class="text-right" width=60% rowspan="2">
                                            <?php
                                            // echo $poqty;
                                            // if (isset($rfp['po_part_id']) == $data['part_id']) {
                                            // $tombol = $data['partMaster_stok'] - $data['partMaster_par'] - $data['part_qtyDibutuhkan'] + $rfp['po_qty'];
                                            // if ($data['partMaster_harga'] > 0) {
                                            //     $stok = $data['partMaster_stok'] + $data['part_qtyDibutuhkan'];
                                            // } else {
                                            //     $stok = $data['partMaster_stok'];
                                            // }
                                            // $tombol = $stok - $data['part_qtyDibutuhkan'] + $rfp['po_qty'];
                                            $tombol = $data['partMaster_stok'] - $data['part_qtyDibutuhkan'] + $rfp['po_qty'];
                                            // echo $tombol;
                                            if ($tombol >= 0) {
                                                $simpan = 0;
                                            } else {
                                                $simpan = 1;
                                            ?>
                                                <a href="<?= base_url('Gudang/Rfp/hargaReq/') . $data['part_id'] ?>" class="btn btn-primary btn-sm">RFP</a>
                                                <!--<form action="<?= base_url('Gudang/Rfp/hargaReq') ?>" method="POST">-->
                                                <!--    <input type="text" name="idpart" value="<?= $data['part_id'] ?>" hidden>-->
                                                <!--    <button type="submit" class="btn btn-primary btn-sm">RFP</button>-->
                                                <!--</form>-->
                                            <?php
                                            }
                                            // }
                                            ?>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th>Harga RFP</th>
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

                                            if ($rfp['po_hargaReq'] > $data['partMaster_harga']) {
                                                $tertinggi = $rfp['po_hargaReq'];
                                            } else {
                                                $tertinggi = $data['partMaster_harga'];
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
                $totalRfp += $simpan;
                $partid = $data['part_id'];
            }
            // echo $total;
            ?>
        </div>
    </div>
    <div class="col-md-5">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Estimasi Parts</h3><br>
                <?php
                $idorder = $order['order_id'];
                //conversi penghitung jumlah hari dari tanggal order ke tanggal estimasi perbaikan selesai
                $tglAwal  = date_create($order['order_tgl']);
                // $tglAkhir = date_create($order['order_estimasiJasaWaktu']);
                // $diff = date_diff($tglAwal, $tglAkhir);

                //conversi penghitung jumlah hari dari tanggal order ke tanggal perkiraan tiba parts yang di akan di PO
                $tglPo = $this->db->query("SELECT * FROM purchaseorder JOIN parts ON purchaseorder.po_part_id = parts.part_id WHERE part_order_id = $idorder ORDER BY po_estimasiPartsWaktu DESC LIMIT 1");
                $tglEstimasi = $tglPo->row_array();
                // $tglPart = date_create($tglEstimasi['po_estimasiPartsWaktu']);
                // $dif2 = date_diff($tglAwal, $tglPart);
                $hari = $tglEstimasi['po_estimasiPartsWaktu'] + $order['order_estimasiJasaWaktu'];
                // $tglEstimasi['po_estimasiPartsWaktu'];

                //konversi penjumlahan tanggal
                date_add($tglAwal, date_interval_create_from_date_string('+' . $hari . ' days'));
                $hasilTgl = date_format($tglAwal, 'Y-m-d');
                $hasilTgl;
                ?>
            </div>
            <div class="card-body" style="background-color: white;">
                <form action="<?= base_url('Gudang/Rfp/estimasiParts') ?>" method="POST">
                    <div class="form-group" hidden>
                        <label for="exampleInputEmail1">Email Pelanggan</label>
                        <input type="text" name="email" class="form-control" value="<?= $order['pelanggan_email'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Estimasi Waktu Jasa</label>
                        <input type="text" name="part" class="form-control" value="<?= $order['order_estimasiJasaWaktu'] ?> Hari" readonly>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Estimasi Pekerjaan Selesai</label>
                        <input type="text" name="perbaikanSelesai" class="form-control" value="<?= $hari ?> Hari Kerja" readonly>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Total Estimasi Biaya Parts</label>
                        <input type="text" name="part" class="form-control" value="<?= $total ?>" hidden>
                        <input type="text" class="form-control" value="Rp <?= number_format($total, 0, "", ".") ?>" readonly>
                        <input type="text" name="idorder" class="form-control" value="<?= $order['order_id'] ?>" hidden>
                    </div>
                    <?php
                    // echo $totalRfp;
                    if ($totalRfp == 0) {
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