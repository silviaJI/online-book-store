<?php
include('./conn.php');
/* catch the post value from sign up form */
session_start();
$id = $_SESSION['email'];
if(!isset($_SESSION['email'])){
    echo '<script>';
    echo 'window.location.href="./login/login.html";';
    echo '</script>';
}
?>
<!DOCTYPE html>
<html>
<head>
   <title>Online shoping</title>
   <link rel="stylesheet" type="text/css" href="project.css">
   <meta charset="utf-8">
   <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
   <!-- <link rel="stylesheet" type="text/css" href="css/font-awesome.css"> -->
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> 
   <script src="js/jquery-3.1.1.min.js"></script>
   <script src="bootstrap/js/bootstrap.min.js"></script>
   <style>
     .book_pic{
      height:200px;
      width:200px;
     }
     .icon{height:100px; width:100px; float:left; margin: 90px 0px 30px 130px;}
     .remind-box{position:relative; top:40%;left:25%; width:700px; height: 300px; overflow:auto;
      background-color: #F6F6F1; border-radius: 8px; border:1px solid #cccccc;}
     .remind-box:hover{}
     .remind-txt{font-size:25px;margin-top:120px; float:left; width:400px; }
     .clear{clear: both;}
     .remind-box .link_d{margin: 10px 10px 10px 40px; width: 100px; float: left;}
     .link_box{margin-top: 220px; margin-left: 200px;}
     button.a{color:white;}
     a{color: inherit;}
   </style>
   <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
</head>


<body id="body">

<div id="header">

<div id="header1" >
   <div class="log">


   <button type="submit" class="Account" ><a href="login\home.php"><img src="image/mine.jpg" style="width:20px;height:25px;margin-right:10px;"><?php echo $id; ?></a></button>

  <?php $_SESSION['email']=$id; ?>

  <button type="submit" name="trackorder" value="TRACKORDER" class="track"><a href="car.php">Cart</a></button>

  <button class="notification"><i class="fa fa-bell" aria-hidden="true"></i></button>
  
  <button type="submit" name="signup" value="SIGNUP" class="signup"><a href="login\sign_up.php" ">Signup</a></button> 
  <button type="submit" name="login" value="LOGIN" class="login" ><a href="login\login.html" >Login</a></button> 

 </div>

</div>

  
<?php
include('./conn.php');
$id = $_SESSION['email'];
$Bid=$_GET["Bid"];//得到购买物品的id
$num = 1;
$table = "order_info";
$Order = md5(uniqid(rand()));

add_item( $table, $Order, $Bid, $id, $num);

function check_item( $table, $id, $Bid) {
  $query = "SELECT * FROM $table WHERE Id='$id' AND Book_id='$Bid'" ;

  $result = mysql_query($query);
  if(! $result) {
   return 0;
  }

  $numRows = mysql_num_rows( $result);
  if( $numRows == 0) {
   return 0;
  } 
  else {
   $row = mysql_fetch_object( $result);
   return $row->num;
  }
 }

function add_item( $table, $Order, $Bid, $id, $num) {
  $qty = check_item( $table, $id, $Bid);/*先检查该类物品有没有已经放入车中*/
  /*若车中没有，则像车中添加该物品*/
  if( $qty == 0) {
   $query = "INSERT INTO $table (Order_id, Id,Book_id,num) VALUES('$Order', '$id', '$Bid', '$num') ";
   include('./conn.php');
   if(mysql_query($query, $conn)){
      echo '
         <div class="remind-box">
        <div class="clear">
          <img src="image/添加成功.png" alt="图标" class="icon">
          <div class="remind-txt">商品已成功添加至购物车！</div>
        </div>
        <div class="link_box">
          <div class="link_d"><a href="car.php">查看购物车</a></div>
          <div class="link_d"><a href="main.php">返回继续购物</a></div>
          </div>
        </div>
        ';
  } else {
      echo '<div class="remind-box">
          <img src="image/添加失败.png" alt="图标"class="icon">
          <div class="remind-txt">抱歉！添加数据失败</div>
          <div class="link_box">
          <div class="link_d"><a href="main.php">请返回重试</a></div>
          </div>
        </div>
        ';   
  }
  }
  //若有，则在原有基础上增加数量
  else {
   $num += $qty; 
   $query = "UPDATE $table SET num='$num' WHERE Id='$id' AND Book_id='$Bid'" ;
   include('./conn.php');
   if(mysql_query($query, $conn)){
      echo '
        <div class="remind-box">
          <div class="clear">
            <img src="image/添加成功.png" alt="图标" class="icon">
            <div class="remind-txt">商品已成功添加至购物车！</div>
          </div>
          <div class="link_box">
            <div class="link_d"><a href="car.php">查看购物车</a></div>
            <div class="link_d"><a href="main.php">返回继续购物</a></div>
          </div>
        </div>
        ';
  } else {
      echo '<div class="remind-box">
          <img src="image/添加失败.png" alt="图标"class="icon">
          <div class="remind-txt">抱歉！添加数据失败</div>
          <div class="link_box">
          <div class="link_d"><a href="main.php">请返回重试</a></div>
          </div>
        </div>';
           
  }
  }
}
?>  
</body>
</html>
