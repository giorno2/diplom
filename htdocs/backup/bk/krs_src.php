<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <title>курсы/другое</title>
</head>
<body>
    <?php 
    include 'sql.php';
    $search = $_POST['search'];
    $prep = $_POST['prep'];
    $prepa = $prep;
    $type = $_POST['type'];
    $date = $_POST['date'];
    $krs_t = getKurs_type();
    $krs = searchDb($search,$prep, $type, $date);
    $krs_data = $krs['data'];
    $krs_count = $krs['count'];
    $prep = getTableData('prep');
    $prep_data = $prep['data'];
    $l = $prep['count'];
    $data = json_encode($krs_data, JSON_HEX_TAG);
    $data2 = json_encode($prep_data, JSON_HEX_TAG);
    $data3 = json_encode($krs_t, JSON_HEX_TAG);
    ?>
    <div class="header">
        <a href="main.php"><img src="pic/logo.png" alt="" width="122" height="61"></a>
        <form action="krs_src.php" method="post" id="sr">
            <input type="search" name="search" class="search" placeholder="поиск" value="<?php echo($search); ?>">
            <input type="submit" value="поиск" class="src_btn">
         </div>
         <div id="src_panel">
            <select  class="g" name="prep" id="wd" value="<?php echo($prepa); ?>">
                <option value="" selected="selected">все</option>
                <?php 
                    foreach($prep_data as $record){
                        echo('<option value="' . $record["id"] . '">' . $record["surname"] . ' ' . $record["name"] . ' ' . $record["patronymic"] . '</option>');
                    }
                ?>
            </select>
            <p>преподаватель: </p>
            <select name="type" id="wd" value="<?php echo($type); ?>">
                <option value="" selected="selected">все</option>
                <?php 
                    foreach($krs_t as $record){
                        echo('<option value="' . $record["id"] . '">' . $record["name"] .  '</option>');
                    }
                ?>
            </select>
            <p>тип: </p>
            <input type="date" name="date" id="wd" value="<?php echo($date); ?>">
            <p>дата: </p>
            </div>
        </form>
        <div class="sidebar" id="sidebar">
        <button id="bs"><img src="pic/bars-solid.svg" alt="" width="46" height="38"></button>
        <ul>
            <li id="tb"><div id="ind"><a class="e" href="main.php">преподаватели</a> <a href="main.php"><img id="book" src="pic/book-solid.svg" alt="" width="46" height="38"></a></div></li>
            <li id="tp"><div id="ind"><a class="e" href="main.php">курсы </a> <a href="main_krs.php"><img id="pen" src="pic/pen-solid.svg" alt="" width="46" height="38"></a></div></li>
        </ul>
    </div>
    <div class="content">

        <form onsubmit="return validateForm()" action="krs_sv.php" method="post">

    <div id="kr_m">
        <script>
        let data = <?php echo(json_encode($krs_data, JSON_HEX_TAG)); ?>;
        let data_2 = <?php echo(json_encode($prep_data, JSON_HEX_TAG)); ?>;
        let data_3 = <?php echo(json_encode($krs_t, JSON_HEX_TAG)); ?>;
        let c = <?php echo($l); ?>;
        </script>
                <button type="button" id="krs_m_new" onclick="oncl(data_2, c, data_3)">
                    <input type="hidden" name="t" id="t">
                    <input type="hidden" name="did" id="del_id" value="0">
                    <img id="plus" src="pic/plus-solid.svg" alt="" width="96.57px" height="96.57px">
                </button>
    <input type="submit" id="save" value="">
    <script src='script.js'></script>
        <script>
         funq(data, data_2, c, data_3);
         </script>
</form>
</body>
</html>