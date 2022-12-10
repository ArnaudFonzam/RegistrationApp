<?php
/* Inclure le fichier config */
require_once "config.php";

if (isset($_POST['savedata'])) {
	$fname = $_POST['firstname'];
	$lname = $_POST['lastname'];
	$phone = $_POST['phone'];
    $invite = $_POST['invitedby'];

	$sql = "INSERT INTO personne (`firstname`, `lastname`, `phone`, `invitedby`) VALUES ('$fname', '$lname', '$phone','$invite')";
    $query_num = mysqli_query($conn, $sql);

    if($query_num){
        echo '<script> alert("Date Saved"); </script>';
        header('Location:index.php');
    }else{
        echo '<script> alert("Date Not Saved"); </script>';
    }
}

?>