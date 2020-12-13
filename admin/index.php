<?php include_once 'admin_includes.php' ?>
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
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
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
                        <!-- Order Box -->
                        <div class="col-12 col-sm-6 col-md-3">
                            <?php $sql_1 = "SELECT * FROM daftar_order WHERE status_tracking ='3'";
                            $result_1 = mysqli_query($conn, $sql_1);
                            $row_1 = mysqli_num_rows($result_1); ?>
                            <div class="small-box bg-success">
                                <div class="inner">
                                    <h3><?php echo $row_1; ?></h3>

                                    <p>Total Finished Order</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-ios-cart"></i>
                                </div>
                                <a href="listOrderHistory.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- Total Menu Box -->
                        <div class="col-12 col-sm-6 col-md-3">
                            <?php $sql_2 = "SELECT * FROM tblmenu";
                            $result_2 = mysqli_query($conn, $sql_2);
                            $row_2 = mysqli_num_rows($result_2); ?>
                            <div class="small-box bg-info">
                                <div class="inner">
                                    <h3><?php echo $row_2; ?></h3>

                                    <p>Total Menu</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-ios-bookmarks"></i>
                                </div>
                                <a href="listMakanan.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- User Regist Box -->
                        <div class="col-12 col-sm-6 col-md-3">
                            <?php $sql_3 = "SELECT * FROM account_google";
                            $result_3 = mysqli_query($conn, $sql_3);
                            $row_3 = mysqli_num_rows($result_3); ?>
                            <div class="small-box bg-primary">
                                <div class="inner">
                                    <h3><?php echo $row_3; ?></h3>

                                    <p>User Registrations</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-person-add"></i>
                                </div>
                                <a href="list_accGoogle.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- Income / Rev. Box -->
                        <div class="col-12 col-sm-6 col-md-3">
                            <?php $sql_4 = "SELECT SUM(total_order) AS value_sum FROM daftar_order WHERE status_tracking='3'";
                            $result_4 = mysqli_query($conn, $sql_4);
                            $row_4 = mysqli_fetch_assoc($result_4);
                            $total_revenue = $row_4['value_sum']; ?>
                            <div class="small-box bg-warning">
                                <div class="inner">
                                    <h3><?php echo rupiah($total_revenue); ?></h3>

                                    <p>Income / Revenue</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-money-bill-wave"></i>
                                </div>
                                <a href="listOrderHistory.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                    </div>
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
                        <?php $sql = "SELECT * FROM daftar_order WHERE status_tracking <='2' ORDER by id_order DESC";
                        $result = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($result) === 0) : ?>
                            <h6 style='text-align: center; color:grey;'>Tidak ada order baru</h6>
                        <?php else : ?>
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
                                            while ($row = mysqli_fetch_array($result)) { ?>
                                                <tr>
                                                    <td><b><?php echo $row['id_order']; ?></b></td>
                                                    <td><b><?php echo $row['tanggal_beli']; ?></b></td>
                                                    <td>
                                                        <div class="p-3 mb-2 bg-warning">
                                                            <b><i class="fas fa-money-bill-wave fa-2x fa-pull-right"></i><?php echo rupiah($row['total_order']); ?></b>
                                                        </div>
                                                    </td>
                                                    <!-- If Else Status Bayar-->
                                                    <?php if ($row['status_pesan'] == 0) : ?>
                                                        <td>
                                                            <div class="p-3 mb-2 bg-danger">
                                                                <b><i class="fas fa-times-circle fa-2x fa-pull-right"></i>Belum Lunas</b>
                                                            </div>
                                                        </td>
                                                    <?php elseif ($row['status_pesan'] == 1) : ?>
                                                        <td>
                                                            <div class="p-3 mb-2 bg-secondary">
                                                                <b><i class="fas fa-spinner fa-2x fa-pull-right fa-spin"></i>Sedang dicek admin</b>
                                                            </div>
                                                        </td>
                                                    <?php elseif ($row['status_pesan'] == 2) : ?>
                                                        <td>
                                                            <div class="p-3 mb-2 bg-success">
                                                                <b><i class="fas fa-check-circle fa-2x fa-pull-right"></i>Sudah Lunas</b>
                                                            </div>
                                                        </td>
                                                    <?php endif; ?>
                                                    <!-- If Else Status Order -->
                                                    <?php if ($row['status_tracking'] == 0) : ?>
                                                        <td>
                                                            <div class="p-3 mb-2 bg-danger">
                                                                <b><i class="fas fa-times-circle fa-2x fa-pull-right"></i>Pesanan Belum Dibuat</b>
                                                            </div>
                                                        </td>
                                                    <?php elseif ($row['status_tracking'] == 1) : ?>
                                                        <td>
                                                            <div class="p-3 mb-2" style='background-color:#E67E22; color:white;'>
                                                                <b><i class="fas fa-lightbulb fa-2x fa-pull-right"></i>Pesanan Sedang Dibuat</b>
                                                            </div>
                                                        </td>
                                                    <?php elseif ($row['status_tracking'] == 2) : ?>
                                                        <td>
                                                            <div class="p-3 mb-2" style='background-color:#D4AC0D; color:white;'>
                                                                <b><i class="fas fa-truck fa-2x fa-pull-right"></i>Pesanan Sedang Diantar</b>
                                                            </div>
                                                        </td>
                                                    <?php elseif ($row['status_tracking'] == 3) : ?>
                                                        <td>
                                                            <div class="p-3 mb-2 bg-success">
                                                                <b><i class="fas fa-check-circle fa-2x fa-pull-right"></i>Pesanan Sudah Diantar</b>
                                                            </div>
                                                        </td>
                                                    <?php endif; ?>
                                                    <!-- If Else Bukti Bayar -->
                                                    <?php if ($row['buktibayar'] > 0) : ?>
                                                        <td><u><a style="color:blue" href="../buktibayar/<?php echo $row['buktibayar']; ?>">
                                                                    <h6 style="text-align:center;"><b>Lihat Bukti</b></h6>
                                                                </a></u>
                                                        <?php else : ?>
                                                        <td>Belum ada bukti bayar</td>
                                                    <?php endif; ?>
                                                </tr>
                                            <?php }; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        <?php endif; ?>
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
                                        <span class="badge badge-danger"></span>
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
                                        $sql = "SELECT * FROM account_google ORDER BY id DESC";
                                        $result = mysqli_query($conn, $sql);
                                        while ($row = mysqli_fetch_array($result)) { ?>
                                            <!--open of while -->
                                            <li>
                                                <img src="<?php echo $row['picture']; ?>" alt="User Image" width="150" height="150">
                                                <a class="users-list-name"><?php echo $row['nama']; ?></a>
                                                <?php $tanggal_register = date_create_from_format('Y-m-d', $row['tanggal_register']); ?>
                                                <span class="users-list-date"><?php echo date_format($tanggal_register, "d F Y"); ?></span>
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
                            $sql = "SELECT * FROM tblmenu ORDER BY id DESC LIMIT 5";
                            $result = mysqli_query($conn, $sql);
                            while ($row = mysqli_fetch_array($result)) { ?>
                                <!--open of while -->
                                <li class="item">
                                    <div class="product-img">
                                        <img src="../menu_image/<?php echo $row['photo']; ?>" alt="Product Image" class="img-size-50">
                                    </div>
                                    <div class="product-info">
                                        <?php if ($row['type'] == 'Makanan') : ?>
                                            <a href="listMakanan.php" class="product-title"><?php echo $row['name']; ?>
                                            <?php else : ?>
                                                <a href="listMinuman.php" class="product-title"><?php echo $row['name']; ?>
                                                <?php endif; ?>
                                                <span class="badge badge-warning float-right"><?php echo rupiah($row['price']); ?></span></a>
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