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
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/dist/css/adminlte.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>

<body class="hold-transition login-page">
    <div class="login-logo">
        <img src="<?= base_url('assets/images/').$configurasi['config_icon'] ?>" class="img-fluid" alt="" width="120" height="120">
        <hr>
    </div>
    <h4 class="text-center">
        <strong>
            <a href="#" class="text-dark"><?= $configurasi['config_namaBengkel'] ?></a>
        </strong>
    </h4>
    <small class="text-center mb-3" style="font-size:14px"><?= $configurasi['config_alamat'] ?> | Telepon <?= $configurasi['config_telp'] ?></small>

    <?php
    if (isset($isi) == "Konfirmasi Gagal") { ?>

        <h3>Maaf, anda telah melakukan konfirmasi sebelumnya, untuk info lebih lanjut silahkan hubungi <?= $configurasi['config_telp'] ?></h3>
    <?php
    } else {
    ?>
        <h3>Terimakasih telah melakukan order, konfirmasi anda akan segera kami proses</h3>
    <?php
    }
    ?>

    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="<?= base_url() ?>assets/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="<?= base_url() ?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?= base_url() ?>assets/dist/js/adminlte.min.js"></script>

</body>

</html>