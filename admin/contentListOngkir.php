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
                    <h1>List Daerah Ongkir</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active">List Daerah Ongkir</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row ">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">List Daerah Ongkir</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama Daerah</th>
                                        <th>Tarif Ongkir</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    include("connection.php");
                                    $sql = "SELECT * FROM ongkir ORDER BY id_ongkir";
                                    $result = mysqli_query($conn, $sql);
                                    $i = 1;
                                    while ($row = mysqli_fetch_array($result)) { ?>
                                        <!--open of while -->
                                        <tr>
                                            <td><b><?php echo $i;
                                                    $i++; ?></b>
                                            </td>
                                            <td><?php echo $row['nama_daerah']; ?></td>
                                            <td>Rp. <?php echo number_format($row['tarif']); ?></td>
                                            <td>
                                                <a class="btn btn-info btn-sm" href="editOngkir.php?id=<?php echo $row['id_ongkir']; ?>">
                                                    <i class="fas fa-pencil-alt">
                                                    </i>
                                                    Edit
                                                </a>
                                                <!-- <a class="btn btn-info btn-sm" href="#">
                                                    <i class="fas fa-pencil-alt">
                                                    </i>
                                                    Edit
                                                </a> -->
                                                <a class="btn btn-danger btn-sm " onclick="return confirmDel()" href="delete_dataOngkir.php?delID=<?php echo $row['id_ongkir']; ?>">
                                                    <i class="fas fa-trash">
                                                    </i>
                                                    Delete
                                                </a>
                                            </td>
                                        </tr>
                                    <?php }; ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <!-- /.row -->
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