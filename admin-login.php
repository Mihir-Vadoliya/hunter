<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>HUNTER| Log In </title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="./public/plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="./public/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="./public/dist/css/adminlte.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<?php
if (isset($_SESSION['subid'])) {
    header('location:sub_admin_home.php');
} elseif (isset($_SESSION['adminid'])) {
    header('location:admin_home.php');
} elseif (isset($_SESSION['superid'])) {
    header('location:super_home.php');
} elseif (isset($_SESSION['sellerid'])) {
    header('location: home.php');
} elseif (isset($_SESSION['miniadmin_id'])) {
    header('Location:mini_admin_home.php');
}

include 'config.php';
$pwdErr = $emailErr = $Err = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $pwdErr = $emailErr = $Err = '';
    $email = $pwd = '';
    $flag = 0;
    $message = '';
    $email = $_POST['id'];
    $pwd = $_POST['pass'];
    $usertype = $_POST['UserType'];

    $pwd = 'jgc' . md5($pwd);

    $email1 = $con->real_escape_string($email);
    $pwd1 = $con->real_escape_string($pwd);

    ($src = $con->query("SELECT * FROM admin  WHERE `admin_id`='$email1' AND `password`='$pwd1'")) or die(mysqli_error());

    if ($src->num_rows > 0) {       
        $Err = '';
        $rowa = $src->fetch_assoc();
        $_SESSION['info'] = $rowa;
        $_SESSION['start'] = time();
        $_SESSION['expire'] = $_SESSION['start'] + 10 * 60;
        $_SESSION['adminid'] = $rowa['an'];
        $_SESSION['adminname'] = $rowa['admin_id'];

        if (isset($_SESSION['adminid'])) {
            header('Location:admin_home.php');
        }
    } else {
        $Err = 'UNREGISTERED ID OR INCORRECT PASSWORD TYPED!';
        header('Location:admin-login.php');
        unset($_SESSION['info']['adminid']);
    }
}

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

?>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href="/">HUNTER </a>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Sign in to start your session</p>
                <p class="login-box-msg text-danger"><?php echo $Err; ?></p>
                <form method="post" id="loginform" class="login-form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                    <div class="input-group mb-3 d-none">
                        <select class="form-control" name="UserType" id="UserType" class="usertype">
                            <option selected="selected" value="0">Seller</option>
                            <option value="1">Super</option>
                            <option value="2"> Main Admin</option>
                            <option value="3">Admin</option>
                            <option value="4">Master Admin</option>
                        </select>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-users"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input class="form-control" type="text" name="id" placeholder="username"
                            class="username" value="">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input class="form-control" type="password" name="pass" placeholder="password"
                            class="password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- /.col -->
                        <div class="col-12">
                            <input class="btn btn-primary btn-block" type="submit" name="save" value="Login"
                                class="submit">
                        </div>
                        <!-- /.col -->
                    </div>
                </form>

                <div class="social-auth-links text-left mb-3 row">
                    <div class="col-12">
                        <a href="https://hunterspt.in/Hunter/Hunter.zip" class="btn btn-inline btn-primary">
                            Download Setup
                        </a>
                    </div>
                </div>
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="./public/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="./public/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="./public/dist/js/adminlte.min.js"></script>

</body>

</html>
