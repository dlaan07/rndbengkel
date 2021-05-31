  <?php
    $id = $this->session->userdata('id');
    $nama = $this->session->userdata('nama');
    $email = $this->session->userdata('email');
    $username = $this->session->userdata('username');
    ?>
  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4" style="background: linear-gradient(to top, #000000 70%, #0085ff 100%);">
      <!-- Brand Logo -->
      <a href="<?= base_url('Admin/Dashboard') ?>" class="brand-link text-center">
          <img src=" <?= base_url() ?>assets/images/<?= $configurasi['config_icon'] ?>" width="50" height="50" alt="AdminLTE Logo" class="img-circle mx-auto d-block elevation-3" style="opacity: .8">
          <span class="brand-text font-weight-bold">HI SA !</span><br>
          <span class="brand-text font-weight-bold"><?= $nama ?></span>
          <!-- <p>eko aprianto</p> -->
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
          <!-- Sidebar user panel (optional) -->
          <!-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
              <div class="image">
                  <img src="<?= base_url() ?>assets/dist/img/iconbikerepair.png" class="img-circle elevation-2" alt="User Image">
              </div>
              <div class="info">
                  <a href="<?= base_url() ?>" class="d-block">Alexander Pierce</a>
              </div>
          </div> -->

          <!-- Sidebar Menu -->
          <nav class="mt-2">
              <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                  <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

                  <li class="nav-item">
                      <a href="<?= base_url('Admin/Dashboard') ?>" class="nav-link">
                          <i class="nav-icon fas fa-tachometer-alt"></i>
                          <p>
                              Dashboard
                          </p>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="<?= base_url('Admin/Pelanggan') ?>" class="nav-link">
                          <i class="nav-icon fas fa-users"></i>
                          <p>
                              Pelanggan
                          </p>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="<?= base_url('Admin/Order') ?>" class="nav-link">
                          <i class="nav-icon fas fa-clipboard-list"></i>
                          <p>
                              Order
                          </p>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="<?= base_url('Admin/Validasi') ?>" class="nav-link">
                          <i class="nav-icon fas fa-paper-plane"></i>
                          <p>
                              Validasi Pelanggan
                          </p>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="<?= base_url('Admin/Perbaikan') ?>" class="nav-link">
                          <i class="nav-icon fas fa-tools"></i>
                          <p>
                              Perbaikan
                          </p>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="<?= base_url('Admin/Tracking') ?>" class="nav-link">
                          <i class="nav-icon fas fa-map-marked-alt"></i>
                          <p>
                              Tracking Barang
                          </p>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="#" class="nav-link ">
                          <i class="nav-icon fas fa-cash-register"></i>
                          <p>
                              Bill
                              <i class="fas fa-angle-left right"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview ">
                          <li class="nav-item ">
                              <a href="<?= base_url('Admin/Bill') ?>" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>
                                      Bill
                                  </p>
                              </a>
                          </li>
                          <li class="nav-item ">
                              <a href="<?= base_url('Admin/Dp') ?>" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>
                                      DP
                                  </p>
                              </a>
                          </li>
                      </ul>
                  </li>
                  <li class="nav-item">
                      <a href="<?= base_url('Auth/Login/logout') ?>" class="nav-link">
                          <i class="nav-icon fas fa-sign-out-alt"></i>
                          <p>
                              Logout
                          </p>
                      </a>
                  </li>
              </ul>
          </nav>
          <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
  </aside>
