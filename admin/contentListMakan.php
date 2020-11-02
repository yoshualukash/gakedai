<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>List Makanan</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active">List Makanan</li>
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
                            <h3 class="card-title">List Menu Makanan GAKedai</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Photo</th>
                                        <th>Nama Makanan</th>
                                        <th>Harga</th>
                                        <th>Deskripsi</th>
                                        <th>Status Menu</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    include("connection.php");
                                    $sql = "SELECT * FROM tblmenu WHERE type='Makanan' ORDER BY id ";
                                    $result = mysqli_query($conn, $sql);
                                    while ($row = mysqli_fetch_array($result)) { ?>
                                        <!--open of while -->
                                        <tr>
                                            <td><?php echo $row['id']; ?></td>
                                            <td>
                                                <ul class="list-inline">
                                                    <li class="list-inline-item">
                                                        <img alt="Avatar" class="table-avatar" src="../menu_image/<?php echo $row['photo']; ?>" width="80" height="80">
                                                    </li>
                                                </ul>
                                            </td>
                                            <td><?php echo $row['name']; ?></td>
                                            <td><?php echo $row['price']; ?></td>
                                            <td><?php echo $row['detail']; ?></td>
                                            <form action="update_statusmenumakan.php" method='post' enctype="multipart/form-data">
                                                <td>
                                                    <?php if ($row['status_menu'] == '0') : ?>
                                                        <select class="form-control" name="status_menu">
                                                            <option value="0" class="form-control" selected>✅ Tersedia</option>
                                                            <option value="1" class="form-control">❌ Habis</option>
                                                        </select>
                                                    <?php else : ?>
                                                        <select class="form-control" name="status_menu">
                                                            <option value="0" class="form-control">✅ Tersedia</option>
                                                            <option value="1" class="form-control" selected>❌ Habis</option>
                                                        </select>
                                                    <?php endif; ?>
                                                    <hr>
                                                    <input type="hidden" name="id" class="form-control" value="<?php echo $row['id']; ?>" readonly>
                                                    <button class="btn btn-info btn-sm float-right" type="submit" name="update_statusmenumakan">
                                                        <i class="fas fa-pencil-alt">
                                                        </i>
                                                        Update
                                                    </button>
                                                </td>
                                            </form>
                                            <td class="project-actions text-right">
                                                <a class="btn btn-info btn-sm" href="editListMakan.php?id=<?php echo $row['id']; ?>">
                                                    <i class=" fas fa-pencil-alt">
                                                    </i>
                                                    Edit
                                                </a>
                                                <hr>
                                                <a class="btn btn-danger btn-sm " onclick="return confirmDel()" href="delete_dataMenuMakan.php?delID=<?php echo $row['id']; ?>">
                                                    <i class="fas fa-trash">
                                                    </i>
                                                    Delete
                                                </a>
                                            </td>
                                        <?php
                                    } //close of while
                                        ?>
                                        </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->