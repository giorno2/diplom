<?php 
include 'sql.php';
$id = $_POST['id'];
$del_id = $_POST['del_id'];
$krs_id = $_POST['kurs_id'];
// $krs_arr = explode(',', $krs_id);
$name = $_POST['name'];
$surname = $_POST['surname'];
$patronymic = $_POST['patronymic'];
$DOB = $_POST['DOB'];
$categorie = $_POST['categorie'];
$phto = $_FILES['phto'];
$times = $_POST['t'];
$nazv = $_POST['nazv'];
$uch_zav = $_POST['uch_zav'];
$date_end = $_POST['date_end'];
$date_start = $_POST['date_start'];
$type = $_POST['type'];
$spec = $_POST['spec'];
$kvl  = $_POST['kvl'];
$kl_c = $_POST['kl_c'];
 
// print_r($del_id);
// print_r($times);
// print_r($krs_arr);
// print_r($del_id);
updatePrep($id,$name,$surname,$patronymic,$DOB,$categorie);
if($del_id != null){
deleteItemsFromKurs($del_id);
}
if($phto["name"] != null){
    $str = strval($id);
    $n = $str . ".png";
    saveImage($phto, $n);
}
$krs_id = getAllIdsFromKursDatabase();

UpdRecords($times,$nazv,$uch_zav,$date_start,$date_end ,$type,$id,$krs_id,$spec,$kvl,$kl_c);
header("Location: main.php");
?>