<?php
include('./conn.php');
/* catch the post value from sign up form */
session_start();
$id = $_SESSION['email'];
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
  <button type="submit" name="login" value="LOGIN" class="login"><a href="login\login.html" >Login</a></button> 

 </div>

</div>
   	<div class="remind-box">
          <div class="clear">
            <img src="image/添加成功.png" alt="图标" class="icon">
            <div class="remind-txt">商品购买成功！</div>
          </div>
        </div>
 
</body>
</html>
