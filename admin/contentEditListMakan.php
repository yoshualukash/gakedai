<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];
} else {
    echo "<script>
            document.location.href = 'listMakanan.php';
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
                    <h1>Edit Menu Makanan</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active">Edit Menu Makanan</li>
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
                    <div class="card card-success">
                        <div class="card-header">
                            <h3 class="card-title">Edit Menu Makanan</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <?php $sql = "SELECT * FROM tblmenu WHERE id='$id'";
                        $result = mysqli_query($conn, $sql);
                        $row = mysqli_fetch_array($result) ?>
                        <form method="post" action="update_listmakan.php" enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="Nama">Nama Menu</label>
                                    <input type="text" class="form-control" id="name" name="name" value="<?php echo $row['name']; ?>" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="Code">Code Menu</label>
                                    <input type="text" class="form-control" id="code" name="code" value="<?php echo $row['code']; ?>" maxlength="7" readonly>
                                </div>

                                <label>Harga Menu</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Rp.</span>
                                    </div>
                                    <input type="text" class="form-control" id="price" name="price" value="<?php echo $row['price']; ?>" maxlength="6" required>
                                </div>
                                <!-- select -->
                                <div class="form-group">
                                    <label for="Type">Tipe Menu</label>
                                    <input type="text" class="form-control" id="type" name="type" value="<?php echo $row['type']; ?>" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="Detail">Deskripsi Menu</label>
                                    <textarea class="form-control" id="Detail" name="detail" rows="5" maxlength="200" required><?php echo $row['detail']; ?></textarea>
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <input type="hidden" name="id" class="form-control" value="<?php echo $id; ?> ?>" readonly>
                                <button type="submit" class="btn btn-success" name="update_listmakan">Save Changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>