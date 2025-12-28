<?php
include_once("includes/db_config.php");
session_start();

// URL theke ID asche kina check kora
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

    // Prepared Statement use kore delete query (Beshi secure)
    $stmt = $db->prepare("DELETE FROM announcements WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        // Delete hoye gele pichone ferot pathabe success message shoho
        echo "<script>
                alert('Notice deleted successfully!');
                window.location.href = '" . $_SERVER['HTTP_REFERER'] . "';
              </script>";
    } else {
        echo "Error: " . $db->error;
    }

    $stmt->close();
} else {
    // ID na thakle pichone ferot pathiye dabe
    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit();
}
?>