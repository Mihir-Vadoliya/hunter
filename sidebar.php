<?php
if (isset($_SESSION['adminid'])) {
    $subadmin_name =  $_SESSION['adminid'];
    $todaydate = date('Y-m-d h:i:sa');
    $queryres = "SELECT * FROM admin where 	an = '$subadmin_name'";
    $result = $con->query($queryres);
    $rowssubadmin = $result->fetch_assoc();
    $subadminname = $rowssubadmin['username'];
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
            <a href="#" class="d-block"><?php echo  $subadminname ?></a>
        </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <li class="nav-item">
                <a href="admin_home.php" class="nav-link">
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
                        <a href="alladmin_create.php" class="nav-link">
                            <i class="far fa-user nav-icon"></i>
                            <p>Master Admin Manager</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="subadmin_create.php" class="nav-link">
                            <i class="far fa-user nav-icon"></i>
                            <p>Admin Manager</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="admin_super_list.php" class="nav-link">
                            <i class="far fa-user nav-icon"></i>
                            <p>Super Manager</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="admin_seller_list.php" class="nav-link">
                            <i class="far fa-user nav-icon"></i>
                            <p>Seller Manager</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="admin_id.php" class="nav-link">
                            <i class="far fa-user nav-icon"></i>
                            <p>All ID Manager</p>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-header">Settings</li>

            <li class="nav-item">
                <a href="admin_today_result.php" class="nav-link">
                <i class="nav-icon fa fa-file-excel"></i>
                    <p>
                        Today Results
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="admin_transaction.php" class="nav-link">
                    <i class="nav-icon fa fa-coins"></i>                   
                    <p>
                        Transections History
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="admin_extend_days.php" class="nav-link">
                    <i class="nav-icon fa fa-calendar"></i>                   
                    <p>
                        Extend Days
                    </p>
                </a>
            </li>
            <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-users"></i>
                    <p>
                       News
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="adminpanel_news.php" class="nav-link">
                            <i class="far fa-user nav-icon"></i>
                            <p>Admin News</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="miniadminpanel_news.php" class="nav-link">
                            <i class="far fa-user nav-icon"></i>
                            <p>Sub Admin News</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="superpanel_news.php" class="nav-link">
                            <i class="far fa-user nav-icon"></i>
                            <p>Super News</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="panel_news.php" class="nav-link">
                            <i class="far fa-user nav-icon"></i>
                            <p>Seller News</p>
                        </a>
                    </li>
                    
                    <li class="nav-item">
                        <a href="admin_panel_news.php" class="nav-link">
                            <i class="far fa-user nav-icon"></i>
                            <p>Software News</p>
                        </a>
                    </li>
                </ul>
            </li> 
            <?php
                        $sql = "SELECT * FROM demoswitch ";
                        $result = $con->query($sql);
                        $row = $result->fetch_assoc();
                        $value = $row['status'];
                         
                        if($value == "Deactive"){
                           $url='activestatus.php?changeDemostatuson=true&status='.$value;
                           $demo = "Demo On";
                           $icon = "fa fa-toggle-off";
                           $textbold ="text-light";
                        }
                        
                        else {
                           $url='deactivestatus.php?changeDemostatusoff=true&status='.$value;
                           $demo = "Demo Off";
                           $icon = "fa fa-toggle-on";
                           $textbold ="text-Success";
                        }
                          
                        ?>         
            <li class="nav-item">
                <a href="<?php echo $url ?>" class="nav-link">
                    <i class="nav-icon <?php echo $icon ?>"></i>
                    <p>
                        <strong class="<?php echo $textbold ?>"> <?php echo $demo ?></strong>
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="admin_self_change_password.php" class="nav-link">
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