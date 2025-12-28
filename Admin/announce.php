<?php 
// 1. Shobar upore session_start thakte hobe
session_start();
include_once("includes/db_config.php"); 
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Dashboard</title>
    
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700%7CRoboto:400,500&display=swap" rel="stylesheet">
    <link type="text/css" href="../public/css/material-icons.css" rel="stylesheet">
    <link type="text/css" href="../public/css/fontawesome.css" rel="stylesheet">
    <link type="text/css" href="../public/css/app.css" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body class="layout-app">

    <div class="preloader">
        <div class="sk-chase">
            <div class="sk-chase-dot"></div><div class="sk-chase-dot"></div><div class="sk-chase-dot"></div>
            <div class="sk-chase-dot"></div><div class="sk-chase-dot"></div><div class="sk-chase-dot"></div>
        </div>
    </div>

    <div class="mdk-drawer-layout js-mdk-drawer-layout"
             data-push
             data-responsive-width="992px">
            <div class="mdk-drawer-layout__content page-content">

                <!-- Header -->

                <!-- Navbar -->

                <?php include_once("includes/th_nav.php"); ?>

            <div class="container page__container page-section">
                <h2>Post Announcement</h2>
                <div class="card mb-4">
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

                <table class="table table-bordered bg-white">
        <thead class="table-dark">
            <tr>
                <th>Title</th>
                <th>Status</th>
                <th>Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
    <?php
    $result = mysqli_query($db, "SELECT * FROM announcements ORDER BY is_pinned DESC, created_at DESC");
    while($row = mysqli_fetch_assoc($result)) {
        $status = $row['is_pinned'] ? '<span class="badge bg-danger">Pinned</span>' : '<span class="badge bg-success">Normal</span>';
        
        echo "<tr>
                <td>{$row['title']}</td>
                <td>{$status}</td>
                <td>{$row['created_at']}</td>
                <td>
                    <a href='delete.php?id={$row['id']}' 
                       class='btn btn-danger btn-sm' 
                       onclick=\"return confirm('Are you sure you want to delete this?')\">
                       Delete
                    </a>
                </td>
            </tr>";
    }
    ?>
</tbody>
    </table>
            </div>
        </div>

        <div class="mdk-drawer js-mdk-drawer" id="default-drawer">
            <div class="mdk-drawer__content">
                <div class="sidebar sidebar-dark-pickled-bluewood sidebar-left" data-perfect-scrollbar>
                    <?php 
                        // Error handle korar jonno isset check kora hoyeche
                        if(file_exists("includes/sidebar.php")) {
                            include_once("includes/sidebar.php"); 
                        } else {
                            echo "<p class='text-white p-3'>Sidebar file missing!</p>";
                        }
                    ?>
                </div>
            </div>
            
        </div>
        

    </div>
    

    <script src="../public/vendor/jquery.min.js"></script>
    <script src="../public/vendor/bootstrap.min.js"></script>
    <script src="../public/vendor/dom-factory.js"></script>
    <script src="../public/vendor/material-design-kit.js"></script>
    <script src="../public/js/app.js"></script>
</body>
</html>