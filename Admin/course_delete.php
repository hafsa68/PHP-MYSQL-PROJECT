<?php
session_start();
include_once("includes/db_config.php"); 

if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: instructor-courses.php");
    exit;
}

$id = intval($_GET['id']); 

// Database Transaction shuru kora bhalo jate ekta delete hole arekta miss na hoy
$db->begin_transaction();

try {
    // 1. Prothome 'payments' table theke oi course er record delete kora
    $db->query("DELETE FROM payments WHERE course_id = $id");

    // 2. Erpor 'courses' table theke course-ti delete kora
    $sql = "DELETE FROM courses WHERE id = $id";
    
    if ($db->query($sql)) {
        $db->commit(); // Shob thik thakle database update hobe
        $_SESSION['success'] = "Course and related payments deleted successfully!";
    } else {
        throw new Exception($db->error);
    }

} catch (Exception $e) {
    $db->rollback(); // Error hole kono kichu delete hobe na
    $_SESSION['error'] = "Error: " . $e->getMessage();
}

header("Location: instructor-courses.php");
exit;
?>