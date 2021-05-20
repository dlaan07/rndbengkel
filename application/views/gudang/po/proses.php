<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Detail Part Order</h3>
    </div>
    <div class="card-body">
        <form action="<?= base_url('Gudang/Purchaseorder/simpanPO') ?>" method="POST">
            <div class="form-group">
                <label for="exampleInputEmail1">Nama Part</label>
                <input type="text" value="<?= $part['partMaster_nama'] ?>" class="form-control" readonly>
                <input type="text" name="idorder" value="<?= $part['part_order_id'] ?>" class="form-control" hidden>
                <input type="text" name="idpart" value="<?= $part['part_id'] ?>" class="form-control" hidden>
                <input type="text" name="idpo" value="<?= $part['po_id'] ?>" class="form-control" hidden>
                <input type="text" name="idpartmaster" value="<?= $part['part_partMaster_id'] ?>" class="form-control" hidden>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Nama Toko</label>
                <input type="text" name="toko" value="<?= $part['po_namaToko'] ?>" class="form-control" readonly>
                <?= form_error('toko', '<small class="text-danger ">', '</small>') ?>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Alamat Toko</label>
                <input type="text" name="alamat" value="<?= $part['po_AlamatToko'] ?>" class="form-control" readonly>
                <?= form_error('alamat', '<small class="text-danger ">', '</small>') ?>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Telpon Toko</label>
                <input type="text" name="tlp" value="<?= $part['po_contactToko'] ?>" class="form-control" readonly>
                <?= form_error('tlp', '<small class="text-danger ">', '</small>') ?>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Qty</label>
                <input type="text" name="qty" value="<?= $part['po_qty'] ?>" class="form-control" placeholder="Qty" readonly>
                <?= form_error('qty', '<small class="text-danger ">', '</small>') ?>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Qty Stok</label>
                <input type="number" name="QtyStok" value="0" class="form-control" placeholder="Qty Stok" onkeypress="return Angkasaja(event)">
                <?= form_error('stok', '<small class="text-danger ">', '</small>') ?>
            </div>
            <div class="form-group" hidden>
                <label for="exampleInputEmail1">Stok</label>
                <input type="text" name="stok" value="<?= $part['partMaster_stok'] ?>" class="form-control" placeholder="Masukan Nama Toko" readonly>
                <?= form_error('qty', '<small class="text-danger ">', '</small>') ?>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Tanggal Pesan</label>
                <input type="date" name="tglPesan" class="form-control">
                <?= form_error('tglPesan', '<small class="text-danger ">', '</small>') ?>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Harga Toko</label>
                <input type="text" name="harga" id="txt1" onkeyup="sum();" value="<?= $part['po_harga'] ?>" class="form-control" placeholder="Masukan Harga" onkeypress="return Angkasaja(event)">
                <?= form_error('harga', '<small class="text-danger ">', '</small>') ?>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Profit (%)</label>
                <input type="text" name="profit" id="txt2" onkeyup="sum();" value="<?= $part['partMaster_profit'] ?>" class="form-control" readonly>
                <?= form_error('profit', '<small class="text-danger ">', '</small>') ?>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Harga Satuan</label>
                <input type="text" name="satuanrfp" value="<?= $part['po_hargaReq'] ?>" id="txt3" class="form-control" readonly>
                <?= form_error('satuanrfp', '<small class="text-danger ">', '</small>') ?>
            </div>
            <button type="submit" class="btn btn-primary">SIMPAN</button>
            <!--<button type="button" class="btn btn-warning" onclick="history.back();">KEMBALI</button>-->
            <a href=" <?= base_url('Gudang/Purchaseorder/detail/').$part['part_order_id']?> " class="btn btn-warning">KEMBALI</a>
                                            
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