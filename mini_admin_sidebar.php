<?php
if (isset($_SESSION['miniadmin_id'])) {
    $subadmin_name =  $_SESSION['miniadmin_id'];
    $todaydate = date('Y-m-d h:i:sa');
    $queryres = "SELECT * FROM mini_admin where mini_id  = '$subadmin_name'";
    $result = $con->query($queryres);
    $rowssubadmin = $result->fetch_assoc();
    $subadminname = $rowssubadmin['mini_username'];
}
?>
<!-- Brand Logo -->
<a href="/" class="brand-link">
    <img src="./public/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">Hunter</span>
</a>

<!-- Sidebar -->
<div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
            <img src="./public/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
            <a href="#" class="d-block"><?php echo $subadminname ; ?></a>
        </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <li class="nav-item">
                <a href="mini_admin_home.php" class="nav-link">
                    <i class="nav-icon fas fa-th"></i>
                    <p>
                        Dashboard
                    </p>
                </a>
            </li>
            <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-users"></i>
                    <p>
                        Users Manager
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="mini_admin_subadmin_create.php" class="nav-link">
                            <i class="far fa-user nav-icon"></i>
                            <p>Admin Manager</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="miniadmin_superlist.php" class="nav-link">
                            <i class="far fa-user nav-icon"></i>
                            <p>Super Manager</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="miniadmin_sellerlist.php" class="nav-link">
                            <i class="far fa-user nav-icon"></i>
                            <p>Seller Manager</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="allkeysinminiadmin.php" class="nav-link">
                            <i class="far fa-user nav-icon"></i>
                            <p>All ID Manager</p>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-header">Settings</li>

            <li class="nav-item">
                <a href="miniadmin_todayresults.php" class="nav-link">
                    <i class="nav-icon fa fa-file-excel"></i>
                    <p>
                        Today Results
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="miniadmin_trasactions.php" class="nav-link">
                    <i class="nav-icon fa fa-coins"></i>
                    <p>
                        Transections History
                    </p>
                </a>
            </li>            
            <li class="nav-item">
                <a href="miniadminself_changepassword.php" class="nav-link">
                    <i class="nav-icon fa fa-key"></i>
                    <p>
                        Change Password
                    </p>
                </a>
            </li>
        </ul>
    </nav>
    <!-- /.sidebar-menu -->
</div>