<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include_once("Admin/includes/db_config.php");
session_start();

header("Cache-Control: no-cache, must-revalidate");
header("Expires: 0");

// Student check logic
if (!isset($_SESSION['email']) || $_SESSION['role'] != 3) {
    header("Location:login.php");
    exit;
}

// Enrollment Data Fetching Logic
$student_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 1; 

$sql = "SELECT payments.*, courses.title, courses.thumbnail 
        FROM payments 
        JOIN courses ON payments.course_id = courses.id 
        WHERE payments.student_id = '$student_id' 
        ORDER BY payments.id DESC";

$result = $db->query($sql);
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>My Enrollment Status</title>

    <link href="https://fonts.googleapis.com/css?family=Lato:400,700%7CRoboto:400,500%7CExo+2:600&display=swap" rel="stylesheet">
    <link type="text/css" href="public/css/material-icons.css" rel="stylesheet">
    <link type="text/css" href="public/css/fontawesome.css" rel="stylesheet">
    <link type="text/css" href="public/css/app.css" rel="stylesheet">

    <style>
        .badge-pending { background-color: #ffc107; color: #000; }
        .badge-completed { background-color: #28a745; color: #fff; }
        .badge-failed { background-color: #dc3545; color: #fff; }
    </style>
</head>

<body class="layout-app">

    <div class="mdk-drawer-layout js-mdk-drawer-layout" data-push data-responsive-width="992px">
        <div class="mdk-drawer-layout__content page-content">

            <?php include_once("inc/st_nav.php") ?>

            <div class="container page__container py-32pt">
                <div class="page-section">
                    <div class="page-separator">
                        <div class="page-separator__text">My Enrollment & Payments</div>
                    </div>

                    <div class="card mb-0">
                        <div class="table-responsive">
                            <table class="table table-flush table-nowrap">
                                <thead>
                                    <tr>
                                        <th>Course</th>
                                        <th>Trx ID</th>
                                        <th>Amount</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if($result->num_rows > 0): ?>
                                        <?php while($row = $result->fetch_object()): ?>
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <img src="uploads/<?= $row->thumbnail; ?>" width="40" class="mr-2 rounded">
                                                    <span class="js-lists-values-course"><strong><?= htmlspecialchars($row->title); ?></strong></span>
                                                </div>
                                            </td>
                                            <td><small class="text-muted"><?= $row->transaction_number; ?></small></td>
                                            <td><strong>$<?= $row->amount; ?></strong></td>
                                            <td><?= date('d M, Y', strtotime($row->paid_at)); ?></td>
                                            <td>
                                                <?php 
                                                    $statusClass = 'badge-pending';
                                                    if($row->payment_status == 'completed') $statusClass = 'badge-completed';
                                                    if($row->payment_status == 'failed') $statusClass = 'badge-failed';
                                                ?>
                                                <span class="badge <?= $statusClass; ?> p-1">
                                                    <?= ucfirst($row->payment_status); ?>
                                                </span>
                                            </td>
                                        </tr>
                                        <?php endwhile; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="5" class="text-center text-muted py-4">You haven't enrolled in any courses yet.</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <?php include_once("inc/st_footer.php"); ?>

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
    <script src="public/vendor/bootstrap.min.js"></script>
    <script src="public/vendor/dom-factory.js"></script>
    <script src="public/vendor/material-design-kit.js"></script>
    <script src="public/js/app.js"></script>
</body>
</html>