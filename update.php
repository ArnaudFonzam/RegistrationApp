<?php
/* Inclure le fichier config */
require_once "config.php";

if (isset($_POST['updatedata'])) {
    $id= $_POST['update_id'];
	$fname = $_POST['fname'];
	$lname = $_POST['lname'];
	$phone = $_POST['phone'];
    $invite = $_POST['invitedby'];

	$sql = "UPDATE personne SET firstname ='$fname', lastname ='$lname', phone= '$phone', invitedby ='$invite' WHERE id='$id' ";
    $query_num = mysqli_query($conn, $sql);
    if($query_num) {
        header('Location:index.php');
    }else{
        echo "Error";
    }
}

?>