<?php include_once("includes/db_config.php");
session_start(); ?>
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
                                href="logout.php">Logout</a>
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
    // 1. Data Sanitization
    $title = mysqli_real_escape_string($db, $_POST['title']);
    $description = mysqli_real_escape_string($db, $_POST['description']);
    $short_description = mysqli_real_escape_string($db, $_POST['short_description']);
    $price = floatval($_POST['price']);
    $discounted_price = floatval($_POST['discounted_price']);
    $category_id = intval($_POST['category_id']);
    $teacher_name = intval($_POST['teacher_name']);
    $level = mysqli_real_escape_string($db, $_POST['level']);
    $duration = intval($_POST['duration']);

    // Checkbox logic
    $is_published = isset($_POST['is_published']) ? 1 : 0;
    $is_featured = isset($_POST['is_featured']) ? 1 : 0;

    // 2. Image Upload
    $thumbnail = '';
    if (isset($_FILES['thumbnail']) && $_FILES['thumbnail']['error'] == 0) {
        $target_dir = "../uploads/";
        if (!file_exists($target_dir)) {
            mkdir($target_dir, 0777, true);
        }
        $file_name = time() . '_' . basename($_FILES['thumbnail']['name']);
        $upload_path = $target_dir . $file_name;

        if (move_uploaded_file($_FILES['thumbnail']['tmp_name'], $upload_path)) {
            $thumbnail = $file_name;
        }
    }

    // 3. Slug creation
    $slug = strtolower(trim($title));
    $slug = preg_replace('/[^a-z0-9]+/', '-', $slug) . '-' . time();

    // 4. Final SQL Query (Quotes removed for Integer fields)
    $sql = "INSERT INTO courses (
        title, slug, description, short_description, 
        price, discounted_price, category_id, teacher_name,
        thumbnail, level, duration,
        is_published, is_featured,
        created_at, updated_at
    ) VALUES (
        '$title', '$slug', '$description', '$short_description',
        $price, $discounted_price, $category_id, $teacher_name,
        '$thumbnail', '$level', $duration,
        $is_published, $is_featured,
        NOW(), NOW()
    )";

    // 5. Execute and Check
    if (mysqli_query($db, $sql)) {
        echo '<div class="alert alert-success">Course added successfully!</div>';
    } else {
        // Eta apnake exact error-ti bole dibe
        echo '<div class="alert alert-danger">Error: ' . mysqli_error($db) . '</div>';
    }
}
?>
                <div class="row mb-32pt">
                    <div class="col-lg-8 d-flex align-items-center">
                        <div class="flex" style="max-width: 100%">


                            <form action="" method="POST" enctype="multipart/form-data">


                                <div class="form-group mt-3">
                                    <label class="form-label" for="title">Course Title:</label>
                                    <input type="text"
                                        class="form-control"
                                        id="title"
                                        name="title"
                                        placeholder="Enter course title"
                                        maxlength="100"
                                        required>
                                    <small class="form-text text-muted">Maximum 100 characters</small>
                                </div>


                                <div class="form-group mt-3">
                                    <label class="form-label" for="description">Description:</label>
                                    <textarea class="form-control"
                                        id="description"
                                        name="description"
                                        placeholder="Write detailed course description..."
                                        rows="4"
                                        required></textarea>
                                </div>


                                <div class="form-group mt-3">
                                    <label class="form-label" for="short_description">Short Description:</label>
                                    <textarea class="form-control"
                                        id="short_description"
                                        name="short_description"
                                        placeholder="Brief summary (for course cards)"
                                        rows="2"
                                        maxlength="255"></textarea>
                                    <small class="form-text text-muted">Maximum 255 characters</small>
                                </div>


                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mt-3">
                                            <label class="form-label" for="price">Price ($):</label>
                                            <input type="number"
                                                class="form-control"
                                                id="price"
                                                name="price"
                                                placeholder="0.00"
                                                step="0.01"
                                                min="0"
                                                max="99999.99"
                                                value="0.00"
                                                required>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group mt-3">
                                            <label class="form-label" for="discounted_price">Discounted Price ($):</label>
                                            <input type="number"
                                                class="form-control"
                                                id="discounted_price"
                                                name="discounted_price"
                                                placeholder="0.00"
                                                step="0.01"
                                                min="0"
                                                max="99999.99"
                                                value="0.00">
                                            <small class="form-text text-muted">Special offer price (optional)</small>
                                        </div>
                                    </div>
                                </div>


                                <div class="form-group mt-3">
                                    <label class="form-label" for="category_id">Category:</label>
                                    <select class="form-control"
                                        id="category_id"
                                        name="category_id"
                                        required>
                                        <option value="">Select Category</option>
                                        <?php
                                        $categories_query = mysqli_query($db, "SELECT * FROM categories");
                                        while ($cat = mysqli_fetch_assoc($categories_query)) {
                                            echo '<option value="' . $cat['id'] . '">' . htmlspecialchars($cat['name']) . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="form-group mt-3">
                                    <label class="form-label" for="teacher_name">Instructor:</label>
                                    <select class="form-control"
                                        id="teacher_name"
                                        name="teacher_name"
                                        required>
                                        <option value="">Select Instructor</option>
                                        <?php
                                        $teachers_query = mysqli_query($db, "SELECT id, full_name, email FROM users WHERE role = 2");

                                        if ($teachers_query && mysqli_num_rows($teachers_query) > 0) {
                                            while ($teacher = mysqli_fetch_assoc($teachers_query)) {
                                                $display_name = !empty($teacher['full_name']) ?
                                                    $teacher['full_name'] :
                                                    $teacher['email'];

                                                echo '<option value="' . $teacher['teacher_name'] . '">' .
                                                    htmlspecialchars($display_name) .
                                                    '</option>';
                                            }
                                        } else {
                                            echo '<option value="">No teachers found</option>';
                                        }
                                        ?>
                                        
                                    </select>
                                </div>

                                <div class="form-group mt-3">
                                    <label class="form-label" for="thumbnail">Thumbnail Image:</label>
                                    <input type="file"
                                        class="form-control"
                                        id="thumbnail"
                                        name="thumbnail"
                                        accept="image/*">
                                    <small class="form-text text-muted">Recommended: 430x168 pixels (JPG, PNG)</small>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mt-3">
                                            <label class="form-label" for="level">Course Level:</label>
                                            <select class="form-control"
                                                id="level"
                                                name="level"
                                                required>
                                                <option value="beginner">Beginner</option>
                                                <option value="intermediate">Intermediate</option>
                                                <option value="advanced">Advanced</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group mt-3">
                                            <label class="form-label" for="duration">Duration (minutes):</label>
                                            <input type="number"
                                                class="form-control"
                                                id="duration"
                                                name="duration"
                                                placeholder="e.g., 180"
                                                min="0"
                                                max="9999"
                                                value="0"
                                                required>
                                            <small class="form-text text-muted">Total course duration in minutes</small>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-3">
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <input class="form-check-input"
                                                type="checkbox"
                                                id="is_published"
                                                name="is_published"
                                                value="1">
                                            <label class="form-check-label" for="is_published">
                                                Publish Course
                                            </label>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <input class="form-check-input"
                                                type="checkbox"
                                                id="is_featured"
                                                name="is_featured"
                                                value="1">
                                            <label class="form-check-label" for="is_featured">
                                                Featured Course
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-4">
                                    <button type="submit" name="submit" class="btn btn-primary">
                                        Add New Course
                                    </button>
                                    &nbsp;&nbsp;
                                    <a href="instructor-courses.php" class="btn btn-secondary">
                                        View All Courses
                                    </a>
                                </div>
                            </form>
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