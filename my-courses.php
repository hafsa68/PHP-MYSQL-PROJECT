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

$student_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 0; 

$sql = "SELECT 
            e.id as enroll_id, 
            e.enrollment_date, 
            e.is_active,
            c.id as course_id, 
            c.title, 
            c.thumbnail, 
            c.price,
            c.discounted_price,
            c.teacher_name
        FROM enrollments e
        JOIN courses c ON e.course_id = c.id
        WHERE e.student_id = '$student_id' 
        ORDER BY e.id DESC";

$result = $db->query($sql);
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>My Courses & Enrollment</title>

    <link href="https://fonts.googleapis.com/css?family=Lato:400,700%7CRoboto:400,500%7CExo+2:600&display=swap" rel="stylesheet">
    <link type="text/css" href="public/css/material-icons.css" rel="stylesheet">
    <link type="text/css" href="public/css/fontawesome.css" rel="stylesheet">
    <link type="text/css" href="public/css/app.css" rel="stylesheet">

    <style>
        .badge-active { background-color: #28a745; color: #fff; }
        .badge-pending { background-color: #ffc107; color: #000; }
        .course-img { border-radius: 4px; object-fit: cover; }
        
        /* কলাম এক লাইনে রাখার ম্যাজিক স্টাইল */
        .table-custom { font-size: 13px; } /* ফন্ট সামান্য ছোট করা হয়েছে */
        .table-custom th, .table-custom td { 
            padding: 12px 8px !important; 
            white-space: nowrap; /* লেখা এক লাইনে রাখবে */
            vertical-align: middle;
        }
        
        /* ছোট স্ক্রিনে স্ক্রলিং সুবিধা কিন্তু দেখতে সুন্দর */
        .custom-card { overflow-x: auto; -webkit-overflow-scrolling: touch; }
        
        /* কোর্সের নাম বেশি লম্বা হলে ডট ডট (...) দেখাবে */
        .text-truncate-custom {
            max-width: 180px;
            display: inline-block;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
    </style>
</head>

<body class="layout-app">

    <div class="mdk-drawer-layout js-mdk-drawer-layout" data-push data-responsive-width="992px">
        <div class="mdk-drawer-layout__content page-content">

            <?php include_once("inc/st_nav.php") ?>

            <div class="container-fluid page__container py-32pt"> <div class="page-section">
                    <div class="page-separator">
                        <div class="page-separator__text">My Subscriptions & Courses</div>
                    </div>

                    <div class="card mb-0 shadow-sm custom-card">
                        <table class="table table-flush table-custom">
                            <thead>
                                <tr>
                                    <th>Course Details</th>
                                    <th>Instructor</th>
                                    <th>Price</th>
                                    <th>Discounted</th>
                                    <th>Enrolled Date</th>
                                    <th>Status</th>
                                    <th class="text-right">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if($result && $result->num_rows > 0): ?>
                                    <?php while($row = $result->fetch_object()): ?>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <img src="uploads/<?= $row->thumbnail; ?>" width="40" height="40" class="mr-2 course-img" alt="course">
                                                <a href="take-course.php?id=<?= $row->course_id; ?>" class="text-body text-truncate-custom" title="<?= htmlspecialchars($row->title); ?>">
                                                    <strong><?= htmlspecialchars($row->title); ?></strong>
                                                </a>
                                            </div>
                                        </td>
                                        <td><small class="text-muted"><?= htmlspecialchars($row->teacher_name); ?></small></td>
                                        <td><small><?= number_format($row->price); ?> ৳</small></td>
                                        <td><strong><?= number_format($row->discounted_price); ?> ৳</strong></td>
                                        <td><small><?= date('d M, Y', strtotime($row->enrollment_date)); ?></small></td>
                                        <td>
                                            <?php if($row->is_active == 1): ?>
                                                <span class="badge badge-active p-1 px-2 rounded-pill small">Active</span>
                                            <?php else: ?>
                                                <span class="badge badge-pending p-1 px-2 rounded-pill small">Pending</span>
                                            <?php endif; ?>
                                        </td>
                                        <td class="text-right">
                                            <div class="d-flex justify-content-end">
                                                <a href="generate_invoice.php?id=<?= $row->enroll_id; ?>" target="_blank" class="btn btn-outline-secondary btn-sm mr-1" title="Invoice">
                                                    <i class="material-icons" style="font-size: 16px;">receipt</i>
                                                </a>
                                                <a href="view-course.php?id=<?= $row->course_id; ?>" class="btn btn-primary btn-sm">Start</a>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php endwhile; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="7" class="text-center text-muted py-5">No records found.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
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