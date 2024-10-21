<?php
if (isset($_SESSION['sellerid'])) {
    $supername =  $_SESSION['sellerid'];
    $todaydate = date('Y-m-d h:i:sa');
    $queryres = "SELECT * FROM userinfo where sn = '$supername'";
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
            <a href="#" class="d-block"><?php echo $supernamess; ?></a>
        </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <li class="nav-item">
                <a href="home.php" class="nav-link">
                    <i class="nav-icon fas fa-th"></i>
                    <p>
                        Dashboard
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="keys.php" class="nav-link">
                    <i class="nav-icon fas fa-th"></i>
                    <p>
                        All ID Manager
                    </p>
                </a>
            </li>

            <li class="nav-header">Settings</li>
            <li class="nav-item">
                <a href="add_proxy.php" class="nav-link">
                    <i class="nav-icon fa fa-file-excel"></i>
                    <p>
                        Proxy Add/Delete
                    </p>
                </a>
            </li>
            
                <li class="nav-item">
                <a href="aws_proxy.php" class="nav-link">
                    <i class="nav-icon fa fa-file-excel"></i>
                    <p>
                        AWS VPS Active
                    </p>
                </a>
            </li>
               <li class="nav-item">
                  <a class="nav-link" href="https://getbts.com/VPN/api/login.php"> 
                    <i class="nav-icon fa fa-file-excel"></i>
                    <p>
                       Proxy Buy
                    </p>
                </a>
            </li>
                <li class="nav-item">
                  <a class="nav-link" href="https://gologin.com/proxy-checker/"> 
                    <i class="nav-icon fa fa-file-excel"></i>
                    <p>
                       Proxy Checker
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="today_result.php" class="nav-link">
                    <i class="nav-icon fa fa-file-excel"></i>
                    <p>
                        Today Results
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="seller_transaction.php" class="nav-link">
                    <i class="nav-icon fa fa-coins"></i>
                    <p>
                        Transections History
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="change_password.php" class="nav-link">
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