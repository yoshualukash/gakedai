<?php
if (isset($_POST["submit"])) {
    if (add_menu($_POST) > 0) {
        echo "<script>
            alert('Menu baru telah ditambahkan!');
            document.location.href = 'listMakanan.php';
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
                    <h1>Tambah Menu Baru</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active">Tambah Menu Baru</li>
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
                            <h3 class="card-title">Tambah Menu Baru</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form method="post" action="" enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="Nama">Nama Menu</label>
                                    <input type="text" class="form-control" id="name" name="addname" placeholder="Nama Menu" required>
                                </div>
                                <div class="form-group">
                                    <label for="Code">Code Menu</label>
                                    <input type="text" class="form-control" id="code" name="addcode" placeholder="Code Menu" maxlength="7" required>
                                </div>

                                <label>Harga Menu</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Rp.</span>
                                    </div>
                                    <input type="text" class="form-control" id="price" name="addprice" placeholder="Harga Menu" maxlength="6" required>
                                </div>
                                <!-- select -->
                                <div class="form-group">
                                    <label>Pilih tipe menu:</label>
                                    <select name="addtype" id="type" class="custom-select" required>
                                        <option value="Makanan">Makanan</option>
                                        <option value="Minuman">Minuman</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="Detail">Deskripsi Menu</label>
                                    <textarea class="form-control" id="Detail" name="adddetail" rows="5" placeholder="Deskripsi Menu" maxlength="200" required></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="photo">Input Gambar</label>
                                    <input type="file" class="form-control" id="photo" name="photo" required>
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-success" name="submit">Submit</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>