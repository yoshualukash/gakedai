<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index.php" class="brand-link">
        <img src="../images/logo_gakedai.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">GAKedai</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="../images/defaultadmin.png" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a><?php echo $nama_admin; ?></a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-header">Main</li>
                <li class="nav-item">
                    <!-- <a href="./index.html" class="nav-link active"> -->
                    <a href="index.php" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                            <i class="right fas"></i>
                        </p>
                    </a>
                </li>
                <li class="nav-header">Management</li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="fas fa-book-open nav-icon "></i>
                        <p>
                            Menu GAKedai
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="listMakanan.php" class="nav-link">
                                <i class="fas fa-utensils nav-icon"></i>
                                <p>List Makanan</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="listMinuman.php" class="nav-link">
                                <i class="fas fa-beer nav-icon"></i>
                                <p>List Minuman</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-book"></i>
                        <p>
                            Order
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="listOrder.php" class="nav-link">
                                <i class=" fas fa-list nav-icon"></i>
                                <p>
                                    New Order List
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="listOrderHistory.php" class="nav-link">
                                <i class=" fas fa-history nav-icon"></i>
                                <p>
                                    Order History
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="listOrderCancel.php" class="nav-link">
                                <i class=" fas fa-window-close nav-icon"></i>
                                <p>
                                    Order Cancel
                                </p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="fas fa-user-lock nav-icon "></i>
                        <p>
                            Account
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item ">
                            <a href="list_accGoogle.php" class="nav-link">
                                <i class="fab fa-google nav-icon"></i>
                                <p>
                                    Google User
                                </p>
                            </a>
                        </li>
                        <?php if ($rowadmin['role'] == 'Super-admin') : ?>
                            <li class="nav-item">
                                <a href="list_accAdmin.php" class="nav-link">
                                    <i class="fas fa-users-cog nav-icon"></i>
                                    <p>
                                        Admin
                                    </p>
                                </a>
                            </li>
                        <?php else : ?>
                        <?php endif; ?>
                    </ul>
                </li>
                <li class="nav-item ">
                    <a href="listOngkir.php" class="nav-link">
                        <i class="nav-icon fas fa-truck"></i>
                        <p>
                            Daftar Daerah Ongkir
                        </p>
                    </a>
                </li>
                <li class="nav-item ">
                    <a href="list_review.php" class="nav-link">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                            Review Pelanggan
                        </p>
                    </a>
                </li>
                <li class="nav-header">Function</li>
                <?php if ($rowadmin['role'] == 'Super-admin') : ?>
                    <li class="nav-item">
                        <a href="add_admin.php" class="nav-link">
                            <i class="fa fa-user-plus nav-icon"></i>
                            <p>
                                Tambah Akun Admin
                            </p>
                        </a>
                    </li>
                <?php else : ?>
                <?php endif; ?>
                <li class="nav-item">
                    <a href="add_menu.php" class="nav-link">
                        <i class="fa fa-user-plus nav-icon"></i>
                        <p>
                            Tambah Menu Baru
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="add_ongkir.php" class="nav-link">
                        <i class="fa fa-user-plus nav-icon"></i>
                        <p>
                            Tambah Ongkir Baru
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="logout.php" class="nav-link">
                        <i class="fa fa-circle text-danger nav-icon"></i>
                        <p>
                            Logout
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>