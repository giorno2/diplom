<?php 
        session_start();
        if (isset($_SESSION["login"]) !== true){
            header("Location: index.php");
        }
        setcookie("login", $_SESSION["login"], time() + 3600);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <title>главная</title>
</head>
<body>

    <div class="header">
        <a href="main.php"><img src="pic/logo.png" alt="" width="122" height="61"></a>
        <form action="main_src.php" method="post" id="sr">
            <input type="search" name="search" class="search" placeholder="поиск">
            <input type="submit" value="поиск" class="src_btn">
        </form>
        <div id="main">
        <h1>Методический кабинет</h1>
        <h2>для добавления преподавателя нажмите на кнопку "+" <a href=""></a></h2>
        </div>
    </div>
    <div class="content" id="mc">
        <a href="add_prep.php"> <div class="prep_new"><img id="plus" src="pic/plus-solid.svg" alt="" width="96.57px" height="96.57px"></div></a>
        <?php
        clearstatcache();
        include 'sql.php';
        $table = "prep";
        $result = getTableData($table);
        $data = $result['data'];
        $count = $result['count'];
        foreach ($data as $row) {
            echo '<div class="prep">';
            echo '<a href="edit_prep.php?id='. $row['id'] . '" id="wq"> <div class="name">';
            echo '<p>' . $row['surname'] . '</p>';
            echo '<p>' . $row['name'] . '</p>';
            echo '<p>' . $row['patronymic'] . '</p>';
            echo '</div>';
            echo '<div class="photo"><img src="im/' . $row['id'] . '.png"></div></a>';
            echo '<a href="del_prep.php?id='. $row['id'] . '" class="d" onclick="return confirm(\'Вы уверены, что хотите удалить?\');">';
            echo '<div class="del_btn"><img src="pic/x-solid.svg" alt=""  width="30px" height="30px"></div>';
            echo '</a>';
            echo '</div>';
        }
        ?> 
    </div>
    <script src="script.js"></script>
</body>
</html>