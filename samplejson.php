<?php
header("Content-type: application/json; charset=utf-8");
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = 'Spirit123*';
$DATABASE_NAME = 'star_login';
$db = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);

$query = "SELECT * FROM `products` WHERE 1";
$result = mysqli_query($db, $query);
$rows = array();
while($row = $result->fetch_array()){
    $rows[] = $row;
}
//Return result to jTable
$qryResult = array();
$qryResult['logs'] = $rows;
echo json_encode($qryResult);

?>