<?php 
$conn = mysqli_connect("127.0.0.1","root","", "testbd");

function send($name, $number){
    global $conn;
    $sql = "INSERT INTO `tst`(`name`, `number`) VALUES ($name,$number)";
    $result = mysqli_query($conn, $sql);
}
?>