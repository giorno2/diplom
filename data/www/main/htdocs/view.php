<?php
        session_start();
        if (isset($_SESSION["login"]) !== true){
            header("Location: index.php");
        }
?>
<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <title>просмотр данных преподавателя</title>
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
        let data = < ? php echo($data); ? > ;
        let data_2 = < ? php echo($data2); ? > ;
        let data_3 = < ? php echo($data3); ? > ;
        let c = < ? php echo($l); ? > ;
    </script>
    <div class="header">
        <a href="main.php"><img src="pic/logo.png" alt="" width="122" height="61"></a>
        <form action="main_src.php" method="post" id="sr">
            <input type="search" name="search" class="search" placeholder="Поиск">
            <input type="submit" value="Поиск" class="src_btn">
        </form>
        <div id="logout">
            <?php echo("<p>" . "вы вошли как: " . $_SESSION["login"] . "</p>"); ?>
            <a href="logout.php">выйти<img src="pic/right-from-bracket-solid.svg" width="17px" height="17px"></a></div>
    </div>
    <div class="content-c">
        <form onsubmit="validateForm(event)" action="ob_prep.php" method="post" id="fr" enctype="multipart/form-data">
            <!-- <input type="hidden" name="kurs_id[]" value = ""> -->
            <?php echo' <input type="hidden" name="id" value="' .$id. '"> '?>
            <label id="im">
                <input type="hidden" name="del_id" id="del_id">
                <input type="hidden" name="pid" value="<?php echo($id); ?>">
                <?php
            echo'<div><img id="imagePreview" src="im/' . $idj . '" style="max-width: 235px; max-height: 307px;" onerror="hideBrokenImage(this)">
            </div>';
            ?>
            </label>
            <div class="tst">
                <?php
                $table = "prep";
                $res = searchDatabaseById($id, $table);
                echo'<label>Фамилия: </label> <input readonly type="text" id="surname" name="surname" value="'. $res["surname"] .'"> </input>';
                echo'<label>Имя: </label> <input readonly type="text" id="name" name="name" value="'. $res["name"] .'"> </input>';
                echo'<label>Отчество: </label> <input readonly type="text" id="patronymic" name="patronymic" value="'. $res["patronymic"] .'"> </input>';
                echo'<label>Дата рождения: </label> <input readonly type="date" name="DOB" id="DOB" value="'. $res["DOB"] .'">';
                echo'<label>Категория: </label> <input readonly type="text" name="categorie" id="categorie" value = "'. $res["categorie"] .'">';
                echo '<a id = "edit" href="edit_prep.php?id=' .$id. '"> редактировать</a>';
                ?>
            </div>
            <div id="kr">
                <p class="nzzn">Образование/курсы</p>
                <div id="tabhb">
                    <button type="button" class="tab-btn" onclick="openTab('tab1', this)">Образование</button>
                    <button type="button" class="tab-btn" id="tb2" onclick="openTab('tab2', this)">Курсы</button>
                </div>
                <input type="hidden" name="t" id="t">
                <div id="tab1" class="tab">

                </div>
                <div id="tab2" class="tab">

                </div>
        </form>

    </div>
        <footer id="ev" style="position:absolute">
            <small>
                © 2024 Сергеев Дмитрий Сергеевич.
            </small>
        </footer>
    <script>
        const fileInput = document.getElementById('file');
        const imagePreview = document.getElementById('imagePreview');
        const text = document.getElementById('textt');
        let qwerty = 0;


        fileInput.addEventListener('change', function () {
            const file = fileInput.files[0];
            if (file) {
                const reader = new FileReader();

                reader.onload = function (e) {
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
            } else {
                element.style.display = 'inline'; // Показать элемент изображения
                text.style.display = 'none';
                console.log(qwerty);
            }
        };
    </script>
    <script src="script.js"></script>
    <script>
        let d3 = < ? php echo json_encode($krs_t, JSON_HEX_TAG); ? > ;
        let d = < ? php echo json_encode($data) ? > ;
        let d1 = < ? php echo json_encode($dataO) ? > ;
        fun_ro(d);
    </script>
</body>

</html>