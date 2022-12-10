<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Contact</title>
    <link rel="stylesheet" href="styles/style.css">
</head>
<body>
<?php
require('config.php');
if (isset($_REQUEST['username'], $_REQUEST['phone'], $_REQUEST['password'])){
  // récupérer le nom d'utilisateur et supprimer les antislashes ajoutés par le formulaire
  $username = stripslashes($_REQUEST['username']);
  $username = mysqli_real_escape_string($conn, $username);
  // récupérer le numero de téléphone et supprimer les antislashes ajoutés par le formulaire
  $phone = stripslashes($_REQUEST['phone']);
  $phone = mysqli_real_escape_string($conn, $phone);
  // récupérer le mot de passe et supprimer les antislashes ajoutés par le formulaire
  $password = stripslashes($_REQUEST['password']);
  $password = mysqli_real_escape_string($conn, $password);
  //requéte SQL + mot de passe crypté
    $query = "INSERT into `user` (username, password, phone)
              VALUES ('$username', '".hash('sha256', $password)."', '$phone')";
  // Exécuter la requête sur la base de données
    $res = mysqli_query($conn, $query);
    if($res){
        //alert('Thank You for Login & You are Redirecting to Login Form');
        //Redirecting to other page or webste code or you can set your own html page.
             //window.location = "index.php";

        header('location:index.php');
    }
}else{
?>
    <div class="box">
        <h1 class="box-title">Register</h1>
        <form action="" method="post">
            <input type="text" class="box-input" name="username" placeholder="user name" required>
            <input type="password" class="box-input" name="password"placeholder="password" required>
            <input type="password" class="box-input" name="cpassword" placeholder="confirme password" required>
            <input type="text" class="box-input" name="phone" placeholder="phone" required>
            <input type="submit" class="box-button"  value="Save">
        </form>
        <p class="box-register"><a href="login.php">login</a></p>
    </div>
<?php } ?>
</body>
</html>