<?php
include('./connect.php');
session_start();//启用session
empty($_POST['search']) && $_POST['search']='';
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
     a{
      color:white;
     }
   </style>
   <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
</head>


<body id="body">

<div id="header">

<div id="header1" >
   <div class="log">


  <button type="submit" class="Account" ><a href="login\home.php"><img src="image/mine.jpg" style="width:20px;height:25px;margin-right:10px;"><?php if(isset($_SESSION)) 
       $id = $_SESSION['email'];echo $id;?></a></button>

  <?php $_SESSION['email']=$id; ?>

  <button type="submit" name="trackorder" value="TRACKORDER" class="track"><a href="car.php">Cart</a></button>

  <button class="notification"><i class="fa fa-bell" aria-hidden="true"></i></button>
  
  <button type="submit" name="signup" value="SIGNUP" class="signup"><a href="login\sign_up.php" ">Signup</a></button> 
  <button type="submit" name="login" value="LOGIN" class="login" ><a href="login\login.html" >Login</a></button> 

 </div>

</div>



<div id="header2" >

 <div class="logo">
   
 <!--   <img class="logo" src="image/flogo.jpg" alt="Mountain View" style="width:150px;height:40px;"> -->
 
 </div>

 <div class="search" >
  <form method="POST" action="main.php">
    <input class="srch" type="text" name="search" id="search" placeholder=" Search for products.">
    <button type="submit" name="submit" value="Submit" class="btn" ">Search</button>
  </form>
</div>

    <div class="menu">
    <ul>
    <li><a class="active" href="#popular">POPULAR</a></li>
    <li class="dropdown">
       <a href="#literature" class="dropbtn">lITERATURE</a>
       <div class="dropdown-content">
            <a href="#">Link 1</a>
            <a href="#">Link 2</a>
            <a href="#">Link 3</a>
       </div>
    </li>
    <li><a href="#culture">CULTURE</a></li>
    <li><a href="#life">LIFE</a></li> 
    <li><a href="#finance">FINANCE</a></li>
    <li><a href="#science & thchnology">SCIENCE & Technology</a></li>
    <li><a href="#more">MORE</a></li>
  </ul>   
  </div>

</div>
</div>
  
     
<div id="header3">
  
       <div class="carousel-inner" class="first">
       <div id="myCarousel" class="carousel slide" data-ride="carousel" class="first">
  

    <!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox">
      <div class="item active" class="first">
          <div class="div1"><img src="image/1.jpg" alt="Chania" width="100%" height="280"></div>
      </div>

         <div class="item">
         <div class="div1"><img src="image/2.jpg" alt="Chania" width="100%" height="280"></div>
         </div>

         <div class="item">
         <div class="div1"><img src="image/3.jpg" alt="Chania" width="100%" height="280"></div>
         </div>

         <div class="item">
         <div class="div1"><img src="image/4.jpg" alt="Chania" width="100%" height="280"></div>
         </div>

         <div class="item">
         <div class="div1"><img src="image/5.jpg" alt="Chania" width="100%" height="280"></div>
         </div>
    </div>

    <!-- Left and right controls -->
      <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>
    </div>

</div>



<?php
  include("./connect.php");
?>

  <div class="container" id="contain">
  
   <?php
    $key=$_POST["search"];
    $row_count = 0;
    $height_sum = 0;
    $weight_sum = 0;
    $sql = 'SELECT * FROM book_info';
    if ($key != null) {
      $sql = "SELECT * FROM book_info WHERE Bname LIKE '%$key%'";
    }
    $stmt = $db->prepare($sql,array(PDO::FETCH_ASSOC));
    $stmt ->execute();   
 

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
      $row_count = $row_count + 1;
  ?>
    <div style="float: left;margin:30px 25px;">
    <?php 
     $url = $row['url'];
     echo "<div style='padding:5px;'><img class='book_pic' src='".$url."' alt='book'></div>";?>
    <div><?php echo $row['Bname'];?></div>
    <div><?php echo '￥'.$row['Bprice'];?></div> 
    
    <button type="submit"><a href="buy.php? Bid=<?php echo $row["ISBN"]; ?>"  style="color:black;"  >加入购物车</a>
    </button>
    </div>
  <?php
    }
  ?>

</div>




</body>
</html>