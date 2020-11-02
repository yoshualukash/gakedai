<?php
require 'input_menu.php';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
} else {
    echo "<script>
            document.location.href = 'listOngkir.php';
			</script>";
}
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper ">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid ">
            <div class="row">
                <div class="col-sm-6">
                    <h1>Edit Daerah Ongkir</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active">Edit Daerah Ongkir</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <!-- left column -->
                <div class="col-sm-6">
                    <!-- general form elements -->
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Edit Daerah Ongkir</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <?php $sql = "SELECT * FROM ongkir WHERE id_ongkir='$id'";
                        $result = mysqli_query($conn, $sql);
                        $row = mysqli_fetch_array($result) ?>
                        <form method="post" action="update_ongkir.php" enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="Nama">Nama Daerah</label>
                                    <input type="text" class="form-control" id="name" name="nama_daerah" value="<?php echo $row['nama_daerah']; ?>" readonly>
                                </div>
                                <label>Harga Tarif</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Rp.</span>
                                    </div>
                                    <input type="text" class="form-control" id="price" name="tarif" value="<?php echo $row['tarif']; ?>" maxlength="6" required>
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <input type="hidden" name="id_order" class="form-control" value="<?php echo $id; ?> ?>" readonly>
                                <button type="submit" class="btn btn-info" name="update_ongkir">Save Changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>