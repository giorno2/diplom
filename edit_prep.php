<?php 
        session_start();
        if (isset($_SESSION["login"]) !== true){
            header("Location: index.php");
        }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <title>редактирование данных преподавателя</title>
</head>
<body>
    <?php
        clearstatcache();
        include 'sql.php';
        $krs_t = getKurs_type();
        $krs1 = getTableDataT('kurs',2);
        $id = $_GET['id'];
        $krs = getTableDataO('kurs', $id);
        usort($krs['data'], function($a, $b) {
            return $a['id'] - $b['id'];
        });
        
        $krs_data = $krs['data'];
        $krs_count = $krs['count'];
        $krs1_data = $krs1['data'];
        $krs1_count = $krs1['count'];
        $prep = getTableData('prep');
        $prep_data = $prep['data'];
        $l = $prep['count'];
        $data = json_encode($krs_data, JSON_HEX_TAG);
        $dataO = json_encode($krs1_data, JSON_HEX_TAG);
        $data2 = json_encode($prep_data, JSON_HEX_TAG);
        $data3 = json_encode($krs_t, JSON_HEX_TAG);
        $idj = $id . ".png";
    ?>
    <script>
        let data = <?php echo($data); ?>;
        let data_2 = <?php echo($data2); ?>;
        let data_3 = <?php echo($data3); ?>;
        let c = <?php echo($l); ?>;
    </script>
    <div class="header">
        <a href="main.php"><img src="pic/logo.png" alt="" width="122" height="61"></a>
        <form action="main_src.php" method="post" id="sr">
            <input type="search" name="search" class="search" placeholder="поиск">
            <input type="submit" value="поиск" class="src_btn">
        </form>
    </div>
    <div class="content">
        <form onsubmit="validateForm(event)" action="ob_prep.php" method="post" id="fr" enctype="multipart/form-data">
            <!-- <input type="hidden" name="kurs_id[]" value = ""> -->
           <?php echo' <input type="hidden" name="id" value="' .$id. '"> '?>
            <label id="im">
            <input type="hidden" name="del_id" id="del_id">
            <input type="hidden" name="pid" value="<?php echo($id); ?>">
            <input type="file" id="file" name="phto" accept="image/png, image/jpeg">
            <?php
            echo'<div><img id="imagePreview" src="im/' . $idj . '" style="max-width: 235px; max-height: 307px;" onerror="hideBrokenImage(this)">
            <p id="textt" style="display: none;">выберите фото</p>
            </div>';
            ?>
            </label>
            <div class="tst">
                <?php
                $table = "prep";
                $res = searchDatabaseById($id, $table);
                echo'<label>фамилия: </label> <input type="text" id="surname" name="surname" value="'. $res["surname"] .'"> </input>';
                echo'<label>имя: </label> <input type="text" id="name" name="name" value="'. $res["name"] .'"> </input>';
                echo'<label>отчество: </label> <input type="text" id="patronymic" name="patronymic" value="'. $res["patronymic"] .'"> </input>';
                echo'<label>дата рождения: </label> <input type="date" name="DOB" id="DOB" value="'. $res["DOB"] .'">';
                echo'<label>категория: </label> <input type="text" name="categorie" id="categorie" value = "'. $res["categorie"] .'">';
                echo'<input type="submit" value="сохранить" id="subm">';
                ?>
            </div>
            <div id="kr">
            <div id="tabhb">
    <button type="button" class="tab-btn" onclick="openTab('tab1', this)">Обучение</button>
    <button type="button" class="tab-btn" id="tb2" onclick="openTab('tab2', this)">Курсы</button>
</div>
    <input type="hidden" name="t" id="t">
<div id="tab1" class="tab">
    <button type="button" id="krs_new" onclick="krs_n()">
        <img id="plus" src="pic/plus-solid.svg" alt="" width="96.57px" height="96.57px">
    </button>
</div>
<div id="tab2" class="tab">
    <button type="button" id="krs_new" onclick="krs_ne()">
        <img id="plus" src="pic/plus-solid.svg" alt="" width="96.57px" height="96.57px">
    </button>
</div>
        </form>
    </div>
    <script>
        const fileInput = document.getElementById('file');
        const imagePreview = document.getElementById('imagePreview');
        const text = document.getElementById('textt');
        let qwerty = 0;

        
        fileInput.addEventListener('change', function() {
            const file = fileInput.files[0];
            if (file) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    imagePreview.src = e.target.result;
                    qwerty = 1;
                    hideBrokenImage(imagePreview);
                };

                reader.readAsDataURL(file);
            }
        });
        function hideBrokenImage(element) {
        if (qwerty === 0) {
        element.style.display = 'none'; // Скрыть элемент изображения
        text.style.display = 'inline';
        console.log(qwerty);
        }
        else{
        element.style.display = 'inline'; // Показать элемент изображения
        text.style.display = 'none';
        console.log(qwerty);
        }
    };

    </script>
    <script src="script.js"></script>
<script>
    let d3 =<?php echo json_encode($krs_t, JSON_HEX_TAG);?>;
    let d = <?php echo json_encode($data)?>;
    let d1 = <?php echo json_encode($dataO)?>;
    fun(d);
</script>
</body>
</html>