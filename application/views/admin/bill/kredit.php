<?php
/**
 * halaman print cicilan
 */

$idorder = $kredit['bill_order_id'];
$queryPart = $this->db->query("SELECT * FROM parts WHERE part_order_id = $idorder");
$jmlPart = $queryPart->num_rows();
// echo $jmlPart;

$invoice = $this->db->query("select * from invoice where invoice_kredit = $kredit_id");
$noinvoice = $invoice->row_array();

$bill = $kredit['bill_id'];
$kreditid = $this->input->get('k');
$cicilan = $this->db->query("select * from kredit where kredit_bill_id = $bill");
$cicilke = $cicilan->result_array();


if ($noinvoice['invoice_nomor'] < 10) {
    $no_invoice = '0000'.$noinvoice['invoice_nomor'];
} else if ($noinvoice['invoice_nomor'] < 100) {
    $no_invoice = '000'.$noinvoice['invoice_nomor'];
}else if ($noinvoice['invoice_nomor'] < 1000) {
    $no_invoice = '00'.$noinvoice['invoice_nomor'];
} else if ($noinvoice['invoice_nomor'] < 10000) {
    $no_invoice = '0'.$noinvoice['invoice_nomor'];
} else if ($noinvoice['invoice_nomor'] < 100000) {
    $no_invoice = $noinvoice['invoice_nomor'];
}

$bayarke = 0;
$total_bayar = 0;
foreach($cicilke as $key){
    if($key['kredit_id'] <= $kreditid){
        $bayar = 1;
        $tb = $key['kredit_bayar'];
        $bayarke += $bayar;
        $total_bayar += $tb;
    }
}
// echo $bayarke;
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
      <strong><?= $kredit['pelanggan_nama'] ?></strong><br>
      <?= $kredit['pelanggan_alamat'] ?><br>
      <?= $kredit['pelanggan_hp'] ?><br>
      <?= $kredit['pelanggan_email'] ?>
    </address>
  </div>
  <!-- /.col -->
  <div class="col-sm-4 invoice-col">
    <?php
    $tglOrder = new Datetime(date($kredit['order_tgl']));
    // echo $tglOrder->format('Ymd');
    ?><br>
    <b>Invoice #0<?= $bayarke ?>-<?= $no_invoice ?></b><br>
    <br>
    <b>Jenis Sepeda :</b> <?= $kredit['order_jenisSepeda'] ?><br>
    <b>Jenis Perbaikan :</b> <?= $kredit['order_jenisPerbaikan'] ?><br>
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
        $this->db->select('*');
        $this->db->from('parts');
        $this->db->join('partmaster', 'parts.part_partMaster_id = partmaster.partMaster_id');
        $this->db->join('repair_order', 'parts.part_order_id= repair_order.order_id');
        $this->db->where('part_order_id', $kredit['order_id']);
        $this->db->where('part_bengkel', $this->session->userdata('bengkel'));
        $query = $this->db->get();
        $part = $query->result_array();

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
  $sisa = $kredit['bill_total'] - $kredit['kredit_bayar'];

  ?>
  <div class="col-5">
    <!--<p class="lead text-bold">&nbsp</p>-->

    <p class="lead text-bold">Pembayaran Rp. <?= number_format($kredit['kredit_bayar'], 0, "", ".") ?></p>
    <div class="table-responsive">
      <table class="table">
        <tr>
          <th style="width:50%">Jenis Pembayaran</th>
          <td><?= $kredit['kredit_metode'] ?></td>
        </tr>
        <tr>
          <th>Tanggal Pembayaran</th>
          <td><?= $kredit['kredit_tgl'] ?></td>
        </tr>
        <tr>
          <th>Catatan</th>
          <td><?= $kredit['kredit_catatan'] ?></td>
        </tr>
      </table>
      <h3 class="text-center" style="background: #42E1AE"><?php if ($sisa == 0) {
                                                            echo "L U N A S";
                                                          } else if ($sisa > 0) {
                                                            echo "BELUM LUNAS";
                                                          } ?></h3>
    </div>
  </div>

  <div class="col-1"></div>
  <!-- /.col -->
  <div class="col-6">
    <p class="lead text-bold">Tanggal Penagihan <?= $kredit['bill_tgl'] ?></p>

    <div class="table-responsive">
      <table class="table">
        <tr>
          <th style="width:50%">Total Harga Parts</th>
          <td>Rp. <?= number_format($total, 0, "", ".") ?></td>
        </tr>
        <tr>
          <th>Total Harga Jasa</th>
          <td>Rp. <?= number_format($kredit['bill_jasa'], 0, "", ".") ?></td>
        </tr>
        <tr>
          <th>Total Penagihan</th>
          <td>Rp. <?= number_format($total + $kredit['bill_jasa'], 0, "", ".") ?></td>
        </tr>
        <tr>
            <th>Total Pembayaran</th>
            <td>Rp. <?= number_format($total_bayar, 0, "", ".") ?><br>
                Sisa <?= number_format($total + $kredit['bill_jasa'] - $total_bayar, 0, "", ".") ?>
            </td>
        </tr>
        <!--<tr>-->
        <!--  <th><h4>Pembayaran</h4></th>-->
        <!--  <td><h4>Rp. <?= number_format($kredit['kredit_bayar'], 0, "", ".") ?></h4></td>-->
        <!--</tr>-->
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
