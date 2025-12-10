<?php include_once("includes/db_config.php");
$id = $_REQUEST['id'];
$sql= "DELETE FROM categories WHERE id ='$id'";
$db ->query($sql);
if ($db ->affected_rows){
  session_start();
    $_SESSION['msg'] = "successfully Deleted";
}
// print_r($_SESSION);


 header("Location:category_manage.php");







?>
