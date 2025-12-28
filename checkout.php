<?php 
// session start kora thaka dorkar jate user data pawa jay
session_start();
include_once("Admin/includes/db_config.php"); 

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Checkout - Dashboard</title>

    <link href="https://fonts.googleapis.com/css?family=Lato:400,700%7CRoboto:400,500%7CExo+2:600&display=swap" rel="stylesheet">
    <link type="text/css" href="public/vendor/spinkit.css" rel="stylesheet">
    <link type="text/css" href="public/vendor/perfect-scrollbar.css" rel="stylesheet">
    <link type="text/css" href="public/css/material-icons.css" rel="stylesheet">
    <link type="text/css" href="public/css/fontawesome.css" rel="stylesheet">
    <link type="text/css" href="public/css/preloader.css" rel="stylesheet">
    <link type="text/css" href="public/css/app.css" rel="stylesheet">
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
    </div>

    <div class="mdk-drawer-layout js-mdk-drawer-layout" data-push data-responsive-width="992px">
        <div class="mdk-drawer-layout__content page-content">

            <?php include_once("inc/st_nav.php"); ?>

            <div class="container-fluid page__container">
                <?php
                // 1. Data Validation
                $course_id = isset($_GET['course_id']) ? intval($_GET['course_id']) : 0;

                // 2. Fetch Course Details (Using $db variable as per your code)
                $stmt = $db->prepare("SELECT * FROM courses WHERE id = ?");
                $stmt->bind_param("i", $course_id);
                $stmt->execute();
                $course_res = $stmt->get_result();
                $course = $course_res->fetch_object();

                if (!$course): 
                ?>
                    <div class="alert alert-soft-danger d-flex align-items-center mt-5" role="alert">
                        <i class="material-icons mr-3">error</i>
                        <div class="text-body"><strong>Error:</strong> Invalid Course Selection or Course Not Found.</div>
                    </div>
                <?php 
                else: 
                    // Payment methods fetch
                    $methods = $db->query("SELECT * FROM payment_methods WHERE is_active = 1");
                    $final_price = ($course->discounted_price > 0) ? $course->discounted_price : $course->price;
                ?>

                    <div class="page-section">
                        <div class="card card-body shadow-sm border-0">
                            <form action="process-payment.php" method="POST">
                                <h3 class="mb-0">Enroll Course: <span class="text-primary"><?= htmlspecialchars($course->title); ?></span></h3>
                                <p class="text-muted">Fill out the form below to complete your enrollment.</p>
                                <hr>

                                <div class="row">
                                    <div class="col-md-7">
                                        <div class="form-group">
                                            <label class="form-label font-weight-bold">Amount to Pay:</label>
                                            <h4 class="text-success"><?= number_format($final_price, 2); ?> BDT</h4>
                                            <input type="hidden" name="course_id" value="<?= $course->id; ?>">
                                            <input type="hidden" name="amount" value="<?= $final_price; ?>">
                                        </div>

                                        <div class="form-group mt-3">
                                            <label class="form-label" for="payment_method">Select Payment Method</label>
                                            <select name="payment_method_id" id="payment_method" class="form-control custom-select" required>
                                                <option value="">-- Choose Method --</option>
                                                <?php while($m = $methods->fetch_object()): ?>
                                                    <option value="<?= $m->id; ?>"><?= $m->name; ?> (<?= $m->account_number; ?>)</option>
                                                <?php endwhile; ?>
                                            </select>
                                        </div>

                                        <div class="form-group mt-3">
                                            <label class="form-label">Your Mobile Number (Payment Number)</label>
                                            <input type="text" name="mobile_number" class="form-control" placeholder="01XXXXXXXXX" required pattern="[0-9]{11}">
                                        </div>

                                        <div class="form-group mt-3">
                                            <label class="form-label">Transaction ID (TrxID)</label>
                                            <input type="text" name="transaction_number" class="form-control text-uppercase" placeholder="Enter TrxID" required>
                                        </div>

                                        <button type="submit" class="btn btn-primary btn-block mt-4">Confirm Payment</button>
                                    </div>

                                   
                                </div>
                            </form>
                        </div>
                    </div>

                <?php endif; // Correct closing tag for line 88 issue ?>
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
    <script src="public/vendor/popper.min.js"></script>
    <script src="public/vendor/bootstrap.min.js"></script>
    <script src="public/vendor/perfect-scrollbar.min.js"></script>
    <script src="public/vendor/dom-factory.js"></script>
    <script src="public/vendor/material-design-kit.js"></script>
    <script src="public/js/app.js"></script>
    <script src="public/js/preloader.js"></script>
</body>
</html>