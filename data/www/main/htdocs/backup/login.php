<?php
include 'sql.php';
$login = $_POST['login'];
$password = $_POST['password'];
$l = login($login, $password);
if($l == true){
    header("Location: main.php");
}
else{
    header("Location: index.php");
}
?>
