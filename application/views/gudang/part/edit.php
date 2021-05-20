<div class="card card-primary elevation-5">
    <div class="card-header">
        <h3 class="card-title">Edit Parts</h3>
    </div>
    <div class="card-body">
        <form action="<?= base_url('Gudang/Parts/edit') ?>" method="POST">
            <?php
            $partId = $part['partMaster_id'];
            $query = $this->db->query("SELECT * FROM purchaseorder JOIN parts ON purchaseorder.po_part_id = parts.part_id WHERE part_partMaster_id = $partId AND po_tracking != '' ORDER BY po_id DESC LIMIT 1");
            $dataPo = $query->row_array();
            // foreach ($dataPo as $po) {
            //     $tglPesan = $po['po_tglPesan'];
            //     $hargaPo = $po['po_harga'];
            // }
            ?>
            <input type="text" name="id" value="<?= $part['partMaster_id'] ?>" hidden>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nama Part</label>
                        <input type="text" name="part" class="form-control" value="<?= $part['partMaster_nama'] ?>" placeholder="Nama Part" readonly>
                        <?= form_error('part', '<small class="text-danger ">', '</small>') ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Harga PO</label>
                        <input type="text" class="form-control" value="<?= $dataPo['po_harga'] ?>" readonly>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Tanggal Update PO</label>
                        <input type="text" class="form-control" value="<?= $dataPo['po_tglPesan'] ?>" readonly>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Keuntungan</label>
                        <input type="text" name="profit" value="<?= $part['partMaster_profit'] ?>%" class="form-control" readonly>
                        <?= form_error('profit', '<small class="text-danger ">', '</small>') ?>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Harga Master</label>
                        <input type="text" name="harga" value="<?= $part['partMaster_harga'] ?>" class="form-control" placeholder="Harga Barang" onkeypress="return Angkasaja(event)">
                        <?= form_error('harga', '<small class="text-danger ">', '</small>') ?>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Stok</label>
                        <input type="number" name="stok" class="form-control" value="<?= $part['partMaster_stok'] ?>" placeholder="Jumlah Stok Barang" onkeypress="return Angkasaja(event)"> 
                        <?= form_error('stok', '<small class="text-danger ">', '</small>') ?>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Par</label>
                        <input type="text" name="par" value="<?= $part['partMaster_par'] ?>" class="form-control" placeholder="Par Barang" onkeypress="return Angkasaja(event)">
                        <?= form_error('par', '<small class="text-danger ">', '</small>') ?>
                    </div>
                </div>
                <div class="col-md-1">
                    <div class="form-group">
                        <label for="">&nbsp</label>
                        <button type="submit" class="btn btn-primary">UPDATE</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>