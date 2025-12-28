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

$student_email = $_SESSION['email'];

// Student result query
$sql = "SELECT * FROM tbl_result WHERE quiz_taker = '$student_email' ORDER BY date_taken DESC";
$results = $db->query($sql);

// Total Questions Count
$q_count_res = $db->query("SELECT COUNT(*) as total FROM tbl_quiz");
$q_row = $q_count_res->fetch_assoc();
$total_questions = $q_row['total'] > 0 ? $q_row['total'] : 1; 
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>My Result History</title>

    <link href="https://fonts.googleapis.com/css?family=Lato:400,700%7CRoboto:400,500%7CExo+2:600&display=swap" rel="stylesheet">
    <link type="text/css" href="public/vendor/spinkit.css" rel="stylesheet">
    <link type="text/css" href="public/vendor/perfect-scrollbar.css" rel="stylesheet">
    <link type="text/css" href="public/css/material-icons.css" rel="stylesheet">
    <link type="text/css" href="public/css/fontawesome.css" rel="stylesheet">
    <link type="text/css" href="public/css/preloader.css" rel="stylesheet">
    <link type="text/css" href="public/css/app.css" rel="stylesheet">

    <style>
        .result-list-card { border: none; border-radius: 12px; box-shadow: 0 5px 20px rgba(0,0,0,0.05); overflow: hidden; }
        .table thead { background-color: #f8faff; }
        .table thead th { border-bottom: none; color: #5567ff; text-transform: uppercase; font-size: 11px; letter-spacing: 1px; padding: 15px; }
        .table td { vertical-align: middle !important; padding: 15px; color: #4e5154; border-top: 1px solid #f1f3f5; }
        .status-badge { padding: 5px 12px; border-radius: 20px; font-size: 11px; font-weight: bold; text-transform: uppercase; }
        .status-pass { background: #e8fadf; color: #2ecc71; }
        .status-fail { background: #ffebeb; color: #e74c3c; }
        .score-text { font-weight: bold; font-size: 15px; color: #333; }
        .date-box { display: flex; align-items: center; color: #888; }
        .date-box i { font-size: 16px; margin-right: 8px; color: #5567ff; }
        .progress-slim { height: 6px; border-radius: 10px; background: #eee; width: 100px; margin-top: 5px; }
    </style>
</head>

<body class="layout-app">

    <div class="preloader">
        <div class="sk-chase">
            <div class="sk-chase-dot"></div>
            <div class="sk-chase-dot"></div>
            <div class="sk-chase-dot"></div>
            <div class="sk-chase-dot"></div>
            <div class="sk-chase-dot"></div>
            <div class="sk-chase-dot"></div>
        </div>
    </div>

    <div class="mdk-drawer-layout js-mdk-drawer-layout" data-push data-responsive-width="992px">
        <div class="mdk-drawer-layout__content page-content">

            <?php include_once("inc/st_nav.php") ?>

            <div class="container page__container page-section">
                <div class="d-flex align-items-center mb-4">
                    <div class="flex">
                        <h2 class="h4 mb-0">My Performance History</h2>
                        <p class="text-muted mb-0">List of all your completed quiz sessions</p>
                    </div>
                    <a href="quiz.php" class="btn btn-outline-primary btn-sm">Take New Quiz</a>
                </div>

                <div class="card result-list-card">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>Attempt Date</th>
                                    <th>Obtained Score</th>
                                    <th>Accuracy</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-right">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if ($results && $results->num_rows > 0): ?>
                                    <?php while ($row = $results->fetch_assoc()): 
                                        $score = $row['total_score'];
                                        $percent = round(($score / $total_questions) * 100);
                                        $is_passed = ($percent >= 50);
                                    ?>
                                    <tr>
                                        <td>
                                            <div class="date-box">
                                                <i class="material-icons">event_note</i>
                                                <span><?= date('d M, Y', strtotime($row['date_taken'])); ?></span>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="score-text"><?= $score; ?></span> 
                                            <small class="text-muted">/ <?= $total_questions; ?></small>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <span class="mr-2 font-weight-bold" style="font-size: 12px;"><?= $percent; ?>%</span>
                                                <div class="progress progress-slim">
                                                    <div class="progress-bar <?= $is_passed ? 'bg-success' : 'bg-danger' ?>" 
                                                         style="width: <?= $percent; ?>%"></div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <span class="status-badge <?= $is_passed ? 'status-pass' : 'status-fail' ?>">
                                                <?= $is_passed ? 'Passed' : 'Failed' ?>
                                            </span>
                                        </td>
                                        <td class="text-right">
                                            <button class="btn btn-sm btn-white text-primary shadow-sm" title="View Details">
                                                <i class="material-icons" style="font-size: 18px;">visibility</i>
                                            </button>
                                        </td>
                                    </tr>
                                    <?php endwhile; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="5" class="text-center py-5">
                                            <p class="text-muted mb-0">No result data found.</p>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
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
    <script src="public/vendor/popper.min.js"></script>
    <script src="public/vendor/bootstrap.min.js"></script>
    <script src="public/vendor/perfect-scrollbar.min.js"></script>
    <script src="public/vendor/dom-factory.js"></script>
    <script src="public/vendor/material-design-kit.js"></script>
    <script src="public/js/app.js"></script>
    <script src="public/js/preloader.js"></script>
    <script src="public/js/settings.js"></script>
</body>

</html>