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
    <title>Добавление преподавателя</title>
</head>
<body>
    <script type="text/javascript">

    </script>
<?php
        clearstatcache();
        include 'sql.php';
        $krs_t = getKurs_type();
        $krs = getTableData('kurs');
        $krs_data = $krs['data'];
        $krs_count = $krs['count'];
        $prep = getTableData('prep');
        $prep_data = $prep['data'];
        $l = $prep['count'];
        $data = json_encode($krs_data, JSON_HEX_TAG);
        $data2 = json_encode($prep_data, JSON_HEX_TAG);
        $data3 = json_encode($krs_t, JSON_HEX_TAG);
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
            <input type="search" name="search" class="search" placeholder="Поиск">
            <input type="submit" value="Поиск" class="src_btn">
        </form>
    <div id="logout">
        <?php echo("<p>" . "вы вошли как: " . $_SESSION["login"] . "</p>"); ?>
        <a href="logout.php">выйти<img src="pic/right-from-bracket-solid.svg" width="17px" height="17px"></a></div>
    </div>
    <div class="content-c">
        <form action="save_prep.php" onsubmit="validateForm(event)" method="post" id="fr" enctype="multipart/form-data">
            <label id="im">
            <input type="file" id="file" name="phto" accept="image/png, image/jpeg">
            <div><img id="imagePreview"  src="#" style="width: 235px; height: 307px;" onerror="hideBrokenImage(this)">
                <p id="textt">Выберите фото</p>
            </div>
            </label>
            <div class="tst">
                <label>Фамилия</label> <input type="text" id="surname" name="surname" placeholder="Фамилия"> </input>
                <label>Имя</label> <input type="text" id="name" name="name" placeholder="Имя"> </input>
                <label>Отчество</label> <input type="text" id="patronymic" name="patronymic" placeholder="Отчество"> </input>
                <label>Дата рождения</label> <input type="date" name="DOB" id="DOB">
                <label>Категория</label> <input type="text" name="categorie" id="categorie" placeholder="Категория">
                <input type="submit" value="Сохранить" id="subm">
            </div>
            <div id="kr">
            <p class="nzzn">Образование/курсы</p>
            <div id="tabhb">
            <button type="button" class="tab-btn" id="tb1" onclick="openTab('tab1',this)">Образование</button>
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
        <footer style="position:initial">
        <small>
        © 2024 Сергеев Дмитрий Сергеевич.
        </small>
    </footer>
    </div>
    <script src="script.js"></script>
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
<script>
    let d3 =<?php echo json_encode($krs_t, JSON_HEX_TAG);?>;
</script>
</body>
</html>
