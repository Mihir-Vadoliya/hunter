<?php
if (isset($_SESSION['superid'])) {
    $supername =  $_SESSION['superid'];
    $todaydate = date('Y-m-d h:i:sa');
    $queryres = "SELECT * FROM super where 	sn = '$supername'";
    $result = $con->query($queryres);
    $rowssubadmin = $result->fetch_assoc();
    $supernamess = $rowssubadmin['name'];
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
            <a href="#" class="d-block"><?php echo $supernamess ; ?></a>
        </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <li class="nav-item">
                <a href="super_home.php" class="nav-link">
                    <i class="nav-icon fas fa-th"></i>
                    <p>
                        Dashboard
                    </p>
                </a>
            </li>
            <li class="nav-item has-treeview">
                <a href="" class="nav-link">
                    <i class="nav-icon fas fa-users"></i>
                    <p>
                        Users Manager
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">                    
                    <li class="nav-item">
                        <a href="super_seller_list.php" class="nav-link">
                            <i class="far fa-user nav-icon"></i>
                            <p>Seller Manager</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="super_keys.php" class="nav-link">
                            <i class="far fa-user nav-icon"></i>
                            <p>All ID Manager</p>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-header">Settings</li>

            <li class="nav-item">
                <a href="super_today_result.php" class="nav-link">
                    <i class="nav-icon fa fa-file-excel"></i>
                    <p>
                        Today Results
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="super_transaction.php" class="nav-link">
                    <i class="nav-icon fa fa-coins"></i>
                    <p>
                        Transections History
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="super_self_change_password.php" class="nav-link">
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