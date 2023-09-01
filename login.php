<?php
require('config.php');
session_start();
$message ;
if (isset($_POST['connect'])){
  $username = stripslashes($_REQUEST['username']);
  $username = mysqli_real_escape_string($conn, $username);
  $password = stripslashes($_REQUEST['password']);
  $password = mysqli_real_escape_string($conn, $password);
  $query = "SELECT * FROM `user` WHERE username='$username' and password='".hash('sha256', $password)."'";
  $result = mysqli_query($conn,$query) or die(mysql_error());
  $rows = mysqli_num_rows($result);
  if($rows==1){
      $_SESSION['username'] = $username;
      header('location: index.php');
  }else{
    $message = "Le nom d'utilisateur ou le mot de passe est incorrect";
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manager Contact</title>
    <link rel="stylesheet" href="styles/style.css">
    <script src="js/script.js"></script>
    <!--<style>
      body{
        background-image : url('image/start1 (2).jpg');
        background-size: 100%;
      }
    </style>-->
</head>
<body>
    <div class="box">
        <h1 class="box-title">Login</h1>
        <form action="" method="post">
            <input type="text" class="box-input" name="username" placeholder="user name" id="uname">
            <input type="password" class="box-input" name="password" placeholder="password" id="pwd">
            <input type="submit" class="box-button" name="connect" value="connexion">
        </form>
        <?php 
          if(isset($message)){
            echo "<p class='errorMessage'>".$message."</p>";
          }
        ?>
        <p class="box-register"><a href="register.php">register</a></p>
        <p class="box-register"><a href="updateMdp.php">Forget Password?</a></p>
        
    </div>
    
</body>
</html>
