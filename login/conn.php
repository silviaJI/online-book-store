<?php
$conn = @mysql_connect("140.117.74.141","group01","1051nsysu01");
if (!$conn){
    die("连接数据库失败：" . mysql_error());
}
mysql_select_db("group01", $conn);
//字符转换，读库
mysql_query("set character set 'gbk'");
//写库
mysql_query("set names 'gbk'");

?>


