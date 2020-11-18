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
                    <h1>List Order</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active">List Order</li>
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
                            <h3 class="card-title">List Order GAKedai</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">ID Order</th>
                                        <th scope="col">Tanggal Beli</th>
                                        <th scope="col">Total Order</th>
                                        <th scope="col">Status Bayar</th>
                                        <th scope="col">Status Order</th>
                                        <th scope="col">Bukti Bayar</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    include("connection.php");
                                    $sql = "SELECT * FROM daftar_order WHERE status_tracking<='2'";
                                    $result = mysqli_query($conn, $sql);
                                    while ($row = mysqli_fetch_array($result)) { ?>
                                        <tr>
                                            <td><b><?php echo $row['id_order']; ?></b></td>
                                            <td><b><?php echo $row['tanggal_beli']; ?></b></td>
                                            <td>
                                                <div class="p-3 mb-2 bg-warning">
                                                    <b><i class="fas fa-money-bill-wave fa-2x fa-pull-right"></i>Rp. <?php echo number_format($row['total_order']); ?></b>
                                                </div>
                                            </td>
                                            <!-- If Else Status Bayar-->
                                            <td>
                                                <form action="update_statuspesan.php" method='post' enctype="multipart/form-data">
                                                    <style>
                                                        .redText {
                                                            background-color: #E74C3C;
                                                            color: white;
                                                            font-weight: bold;
                                                        }

                                                        .greyText {
                                                            background-color: grey;
                                                            color: white;
                                                            font-weight: bold;
                                                        }

                                                        .greenText {
                                                            background-color: green;
                                                            color: white;
                                                            font-weight: bold;
                                                        }

                                                        .yellowText {
                                                            background-color: #F1C40F;
                                                            color: white;
                                                            font-weight: bold;
                                                        }

                                                        .orangeText {
                                                            background-color: #E67E22;
                                                            color: white;
                                                            font-weight: bold;
                                                        }
                                                    </style>

                                                    <?php if ($row['status_pesan'] == 0) : ?>
                                                        <select onchange="this.className=this.options[this.selectedIndex].className" class="form-control redText" name="status_pesan">
                                                            <option value="0" class="form-control redText" selected>❌ Belum Lunas</option>
                                                            <option value="1" class="form-control greyText">📑 Sedang dicek admin</option>
                                                            <option value="2" class="form-control greenText">✅ Sudah Lunas</option>
                                                        </select>
                                                    <?php elseif ($row['status_pesan'] == 1) : ?>
                                                        <select onchange="this.className=this.options[this.selectedIndex].className" class="form-control greyText" name="status_pesan">
                                                            <option value="0" class="form-control redText">❌ Belum Lunas</option>
                                                            <option value="1" class="form-control greyText" selected>📑 Sedang dicek admin</option>
                                                            <option value="2" class="form-control greenText">✅ Sudah Lunas</option>
                                                        </select>
                                                    <?php elseif ($row['status_pesan'] == 2) : ?>
                                                        <select onchange="this.className=this.options[this.selectedIndex].className" class="form-control greenText" name="status_pesan">
                                                            <option value="0" class="form-control redText">❌ Belum Lunas</option>
                                                            <option value="1" class="form-control greyText">📑 Sedang dicek admin</option>
                                                            <option value="2" class="form-control greenText" selected>✅ Sudah Lunas</option>
                                                        </select>
                                                    <?php endif; ?>

                                                    <hr>
                                                    <input type="hidden" name="id_order" class="form-control" value="<?php echo $row['id_order']; ?>" readonly>
                                                    <button class="btn btn-info btn-sm float-right" type="submit" name="update_statuspesan">
                                                        <i class="fas fa-pencil-alt">
                                                        </i>
                                                        Update
                                                    </button>
                                                </form>
                                            </td>
                                            <!-- If Else Status Order -->
                                            <td>
                                                <form action="update_statustracking.php" method='post' enctype="multipart/form-data">
                                                    <?php if ($row['status_tracking'] == 0) : ?>
                                                        <select onchange="this.className=this.options[this.selectedIndex].className" class="form-control redText" name="status_tracking">
                                                            <option value="0" class="form-control redText" selected>❌ Pesanan Belum Dibuat</option>
                                                            <option value="1" class="form-control orangeText">👨‍🍳 Pesanan Sedang Dibuat</option>
                                                            <option value="2" class="form-control yellowText">🛵 Pesanan Sedang Diantar</option>
                                                            <option value="3" class="form-control greenText">✅ Pesanan Sudah Diantar</option>
                                                        </select>
                                                    <?php elseif ($row['status_tracking'] == 1) : ?>
                                                        <select onchange="this.className=this.options[this.selectedIndex].className" class="form-control orangeText" name="status_tracking">
                                                            <option value="0" class="form-control redText">❌ Pesanan Belum Dibuat</option>
                                                            <option value="1" class="form-control orangeText" selected>👨‍🍳 Pesanan Sedang Dibuat</option>
                                                            <option value="2" class="form-control yellowText">🛵 Pesanan Sedang Diantar</option>
                                                            <option value="3" class="form-control greenText">✅ Pesanan Sudah Diantar</option>
                                                        </select>
                                                    <?php elseif ($row['status_tracking'] == 2) : ?>
                                                        <select onchange="this.className=this.options[this.selectedIndex].className" class="form-control yellowText" name="status_tracking">
                                                            <option value="0" class="form-control redText">❌ Pesanan Belum Dibuat</option>
                                                            <option value="1" class="form-control orangeText">👨‍🍳 Pesanan Sedang Dibuat</option>
                                                            <option value="2" class="form-control yellowText" selected>🛵 Pesanan Sedang Diantar</option>
                                                            <option value="3" class="form-control greenText">✅ Pesanan Sudah Diantar</option>
                                                        </select>
                                                    <?php elseif ($row['status_tracking'] == 3) : ?>
                                                        <select onchange="this.className=this.options[this.selectedIndex].className" class="form-control greenText" name="status_tracking">
                                                            <option value="0" class="form-control redText">❌ Pesanan Belum Dibuat</option>
                                                            <option value="1" class="form-control orangeText">👨‍🍳 Pesanan Sedang Dibuat</option>
                                                            <option value="2" class="form-control yellowText">🛵 Pesanan Sedang Diantar</option>
                                                            <option value="3" class="form-control greenText" selected>✅ Pesanan Sudah Diantar</option>
                                                        </select>
                                                    <?php endif; ?>
                                                    <hr>
                                                    <input type="hidden" name="id_order" class="form-control" value="<?php echo $row['id_order']; ?>" readonly>
                                                    <button class="btn btn-info btn-sm float-right" type="submit" name="update_statustracking">
                                                        <i class="fas fa-pencil-alt">
                                                        </i>
                                                        Update
                                                    </button>
                                                </form>
                                            </td>
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
                                            <td>
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        Action
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item text-white bg-green" href="listOrder.php?id=<?php echo $row['id_order']; ?>"><i class="fas fa-eye">
                                                            </i>&nbsp; View Order</a>
                                                        <div class="dropdown-divider"></div>
                                                        <a class="dropdown-item text-white bg-red" onclick="return confirmDelOrder()" href="delete_orderadmin.php?delID=<?php echo $row['id_order']; ?>"><i class="fas fa-trash">
                                                            </i>&nbsp; Cancel Order</a>
                                                    </div>
                                                </div>
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
                                        <a href="listOrder.php">&times;</a>
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
                                        <a href="listOrder.php" class="btn btn-secondary">Close</a>
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