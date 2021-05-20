  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="background-color: #fdfdfd;">
      <!-- Content Header (Page header) -->
      <div class="content-header">
          <div class="container-fluid">
              <div class="row mb-2">
                  <div class="col-sm-6">
                      <h1 class="m-0 text-dark"><?= $title ?></h1>
                  </div><!-- /.col -->
                  <div class="col-sm-6">
                      <ol class="breadcrumb float-sm-right">
                          <li class="breadcrumb-item"><a href="<?= base_url('Gudang/Dashboard/') ?>">Home</a></li>
                          <li class="breadcrumb-item active"><?= $title ?></li>
                      </ol>
                  </div><!-- /.col -->
              </div><!-- /.row -->
          </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <section class="content">
          <div class="container-fluid">

              <?php

                if ($isi) {
                    $this->load->view($isi);
                }
                ?>

          </div>
      </section>
  </div>