<?php
require('config.php');
if (isset($_REQUEST['username'], $_REQUEST['password'])){
  // récupérer le nom d'utilisateur et supprimer les antislashes ajoutés par le formulaire
  $username = stripslashes($_REQUEST['username']);
  $username = mysqli_real_escape_string($conn, $username);
  // récupérer le mot de passe et supprimer les antislashes ajoutés par le formulaire
  $password = stripslashes($_REQUEST['password']);
  $password = mysqli_real_escape_string($conn, $password);
  // verifier s'il ya un utilisateur possédant deja ce user name
  $query_search = " SELECT * FROM user where username = '$username'";
  $resul = mysqli_query($conn, $query_search);
  $number_ligne = mysqli_num_rows($resul);
  if ($number_ligne > 1  ){
    //requéte SQL + mot de passe crypté
    $query = "UPDATE `user` SET `password`='".hash('sha256', $password)."' WHERE `username`='$username'";
    // Exécuter la requête sur la base de données
    $res = mysqli_query($conn, $query);
    if($res){
    //alert('Thank You for Login & You are Redirecting to Login Form');
    //Redirecting to other page or webste code or you can set your own html page.
    //window.location = "index.php";

    header('location:login.php');
    }
  }else{
    $message = " il n'existe pas d'utilisateur possèdant ce nom d'utilisateur";
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
</head>
<body>
    <div class="box">
        <h1 class="box-title"> Reset password</h1>
        <form action="" method="post">
            <input type="text" class="box-input" placeholder="user name" name="username" required>
            <input type="password" class="box-input" placeholder="new password" name="password" required>
            <input type="submit" class="box-button" value="update">
            <?php 
                if(isset($message)){
                    echo "<p class='erreur'>".$message."</p>";
                }
            ?>
            <p class="box-register"><a href="login.php">login</a></p>
        </form>
    </div>
    
</body>
</html>