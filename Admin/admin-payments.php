<?php
include_once("../Admin/includes/db_config.php"); 
session_start();

// ডাটাবেজ কোয়েরি
$sql = "SELECT 
            e.id as enroll_id, 
            u.full_name as student_name, 
            u.email as student_email, 
            c.title as course_title, 
            e.enrollment_date, 
            e.is_active 
        FROM enrollments e
        INNER JOIN users u ON e.student_id = u.id
        INNER JOIN courses c ON e.course_id = c.id
        WHERE u.role = 3  
        ORDER BY e.enrollment_date DESC";

$result = $db->query($sql);
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Enrollment Dashboard</title>

    <link href="https://fonts.googleapis.com/css?family=Lato:400,700%7CRoboto:400,500%7CExo+2:600&display=swap" rel="stylesheet">
    <link type="text/css" href="../public/vendor/spinkit.css" rel="stylesheet">
    <link type="text/css" href="../public/vendor/perfect-scrollbar.css" rel="stylesheet">
    <link type="text/css" href="../public/css/material-icons.css" rel="stylesheet">
    <link type="text/css" href="../public/css/fontawesome.css" rel="stylesheet">
    <link type="text/css" href="../public/css/preloader.css" rel="stylesheet">
    <link type="text/css" href="../public/css/app.css" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <style>
        .status-badge { padding: 5px 10px; border-radius: 4px; font-size: 12px; }
        .table thead th { background-color: #f8f9fa; border-top: none; }
        /* Sidebar layout fix */
        .mdk-drawer-layout__content { min-height: 100vh; }
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

            <div class="navbar navbar-expand pr-0 navbar-light border-bottom-2"
                id="default-navbar"
                data-primary>

                <!-- Navbar Toggler -->

                <button class="navbar-toggler w-auto mr-16pt d-block d-lg-none rounded-0"
                    type="button"
                    data-toggle="sidebar">
                    <span class="material-icons">short_text</span>
                </button>

                <!-- // END Navbar Toggler -->

                <!-- Navbar Brand -->

                <a href="index.html"
                    class="navbar-brand mr-16pt d-lg-none">

                    <span class="avatar avatar-sm navbar-brand-icon mr-0 mr-lg-8pt">

                        <span class="avatar-title rounded bg-primary"><img src="../public/images/illustration/student/128/white.svg"
                                alt="logo"
                                class="img-fluid" /></span>

                    </span>

                    <span class="d-none d-lg-block">Luma</span>
                </a>

                <!-- // END Navbar Brand -->

                <span class="d-none d-md-flex align-items-center mr-16pt">

                    <span class="avatar avatar-sm mr-12pt">

                        <span class="avatar-title rounded navbar-avatar"><i class="material-icons">trending_up</i></span>

                    </span>

                    <small class="flex d-flex flex-column">
                        <strong class="navbar-text-100">Earnings</strong>
                        <span class="navbar-text-50">&dollar;12.3k</span>
                    </small>
                </span>
                <span class="d-none d-md-flex align-items-center mr-16pt">

                    <span class="avatar avatar-sm mr-12pt">

                        <span class="avatar-title rounded navbar-avatar"><i class="material-icons">receipt</i></span>

                    </span>

                    <small class="flex d-flex flex-column">
                        <strong class="navbar-text-100">Sales</strong>
                        <span class="navbar-text-50">264</span>
                    </small>
                </span>

                <div class="flex"></div>

                <!-- Switch Layout -->

                <a href="../Compact_App_Layout/ui-forms.html"
                    class="navbar-toggler navbar-toggler-custom align-items-center justify-content-center d-none d-lg-flex"
                    data-toggle="tooltip"
                    data-title="Switch to Compact Layout"
                    data-placement="bottom"
                    data-boundary="window">
                    <span class="material-icons">swap_horiz</span>
                </a>

                <!-- // END Switch Layout -->

                <!-- Navbar Menu -->

                <div class="nav navbar-nav flex-nowrap d-flex mr-16pt">

                    <!-- Notifications dropdown -->
                    <div class="nav-item dropdown dropdown-notifications dropdown-xs-down-full"
                        data-toggle="tooltip"
                        data-title="Messages"
                        data-placement="bottom"
                        data-boundary="window">
                        <button class="nav-link btn-flush dropdown-toggle"
                            type="button"
                            data-toggle="dropdown"
                            data-caret="false">
                            <i class="material-icons icon-24pt">mail_outline</i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right">
                            <div data-perfect-scrollbar
                                class="position-relative">
                                <div class="dropdown-header"><strong>Messages</strong></div>
                                <div class="list-group list-group-flush mb-0">

                                    <a href="javascript:void(0);"
                                        class="list-group-item list-group-item-action unread">
                                        <span class="d-flex align-items-center mb-1">
                                            <small class="text-black-50">5 minutes ago</small>

                                            <span class="ml-auto unread-indicator bg-accent"></span>

                                        </span>
                                        <span class="d-flex">
                                            <span class="avatar avatar-xs mr-2">
                                                <img src="../public/images/people/110/woman-5.jpg"
                                                    alt="people"
                                                    class="avatar-img rounded-circle">
                                            </span>
                                            <span class="flex d-flex flex-column">
                                                <strong class="text-black-100">Michelle</strong>
                                                <span class="text-black-70">Clients loved the new design.</span>
                                            </span>
                                        </span>
                                    </a>

                                    <a href="javascript:void(0);"
                                        class="list-group-item list-group-item-action">
                                        <span class="d-flex align-items-center mb-1">
                                            <small class="text-black-50">5 minutes ago</small>

                                        </span>
                                        <span class="d-flex">
                                            <span class="avatar avatar-xs mr-2">
                                                <img src="../public/images/people/110/woman-5.jpg"
                                                    alt="people"
                                                    class="avatar-img rounded-circle">
                                            </span>
                                            <span class="flex d-flex flex-column">
                                                <strong class="text-black-100">Michelle</strong>
                                                <span class="text-black-70">🔥 Superb job..</span>
                                            </span>
                                        </span>
                                    </a>

                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- // END Notifications dropdown -->

                    <!-- Notifications dropdown -->
                    <div class="nav-item ml-16pt dropdown dropdown-notifications dropdown-xs-down-full"
                        data-toggle="tooltip"
                        data-title="Notifications"
                        data-placement="bottom"
                        data-boundary="window">
                        <button class="nav-link btn-flush dropdown-toggle"
                            type="button"
                            data-toggle="dropdown"
                            data-caret="false">
                            <i class="material-icons">notifications_none</i>
                            <span class="badge badge-notifications badge-accent">2</span>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right">
                            <div data-perfect-scrollbar
                                class="position-relative">
                                <div class="dropdown-header"><strong>System notifications</strong></div>
                                <div class="list-group list-group-flush mb-0">

                                    <a href="javascript:void(0);"
                                        class="list-group-item list-group-item-action unread">
                                        <span class="d-flex align-items-center mb-1">
                                            <small class="text-black-50">3 minutes ago</small>

                                            <span class="ml-auto unread-indicator bg-accent"></span>

                                        </span>
                                        <span class="d-flex">
                                            <span class="avatar avatar-xs mr-2">
                                                <span class="avatar-title rounded-circle bg-light">
                                                    <i class="material-icons font-size-16pt text-accent">account_circle</i>
                                                </span>
                                            </span>
                                            <span class="flex d-flex flex-column">

                                                <span class="text-black-70">Your profile information has not been synced correctly.</span>
                                            </span>
                                        </span>
                                    </a>

                                    <a href="javascript:void(0);"
                                        class="list-group-item list-group-item-action">
                                        <span class="d-flex align-items-center mb-1">
                                            <small class="text-black-50">5 hours ago</small>

                                        </span>
                                        <span class="d-flex">
                                            <span class="avatar avatar-xs mr-2">
                                                <span class="avatar-title rounded-circle bg-light">
                                                    <i class="material-icons font-size-16pt text-primary">group_add</i>
                                                </span>
                                            </span>
                                            <span class="flex d-flex flex-column">
                                                <strong class="text-black-100">Adrian. D</strong>
                                                <span class="text-black-70">Wants to join your private group.</span>
                                            </span>
                                        </span>
                                    </a>

                                    <a href="javascript:void(0);"
                                        class="list-group-item list-group-item-action">
                                        <span class="d-flex align-items-center mb-1">
                                            <small class="text-black-50">1 day ago</small>

                                        </span>
                                        <span class="d-flex">
                                            <span class="avatar avatar-xs mr-2">
                                                <span class="avatar-title rounded-circle bg-light">
                                                    <i class="material-icons font-size-16pt text-warning">storage</i>
                                                </span>
                                            </span>
                                            <span class="flex d-flex flex-column">

                                                <span class="text-black-70">Your deploy was successful.</span>
                                            </span>
                                        </span>
                                    </a>

                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- // END Notifications dropdown -->

                    <div class="nav-item dropdown">
                        <a href="#"
                            class="nav-link d-flex align-items-center dropdown-toggle"
                            data-toggle="dropdown"
                            data-caret="false">

                            <span class="avatar avatar-sm mr-8pt2">

                                <span class="avatar-title rounded-circle bg-primary"><i class="material-icons">account_box</i></span>

                            </span>

                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <div class="dropdown-header"><strong>Account</strong></div>
                            <a class="dropdown-item"
                                href="edit-account.html">Edit Account</a>
                            <a class="dropdown-item"
                                href="billing.html">Billing</a>
                            <a class="dropdown-item"
                                href="billing-history.html">Payments</a>
                            <a class="dropdown-item"
                                href="logout.php">Logout</a>
                        </div>
                    </div>
                </div>

                <!-- // END Navbar Menu -->

            </div>

    
            <div class="pt-32pt">
                <div class="container page__container d-flex flex-column flex-md-row align-items-center">
                    <div class="flex mb-24pt mb-md-0">
                        <h2 class="mb-0">Enrollments</h2>
                        <ol class="breadcrumb p-0 m-0">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Enrollment Payments</li>
                        </ol>
                    </div>
                </div>
            </div>

            <div class="container page__container page-section">
                <div class="card shadow-sm">
                    <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
                        <h4 class="mb-0" style="color: white;">All Enrollment Payments</h4>
                        <span class="badge badge-light"><?= ($result) ? $result->num_rows : 0; ?> Total Records</span>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0 align-middle">
                                <thead>
                                    <tr>
                                        <th class="pl-4">#ID</th>
                                        <th>Student Details</th>
                                        <th>Enrolled Course</th>
                                        <th>Enroll Date</th>
                                        <th>Status</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    if ($result && $result->num_rows > 0) {
                                        while($row = $result->fetch_assoc()) {
                                            ?>
                                            <tr>
                                                <td class="pl-4 font-weight-bold text-secondary">#<?= $row['enroll_id'] ?></td>
                                                <td>
                                                    <div class="font-weight-bold"><?= $row['student_name'] ?></div>
                                                    <small class="text-muted"><?= $row['student_email'] ?></small>
                                                </td>
                                                <td>
                                                    <span class="badge badge-light border font-weight-normal">
                                                        <?= $row['course_title'] ?>
                                                    </span>
                                                </td>
                                                <td>
                                                    <?= date('d M, Y', strtotime($row['enrollment_date'])) ?><br>
                                                    <small class="text-muted"><?= date('h:i A', strtotime($row['enrollment_date'])) ?></small>
                                                </td>
                                                <td>
                                                    <?php if($row['is_active'] == 1): ?>
                                                        <span class="badge badge-success status-badge">Active</span>
                                                    <?php else: ?>
                                                        <span class="badge badge-danger status-badge">Inactive</span>
                                                    <?php endif; ?>
                                                </td>
                                                <td class="text-center">
                                                    <button class="btn btn-sm btn-light border" title="Edit Status">
                                                        <i class="fas fa-edit text-primary"></i>
                                                    </button>
                                                    <button class="btn btn-sm btn-light border" title="Remove">
                                                        <i class="fas fa-trash text-danger"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    } else {
                                        echo "<tr><td colspan='6' class='text-center py-5 text-muted'>No students have enrolled yet.</td></tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    
                    <div class="card-footer bg-white">
                        <p class="text-muted small mb-0">Total Enrollments: <strong><?= ($result) ? $result->num_rows : 0 ?></strong></p>
                    </div>
                </div>
            </div>

            <?php include_once("includes/footer.php") ;?>

        </div> <div class="mdk-drawer js-mdk-drawer" id="default-drawer">
            <div class="mdk-drawer__content">
                <div class="sidebar sidebar-dark-pickled-bluewood sidebar-left" data-perfect-scrollbar>
                    <?php include_once("includes/sidebar.php"); ?>
                </div>
            </div>
        </div>

    </div>

    <script src="../public/vendor/jquery.min.js"></script>
    <script src="../public/vendor/popper.min.js"></script>
    <script src="../public/vendor/bootstrap.min.js"></script>
    <script src="../public/vendor/perfect-scrollbar.min.js"></script>
    <script src="../public/vendor/dom-factory.js"></script>
    <script src="../public/vendor/material-design-kit.js"></script>
    <script src="../public/js/app.js"></script>
    <script src="../public/js/preloader.js"></script>
    <script src="../public/js/settings.js"></script>

</body>
</html>