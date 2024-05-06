<?php 
include 'sql.php';
$id = $_POST['id'];
$del_id = $_POST['did'];
$nazv = $_POST['nazv'];
$opis = $_POST['opis'];
$date = $_POST['date'];
$type = $_POST['type'];
$prep = $_POST['prep'];
$times = $_POST['t'];
print_r($del_id);
print_r($times);

if($del_id != 0 || $times == 0){
    deleteItemsFromKurs($del_id);
}

$krs_id = getAllIdsFromKursDatabase();
UpdRecords($times,$nazv,$opis,$date,$type,$id,$krs_id);
header("Location: main_krs.php");
?>