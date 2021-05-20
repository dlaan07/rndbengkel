<?php
$idorder = $order['order_id'];
$kreditid = $kredit['kredit_id'];
$queryPart = $this->db->query("SELECT * FROM parts WHERE part_order_id = $idorder");
$jmlPart = $queryPart->num_rows();
// echo $jmlPart;

// $invoice = $this->db->query("SELECT * FROM invoice WHERE $idorder ORDER BY invoice_id DESC LIMIT 1");
// $noinvoice = $invoice->row_array();
// $kredit_id = $asdasd["kredit_id"];
// $invoice = $this->db->query("select * from invoice where invoice_kredit = $kredit");
// $noinvoice = $invoice["kredit_id"];
$invoice = $this->db->query("select * from invoice where invoice_kredit = $kreditid");
$noinvoice = $invoice->row_array();

/*
padding nomor invoice
 */
// if ($noinvoice['invoice_nomor'] < 10) {
//     $no_invoice = '0000'.$noinvoice['invoice_nomor'];
// } else if ($noinvoice['invoice_nomor'] < 100) {
//     $no_invoice = '000'.$noinvoice['invoice_nomor'];
// }else if ($noinvoice['invoice_nomor'] < 1000) {
//     $no_invoice = '00'.$noinvoice['invoice_nomor'];
// } else if ($noinvoice['invoice_nomor'] < 10000) {
//     $no_invoice = '0'.$noinvoice['invoice_nomor'];
// } else if ($noinvoice['invoice_nomor'] < 100000) {
//     $no_invoice = $noinvoice['invoice_nomor'];
// }

$no_invoice = str_pad($noinvoice['invoice_nomor'], 5, "0", STR_PAD_LEFT);
?>
<!-- title row -->
<div class="row">
  <div class="col-12">
    <h2 class="page-header">
      <!--<i class="fas fa-globe"></i> AdminLTE, Inc.-->
      <small><?= $configurasi['config_namaBengkel'] ?></small>
      <img src="<?= base_url() ?>assets/images/<?= $configurasi['config_icon'] ?>" heigth="85px" width="85px" class="float-right">
    </h2>
  </div>
  <!-- /.col -->
</div>
<!-- info row -->
<div class="row invoice-info">
  <div class="col-sm-4 invoice-col">
    <!-- <h1><?php echo join("\n", $kredit); ?></h1> -->
    <!-- <h1><?php echo $kreditid; ?></h1> -->
    <!-- <h1><?php echo print_r($kredit); ?></h1> -->
    From
    <address>
      <strong><?= $nama = $this->session->userdata['nama'] ?></strong><br>
      <?= $configurasi['config_namaBengkel'] ?><br>
      <?= $configurasi['config_alamat'] ?><br>
      <?= $configurasi['config_telp'] ?>
    </address>
  </div>
  <!-- /.col
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

    <b>Invoice #99-<?= $no_invoice ?></b><br>
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
  $sisa = $total + $order['order_estimasiJasaHarga'] - $kredit['kredit_bayar'];
  ?>
  <div class="col-5">
    <div class="mt-5 mb-5">&nbsp</div>
    <h3 class="text-center mt-5" style="background: #42E1AE">Down Payment</h3>
  </div>

  <div class="col-1"></div>
  <!-- /.col -->
  <div class="col-6">
    <p class="lead text-bold">Tanggal DP <?= date('d-m-Y') ?></p>

    <div class="table-responsive">
      <table class="table">
        <tr>
          <th style="width:50%">Estimasi Harga Parts</th>
          <td>Rp. <?= number_format($total, 0, "", ".") ?></td>
        </tr>
        <tr>
          <th>Estimasi Harga Jasa</th>
          <td>Rp. <?= number_format($order['order_estimasiJasaHarga'], 0, "", ".") ?></td>
        </tr>
        <tr>
          <th>Total Estimasi</th>
          <td>Rp. <?= number_format($total + $order['order_estimasiJasaHarga'], 0, "", ".") ?></td>
        </tr>
        <tr>
          <th>Down Payment</th>
          <td>Rp. <?= number_format($kredit['kredit_bayar'], 0, "", ".") ?> <?php if ($sisa >= 0) {
                                                                        echo ' <span class="badge badge-info">Sisa Rp. ' . number_format($sisa, 0, "", ".") . '</span>';
                                                                      } ?></td>
        </tr>
      </table>
    </div>
    <!-- /.col -->

  </div>
  <!-- /.row -->
</div>
<!-- ./wrapper -->
<script type="text/javascript">
  window.addEventListener("load", window.print());
</script>
