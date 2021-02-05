<?php
$dbhost= 'localhost';
$dbsuer= 'root';
$dbpas= '';
//$db= 'medicalcollege';
$db= 'medicalcollege';
$con= mysql_connect($dbhost,$dbsuer,$dbpas);
mysql_select_db($db);
?>