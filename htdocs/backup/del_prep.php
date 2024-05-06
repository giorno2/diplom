<?php 
include 'sql.php';
$id = $_GET['id'];
deleteRecord($id);
header("Location: main.php");
?>