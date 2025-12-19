<?php
include_once("Admin/includes/db_config.php");
session_start();

if (isset($_SESSION['email'])) {
    switch ($_SESSION['role']) {
       
        case 2:
            header("Location: instructor_dashboard.php");
            exit;
        case 3:
            header("Location: student_dashboard.php");
            exit;
    }
}

$error = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {

    $email = $_POST['email'];
    $password = md5($_POST['password']);
    $role = $_POST['role'];

    $sql = "SELECT * FROM users 
            WHERE email='$email' 
            AND password='$password' 
            AND role='$role'";

    $result = $db->query($sql);

    if ($result && $result->num_rows == 1) {
        $row = $result->fetch_object();

        $_SESSION['name']  = $row->full_name;
        $_SESSION['email'] = $row->email;
        $_SESSION['role']  = $row->role;

        
        if ($role == 2) header("Location: instructor_dashboard.php");
        if ($role == 3) header("Location: student_dashboard.php");
        exit;

    } else {
        $error = "Incorrect Email, Password or Role";
    }
}
?>


<!DOCTYPE html>
<html lang="en"
    dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible"
        content="IE=edge">
    <meta name="viewport"
        content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Login</title>

    <!-- Prevent the demo from appearing in search engines -->
    <meta name="robots"
        content="noindex">

    <link href="https://fonts.googleapis.com/css?family=Lato:400,700%7CRoboto:400,500%7CExo+2:600&display=swap"
        rel="stylesheet">

    <!-- Preloader -->
    <link type="text/css"
        href="public/vendor/spinkit.css"
        rel="stylesheet">

    <!-- Perfect Scrollbar -->
    <link type="text/css"
        href="public/vendor/perfect-scrollbar.css"
        rel="stylesheet">

    <!-- Material Design Icons -->
    <link type="text/css"
        href="public/css/material-icons.css"
        rel="stylesheet">

    <!-- Font Awesome Icons -->
    <link type="text/css"
        href="public/css/fontawesome.css"
        rel="stylesheet">

    <!-- Preloader -->
    <link type="text/css"
        href="public/css/preloader.css"
        rel="stylesheet">

    <!-- App CSS -->
    <link type="text/css"
        href="public/css/app.css"
        rel="stylesheet">

</head>

<body class="layout-default layout-login-centered-boxed">

    <div class="layout-login-centered-boxed__form card">

        <div class="d-flex flex-column justify-content-center align-items-center mt-2 mb-5 navbar-light">

            <a href="index.html"
                class="navbar-brand flex-column mb-2 align-items-center mr-0"
                style="min-width: 0">

                <span class="avatar avatar-sm navbar-brand-icon mr-0">

                    <span class="avatar-title rounded bg-primary"><img src="public/images/illustration/student/128/white.svg"
                            alt="logo"
                            class="img-fluid" /></span>

                </span>

                Luma
            </a>
            <p class="m-0">Login to access your Luma Account </p>
        </div>
<?php if ($error): ?>
<div class="alert alert-danger text-center">
    <?= $error ?>
</div>
<?php endif; ?>


        <a href="index.html"
            class="btn btn-light btn-block mb-24pt">
            <span class="fab fa-google icon--left"></span>
            Continue with Google
        </a>

        <div class="page-separator justify-content-center">
            <div class="page-separator__text bg-white">or</div>
        </div>

        <form action="" method="post"
            novalidate>
            <div class="form-group">
                <label class="text-label"
                    for="email_2">Email Address:</label>
                <div class="input-group input-group-merge">
                    <input id="email_2"
                        type="email"
                        required=""
                        class="form-control form-control-prepended"
                        placeholder="admin@gmail.com" name="email">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <span class="far fa-envelope"></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="text-label"
                    for="password_2">Password:</label>
                <div class="input-group input-group-merge">
                    <input id="password_2"
                        type="password"
                        required=""
                        class="form-control form-control-prepended"
                        placeholder="Enter your password" name="password">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <span class="fa fa-key"></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <select class="form-control" name="role">
                    <option value="">Login As</option>
                    
                    <option value="2">Teacher</option>
                    <option value="3">Student</option>
                </select>
            </div>
            <div class="form-group">
                <button class="btn btn-block btn-primary"
                    type="submit" name="login">Login</button>
            </div>
            <div class="form-group text-center">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox"
                        class="custom-control-input"
                        checked=""
                        id="remember">
                    <label class="custom-control-label"
                        for="remember">Remember me for 30 days</label>
                </div>
            </div>
            <div class="form-group text-center">
                <a href="">Forgot password?</a> <br>
                Don't have an account? <a class="text-body text-underline"
                    href="signup.html">Sign up!</a>
            </div>
        </form>
    </div>

    <!-- jQuery -->
    <script src="public/vendor/jquery.min.js"></script>

    <!-- Bootstrap -->
    <script src="public/vendor/popper.min.js"></script>
    <script src="public/vendor/bootstrap.min.js"></script>

    <!-- Perfect Scrollbar -->
    <script src="public/vendor/perfect-scrollbar.min.js"></script>

    <!-- DOM Factory -->
    <script src="public/vendor/dom-factory.js"></script>

    <!-- MDK -->
    <script src="public/vendor/material-design-kit.js"></script>

    <!-- App JS -->
    <script src="public/js/app.js"></script>

    <!-- Preloader -->
    <script src="public/js/preloader.js"></script>

</body>

</html>