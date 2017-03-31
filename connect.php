<?php
	try{
		$dsn = "mysql:dbname=group01; localhost = 140.117.74.141";
		$db = new PDO($dsn,'group01','1051nsysu01',array(PDO::MYSQL_ATTR_INIT_COMMAND =>"set names utf8"));
		$db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
	}
	catch(PDOException $e){
		echo $e->getMessage();
		$dsn->rollBack();
	}
?>