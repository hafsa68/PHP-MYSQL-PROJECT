<?php
include_once("includes/db_config.php"); 
if (!isset($_GET['id'])) {
    die("Course ID missing");
}

$id = intval($_GET['id']); 


$sql = "DELETE FROM courses WHERE id=$id";
if ($db->query($sql)) {
    $_SESSION['success'] = "Course deleted successfully!";
} else {
    $_SESSION['error'] = "Error deleting course: " . $db->error;
}


header("Location: instructor-courses.php");
exit;
?>
