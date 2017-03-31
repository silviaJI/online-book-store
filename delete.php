<?php
include('./conn.php');
session_start();//启用session
$id = $_SESSION['email'];
//$id ="jjy1996@126.com";
$Bid =$_GET['Bid'];

mysql_query("DELETE FROM order_info WHERE Id='$id' AND Book_id='$Bid'");
header("location:car.php")
?>
