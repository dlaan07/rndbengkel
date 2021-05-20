<?php
if ($this->session->flashdata('gagal')) {
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">';
    echo $this->session->flashdata('gagal');
    echo ' <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>
    </button>', '</div>';
}
?>
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Detail Pengecekan</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->

    <!-- <form role="form" method="get"> -->
    <div class="card-body">
        <form action="<?= base_url('Teknisi/Order/edit') ?>" method="POST">
            <input type="text" name="idorder" value="<?= $order['order_id'] ?>" hidden>
            <div class="form-group">
                <label for="exampleInputEmail1">Nama Pelanggan</label>
                <input type="text" class="form-control" name="pelanggan" value="<?= $order['pelanggan_nama'] ?>" readonly>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Alamat Pelanggan</label>
                <input type="text" class="form-control" value="<?= $order['pelanggan_alamat'] ?>" readonly>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Kontak Pelanggan</label>
                <input type="text" class="form-control" value="<?= $order['pelanggan_hp'] ?>" readonly>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Email Pelanggan</label>
                <input type="text" class="form-control" value="<?= $order['pelanggan_email'] ?>" readonly>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Jenis Sepeda</label>
                <input type="text" class="form-control" value="<?= $order['order_jenisSepeda'] ?>" readonly>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Warna Sepeda</label>
                <input type="text" class="form-control" value="<?= $order['order_warnaSepeda'] ?>" readonly>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Jenis Perbaikan</label>
                <input type="text" class="form-control" value="<?= $order['order_jenisPerbaikan'] ?>" readonly>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Keterangan</label>
                <textarea name="keterangan" class="form-control" cols="10" rows="5" readonly><?= $order['order_keterangan'] ?></textarea>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Status Perbaikan</label>
                <input type="text" class="form-control" value="<?php if ($order['order_status'] == 1) {
                                                                    echo "Dalam Pengecekan";
                                                                } else if ($order['order_status'] == 2) {
                                                                    echo "Selesai Pengecekan";
                                                                } else if ($order['order_status'] == 3) {
                                                                    echo "Menunggu RFP";
                                                                } else if ($order['order_status'] == 4) {
                                                                    echo "Selesai Pengecekan RFP";
                                                                } else if ($order['order_status'] == 5) {
                                                                    echo "Pelanggan Setuju";
                                                                } else if ($order['order_status'] == 6) {
                                                                    echo "Pelanggan Tidak Setuju";
                                                                } else if ($order['order_status'] == 7) {
                                                                    echo "Menunggu Barang";
                                                                } ?>" readonly>
            </div>
            
            <?php 
            
            $idorder = $order['order_id'];
            $part = $this->db->query("SELECT * FROM parts join partmaster on parts.part_partMaster_id = partmaster.partMaster_id where part_order_id = $idorder");
            $par = $part->result_array();
            $tersedia = 0;
            $tombol = 0;
            foreach ($par as $b){
                $idpart = $b['part_id'];
                $stok = $b['partMaster_stok'] - $b['part_qtyDibutuhkan'];
                if($stok > 0){
                    $barang = 1;
                } else {
                    $barang = 0;
                }
                $tersedia += $barang;
            }
                
            $query = $this->db->query("SELECT * from purchaseorder join parts on purchaseorder.po_part_id = parts.part_id where part_order_id = $idorder");
            $po = $query->result_array();
            foreach($po as $p){
                if($p['po_tracking'] == 4) {
                     $simpan = 1;
                } else {
                     $simpan = 0;
                }
                
                $tombol += $simpan;
            }     
                
            // echo $tersedia . " tersedia <br>";
            // echo $tombol . " barang sampe";
            
            if ($order['order_status'] == 5 or $order['order_status'] == 7){
                // if ($tersedia == 0 && $tombol == 0) {
                //     $radio = "hidden";
                // } else {
                $radio = "";
                // }
            } else {
                $radio = "hidden";
            }
            ?>
            <div class="form-group" <?= $radio ?>>
                <label for="exampleInputEmail1">Update Status Pekerjaan</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="cek" value="8">
                    <label class="form-check-label text-bold">Dalam Pengerjaan</label>
                </div>
            </div>
    </div>

    <div class="card-footer">
        <button type="submit" class="btn btn-primary">SIMPAN</button>
        <button type="button" class="btn btn-warning" onclick="history.back();">KEMBALI</button>
    </div>
    </form>
</div>