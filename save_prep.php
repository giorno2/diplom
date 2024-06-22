<?php
// Включение отображения всех ошибок
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Подключение файла с функциями работы с базой данных
include 'sql.php';

// Получение данных из POST-запроса
$name = $_POST['name'] ?? null;
$surname = $_POST['surname'] ?? null;
$patronymic = $_POST['patronymic'] ?? null;
$DOB = $_POST['DOB'] ?? null;
$categorie = $_POST['categorie'] ?? null;
$phto = $_FILES['phto'] ?? null;
$times = $_POST['t'] ?? null;
$nazv = $_POST['nazv'] ?? null;
$uch_zav = $_POST['uch_zav'] ?? null;
$date_end = $_POST['date_end'] ?? null;
$date_start = $_POST['date_start'] ?? null;
$type = $_POST['type'] ?? null;
$kvl = $_POST['kvl'] ?? null;
$kl_c = $_POST['kl_c'] ?? null;
$spec = $_POST['spec'] ?? null;

// Добавление нового элемента и получение его ID
$newElementId = addNewElement($name, $surname, $patronymic, $DOB, $categorie);
if ($newElementId === false) {
    die("Error adding new element."); // Лучше обработать ошибку более деликатно
}

// Если загружена фотография, сохранить её
if ($phto && $phto['error'] === UPLOAD_ERR_OK) {
    $photoName = $newElementId . ".png"; // Пример имени файла, лучше применять более сложные проверки
    saveImage($phto, $photoName);
}

// Сохранение других данных в базу данных
saveRecords($times, $nazv, $uch_zav, $date_start, $date_end, $type, $newElementId, $spec, $kvl, $kl_c);

// Перенаправление на другую страницу
if (!headers_sent()) {
    header("Location: view.php?id=" . $newElementId);
    exit();
} else {
    echo "Headers already sent!";
    exit();
}
