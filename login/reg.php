<?php
	$e_mail = htmlspecialchars($_POST["email"]);
	$psd = htmlspecialchars($_POST["password"]);
	$psd_a = htmlspecialchars($_POST["repassword"]);
	$tel = htmlspecialchars($_POST["tel"]);
	$bir = htmlspecialchars($_POST["birthday"]);

	//注册信息判断
  	if (!preg_match("/[a-za-z0-9]+@[a-za-z0-9]+.com/",$e_mail))  
  		{  
      		exit('错误：E-mail已经被使用或者格式错误！<a href="javascript:history.back(-1);">返回</a>');
  		}
	 
	if (!preg_match("/^(?=.*[a-z])(?=.*[A-Z]).{6,16}$/",$psd))  
	  {  
	      exit('错误：密码应为6~16位大小写英文字母！<a href="javascript:history.back(-1);">返回</a>');
	  }  

	if ($psd != "" && $psd_a !="")
		{
			if ($psd != $psd_a) {
				exit('错误：密码再次输入错误！<a href="javascript:history.back(-1);">返回</a>');
		}
	}

	if(!preg_match("/^0\d{9}$/", $tel)){
			exit('错误：电话号码格式错误！<a href="javascript:history.back(-1);">返回</a>');
		}
	
	$tempbir = '#(19|20)(\d){2}/(0[1-9]|1[0-2])/(0[1-9]|[12][0-9]|3[0-1])#';
	if (!preg_match($tempbir,$bir))  
	  {  
	      exit('错误：生日格式不合法！<a href="javascript:history.back(-1);">返回</a>');
	  }  

	//包含数据库连接文件
	include('conn.php');
	//检测用户名是否已经存在
	$check_query = mysql_query("select Id from user_info where Id='$e_mail' limit 1");
	if(mysql_fetch_array($check_query)){
    echo '错误：用户名 ',$e_mail,' 已存在。<a href="javascript:history.back(-1);">返回</a>';
    exit;
	}
	/*$check_query = "select Id from user_info where Id='$e_mail' limit 1";
	$stmt = $connection->query($check_query);
	$stmt = $db->prepare($sql,array(PDO::FETCH_ASSOC));
	$stmt ->execute();
	if(mysql_fetch_array($stmt)){
	    echo '错误：邮箱 ',$e_mail,' 已被注册。<a href="javascript:history.back(-1);">返回</a>';
	    exit;
	}*/
	//写入数据
	$password = MD5($psd);
	$sql = "INSERT INTO user_info(Id,psd,tel,bir)VALUES('$e_mail','$password','$tel',
	$bir)";
	if(mysql_query($sql, $conn)){
	    exit('用户注册成功！点击此处 <a href="login.html">登录</a>');
	} else {
	    echo '抱歉！添加数据失败：',mysql_error(),'<br />';
	    echo '点击此处 <a href="javascript:history.back(-1);">返回</a> 重试';
	}


?>