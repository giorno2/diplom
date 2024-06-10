<?php 
session_start();
if(isset($_SESSION["login"]) === true){
    unset($_SESSION["login"]);
    header("Location: index.php");
}
else{
    header("Location: index.php");
}
?>
