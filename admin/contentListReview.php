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
                                        <th>Status Review</th>
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
                                            <td>
                                                <form action="update_statusreview.php" method='post' enctype="multipart/form-data">
                                                    <style>
                                                        .redText {
                                                            background-color: #E74C3C;
                                                            color: white;
                                                            font-weight: bold;
                                                        }

                                                        .greenText {
                                                            background-color: green;
                                                            color: white;
                                                            font-weight: bold;
                                                        }
                                                    </style>

                                                    <?php if ($row['status_review'] == 0) : ?>
                                                        <select onchange="this.className=this.options[this.selectedIndex].className" class="form-control redText" name="status_review">
                                                            <option value="0" class="form-control redText" selected>❌ Tidak Ditampilkan</option>
                                                            <option value="1" class="form-control greenText">✅ Ditampilkan</option>
                                                        </select>
                                                    <?php elseif ($row['status_review'] == 1) : ?>
                                                        <select onchange="this.className=this.options[this.selectedIndex].className" class="form-control greenText" name="status_review">
                                                            <option value="0" class="form-control redText">❌ Tidak Ditampilkan</option>
                                                            <option value="1" class="form-control greenText" selected>✅ Ditampilkan</option>
                                                        </select>
                                                    <?php endif; ?>
                                                    <hr>
                                                    <input type="hidden" name="id" class="form-control" value="<?php echo $row['id']; ?>" readonly>
                                                    <button class="btn btn-info btn-sm float-right" type="submit" name="update_statusreview">
                                                        <i class="fas fa-pencil-alt">
                                                        </i>
                                                        Update
                                                    </button>
                                                </form>
                                            </td>
                                            <td class="project-actions text-right">
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