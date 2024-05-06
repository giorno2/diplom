<?php 
include 'sql.php';
$name = isset($_POST['name']) ? $_POST['name'] : null;
$surname = isset($_POST['surname']) ? $_POST['surname'] : null;
$patronymic = isset($_POST['patronymic']) ? $_POST['patronymic'] : null;
$DOB = isset($_POST['DOB']) ? $_POST['DOB'] : null;
$categorie = isset($_POST['categorie']) ? $_POST['categorie'] : null;
$phto = isset($_FILES['phto']) ? $_FILES['phto'] : null;
$times = isset($_POST['t']) ? $_POST['t'] : null;
$nazv = isset($_POST['nazv']) ? $_POST['nazv'] : null;
$uch_zav = isset($_POST['uch_zav']) ? $_POST['uch_zav'] : null;
$date_end = isset($_POST['date_end']) ? $_POST['date_end'] : null;
$date_start = isset($_POST['date_start']) ? $_POST['date_start'] : null;
$type = isset($_POST['type']) ? $_POST['type'] : null;
$kvl = isset($_POST['kvl']) ? $_POST['kvl'] : null;
$kl_c = isset($_POST['kl_c']) ? $_POST['kl_c'] : null;
$spec = isset($_POST['spec']) ? $_POST['spec'] : null;

$newElementId = addNewElement($name, $surname, $patronymic, $DOB, $categorie);

if($phto != null){
    $str = strval($newElementId);
    $n = $str . ".png";
    saveImage($phto, $n);
}

saveRecords($times,$nazv, $uch_zav, $date_start, $date_end, $type, $newElementId, $spec, $kvl, $kl_c,);
header("Location: main.php");
exit();
?>
