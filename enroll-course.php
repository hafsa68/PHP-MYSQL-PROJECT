<?php
include_once("Admin/includes/db_config.php");

if (isset($_GET['course_id'])) {
    $id = $_GET['course_id'];
    
    // Teachers table nei, tai shudhu courses table theke data nibo
    $sql = "SELECT * FROM courses WHERE id = $id";
            
    $result = $db->query($sql);
    $course = $result->fetch_object();

    if (!$course) {
        die("Course found hoyni!");
    }
} else {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($course->title); ?></title>
    <link type="text/css" href="public/css/app.css" rel="stylesheet">
</head>
<body class="layout-app">
    <div class="container py-32pt">
        <div class="row">
            <div class="col-lg-8">
                <h1><?= htmlspecialchars($course->title); ?></h1>
                <p><?= htmlspecialchars($course->description); ?></p>
                <img src="uploads/<?= $course->thumbnail; ?>" class="img-fluid rounded">
            </div>

            <div class="col-lg-4">
                <div class="card card-body">
                    <h2 class="text-primary">$<?= ($course->discounted_price > 0) ? $course->discounted_price : $course->price; ?></h2>
                    
                    <form action="process-payment.php" method="POST">
                        <input type="hidden" name="course_id" value="<?= $course->id; ?>">
                        <button type="submit" class="btn btn-success btn-block">Enroll Now</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>