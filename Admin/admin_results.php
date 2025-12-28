<?php include_once("includes/db_config.php");
session_start();
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
        <title>Edit Quiz</title>

        <!-- Prevent the demo from appearing in search engines -->
        <meta name="robots"
              content="noindex">

        <link href="https://fonts.googleapis.com/css?family=Lato:400,700%7CRoboto:400,500%7CExo+2:600&display=swap"
              rel="stylesheet">

        <!-- Preloader -->
        <link type="text/css"
              href="../public/vendor/spinkit.css"
              rel="stylesheet">

        <!-- Perfect Scrollbar -->
        <link type="text/css"
              href="../public/vendor/perfect-scrollbar.css"
              rel="stylesheet">

        <!-- Material Design Icons -->
        <link type="text/css"
              href="../public/css/material-icons.css"
              rel="stylesheet">

        <!-- Font Awesome Icons -->
        <link type="text/css"
              href="../public/css/fontawesome.css"
              rel="stylesheet">

        <!-- Preloader -->
        <link type="text/css"
              href="../public/css/preloader.css"
              rel="stylesheet">

        <!-- App CSS -->
        <link type="text/css"
              href="../public/css/app.css"
              rel="stylesheet">

        <!-- Quill Theme -->
        <link type="text/css"
              href="../public/css/quill.css"
              rel="stylesheet">
        <!-- Select2 -->
        <link type="text/css"
              href="../public/vendor/select2/select2.min.css"
              rel="stylesheet">
        <link type="text/css"
              href="../public/css/select2.css"
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

                <?php include_once("includes/th_nav.php"); ?>

                <!-- // END Navbar -->

                <!-- // END Header -->

               

                <!-- BEFORE Page Content -->

                <!-- // END BEFORE Page Content -->
<?php
include_once("includes/db_config.php");
$results = $db->query("SELECT * FROM tbl_result ORDER BY date_taken DESC");
?>

<div class="container mt-5">
    <h3>Student Quiz Results</h3>
    <table class="table table-bordered table-striped">
        <thead class="thead-dark">
            <tr>
                <th>ID</th>
                <th>Student Email</th>
                <th>Total Score</th>
                <th>Date Taken</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = $results->fetch_assoc()): ?>
            <tr>
                <td><?= $row['tbl_result_id']; ?></td>
                <td><?= $row['quiz_taker']; ?></td>
                <td><span class="badge badge-success"><?= $row['total_score']; ?></span></td>
                <td><?= $row['date_taken']; ?></td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>
                <!-- Page Content -->

                

                <!-- // END Page Content -->

                <!-- Footer -->

                <div class="bg-white border-top-2 mt-auto">
                    <div class="container page__container page-section d-flex flex-column">
                        <p class="text-70 brand mb-24pt">
                            <img class="brand-icon"
                                 src="../public/images/logo/black-70@2x.png"
                                 width="30"
                                 alt="Luma"> Luma
                        </p>
                        <p class="measure-lead-max text-50 small mr-8pt">Luma is a beautifully crafted user interface for modern Education Platforms, including Courses & Tutorials, Video Lessons, Student and Teacher Dashboard, Curriculum Management, Earnings and Reporting, ERP, HR, CMS, Tasks, Projects, eCommerce and more.</p>
                        <p class="mb-8pt d-flex">
                            <a href=""
                               class="text-70 text-underline mr-8pt small">Terms</a>
                            <a href=""
                               class="text-70 text-underline small">Privacy policy</a>
                        </p>
                        <p class="text-50 small mt-n1 mb-0">Copyright 2019 &copy; All rights reserved.</p>
                    </div>
                </div>

                <!-- // END Footer -->

            </div>

            <!-- // END drawer-layout__content -->

            <!-- Drawer -->

            <div class="mdk-drawer js-mdk-drawer"
                 id="default-drawer">
                <div class="mdk-drawer__content">
                    <div class="sidebar sidebar-dark-pickled-bluewood sidebar-left"
                         data-perfect-scrollbar>

                        <!-- Sidebar Content -->
                         <?php include_once("includes/sidebar.php") ?>
                        <!-- // END Sidebar Content -->

                    </div>
                </div>
            </div>

            <!-- // END Drawer -->

        </div>

        <!-- // END Drawer Layout -->

        <!-- jQuery -->
        <script src="../public/vendor/jquery.min.js"></script>

        <!-- Bootstrap -->
        <script src="../public/vendor/popper.min.js"></script>
        <script src="../public/vendor/bootstrap.min.js"></script>

        <!-- Perfect Scrollbar -->
        <script src="../public/vendor/perfect-scrollbar.min.js"></script>

        <!-- DOM Factory -->
        <script src="../public/vendor/dom-factory.js"></script>

        <!-- MDK -->
        <script src="../public/vendor/material-design-kit.js"></script>

        <!-- App JS -->
        <script src="../public/js/app.js"></script>

        <!-- Preloader -->
        <script src="../public/js/preloader.js"></script>

        <!-- Quill -->
        <script src="../public/vendor/quill.min.js"></script>
        <script src="../public/js/quill.js"></script>
        <!-- Select2 -->
        <script src="../public/vendor/select2/select2.min.js"></script>
        <script src="../public/js/select2.js"></script>

        <!-- Highlight.js -->
        <script src="../public/js/hljs.js"></script>

    </body>

</html>