<?php include('../config/constants.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login-Food order System</title>
    <link rel="stylesheet" type="text/css" href="../css/admin.css">
</head>
<body>
    <div class="login">
    <h1 class="text-center">Login</h1>
    <br><br>

    <?php
    if(isset($_SESSION['login'])){
        echo $_SESSION['login'];
        unset($_SESSION['login']);
    }
    if(isset($_SESSION['no-login-message'])){
        echo $_SESSION['no-login-message'];
        unset($_SESSION['no-login-message']);
    }
    ?>
    <br><br>
    <!-- login form -->
    <form action="" method="POST" class="text-center">
      Username:
      <br>
      <input type="text" name="username" placeholder="Enter Username"><br><br>

      Password: <br>
      <input type="password" name="password" placeholder="Enter Password"> <br> <br>
      <input type="submit" name="submit" value="Login" class="btn-primary"><br><br>
    </form>

    <p class="text-center">Created By- <a href="">Karishma</a> </p>
    </div>
</body>
</html>
<?php 
//check whether submit btn is clicked or not
if(isset($_POST['submit'])){
    $username=$_POST['username'];
    $password=md5($_POST['password']);
//to check whether username and psswd exists or not
    $sql= "SELECT *FROM tbl_admin WHERE username='$username' AND password='$password'" ;
    $res=mysqli_query($conn,$sql);
    //count rows whether user exists or not
    $count=mysqli_num_rows($res);
    if($count==1){

       $_SESSION['login']="<div class='success text-center'>Login Successful</div>" ;

       //another session to check whether the user is logged in or not
       $_SESSION['user']=$username;   //it wont be unset,this will remain as it is and it will unset when the user is logged out
       header('location:'.SITEURL.'admin/');
    }
    else{
        $_SESSION['login']="<div class='error text-center'>Login Failed</div>" ;
       header('location:'.SITEURL.'admin/login.php');
    }
}
?>