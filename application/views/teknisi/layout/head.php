<?php
$this->user_login->cek_login_teknisi();
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?= $title ?> | <?= $configurasi['config_namaBengkel'] ?></title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="<?= base_url('assets/images/') . $configurasi['config_icon'] ?>" rel="shortcut icon">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- daterange picker -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/daterangepicker/daterangepicker.css">
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Bootstrap Color Picker -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">
    <!-- Tempusdominus Bbootstrap 4 -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <!-- Bootstrap4 Duallistbox -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/dist/css/adminlte.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

    <!-- DataTables -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/datatables-bs4/css/dataTables.bootstrap4.css">

    <script type="text/javascript" src="https://code.jquery.com/jquery-latest.js">
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.error').hide();
            $('#estimasiharga').hide();
            $('#estimasiwaktu').hide();
            $('#tombolSimpan').hide();
            $('.submit').click(function(event) {
                event.preventDefault();
                var hitung = 0;
                var total = 0;

                $('form').find(':checkbox').each(function() {
                    if ($(this).is(':checked')) {
                        hitung++;
                        total = total + parseInt($(this).val());
                    }
                });
                if (hitung == 0) {
                    // $('p.hasil').hide();
                    $('.error').show();
                    document.getElementById('txt3').value = "";
                } else {
                    $('.error').hide();
                    $('#estimasiharga').show();
                    $('#estimasiwaktu').show();
                    $('#tombolSimpan').show();
                    // $('p.hasil').show();
                    // $('p.hasil').text('Total Rp. ' + total);
                    // var result = parseInt(txtFirstNumberValue);
                    // var result = parseInt(txtFirstNumberValue * 1) + (parseInt(txtFirstNumberValue) * parseInt(txtSecondNumberValue) / 100);
                    // if (!isNaN(result)) {
                    document.getElementById('txt3').value = total;
                    // }
                }
            });
        });
    </script>
</head>