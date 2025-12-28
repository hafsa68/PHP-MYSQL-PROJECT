<?php
include_once("includes/db_config.php");

if (!isset($_GET['id']));

$id = intval($_GET['id']);
$sql="DELETE FROM users WHERE id=$id";
$db ->query($sql);
if ($db ->affected_rows){
  session_start();
    $_SESSION['msg'] = "successfully Deleted";
}
// print_r($_SESSION);
header("Location: teachers_list.php");
?>
