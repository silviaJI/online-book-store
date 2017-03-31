<?php
session_start();
/* include the connect file */
include('./connect.php');

/* catch the post value from sign up form */
$id = $_SESSION['email'];
$name = $_POST['username'];
$gender = $_POST['usergender'];
$address = $_POST['useraddress'];

/* 更新個人資料 */
try{

	$sql = "UPDATE user_info SET NAME=:name, GENDER=:gender, ADDRESS=:address WHERE Id=:id";
	$edit_sql = $db->prepare($sql, array(PDO::FETCH_ASSOC));
	$edit_sql->execute(array(':id'=>$id, ':name'=>$name, ':gender'=>$gender, ':address'=>$address));
	$_SESSION['email'] = $id;
	echo '<script>';
	echo 'window.location.href="./home.php";';
	echo '</script>';
}catch(PDOException $e){
	/* 修改有誤告知使用者後導回 */
	//echo $e->getMessage();
	echo '<script>';
	echo 'alert("修改失敗");';
	echo 'window.location.href="./home.php";';
	echo '</script>';
}

?>