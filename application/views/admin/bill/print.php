<?php
/**
 * halaman print bill / lunas
 */

$idorder = $order['order_id'];
$queryPart = $this->db->query("SELECT * FROM parts WHERE part_order_id = $idorder");
$jmlPart = $queryPart->num_rows();
// echo $jmlPart;

$invoice = $this->db->query("select * from invoice where invoice_kredit = $kredit_id");
$noinvoice = $invoice->row_array();

$no_invoice = str_pad($noinvoice['invoice_nomor'], 5, "0", STR_PAD_LEFT);
?>
<!-- title row -->
<div class="row">
  <div class="col-12">
    <h2 class="page-header">
      <small><?= $configurasi['config_namaBengkel'] ?></small>
      <img src="<?= base_url() ?>assets/images/<?= $configurasi['config_icon'] ?>" heigth="85px" width="85px" class="float-right">
    </h2>
  </div>
  <!-- /.col -->
</div>
<!-- info row -->
<div class="row invoice-info">
  <div class="col-sm-4 invoice-col">
    From
    <address>
      <strong><?= $nama = $this->session->userdata['nama'] ?></strong><br>
      <?= $configurasi['config_namaBengkel'] ?><br>
      <?= $configurasi['config_alamat'] ?><br>
      <?= $configurasi['config_telp'] ?>
    </address>
  </div>
  <!-- /.col -->
  <div class="col-sm-4 invoice-col">
    To
    <address>
      <strong><?= $order['pelanggan_nama'] ?></strong><br>
      <?= $order['pelanggan_alamat'] ?><br>
      <?= $order['pelanggan_hp'] ?><br>
      <?= $order['pelanggan_email'] ?>
    </address>
  </div>
  <!-- /.col -->
  <div class="col-sm-4 invoice-col">
    <?php
    $tglOrder = new Datetime(date($order['order_tgl']));
    // echo $tglOrder->format('Ymd');
    ?><br>
    <b>Invoice #00-<?= $no_invoice?></b><br>
    <br>
    <b>Jenis Sepeda :</b> <?= $order['order_jenisSepeda'] ?><br>
    <b>Jenis Perbaikan :</b> <?= $order['order_jenisPerbaikan'] ?><br>
  </div>
  <!-- /.col -->
</div>
<!-- /.row -->

<!-- Table row -->
<div class="row">
  <div class="col-12 table-responsive">
    <table class="table table-striped">
      <thead>
        <tr>
          <th>Nama Part</th>
          <th>Qty</th>
          <th>Harga Satuan</th>
          <th>Jumlah</th>
        </tr>
      </thead>
      <tbody>
        <?php
        if ($jmlPart > 0) {
          $total = 0;
          foreach ($part as $p) {
            $idpart = $p['part_id'];
            $queryPo = $this->db->query("SELECT * FROM purchaseorder where po_part_id = $idpart");
            $data = $queryPo->row_array();

            if ($p['part_harga'] == 0) {
              $harga = $data['po_hargaReq'];
            } else {
              if ($p['part_harga'] > $data['po_hargaReq']) {
                $harga = $p['part_harga'];
              } else {
                $harga = $data['po_hargaReq'];
              }
            }
        ?>
            <tr>
              <td><?= $p['partMaster_nama'] ?></td>
              <td><?= $p['part_qtyDibutuhkan'] ?></td>
              <td>Rp. <?= number_format($harga, 0, "", ".") ?></td>
              <td>Rp. <?= number_format($sub = $harga * $p['part_qtyDibutuhkan'], 0, "", ".") ?></td>
            </tr>
          <?php
            $total += $sub;
          }
          // echo $jPart;
          ?>
          <tr>
            <td colspan="3" class="text-bold text-center"> Total </td>
            <td>Rp. <?= number_format($total, 0, "", ".") ?></td>
          </tr>
        <?php
        } else {
          $total = 0;
        ?>
          <tr>
            <td colspan=4 class="text-center text-bold">Tidak ada pergantian parts</td>
          </tr>
        <?php
        }
        ?>
      </tbody>
    </table>
    <hr>
  </div>
  <!-- /.col -->
</div>
<!-- /.row -->

<div class="row">
  <!--<div class="row" style="background-color: #0000ff;">-->
  <!-- accepted payments column -->

  <?php
  $cicil = 0;
  foreach ($kredit as $kredit) {
    if ($kredit['kredit_bill_id'] == $bill['bill_id']) {
      $cicil += $kredit['kredit_bayar'];
    }
  }
  $sisa = $bill['bill_total'] - $cicil;
  ?>
  <div class="col-4">
    <p class="lead text-bold">Tanggal Penagihan <?= $bill['bill_tgl'] ?></p>

    <div class="table-responsive">
      <table class="table">
        <tr>
          <th style="width:50%">Total Harga Parts</th>
          <td>Rp. <?= number_format($total, 0, "", ".") ?></td>
        </tr>
        <tr>
          <th>Total Harga Jasa</th>
          <td>Rp. <?= number_format($bill['bill_jasa'], 0, "", ".") ?></td>
        </tr>
        <tr>
          <th>Total Tagihan</th>
          <td>Rp. <?= number_format($total + $bill['bill_jasa'], 0, "", ".") ?></td>
        </tr>
        <tr>
          <th>Total Sudah Dibayar</th>
          <td>Rp. <?= number_format($cicil, 0, "", ".") ?></td>
        </tr>

      </table>

    </div>
    <!-- /.col -->

  </div>
  <!-- /.row -->

  <!-- /.col -->
  <div class="col-8">
    <p style="visibility: hidden" class="lead text-bold"> . ?></p>
    <div class="table-responsive">
      <table class="table">
        <tr>
          <th style="width:50%">Jenis Pembayaran</th>
          <td><?= $bill['bill_jenisPembayaran'] ?></td>
        </tr>
        <tr>
          <th>Tanggal Pembayaran</th>
          <td><?= $bill['bill_tglPembayaran'] ?></td>
        </tr>
        <tr>
          <th>Catatan</th>
          <td><?= $bill['bill_keterangan'] ?></td>
        </tr>
        <tr>
          <?php if ($kredit['kredit_bayar'] >= 0): ?>
            <th style="width:50%"><h1 class="text-bold">Pembayaran</h1></th>
            <td><h1 class="text-bold">Rp. <?= number_format($kredit['kredit_bayar'], 0, "", ".") ?></h1></td>
          <?php else: ?>
            <th style="width:50%"><h1 class="text-bold">Kredit</h1></th>
            <td><h1 class="text-bold">Rp. <?= number_format($kredit['kredit_bayar'], 0, "", ".") ?></h1></td>
          <?php endif; ?>

        </tr>
      </table>

      <!-- <?php print_r($kredit) ?> -->
      <h3 class="text-center" style="background: #42E1AE"><?php if ($sisa == 0) {
                                                            echo "L U N A S";
                                                          } else if ($sisa > 0) {
                                                            echo "BELUM LUNAS";
                                                          } ?></h3>

    </div>
  </div>
</div>
<!-- ./wrapper -->
<script type="text/javascript">
  window.addEventListener("load", window.print());
</script>
