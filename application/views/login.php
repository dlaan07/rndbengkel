<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Login Bengkel Intala</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="<?= base_url('assets/dist/img/')?>intala2.png" rel="shortcut icon">
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
    
    <style>
        #bengkel-bg {

            background-image: url("<?= base_url() ?>assets/dist/img/bg1.jpg");
            /*background-repeat: no-repeat center fixed;*/

            background-size: cover;
            background-attachment: fixed;
        }

        #box1 {
            background: rgba(0, 0, 0, 0.4);
        }
    </style>
</head>

<body class="hold-transition login-page" id="bengkel-bg">
    <!-- <small class="text-center mb-3" style="font-size:14px"><?= $configurasi['config_alamat'] ?> | Telepon <?= $configurasi['config_telp'] ?></small> -->
    <div class="login-box">
        <!-- /.login-logo -->
        <!--<div class="card">-->
            <div class="card-body login-card-body" id="box1">
                <div class="login-logo">
                     <img src="<?= base_url('assets/dist/img/')?>intala2.png" class="img-fluid" alt="" width="120" height="120">
                    <!--<hr>-->
                </div>
                <p class="login-box-msg" style="color: white">Sign in to start your session</p>
                <?php
                if ($this->session->flashdata('sukses')) {
                    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">';
                    echo $this->session->flashdata('sukses');
                    echo ' <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>
    </button>', '</div>';
                }
                ?>

                <form action="<?= base_url('Auth/Login/masuk') ?>" method="post">
                    <div class="input-group mb-3">
                        <input type="email" name="email" class="form-control" placeholder="Email" >
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" name="password" class="form-control" placeholder="Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>

                <!-- <p class="mb-1">
                    <a href="forgot-password.html">I forgot my password</a>
                </p>
                <p class="mb-0">
                    <a href="register.html" class="text-center">Register a new membership</a>
                </p> -->
            </div>
            <!-- /.login-card-body -->
        <!--</div>-->
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="<?= base_url() ?>assets/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="<?= base_url() ?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?= base_url() ?>assets/dist/js/adminlte.min.js"></script>

</body>

</html>