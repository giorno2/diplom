<?php
session_start();
include 'sql.php';
$login = $_POST['login'];
$password = $_POST['password'];
$l = login($login, $password);
if($l == true){
    $_SESSION["login"] = $login;
    header("Location: main.php");
}
else{
    header("Location: index.php");
    $_SESSION["error"] = "неверный логин или пароль";
}
?>
