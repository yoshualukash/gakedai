<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>List Review Pelanggan</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active">List Review Pelanggan</li>
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
                            <h3 class="card-title">List Review Pelanggan</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama Pelanggan</th>
                                        <th>ID</th>
                                        <th>Email</th>
                                        <th>Judul</th>
                                        <th>Pesan</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    include("connection.php");
                                    $sql = "SELECT * FROM pesan_saran ORDER BY id ";
                                    $result = mysqli_query($conn, $sql);
                                    $i = 1;
                                    while ($row = mysqli_fetch_array($result)) { ?>
                                        <!--open of while -->
                                        <tr>
                                            <td><b><?php echo $i;
                                                    $i++; ?></b>
                                            </td>
                                            <td><?php echo $row['nama']; ?></td>
                                            <td><?php echo $row['id']; ?></td>
                                            <td><?php echo $row['email']; ?></td>
                                            <td><?php echo $row['judul']; ?></td>
                                            <td><?php echo $row['pesan']; ?></td>
                                            <td class="project-actions text-right">
                                                <a class="btn btn-info btn-sm" href="#">
                                                    <i class="fas fa-eye">
                                                    </i>
                                                    View
                                                </a>
                                                <!-- <a class="btn btn-info btn-sm" href="#">
                                                    <i class="fas fa-pencil-alt">
                                                    </i>
                                                    Edit
                                                </a> -->
                                                <a class="btn btn-danger btn-sm " onclick="return confirmDel()" href="delete_dataReview.php?delID=<?php echo $row['id']; ?>">
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