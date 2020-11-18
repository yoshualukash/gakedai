<?php
if (isset($_POST["submit"])) {
    if (add_ongkir($_POST) > 0) {
        echo "<script>
            alert('Daerah ongkir baru telah ditambahkan!');
            document.location.href = 'listOngkir.php';
			</script>";
    } else {
        echo mysqli_error($conn);
    }
}
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper ">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid ">
            <div class="row">
                <div class="col-sm-6">
                    <h1>Tambah Daerah Ongkir Baru</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active">Tambah Daerah Ongkir Baru</li>
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
                            <h3 class="card-title">Tambah Daerah Ongkir Baru</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form method="post" action="" enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="Nama">Nama Daerah</label>
                                    <input type="text" class="form-control" id="name" name="nama_daerah" placeholder="Nama Daerah" required>
                                </div>
                                <label>Harga Tarif</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Rp.</span>
                                    </div>
                                    <input type="text" class="form-control" id="price" name="tarif" placeholder="Harga Tarif" maxlength="6" required>
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-info" name="submit">Submit</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>