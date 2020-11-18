<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];
} ?>
<!-- Content Wrapper. Contains page content -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script>
    $(document).ready(function() {
        $("#myModal").modal('show');
    });
</script>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>List Order History</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active">List Order History</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">List Order History GAKedai</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">ID Order</th>
                                        <th scope="col">Waktu Beli</th>
                                        <th scope="col">Total Order</th>
                                        <th scope="col">Status Order</th>
                                        <th scope="col">Waktu Selesai Order</th>
                                        <th scope="col">Bukti Bayar</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    include("connection.php");
                                    $sql = "SELECT * FROM daftar_order WHERE status_tracking ='3'";
                                    $result = mysqli_query($conn, $sql);
                                    while ($row = mysqli_fetch_array($result)) { ?>
                                        <?php $tanggal_beli = date_create_from_format('Y-m-d', $row['tanggal_beli']); ?>
                                        <tr>
                                            <td><b><?php echo $row['id_order']; ?></b></td>
                                            <td><b><?php echo date_format($tanggal_beli, "d-M-Y"); ?>
                                                    <hr><?php echo $row['waktu_beli']; ?></b></td>
                                            <td>
                                                <div class="p-3 mb-2 bg-warning">
                                                    <b><i class="fas fa-money-bill-wave fa-2x fa-pull-right"></i>Rp. <?php echo number_format($row['total_order']); ?></b>
                                                </div><b></b>
                                            </td>
                                            <!-- Status Order -->
                                            <td>
                                                <div class="p-3 mb-2 bg-success">
                                                    <b><i class="fas fa-check-circle fa-2x fa-pull-right"></i>Pesanan Sudah Diantar</b>
                                                </div>
                                            </td>
                                            <!-- Waktu Selesai Order -->
                                            <td style="text-align:center;"><b><?php echo $row['waktu_selesai']; ?></b>
                                            </td>
                                            <!-- If Else Bukti Bayar -->
                                            <td><u><a style="color:blue" href="../buktibayar/<?php echo $row['buktibayar']; ?>">
                                                        <h6 style="text-align:center;"><b>Lihat Bukti</b></h6>
                                                    </a></u>
                                            </td>
                                            <td>
                                                <b>
                                                    <a class="btn btn-success btn-sm float-right" href="listOrderHistory.php?id=<?php echo $row['id_order']; ?>">
                                                        <i class="fas fa-eye">
                                                        </i>
                                                        View
                                                    </a>
                                                </b>
                                            </td>
                                        </tr>
                                    <?php }; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- Modal Informasi Rinci Orderan -->
                <div class='col-md-12'>
                    <?php if (isset($_GET['id'])) : ?>
                        <div id="myModal" class="modal fade">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <?php $ambil1 = $conn->query("SELECT * FROM daftar_order JOIN account_google ON daftar_order.id_pelanggan = account_google.id WHERE daftar_order.id_order='$_GET[id]'");
                                    $detail = $ambil1->fetch_assoc(); ?>
                                    <div class="modal-header">
                                        <h2>Rincian Order #<?php echo $detail['id_order']; ?></h2>
                                        <a href="listOrderHistory.php">&times;</a>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <h6>Customer &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;:&nbsp; <?php echo $detail['nama']; ?></h6>
                                            </div>
                                            <div class="col-md-6">
                                                <h6 style="text-align:right;">Order No : &nbsp; <?php echo $detail['id_order']; ?></h6>
                                            </div>
                                            <div class="col-md-12">
                                                <h6>Ongkos Kirim &nbsp; &nbsp; &nbsp;: &nbsp;Rp.<?php echo number_format($detail['tarif']); ?> (<?php echo $detail['nama_daerah']; ?>)</h6>
                                            </div>
                                            <div class="col-md-12">
                                                <h6>Nomor Telepon &nbsp;: &nbsp;<?php echo $detail['no_telepon']; ?></h6>
                                            </div>
                                            <div class="col-md-12">
                                                <h6>Alamat Antar &nbsp; &nbsp; &nbsp;:&nbsp; <?php echo $detail['alamat']; ?></h6>
                                            </div>
                                            <div class="col-md-12">
                                                <h6><?php echo $detail['tanggal_beli']; ?> &nbsp; <?php echo $detail['waktu_beli']; ?></h6>
                                            </div>
                                        </div>
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th scope="col">No</th>
                                                    <th scope="col">Produk</th>
                                                    <th scope="col">Harga</th>
                                                    <th scope="col">Jumlah</th>
                                                    <th scope="col">SubHarga</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $iter = 1; ?>
                                                <?php $totalbelanja = 0; ?>
                                                <?php $ambil = $conn->query("SELECT * FROM pembelian_produk JOIN tblmenu ON pembelian_produk.id_produk = tblmenu.id WHERE pembelian_produk.id_order='$_GET[id]'"); ?>
                                                <?php while ($pecah = $ambil->fetch_assoc()) { ?>
                                                    <tr>
                                                        <th><?php echo $iter; ?></th>
                                                        <th><?php echo $pecah['nama_produk']; ?></th>
                                                        <td>Rp.<?php echo number_format($pecah['harga']); ?></td>
                                                        <td><?php echo $pecah['jumlah']; ?></td>
                                                        <?php $subharga = $pecah['harga'] * $pecah['jumlah']; ?>
                                                        <td>Rp.<?php echo number_format($subharga); ?></td>
                                                    </tr>
                                                    <?php $iter += 1; ?>

                                                    <?php $totalbelanja += $subharga; ?>
                                                <?php } ?>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th colspan="4"> Sub Total</th>
                                                    <th>Rp.<?php echo number_format($totalbelanja); ?></th>
                                                </tr>
                                                <tr>
                                                    <th colspan="4"> Ongkir</th>
                                                    <th>Rp.<?php echo number_format($detail['tarif']); ?></th>
                                                </tr>
                                                <tr>
                                                    <th colspan="4"> Unique ID</th>
                                                    <th>Rp.<?php echo number_format($detail['uniq_id']); ?></th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                        <h3>Total Pembayaran : Rp.<?php echo number_format($detail['total_order']); ?></h3>
                                    </div>
                                    <div class="modal-footer">
                                        <a href="listOrderHistory.php" class="btn btn-secondary">Close</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- Menu Toggle Script -->
<script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
</script>
<!-- /.content-wrapper -->