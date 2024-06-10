<?php 
include("sql.php");
$name = $_POST["name"];
$number = $_POST["number"];

send($name, $number);
?>