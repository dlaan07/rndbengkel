<?php
if ($this->session->flashdata('gagal')) {
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">';
    echo $this->session->flashdata('gagal');
    echo ' <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>
    </button>', '</div>';
}
if ($order['order_estimasiJasaHarga'] != "") {
    $order_id = $order['order_id'];
    redirect(base_url('Teknisi/Order/editPengecekan/') . $order_id);
}

$total = 0;
foreach ($partOrder as $key) {
    $barang = $key['part_partMaster_id'];
    $total += $barang;
}
// echo $total;
if ($total > 0) {
    $display = "block";
    $ya = "checked";
    $tidak = "";
    $value = 1;
    $disabled = "disabled";
} else {
    $display = "none";
    $ya = "";
    $tidak = "checked";
    $value = 2;
    $disabled = "";
}
?>

<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Detail Order Pelanggan</h3>
    </div>
    <div class="card-body" style="background-color: silver;">
        <table>
            <thead>
                <tr>
                    <th>Nama</th>
                    <td>: <?= $order['pelanggan_nama'] ?></td>
                </tr>
                <tr>
                    <th>Jenis Sepeda</th>
                    <td>: <?= $order['order_jenisSepeda'] ?></td>
                </tr>
                <tr>
                    <th>Warna Sepeda</th>
                    <td>: <?= $order['order_warnaSepeda'] ?></td>
                </tr>
                <tr>
                    <th>Jenis Perbaikan</th>
                    <td>: <?= $order['order_jenisPerbaikan'] ?></td>
                </tr>
                <tr>
                    <th>Keterangan</th>
                    <td>: <?= $order['order_keterangan'] ?></td>
                </tr>
            </thead>
        </table>
    </div>
</div>

