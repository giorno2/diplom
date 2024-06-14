<?php
session_start();
if(isset($_SESSION["login"]) === true){
    header("Location: main.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <title>Авторизация</title>
</head>
<body>
    <div class="main">
                <img src="pic/logo.png" alt="" height="245px" width="500px">
                <h1>Методический кабинет</h1>
                <?php
                    if(isset($_SESSION["error"]) === true){
                        echo "<p id='error' style='color:red'>" . $_SESSION['error'] . "</p>";
                        unset($_SESSION["error"]);
                    }
                ?>
        <div class="log">
            <form action="login.php" method="post">
                <p>АВТОРИЗАЦИЯ</p>
                <?php
                    if (isset($_COOKIE['login'])){
                        echo"<input type= 'text' name='login' id='login' value= ". $_COOKIE['login'] . ">";
                    }
                    else{
                        echo"<input type='text' name='login' id='login' placeholder='Логин'>";
                    }
                ?>
                <input type="password" name="password" id="password" placeholder="Пароль">
                <input type="submit" value="ВОЙТИ">
            </form>
        </div>
        <footer>
        <small>
        © 2024 Сергеев Дмитрий Сергеевич.
        </small>
    </footer>
    </div>
</body>
</html>