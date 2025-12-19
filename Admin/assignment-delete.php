<?php
include_once("includes/db_config.php");

// session start আগে
session_start();

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // query execute
    $result = mysqli_query($db, "DELETE FROM assignments WHERE id=$id");

    if ($result && mysqli_affected_rows($db) > 0) {
        $_SESSION['msg'] = "Successfully Deleted";
    } else {
        $_SESSION['msg'] = "Delete Failed or ID not found";
    }
}

header("Location: assignment-list.php");
exit;
?>
