<?php
session_start();
if (isset($_SESSION['password'])) {
  $username = $_SESSION['username'];
}
if (!isset($_SESSION['password'])) {
  header('location:login.php');
} else if (isset($_SESSION['password'])) {
  $username = $_SESSION['username'];
} ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>GAKedai Admin Dashboard</title>
  <link rel="icon" href="../images/logo_gakedai.png" type="image/png">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
  <div class="wrapper">

    <!-- Navbar -->
    <?php include_once 'navbar.php' ?>
    <!-- End Navbar -->

    <!-- Sidebar -->
    <?php include_once 'sidebar.php' ?>
    <!-- End Sidebar -->

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark">Dashboard</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <!-- Info boxes -->
          <div class="row">
            <div class="col-12 col-sm-6 col-md-3">
              <div class="info-box">
                <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>

                <div class="info-box-content">
                  <span class="info-box-text">Order</span>
                  <span class="info-box-number">0</span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-12 col-sm-6 col-md-3">
              <div class="info-box mb-3">
                <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>

                <div class="info-box-content">
                  <span class="info-box-text">New Members</span>
                  <span class="info-box-number">2</span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>
            <!-- /.col -->

            <!-- fix for small devices only -->
            <div class="clearfix hidden-md-up"></div>

            <div class="col-12 col-sm-6 col-md-3">
              <div class="info-box mb-3">
                <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>

                <div class="info-box-content">
                  <span class="info-box-text">Sales</span>
                  <span class="info-box-number">0</span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-12 col-sm-6 col-md-3">
              <div class="info-box mb-3">
                <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>

                <div class="info-box-content">
                  <span class="info-box-text">Total Members</span>
                  <span class="info-box-number">10</span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
          <!-- TABLE: LATEST ORDERS -->
          <div class="card">
            <div class="card-header border-transparent">
              <h3 class="card-title">Latest Orders</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                  <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
              <div class="table-responsive">
                <table class="table m-0">
                  <thead>
                    <tr>
                      <th scope="col">ID Order</th>
                      <th scope="col">Tanggal Order</th>
                      <th scope="col">Total Order</th>
                      <th scope="col">Status Bayar</th>
                      <th scope="col">Status Order</th>
                      <th scope="col">Bukti Bayar</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    include("connection.php");
                    $sql = "SELECT * FROM daftar_order ORDER BY id_order desc LIMIT 5";
                    $result = mysqli_query($conn, $sql);
                    while ($row = mysqli_fetch_array($result)) { ?>
                      <tr>
                        <td><b><?php echo $row['id_order']; ?></b></td>
                        <td><b><?php echo $row['tanggal_beli']; ?></b></td>
                        <td><b>Rp. <?php echo number_format($row['total_order']); ?></b></td>
                        <!-- If Else Status Bayar-->
                        <?php if ($row['status_pesan'] == 0) : ?>
                          <td style="color:red"><b><i class="fas fa-times fa-2x fa-pull-left"></i>Belum Lunas</b></td>
                        <?php elseif ($row['status_pesan'] == 1) : ?>
                          <td style="color:grey">
                            <b><i class="fa fa-spinner fa-2x fa-pull-left fa-spin"></i>Bukti bayar sedang dicek</b></td>
                        <?php elseif ($row['status_pesan'] == 2) : ?>
                          <td style="color:green"><b><i class="fas fa-check-circle fa-2x fa-pull-left"></i>Sudah Lunas</b></td>
                        <?php endif; ?>
                        <!-- If Else Status Order -->
                        <?php if ($row['status_tracking'] == 0) : ?>
                          <td style="color:red"><b><i class="fas fa-times fa-2x fa-pull-left"></i>Pesanan Belum Dibuat</b></td>
                        <?php elseif ($row['status_tracking'] == 1) : ?>
                          <td style="color:#E67E22"><b><i class="fas fa-lightbulb fa-2x fa-pull-left"></i>Pesanan Sedang Dibuat</b></td>
                        <?php elseif ($row['status_tracking'] == 2) : ?>
                          <td style="color:#D4AC0D"><b><i class="fas fa-truck fa-2x fa-pull-left"></i>Pesanan Sedang Diantar</b></td>
                        <?php elseif ($row['status_tracking'] == 3) : ?>
                          <td style="color:green"><b><i class="fas fa-check-circle fa-2x fa-pull-left"></i>Pesanan Sudah Diantar</b></td>
                        <?php endif; ?>
                        <!-- If Else Bukti Bayar -->
                        <?php if ($row['buktibayar'] > 0) : ?>
                          <td><u><a style="color:blue" href="../buktibayar/<?php echo $row['buktibayar']; ?>">
                                <h6 style="text-align:center;"><b>Lihat Bukti</b></h6>
                              </a></u>
                            <hr>
                            <a class="btn btn-danger btn-sm float-right" onclick="return confirmDel()" href="delete_buktibayar.php?delID=<?php echo $row['id_order']; ?>">
                              <i class="fas fa-trash">
                              </i>
                            </a>
                          <?php else : ?>
                          <td>Belum ada bukti bayar</td>
                        <?php endif; ?>
                      </tr>
                    <?php }; ?>
                  </tbody>
                </table>
              </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer clearfix">
              <a href="listOrder.php" class="btn btn-sm btn-secondary float-right">View All Orders</a>
            </div>
            <!-- /.card-footer -->
          </div>
          <!-- /.card -->

          <!-- /.col -->
          <!-- Main row -->
          <div class="row">
            <div class="card-body p-0">
              <!-- USERS LIST -->
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Latest Members</h3>

                  <div class="card-tools">
                    <span class="badge badge-danger">2 New Members</span>
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>
                    </button>
                  </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0">
                  <ul class="users-list clearfix">
                    <?php
                    include("connection.php");
                    $sql = "SELECT * FROM account_google ORDER BY id DESC";
                    $result = mysqli_query($conn, $sql);
                    while ($row = mysqli_fetch_array($result)) { ?>
                      <!--open of while -->
                      <li>
                        <img src="<?php echo $row['picture']; ?>" alt="User Image" width="150" height="150">
                        <a class="users-list-name"><?php echo $row['nama']; ?></a>
                        <span class="users-list-date">Today</span>
                      </li>
                    <?php }; ?>
                  </ul>
                  <!-- /.users-list -->
                </div>
                <!-- /.card-body -->
                <div class="card-footer text-center">
                  <a href="list_accGoogle.php">View All Users</a>
                </div>
                <!-- /.card-footer -->
              </div>
              <!--/.card -->
            </div>
            <!-- /.col -->
          </div>
        </div>
        <!-- /.row -->
        <!-- PRODUCT LIST -->
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Recently Added Menu</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
              <button type="button" class="btn btn-tool" data-card-widget="remove">
                <i class="fas fa-times"></i>
              </button>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body p-0">
            <ul class="products-list product-list-in-card pl-2 pr-2">
              <?php
              include("connection.php");
              $sql = "SELECT * FROM tblmenu ORDER BY id DESC LIMIT 5";
              $result = mysqli_query($conn, $sql);
              while ($row = mysqli_fetch_array($result)) { ?>
                <!--open of while -->
                <li class="item">
                  <div class="product-img">
                    <img src="../menu_image/<?php echo $row['photo']; ?>" alt="Product Image" class="img-size-50">
                  </div>
                  <div class="product-info">
                    <a href="javascript:void(0)" class="product-title"><?php echo $row['name']; ?>
                      <span class="badge badge-warning float-right">Rp. <?php echo $row['price']; ?></span></a>
                    <span class="product-description">
                      <?php echo $row['detail']; ?>
                    </span>
                  </div>
                </li>
              <?php }; ?>
              <!-- /.item -->
            </ul>
          </div>
          <!-- /.card-body -->
          <div class="card-footer text-center">
            <a href="listMakanan.php" class="uppercase">View All Products</a>
          </div>
          <!-- /.card-footer -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
  </div>
  <!--/. container-fluid -->
  </section>
  <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2014-2019 <a href="http://adminlte.io">AdminLTE.io</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.0.5
    </div>
  </footer>
  </div>
  <!-- ./wrapper -->

  <!-- REQUIRED SCRIPTS -->
  <!-- jQuery -->
  <script src="plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap -->
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- overlayScrollbars -->
  <script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
  <!-- AdminLTE App -->
  <script src="dist/js/adminlte.js"></script>

  <!-- OPTIONAL SCRIPTS -->
  <script src="dist/js/demo.js"></script>

  <!-- PAGE PLUGINS -->
  <!-- jQuery Mapael -->
  <script src="plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
  <script src="plugins/raphael/raphael.min.js"></script>
  <script src="plugins/jquery-mapael/jquery.mapael.min.js"></script>
  <script src="plugins/jquery-mapael/maps/usa_states.min.js"></script>
  <!-- ChartJS -->
  <script src="plugins/chart.js/Chart.min.js"></script>

  <!-- PAGE SCRIPTS -->
  <script src="dist/js/pages/dashboard2.js"></script>
</body>

</html>