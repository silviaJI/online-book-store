<?php
session_start();
include('./connect.php');

if(!isset($_SESSION['email'])){
    echo '<script>';
    echo 'window.location.href="./sign_up.php";';
    echo '</script>';
}else{
    $sql = "SELECT NAME FROM user_info WHERE Id=:id";
    $name_sql = $db->prepare($sql, array(PDO::FETCH_ASSOC));
    $name_sql->execute(array(':id'=>$_SESSION['email']));
    $username = $name_sql->fetch(PDO::FETCH_ASSOC)['NAME'];
}
?>

<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>My Onilne Shop</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <!-- <link rel="stylesheet" href="home.css"> -->
</head>

<body>
    <div class="container">
            <h1 class="text-center">我們的精神角落</h1>
            <?php
                $sql = "SELECT Id, NAME, GENDER, ADDRESS, tel,bir FROM user_info WHERE Id=:id";
                $info_sql = $db->prepare($sql, array(PDO::FETCH_ASSOC));
                $info_sql->execute(array(':id'=>$_SESSION['email']));
                $result = $info_sql->fetch(PDO::FETCH_ASSOC);
                $_SESSION['email']=$result['Id'];
                $useremail = $result['Id'];
                $username = $result['NAME'];
                $usergender = $result['GENDER'];
                $useraddress = $result['ADDRESS'];
                $usertel = $result['tel'];
                $userbday = $result['bir'];
            ?>

       <form action="edit.php" method="POST" role="form">
                <legend>Edit My Info</legend>
            
                <div class="form-group">
                    <label for="useremail">EMAIL</label>
                    <input type="text" class="form-control" id="useremail" name="useremail" placeholder="Input field" value="<?php echo $useremail; ?>" disabled>

                    <label for="userbday">BIRTHDAY</label>
                    <input type="text" class="form-control" id="userbday" name="userbday" placeholder="Input field" value="<?php echo $userbday; ?>" disabled>

                    <label for="usertel">MOBILE</label>
                    <input type="text" class="form-control" id="usertel" name="usertel" placeholder="Input field" value="<?php echo $usertel; ?>" disabled>

                    <label for="username">NAME</label>
                    <input type="text" class="form-control" id="username" name="username" placeholder="Input field" value="<?php echo $username; ?>" required="required">
                    <label for="usergender">GENDER</label>
                    <div class="radio">
                        <label>
                            <input type="radio" name="usergender" id="usergender" value="M" <?php if($usergender == 'M'){echo 'checked="checked"';} ?> >
                            男
                        </label>
                        <label>
                            <input type="radio" name="usergender" id="usergender" value="F" <?php if($usergender == 'F'){echo 'checked="checked"';} ?> >
                            女
                        </label>
                    </div>
                    <label for="useraddress">ADDRESS</label>
                    <input type="text" class="form-control" id="useraddress" name="useraddress" placeholder="Input field" value="<?php echo $useraddress; ?>" required="required">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>

                <a class="btn btn-warning" href="./sign_out.php" role="button">SignOut</a>

                <a class="btn btn-success" href="../main.php" role="button">去補充精神食糧吧！</a>
            </form>

            </div>


        <!-- jQuery -->
        <script src="//code.jquery.com/jquery.js"></script>
        <!-- Bootstrap JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
        <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
        <script src="Hello World"></script>
</body>
</html>