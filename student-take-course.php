<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include_once("Admin/includes/db_config.php");
session_start();

header("Cache-Control: no-cache, must-revalidate");
header("Expires: 0");

// Auth Check
if (!isset($_SESSION['email']) || $_SESSION['role'] != 3) {
    header("Location:login.php");
    exit;
}

// Course Data Fetch
$sql = "SELECT * FROM courses";
$courses = $db->query($sql);
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Student Dashboard - Courses</title>

    <link href="https://fonts.googleapis.com/css?family=Lato:400,700%7CRoboto:400,500%7CExo+2:600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

    <link type="text/css" href="public/vendor/spinkit.css" rel="stylesheet">
    <link type="text/css" href="public/css/app.css" rel="stylesheet">
    <link type="text/css" href="public/css/material-icons.css" rel="stylesheet">

    <style>
        /* Custom Styling for Course Cards */
        .course-card { transition: 0.3s; border: none; box-shadow: 0 4px 12px rgba(0,0,0,0.08); border-radius: 8px; overflow: hidden; }
        .course-card:hover { transform: translateY(-5px); box-shadow: 0 8px 20px rgba(0,0,0,0.15); }
        .thumb-container { height: 160px; background: #f0f0f0; display: flex; align-items: center; justify-content: center; overflow: hidden; }
        .thumb-container img { width: 100%; height: 100%; object-fit: cover; }
        .page-separator__text { font-weight: bold; color: #333; text-transform: uppercase; letter-spacing: 1px; }
    </style>
</head>

<body class="layout-app">

    <div class="preloader">
        <div class="sk-chase">
            <div class="sk-chase-dot"></div><div class="sk-chase-dot"></div>
            <div class="sk-chase-dot"></div><div class="sk-chase-dot"></div>
            <div class="sk-chase-dot"></div><div class="sk-chase-dot"></div>
        </div>
    </div>

    <div class="mdk-drawer-layout js-mdk-drawer-layout" data-push data-responsive-width="992px">
        <div class="mdk-drawer-layout__content page-content">

            <?php include_once("inc/st_nav.php") ?>

            <div class="container page__container page-section">
                
                <div class="page-separator mb-4">
                    <div class="page-separator__text">Available Courses</div>
                </div>

                <div class="row">
                    <?php if ($courses && $courses->num_rows > 0): ?>
                        <?php while ($row = $courses->fetch_object()): ?>
                            <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                                <div class="card h-100 course-card">
                                    
                                    <div class="thumb-container">
                                        <img src="uploads/<?= $row->thumbnail; ?>" alt="<?= htmlspecialchars($row->title); ?>">
                                    </div>
                                    
                                    <div class="card-body d-flex flex-column p-3">
                                        <div class="d-flex justify-content-between mb-2">
                                            <small class="text-warning d-flex align-items-center">
                                                <i class="material-icons" style="font-size:14px;">star</i>&nbsp;4.5
                                            </small>
                                            <small class="text-muted"><?= $row->duration; ?>h</small>
                                        </div>
                                        
                                        <h6 class="card-title font-weight-bold" style="font-size: 15px; min-height: 40px;">
                                            <?= htmlspecialchars($row->title); ?>
                                        </h6>
                                        
                                        <div class="mt-auto pt-3 d-flex justify-content-between align-items-center">
                                            <div>
                                                <?php if (!empty($row->discounted_price)): ?>
                                                    <span class="h6 mb-0 text-primary font-weight-bold">$<?= $row->discounted_price; ?></span>
                                                    <small class="text-muted"><del>$<?= $row->price; ?></del></small>
                                                <?php else: ?>
                                                    <span class="h6 mb-0 text-primary font-weight-bold">$<?= $row->price; ?></span>
                                                <?php endif; ?>
                                            </div>
                                            <a href="pyment_getway/checkout_hosted.php?= $row->id; ?>" class="btn btn-primary btn-sm rounded">Enroll</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <div class="col-12"><p class="alert alert-light text-center">No courses found in database.</p></div>
                    <?php endif; ?>
                </div>

            </div>

            <?php include_once("inc/st_footer.php") ;?>

        </div>

        <div class="mdk-drawer js-mdk-drawer" id="default-drawer">
            <div class="mdk-drawer__content">
                <div class="sidebar sidebar-dark-pickled-bluewood sidebar-left" data-perfect-scrollbar>
                    <?php include_once("inc/st_sidebar.php"); ?>
                </div>
            </div>
        </div>
    </div>

    <script src="public/vendor/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="public/vendor/perfect-scrollbar.min.js"></script>
    <script src="public/vendor/dom-factory.js"></script>
    <script src="public/vendor/material-design-kit.js"></script>
    <script src="public/js/app.js"></script>
    <script src="public/js/preloader.js"></script>

</body>
</html>