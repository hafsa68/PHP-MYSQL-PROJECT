<?php
session_start();
include_once "includes/db_config.php";
$id = intval($_GET['id']);
$sql="DELETE FROM assignment_submissions WHERE id=$id";
if ($sql && mysqli_affected_rows($db) > 0) {
        $_SESSION['msg'] = "Successfully Deleted";
    } else {
        $_SESSION['msg'] = "Delete Failed or ID not found";
    }

header("Location: submission-list.php");
?>