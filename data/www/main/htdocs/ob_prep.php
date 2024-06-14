<?php 
include 'sql.php';
$id = $_POST['id'];
$del_id = $_POST['del_id'];
$krs_id =isset($_POST['kurs_id']) ? $_POST['kurs_id'] : null;
// $krs_arr = explode(',', $krs_id);
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
if (isset($name) === true ||isset($surname) === true || isset($patronymic) === true || isset($DOB) === true || isset($categorie) === true || isset($nazv) === true || 
isset($uch_zav) === true || isset($date_end) === true || isset($date_start) === true || isset($type) === true || isset($spec) === true || isset($kvl) === true ||
isset($kl_c) === true){
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
    header("Location: view.php?id=".$id);
}
else{
    header("Location: view.php?id=".$id);
};
?>