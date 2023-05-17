<?php
//Load the database connfiguration
include 'config.php';

//filter the excel data

function filterData(&$str) {
        $str = preg_replace("/\t/","\\t", $str);
        $str = preg_replace("/\r?\n/","\\n", $str);

        if(strstr($str, '"')) $str ='"' . $str = preg_replace('"','""', $str). '"';
}

//Excel file name for download

$fileName = "members-data_".date('Y-m-d').".xls";

// Column name as first row

$field = array("ID", "First Name", "Last Name", "Phone", "Invited By");

// Display Column name as first row
$excelData = implode("\t", array_values($field))."\n";

//fetch records from database
$query = "SELECT * FROM personne ORDER BY ID ASC";
$result = mysqli_query($conn, $query);

if(mysqli_num_rows($result) > 0){
    //Output each row of the data

    foreach($result as $row){
       $ligneData = array($row['id'], $row['firstname'], $row['lastname'], $row['phone'], $row['invitedby']);
       array_walk($ligneData, 'filterData');
       $excelData .= implode("\t", array_values($ligneData))."\n";
    }
} else {
    $excelData = 'No records found....'."\n";
}
// Header for Download
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachement; filename=\"$fileName\"");

//Render excel Data

echo $excelData;

exit;
?>