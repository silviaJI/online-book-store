<?php
include('./connect.php');
session_start();//启用session
$id = $_SESSION['email'];
//$id ="jjy1996@126.com";
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
     a{
      color: inherit;
     }
     .title{text-align: center;
            padding: 10px;
            border-radius: 5px;
            border-bottom-left-radius: 0px;
            border-bottom-right-radius: 0px;
            background: #ececec;
            font-size: 18pt;
            font-weight: 600;
            font-family: Verdana, Geneva, sans-serif;
            color: #666666;}
     .table_head{background-color: #F6F6F1; color: #545652;}
     .count{text-align: right; margin-right: 30px;}
     .main_car{position: relative; top: 30%; left: 17%; font-size: 17px; width: 850px; border:1px solid #cccccc;
      border-radius: 5px; padding-bottom:10px;}
     .main_car tr{height: 38px;}
     .btn_box{margin-top: 40px;margin-bottom: 15px; position: relative; left: 65%;}
     .btn_box button{margin-right: 40px;}
     table tr td {text-align: center; border:1px solid #F6F6F1;}
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


<div class="main_car">
    <div class="title">购物车</div>
    <table >
      <tr class="table_head">
      <td width="300">商品名</td>
      <td width="150">单价（元）</td>
      <td width="90">数量</td> 
      <td width="150">金额（元）</td>
      <td width="177">操作</a></td>
      </tr>
<?php
$sum = 0;
$row_count = 0;

$sql = "SELECT * FROM order_info WHERE Id='$id'";
$stmt = $db->prepare($sql,array(PDO::FETCH_ASSOC));
$stmt ->execute();

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
      
      $row_count = $row_count + 1;
      $Bid = $row['Book_id'];
?>

  <?php
    $query = "SELECT * FROM book_info WHERE ISBN='$Bid'";
    $sth = $db->prepare($query,array(PDO::FETCH_ASSOC));
    $sth ->execute();
    $row1 = $sth->fetch(PDO::FETCH_ASSOC);
    $sum += $row1["Bprice"]*$row["num"]; 
  ?>
    <tr>
      <td width="300"><?php echo $row1['Bname'];?></td>
      <td width="150"><?php echo '￥'.$row1['Bprice'];?></td>
      <td width="90"><?php echo $row['num'];?></td>
      <td width="150"><?php echo '￥'.$row1['Bprice']*$row['num'];?></td> 
      <td width="177"><a href="delete.php? Bid=<?php echo $row["Book_id"]?>">删除</a></td>
      </tr>
   
  <?php
    }
  ?>
  <tr class="table_head count" >
    <td colspan="5"><div style="margin-right: 30px; float: right;"><?php echo "总价格:".$sum;?></div></td>
  </tr>
   </table>
  
<div class="btn_box">
  <button class="btn"><a href="main.php">返回继续购物</a></button>
  <button class="btn" id="buy_now">立即购买</button>
</div>
</div>

<script type="text/javascript">
  var btn_buy = document.getElementById('buy_now');
  btn_buy.onclick = function(){
      
      if (window.confirm("您确定要购买吗？")) {
        window.location.href="./checkBuy.php";
      } else {
        alert("已取消购买");
      }
  }
</script>
</body>
</html>