<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Form Pengecekan</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->

    <!-- <form role="form" method="get"> -->
    <div class="card-body">
        <div class="form-group">
            <label for="exampleInputEmail1">Apakah diperlukan suku cadang dalam layanan/perbaikan ini ?</label>
            <div class="form-check">
                <input class="form-check-input" type="radio" value="1" name="jenis_perbaikan" onclick="displayResult(this.value)" onchange="showDiv(this)" <?= $ya ?>>
                <label class="form-check-label">Iya</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" value="2" name="jenis_perbaikan" onclick="displayResult(this.value)" onchange="showDiv(this)" <?= $tidak ?> <?= $disabled ?>>
                <label class="form-check-label">Tidak</label>

            </div>

            <?= form_error('cek', '<small class="text-danger ">', '</small>') ?>
        </div>
        <script>
            function displayResult(cek) {
                document.getElementById("result").value = cek;
            }
        </script>
        <script>
            function showDiv(elem) {
                // 
                if (elem.value == '1')
                    document.getElementById('result2').style.display = "block";
                if (elem.value == '2')
                    document.getElementById('result2').style.display = "none";
            }
        </script>
        <div class="row" id="result2" style="display: <?= $display ?>;">
            <div class=" col-12">
                <!-- Untuk menambahkan kebutuhan part  -->
                <form action="<?= base_url('Teknisi/PartOrder/tambahPartOrder') ?>" method="POST">
                    <input type="text" name="id" value="<?= $order['order_id'] ?>" hidden>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Suku Cadang ?</label><br>
                        <small>Suku cadang apa saja yang diperlukan ?</small>
                        <div class="row">
                            <div class="col-md-7">
                                <select name="part" class="form_control select2" style="width: 100%;">
                                    <!-- <option selected="selected">--Pilih Nama Pelanggan--</option> -->
                                    <option>--Pilih Part--</option>
                                    <?php foreach ($part as $p) {
                                    ?>
                                        <option value="<?= $p['partMaster_id'] ?>"><?= $p['partMaster_nama'] ?> || Stok = <?= $p['partMaster_stok'] ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                                <?= form_error('part', '<small class="text-danger ">', '</small>') ?>
                            </div>
                            <div class="col-md-1">
                                <label for="exampleInputEmail1">QTY :</label>
                            </div>
                            <div class="col-md-2">
                                <input type="text" name="qty" class="form-control" placeholder="Masukan Qty" onkeypress="return Angkasaja(event)">
                                <?= form_error('qty', '<small class="text-danger ">', '</small>') ?>
                            </div>
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-primary btn-block">SIMPAN</button>
                            </div>
                        </div>
                    </div>
                </form>

                <!-- untuk menampilkan kebutuhan part  -->
                <table class="table" style="background-color: silver;">
                    <?php foreach ($partOrder as $part) {
                    ?>
                        <tr>
                            <th><?= $part['partMaster_nama'] ?></th>
                            <th><?= $part['part_qtyDibutuhkan'] ?></th>
                            <th class="nav justify-content-end">
                                <form action="<?= base_url('Teknisi/PartOrder/hapus') ?>" method="POST">
                                    <input type="text" name="idpart" value="<?= $part['part_id'] ?>" hidden>
                                    <input type="text" name="part" value="<?= $part['part_partMaster_id'] ?>" hidden>
                                    <input type="text" name="qty" value="<?= $part['part_qtyDibutuhkan'] ?>" hidden>
                                    <input type="text" name="idorder" value="<?= $part['part_order_id'] ?>" hidden>
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <li class="fa fas fa-trash"></li>
                                    </button>
                                </form>
                            </th>
                        </tr>
                    <?php
                    }
                    ?>
                </table>
                <!-- Jika part belum terdaftar -->
                <div class="nav justify-content-center pt-3">
                    <!--<form action="<?= base_url('Teknisi/PartOrder/partBaru') ?>" method="POST">-->
                    <!--    <input type="text" name="idorder" value="<?= $order['order_id'] ?>" hidden>-->
                    <!--    <button type="submit" class="btn btn-primary">TAMBAH PART BARU</button>-->
                    <!--</form>-->
                    <a href="<?= base_url('Teknisi/PartOrder/partBaru/') . $order['order_id'] ?>" class="btn btn-primary">TAMBAH PART BARU</a>
                </div>
            </div>
        </div>

        <!-- Data estimasi -->
        <form>
            <div class="card-body table-responsive p-0 mb-3" style="height: 300px;">
                <table class="table table-head-fixed text-nowrap">
                    <thead>
                        <tr>
                            <td>Checked</td>
                            <td>Nama Jasa</td>
                            <td>Harga Jasa</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($jasa as $j) {
                        ?>
                            <tr>
                                <td><input type="checkbox" id="" name="" value=<?= $j['jasa_harga'] ?> class="kotak_info"></td>
                                <td><?= $j['jasa_nama'] ?></td>
                                <td><?= $j['jasa_harga'] ?></td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <p class="error text-danger">Pilih sedikitnya satu jenis service. </p>
            <input class="submit btn btn-success" type="submit" value="Total Biaya Jasa">
        </form>
        <form action="<?= base_url('Teknisi/PartOrder/tambahPengecekan') ?>" method="POST">
            <input type="text" id="namaPelanggan" name="nampel" value="<?= $order['pelanggan_nama'] ?>" hidden>
            <input type="text" id="emailPelanggan" name="emailpel" value="<?= $order['pelanggan_email'] ?>" hidden>
            <input type="text" id="result" name="cek" value="<?= $value ?>" hidden>
            <input type="text" name="idorder" value="<?= $order['order_id'] ?>" hidden>
            <div class="form-group" id="estimasiharga">
                <label for="exampleInputEmail1">Estimasi Biaya Jasa</label>
                <input type="text" name="jasa" class="form-control" id="txt3" placeholder="Estimasi Biaya Jasa" onkeypress="return event.charCode >= 48 && event.charCode <=57">
                <?= form_error('jasa', '<small class="text-danger ">', '</small>') ?>
            </div>
            <div class="form-group" id="estimasiwaktu">
                <label for="exampleInputEmail1">Estimasi Waktu Pengerjaan (Hari Kerja)</label>
                <input type="text" name="waktu" class="form-control" placeholder="Estimasi Waktu Pengerjaan" onkeypress="return event.charCode >= 48 && event.charCode <=57">
                <?= form_error('waktu', '<small class="text-danger ">', '</small>') ?>
            </div>
    </div>
    <!-- /.card-body -->

    <div class="card-footer">
        <button type="submit" class="btn btn-primary" id="tombolSimpan">SIMPAN</button>
    </div>
    </form>
</div>

<!-- <script>
    function sum() {
        var txtFirstNumberValue = document.getElementById('txt1').value;
        // var txtSecondNumberValue = document.getElementById('txt2').value;
        var result = parseInt(txtFirstNumberValue);
        // var result = parseInt(txtFirstNumberValue * 1) + (parseInt(txtFirstNumberValue) * parseInt(txtSecondNumberValue) / 100);
        if (!isNaN(result)) {
            document.getElementById('txt3').value = result;
        }
    }
</script> -->