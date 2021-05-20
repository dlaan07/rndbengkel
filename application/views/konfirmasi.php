<!DOCTYPE html>
<html>

<head>
    <style>
        .button {
          
          border: none;
          color: white;
          padding: 15px 32px;
          text-align: center;
          text-decoration: none;
          display: inline-block;
          font-size: 12px;
          margin: 4px 2px;
          cursor: pointer;
          -webkit-transition-duration: 0.4s; /* Safari */
          transition-duration: 0.4s;
        }
        
        .button1 {
          box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);
        }
        
        .hijau {
            background-color: #4CAF50;
        }
        
        .merah{
            background-color: #ff3f34;
        }
        
        body {
            background-color: #cecece;
        }
        
        table {
          border-collapse: collapse;
          width: 50%;
        }
        
        th, td {
          padding: 8px;
          text-align: left;
          border-bottom: 1px solid #ddd;
        }
        
        tr:hover {background-color:#f5f5f5;}
    </style>
</head>

<body class="hold-transition login-page">
    
    

<?php
$idorder = $order['order_id'];
$queryPart = $this->db->query("SELECT * FROM parts WHERE part_order_id = $idorder");
$jmlPart = $queryPart->num_rows();
// echo $jmlPart;

$total = 0;
?>

<div class="row">
    <div class="col-md-5 col-sm-12">
        <div class="card card-primary elevation-5">
            <div class="card-header">
                <h3 class="card-title">Detail Pelanggan</h3><hr>
            </div>
            <div class="card-body">
                <table class="table">
                    <tbody>
                        <tr>
                            <td class="text-bold">
                                ID Pelanggan
                            </td>
                            <td>
                                PLGN-00<?= $order['pelanggan_id'] ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-bold">
                                ID Order
                            </td>
                            <td>
                                ORDER-00<?= $order['order_id'] ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-bold">
                                Nama Pelanggan
                            </td>
                            <td>
                                <?= $order['pelanggan_nama'] ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-bold">
                                Alamat Pelanggan
                            </td>
                            <td>
                                <?= $order['pelanggan_alamat'] ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-bold">
                                Telp Pelanggan
                            </td>
                            <td>
                                <?= $order['pelanggan_hp'] ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-bold">
                                Email Pelanggan
                            </td>
                            <td>
                                <?= $order['pelanggan_email'] ?>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-7 col-sm-12">
        <div class="card card-info elevation-5">
            <div class="card-body">
                <div class="card">
                    <div class="card-body">
                        <h3>Data Sepeda</h3><hr>
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td class="text-bold">Jenis Sepeda</td>
                                    <td><?= $order['order_jenisSepeda'] ?></td>
                                </tr>
                                <tr>
                                    <td class="text-bold">Warna Sepeda</td>
                                    <td><?= $order['order_warnaSepeda'] ?></td>
                                </tr>
                                <tr>
                                    <td class="text-bold">Keterangan</td>
                                    <td><?= $order['order_keterangan'] ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <?php
                if ($jmlPart > 0) {
                ?>
                    <div class="card">
                        <div class="card-body">
                            <h3>Data Parts</h3>
                            <hr>
                            <table class="table">
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
                                            <td><?= number_format($harga, 0, "", ".") ?></td>
                                            <td><?= number_format($sub = $harga * $p['part_qtyDibutuhkan'], 0, "", ".") ?></td>
                                        </tr>
                                    <?php
                                        $total += $sub;
                                    }
                                    // echo $jPart;
                                    ?>
                                    <tr>
                                        <td colspan="3" class="text-bold text-center"> Total </td>
                                        <td><?= number_format($total, 0, "", ".") ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                <?php
                }
                ?>
                <div class="card">
                    <div class="card-body">
                        <h3>Data Estimasi</h3><hr>
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td>
                                        Estimasi Perbaikan Selesai
                                    </td>
                                    <td>
                                        <?php
                                            $tglPo = $this->db->query("SELECT * FROM purchaseorder JOIN parts ON purchaseorder.po_part_id = parts.part_id WHERE part_order_id = $idorder ORDER BY po_estimasiPartsWaktu DESC LIMIT 1");
                                            $tglEstimasi = $tglPo->row_array();
                                            
                                            $waktu = $order['order_estimasiJasaWaktu'] + $tglEstimasi['po_estimasiPartsWaktu'];
                                            echo $waktu . " Hari karja setelah melakukan konfirmasi";
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-bold">Estimasi Harga Jasa</td>
                                    <td><?= number_format($order['order_estimasiJasaHarga'], 0, "", ".") ?></td>
                                </tr>
                                <tr>
                                    <td class="text-bold">Estimasi Harga Parts</td>
                                    <td><?= number_format($total, 0, "", ".") ?></td>
                                </tr>
                                <tr>
                                    <td class="text-bold">Total Estimasi</td>
                                    <td><?= number_format($order['order_estimasiJasaHarga'] + $total, 0, "", ".") ?></td>
                                </tr>
                            </tbody>
                        </table>
                        <span class="badge badge-info text-bold" >Harga dapat berubah setelah perbaikan</span>
                    </div>
                </div>


                <h4>Silahkan klik tombol berikut untuk proses selanjutnya :</h4><br>
                <table>
                    <tr>
                        <td>
                            <a href="bengkel.intala.com/Validasi/validasiSetuju?token=<?= $order['order_id'] ?>&bengkel=<?=$order['order_bengkel']?>"><button class="button button1 hijau"> Setuju </button></a>
                        </td>
                        <td>
                            <a href="bengkel.intala.com/Validasi/validasiCancel?token=<?= $order['order_id'] ?>&bengkel=<?=$order['order_bengkel']?>"><button class="button button1 merah"> Tidak Setuju </button></a>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>

</body>

</html>