<?php
/* Inclure le fichier config */
require_once "config.php";

if (isset($_POST['deletedata'])) {
    $id= $_POST['delete_id'];
	$sql = "DELETE FROM personne WHERE id='$id'";
    $query_num = mysqli_query($conn, $sql);
    if($query_num) {
        header('Location:index.php');
    } else {
        echo "Error";
    }
}

?>