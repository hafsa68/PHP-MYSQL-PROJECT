<?php include_once("includes/db_config.php"); ?>
<!DOCTYPE html>
<html lang="en"
    dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible"
        content="IE=edge">
    <meta name="viewport"
        content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Forms</title>

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

    <!-- Flatpickr -->
    <link type="text/css"
        href="../public/css/flatpickr.css"
        rel="stylesheet">
    <link type="text/css"
        href="../public/css/flatpickr-airbnb.css"
        rel="stylesheet">

    <!-- DateRangePicker -->
    <link type="text/css"
        href="../public/vendor/daterangepicker.css"
        rel="stylesheet">

    <!-- Quill Theme -->
    <link type="text/css"
        href="../public/css/quill.css"
        rel="stylesheet">

    <!-- Touchspin -->
    <link type="text/css"
        href="../public/css/bootstrap-touchspin.css"
        rel="stylesheet">

    <!-- Select2 -->
    <link type="text/css"
        href="../public/vendor/select2/select2.min.css"
        rel="stylesheet">
    <link type="text/css"
        href="../public/css/select2.css"
        rel="stylesheet">

</head>

<body class="layout-app ui ">

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
                                href="login.html">Logout</a>
                        </div>
                    </div>
                </div>

                <!-- // END Navbar Menu -->

            </div>

            <!-- // END Navbar -->

            <!-- // END Header -->

            <div class="pt-32pt">
                <div class="container page__container d-flex flex-column flex-md-row align-items-center text-center text-sm-left">
                    <div class="flex d-flex flex-column flex-sm-row align-items-center">

                        <div class="mb-24pt mb-sm-0 mr-sm-24pt">
                            <h2 class="mb-0">Forms</h2>

                            <ol class="breadcrumb p-0 m-0">
                                <li class="breadcrumb-item"><a href="index.html">Home</a></li>

                                <li class="breadcrumb-item">

                                    <a href="">Components</a>

                                </li>

                                <li class="breadcrumb-item active">

                                    Forms

                                </li>

                            </ol>

                        </div>
                    </div>

                </div>
            </div>

            <!-- BEFORE Page Content -->

            <!-- // END BEFORE Page Content -->

            <!-- Page Content -->


            <div class="container page__container page-section">
                <?php
                if (isset($_POST['submit'])) {
                    $name = ($_POST['name']);
                    $description = ($_POST['description']);
                    $sql = "INSERT INTO categories (name, description, created_at) VALUES ('$name','$description', NOW())";
                     $db->query($sql);
                     
                    if ($db->affected_rows) {
                        
                        echo '<div class="alert alert-soft-success d-flex"
            role="alert">
            <i class="material-icons mr-12pt">check_circle</i>
            <div class="text-body">
            Successfully Inserted
            
            </div> </div>';
            
                    } else {
                        echo ('Error');
                    }
                }
                ?>
                <div class="row mb-32pt">

                    <div class="col-lg-8 d-flex align-items-center">

                        <div class="flex" style="max-width: 100%">

                            <!-- Form Start -->
                            <form action="" method="POST">

                                <div class="form-group">
                                    <label class="form-label" for="categoryName">Category Name:</label>
                                    <input type="text"
                                        class="form-control"
                                        id="categoryName"
                                        name="name"
                                        placeholder="Enter category name"
                                        required>
                                </div>

                                <div class="form-group mt-3">
                                    <label class="form-label" for="categoryDescription">Description:</label>
                                    <textarea class="form-control"
                                        id="categoryDescription"
                                        name="description"
                                        placeholder="Write something..."
                                        rows="3"></textarea>
                                </div>

                                <button type="submit" name="submit" class="btn btn-primary mt-3">
                                    Add New Category
                                </button>
                                     &nbsp;
                            &nbsp;
                            &nbsp;
                            &nbsp;
                               <a href="category_manage.php" class="btn btn-primary mt-3">CHECK</a>
                            </form>
                            <!-- Form End -->

                        </div>
                    </div>

                </div>



            </div>

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

                    <?php include_once("includes/sidebar.php"); ?>
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

    <!-- Touchspin -->
    <script src="../public/vendor/jquery.bootstrap-touchspin.js"></script>
    <script src="../public/js/touchspin.js"></script>

    <!-- Flatpickr -->
    <script src="../public/vendor/flatpickr/flatpickr.min.js"></script>
    <script src="../public/js/flatpickr.js"></script>

    <!-- DateRangePicker -->
    <script src="../public/vendor/moment.min.js"></script>
    <script src="../public/vendor/daterangepicker.js"></script>
    <script src="../public/js/daterangepicker.js"></script>

    <!-- jQuery Mask Plugin -->
    <script src="../public/vendor/jquery.mask.min.js"></script>

    <!-- Quill -->
    <script src="../public/vendor/quill.min.js"></script>
    <script src="../public/js/quill.js"></script>

    <!-- Select2 -->
    <script src="../public/vendor/select2/select2.min.js"></script>
    <script src="../public/js/select2.js"></script>

</body>

</html>