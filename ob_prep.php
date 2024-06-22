<?php
// Подключение файла с функциями работы с базой данных
include 'sql.php';

// Получение данных из POST-запроса
$id = $_POST['id'] ?? null;
$del_id = $_POST['del_id'] ?? null;
$kurs_id = isset($_POST['kurs_id']) ? $_POST['kurs_id'] : null;

// Получение данных для обновления записи
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

// Проверка наличия хотя бы одного поля для обновления
if (!$name && !$surname && !$patronymic && !$DOB && !$categorie && !$nazv && !$uch_zav && !$date_end && !$date_start && !$type && !$spec && !$kvl && !$kl_c && !$phto) {
    // Если ни одно поле не было передано для обновления, перенаправляем обратно
    header("Location: view.php?id=".$id);
    exit();
}

// Обновление информации о пользователе
updatePrep($id, $name, $surname, $patronymic, $DOB, $categorie);

// Удаление элементов из курса, если указаны
if ($del_id !== null) {
    deleteItemsFromKurs($del_id);
}

// Сохранение фотографии, если она была загружена
if ($phto['name'] !== '' && $phto['error'] === UPLOAD_ERR_OK) {
    $photoName = $id . ".png";
    saveImage($phto, $photoName);
}

// Обновление остальных записей
$kurs_id = getAllIdsFromKursDatabase(); // Почему здесь?

UpdRecords($times, $nazv, $uch_zav, $date_start, $date_end, $type, $id, $kurs_id, $spec, $kvl, $kl_c);

// Перенаправление на страницу просмотра
header("Location: view.php?id=".$id);
exit();