<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include_once("Admin/includes/db_config.php");
session_start();

header("Cache-Control: no-cache, must-revalidate");
header("Expires: 0");
if (!isset($_SESSION['email']) || $_SESSION['role'] != 3) {
    header("Location:login.php");
    exit;
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
        <title>Dashboard</title>

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

    <body class="layout-app ">

        <div class="preloader">
            <div class="sk-chase">
                <div class="sk-chase-dot"></div>
                <div class="sk-chase-dot"></div>
                <div class="sk-chase-dot"></div>
                <div class="sk-chase-dot"></div>
                <div class="sk-chase-dot"></div>
                <div class="sk-chase-dot"></div>
            </div>

            <!-- <div class="sk-bounce">
    <div class="sk-bounce-dot"></div>
    <div class="sk-bounce-dot"></div>
  </div> -->

            <!-- More spinner examples at https://github.com/tobiasahlin/SpinKit/blob/master/examples.html -->
        </div>

        <!-- Drawer Layout -->

        <div class="mdk-drawer-layout js-mdk-drawer-layout"
             data-push
             data-responsive-width="992px">
            <div class="mdk-drawer-layout__content page-content">

                <!-- Header -->

                <!-- Navbar -->

               <?php include_once("inc/st_nav.php") ?>

                <!-- // END Navbar -->
<div class="card mb-5 shadow-sm">
        <div class="card-body">
            <form action="process.php" method="POST">
                <div class="mb-3"><input type="text" name="title" class="form-control" placeholder="Title" required></div>
                <div class="mb-3"><textarea name="content" class="form-control" placeholder="Content details..." required></textarea></div>
                <div class="form-check mb-3">
                    <input type="checkbox" name="is_pinned" value="1" class="form-check-input" id="pin">
                    <label class="form-check-label" for="pin">Pin this announcement</label>
                </div>
                <button type="submit" name="add_announcement" class="btn btn-primary">Post Announcement</button>
            </form>
        </div>
    </div>

    
                <!-- // END Header -->

                <?php include_once("inc/st_footer.php") ;?>

                <!-- // END Footer -->

            </div>

            <!-- // END drawer-layout__content -->

            <!-- Drawer -->

            <div class="mdk-drawer js-mdk-drawer"
                 id="default-drawer">
                <div class="mdk-drawer__content">
                    <div class="sidebar sidebar-dark-pickled-bluewood sidebar-left"
                         data-perfect-scrollbar>

                       <?php include_once("inc/st_sidebar.php"); ?>

                        <!-- // END Sidebar Content -->

                    </div>
                </div>
            </div>

            <!-- // END Drawer -->

        </div>

        <!-- // END Drawer Layout -->

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

        <!-- Global Settings -->
        <script src="public/js/settings.js"></script>

        <!-- Flatpickr -->
        <script src="public/vendor/flatpickr/flatpickr.min.js"></script>
        <script src="public/js/flatpickr.js"></script>

        <!-- Moment.js -->
        <script src="public/vendor/moment.min.js"></script>
        <script src="public/vendor/moment-range.js"></script>

        <!-- Chart.js -->
        <script src="public/vendor/Chart.min.js"></script>
        <script src="public/js/chartjs.js"></script>

        <!-- Chart.js Samples -->
        <script src="public/js/page.student-dashboard.js"></script>

        <!-- List.js -->
        <script src="public/vendor/list.min.js"></script>
        <script src="public/js/list.js"></script>

        <!-- Tables -->
        <script src="public/js/toggle-check-all.js"></script>
        <script src="public/js/check-selected-row.js"></script>

    </body>

</html>