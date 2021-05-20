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
        <h3 class="card-title">Detail Part Order</h3>
    </div>
    <div class="card-body">
        <form action="<?= base_url('Gudang/Rfp/tambahRfp') ?>" method="POST">
            <div class="form-group">
                <label for="exampleInputEmail1">Nama Part</label>
                <input type="text" value="<?= $part['partMaster_nama'] ?>" class="form-control" readonly>
                <input type="text" name="idpart" value="<?= $part['part_id'] ?>" class="form-control" hidden>
                <input type="text" name="idorder" value="<?= $part['part_order_id'] ?>" class="form-control" hidden>
                <input type="text" name="idpartmaster" value="<?= $part['part_partMaster_id'] ?>" class="form-control" hidden>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Nama Toko</label>
                <input type="text" name="toko" class="form-control" value="<?= set_value('toko') ?>" placeholder="Masukan Nama Toko">
                <?= form_error('toko', '<small class="text-danger ">', '</small>') ?>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Alamat Toko</label>
                <input type="text" name="alamat" class="form-control" value="<?= set_value('alamat') ?>" placeholder="Masukan Alamat Toko">
                <?= form_error('alamat', '<small class="text-danger ">', '</small>') ?>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Telpon Toko</label>
                <input type="text" name="tlp" class="form-control" value="<?= set_value('tlp') ?>" placeholder="Masukan Nomor Telpon Toko" maxlength="12" onkeypress="return Angkasaja(event)">
                <?= form_error('tlp', '<small class="text-danger ">', '</small>') ?>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Qty</label>
                <input type="text" name="qty" value="<?= $part['part_qtyDibutuhkan'] ?>" class="form-control" placeholder="Masukan Qty" readonly>
                <?= form_error('qty', '<small class="text-danger ">', '</small>') ?>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Harga Toko</label>
                <input type="text" name="harga" id="txt1" onkeyup="sum();" class="form-control" placeholder="Masukan Harga" onkeypress="return Angkasaja(event)>
                <?= form_error('harga', '<small class="text-danger ">', '</small>') ?>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Profit (%)</label>
                <input type="text" name="profit" id="txt2" onkeyup="sum();" value="<?= $part['partMaster_profit'] ?>" class="form-control" placeholder="Profit" onkeypress="return Angkasaja(event)">
                <?= form_error('profit', '<small class="text-danger ">', '</small>') ?>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Estimasi Harga Satuan RFP</label>
                <input type="text" name="satuanrfp" id="txt3" class="form-control" readonly>
                <?= form_error('satuanrfp', '<small class="text-danger ">', '</small>') ?>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Estimasi Part Waktu (Hari)</label>
                <input type="text" name="tglPart" class="form-control" onkeypress="return event.charCode >= 48 && event.charCode <=57">
                <?= form_error('tglPart', '<small class="text-danger ">', '</small>') ?>
            </div>
            <button type="submit" class="btn btn-primary">SIMPAN</button>
            <button type="button" class="btn btn-warning" onclick="history.back();">KEMBALI</button>
        </form>
    </div>
</div>

<script>
    function sum() {
        var txtFirstNumberValue = document.getElementById('txt1').value;
        var txtSecondNumberValue = document.getElementById('txt2').value;
        // var result = parseInt(txtFirstNumberValue) * (1 + parseInt(txtSecondNumberValue));
        var result = parseInt(txtFirstNumberValue * 1) + (parseInt(txtFirstNumberValue) * parseInt(txtSecondNumberValue) / 100);
        if (!isNaN(result)) {
            document.getElementById('txt3').value = result;
        }
    }
</script>