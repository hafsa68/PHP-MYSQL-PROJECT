<?php
session_start();
include_once("includes/db_config.php");

if (isset($_POST['add_announcement'])) {
    // 1. Form theke data neya (Security-r jonno escape kora hoyeche)
    $title = mysqli_real_escape_string($db, $_POST['title']);
    $content = mysqli_real_escape_string($db, $_POST['content']);
    
    // 2. Current Time neya
    $created_at = date('Y-m-d H:i:s');

    // 3. Database-e Insert kora
    // Note: Column names gulo apnar database table-er sathe mil thakte hobe
    $sql = "INSERT INTO announcements (title, content, created_at) VALUES ('$title', '$content', '$created_at')";

    if ($db->query($sql)) {
        $_SESSION['success'] = "Announcement posted successfully!";
    } else {
        $_SESSION['error'] = "Error: " . $db->error;
    };
    header("Location:announce.php");
};
?>