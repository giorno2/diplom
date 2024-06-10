<?php
function connectToDatabase() {
    clearstatcache();
    $servername = "172.16.238.10";
    $username = "root";
    $password = ""; // Использование пустой строки для пароля
    $dbname = "mk";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        // Установка PDO для обработки ошибок
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    } catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
        die();
    }
}
    
function login($username, $password) {
    $conn = connectToDatabase();
    if (!$conn) {
        return "Connection failed";
    }

    $sql = "SELECT * FROM user WHERE login = :login AND password = :password";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':login', $username);
    $stmt->bindParam(':password', $password);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        $conn = null; // Закрываем соединение с базой данных
        return true;
    } else {
        $conn = null; // Закрываем соединение с базой данных
        return false;
    }
}

function getTableData($tableName) {
    $conn = connectToDatabase();

    // Удалите вызов quote() для $tableName

    $sql = "SELECT * FROM $tableName";
    
    try {
        $result = $conn->query($sql);
        if (!$result) {
            throw new Exception("Error: " . $conn->errorInfo()[2]); // Выбросить исключение при ошибке
        }

        $data = $result->fetchAll(PDO::FETCH_ASSOC);
        $rowCount = count($data);

        $conn = null; // Закрыть соединение с базой данных

        return ['data' => $data, 'count' => $rowCount];
    } catch (Exception $e) {
        return "Error: " . $e->getMessage();
    }
}


function getTableDataO($tableName, $id) {
    $conn = connectToDatabase();

    $sql = "SELECT * FROM $tableName WHERE prep_id = :id";

    try {
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $rowCount = count($data);

        $conn = null; // Закрыть соединение с базой данных

        return ['data' => $data, 'count' => $rowCount];
    } catch (PDOException $e) {
        return "Error: " . $e->getMessage();
    }
}

function getTableDataT($tableName, $type) {
    $conn = connectToDatabase();

    $sql = "SELECT * FROM $tableName WHERE type = :type";

    try {
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':type', $type); // Привязываем параметр :type к значению $type
        $stmt->execute();

        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $rowCount = count($data);

        $conn = null; // Закрыть соединение с базой данных

        return ['data' => $data, 'count' => $rowCount];
    } catch (PDOException $e) {
        return "Error: " . $e->getMessage();
    }
}


function searchDatabase($searchQuery, $tableName) {
    $db = connectToDatabase();

    $searchQuery = "%$searchQuery%"; // Добавляем символы для поиска по любой части строки

    $sql = "SELECT * FROM $tableName WHERE name LIKE :searchQuery OR surname LIKE :searchQuery OR patronymic LIKE :searchQuery";
    
    try {
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':searchQuery', $searchQuery);
        $stmt->execute();

        $resultsArray = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $db = null; // Закрываем соединение с базой данных

        if (!empty($resultsArray)) {
            return $resultsArray;
        } else {
            return null;
        }
    } catch (PDOException $e) {
        return "Error: " . $e->getMessage();
    }
}


function searchDatabaseById($id, $tableName) {
    $db = connectToDatabase();
    $id = (int) $id; // Преобразование к целому числу для безопасности

    $sql = "SELECT * FROM $tableName WHERE id = :id";

    try {
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        $db = null; // Закрыть соединение с базой данных

        if ($result) {
            return $result;
        } else {
            return "Запись не найдена";
        }
    } catch (PDOException $e) {
        return "Error: " . $e->getMessage();
    }
}

function addNewElement($name, $surname, $patronymic, $DOB, $categorie) {
    $conn = null;
    try {
        // Подключение к базе данных через PDO
        $conn = connectToDatabase();
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $conn->beginTransaction(); // Начало транзакции

        $sql = "INSERT INTO prep (name, surname, patronymic, DOB, categorie) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$name, $surname, $patronymic, $DOB, $categorie]);

        $last_id = $conn->lastInsertId();

        $conn->commit(); // Подтверждение транзакции

        return $last_id;
    } catch (PDOException $e) {
        $conn->rollback(); // Откат транзакции в случае ошибки
        return "Ошибка: " . $e->getMessage();
    } finally {
        if ($conn !== null) {
            $conn = null; // Закрытие соединения в блоке finally
        }
    }
}


function saveImage($sourceFile, $fileName) {
    ini_set('display_errors', 1);
    error_reporting(E_ALL);

    $targetDir = 'im/'; // Папка, куда сохранять изображение
    $targetFile = $targetDir . $fileName;

    // Создаем папку, если её нет
    if (!file_exists($targetDir)) {
        mkdir($targetDir, 0777, true);
    }

    // Проверка существования файла и замена его на новый
    if (file_exists($targetFile)) {
        unlink($targetFile); // Удаляем существующий файл
    }

    // Копирование нового файла
    if (move_uploaded_file($sourceFile['tmp_name'], $targetFile)) {
        return "Изображение успешно сохранено: " . $fileName;
    } else {
        return "Ошибка при сохранении изображения";
    }
}


function saveRecords($n, $nameArray, $uch_zavArray, $date_startArray, $date_endArray, $typeArray, $prep_id, $spec_Array, $kvlArray, $kl_cArray,) {
    $conn = connectToDatabase();
    if (!$conn) {
        die("Failed to connect to database");
    }

    try {
        $conn->beginTransaction();

        $sql = "INSERT INTO kurs (name, uch_zav, date_start, date_end, spec, type, kvl, kl_c, prep_id) VALUES (:name, :uch_zav, :date_start, :date_end, :spec, :type, :kvl, :kl_c, :prep_id)";
        $stmt = $conn->prepare($sql);

        for ($i = 0; $i < $n; $i++) {
            $name = $nameArray[$i];
            $uch_zav = $uch_zavArray[$i];
            $date_start = $date_startArray[$i];
            $date_end = $date_endArray[$i];
            $spec = $spec_Array[$i];
            $type = $typeArray[$i];
            $kvl = $kvlArray[$i];
            $kl_c = $kl_cArray[$i];

            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':uch_zav', $uch_zav);
            $stmt->bindParam(':date_start', $date_start);
            $stmt->bindParam(':date_end', $date_end);
            $stmt->bindParam(':spec', $spec);
            $stmt->bindParam(':type', $type);
            $stmt->bindParam(':kvl', $kvl);
            $stmt->bindParam(':kl_c', $kl_c);
            $stmt->bindParam(':prep_id', $prep_id);

            $stmt->execute();
        }

        $conn->commit();

        header("Location: main.php");
        exit();
    } catch (PDOException $e) {
        $conn->rollBack();
        // Log or handle the error appropriately
        echo "Error: " . $e->getMessage();
    } finally {
        $conn = null;
    }
}


function getRecordsByPrepId($prep_id) {
    $conn = connectToDatabase();
    if (!$conn) {
        die("Failed to connect to database");
    }

    try {
        $sql = "SELECT id, name, opis, date, type FROM kurs WHERE prep_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$prep_id]);

        $records = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return array('count' => count($records), 'records' => $records);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        return array('count' => 0, 'records' => array());
    } finally {
        $conn = null;
    }
}


function updatePrep($id, $name, $surname, $patronymic, $dob, $categorie) {
    $conn = connectToDatabase();

    try {
        $sql = "UPDATE prep SET name=?, surname=?, patronymic=?, DOB=?, categorie=? WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$name, $surname, $patronymic, $dob, $categorie, $id]);

        // Здесь нет вывода
    } catch (PDOException $e) {
        // Вместо вывода сообщения об ошибке можно обработать ошибку иначе
        // Например, можно записать ошибку в файл или перенаправить пользователя на страницу ошибки
        // Пример записи ошибки в файл: error_log("Ошибка при обновлении данных: " . $e->getMessage(), 0);
        // Пример перенаправления на страницу ошибки: header("Location: error.php");
        // Примечание: Обязательно завершите выполнение скрипта после вызова header(), чтобы предотвратить дальнейшее выполнение скрипта
        throw $e;
    }
}


function deleteKursData($id) {
    $conn = connectToDatabase();

    try {
        $sql = "DELETE FROM kurs WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$id]);

    } catch (PDOException $e) {
        echo "Ошибка при удалении записи: " . $e->getMessage();
    }
}

function deleteItemsFromKurs($idStr) {
    $conn = connectToDatabase();

    try {
        // Преобразование строки id в массив для безопасного использования в SQL запросе
        $idArray = explode(",", $idStr);
        $idArray = array_map('intval', $idArray); // Преобразование каждого id в целое число

        // Подготка плейсхолдеров для SQL запроса
        $placeholders = implode(',', array_fill(0, count($idArray), '?'));

        // SQL запрос для удаления элементов
        $sql = "DELETE FROM kurs WHERE id IN ($placeholders)";
        $stmt = $conn->prepare($sql);
        $stmt->execute($idArray);

    } catch (PDOException $e) {
        echo "Ошибка при удалении элементов: " . $e->getMessage();
    }
}

function UpdRecords($n, $nameArray, $uch_zavArray, $date_startArray, $date_endArray, $typeArray, $prep_id, $idArray, $specArray, $kvlArray, $kl_cArray) {
    $conn = connectToDatabase();
    if (!$conn) {
        die("Connection failed");
    }

    try {
        $sql = "INSERT INTO kurs (id, name, uch_zav, date_start, date_end, spec, type, prep_id, kvl, kl_c)
                VALUES (:id, :name, :uch_zav, :date_start, :date_end, :spec, :type, :prep_id, :kvl, :kl_c)
                ON DUPLICATE KEY UPDATE
                name=VALUES(name), uch_zav=VALUES(uch_zav), date_start=VALUES(date_start), date_end=VALUES(date_end), 
                spec=VALUES(spec), type=VALUES(type), prep_id=VALUES(prep_id), kvl=VALUES(kvl), kl_c=VALUES(kl_c)";
        $stmt = $conn->prepare($sql);

        for ($i = 0; $i < $n; $i++) {
            $id = isset($idArray[$i]) ? $idArray[$i] : null;
            $name = $nameArray[$i];
            $uch_zav = $uch_zavArray[$i];
            $date_start = $date_startArray[$i];
            $date_end = $date_endArray[$i];
            $type = $typeArray[$i];
            $spec = $specArray[$i];
            $kvl = $kvlArray[$i];
            $kl_c = $kl_cArray[$i];
            
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':uch_zav', $uch_zav);
            $stmt->bindParam(':date_start', $date_start);
            $stmt->bindParam(':date_end', $date_end);
            $stmt->bindParam(':spec', $spec);
            $stmt->bindParam(':type', $type);
            $stmt->bindParam(':prep_id', $prep_id);
            $stmt->bindParam(':kvl', $kvl);
            $stmt->bindParam(':kl_c', $kl_c);

            $stmt->execute();
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    } finally {
        $conn = null;
    }
}



function getAllIdsFromKursDatabase() {
    $conn = connectToDatabase();
    if (!$conn) {
        die("Connection failed");
    }

    $ids = array(); // Массив для хранения id

    try {
        $sql = "SELECT id FROM kurs";
        $stmt = $conn->query($sql);

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $ids[] = $row["id"];
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

    $conn = null;

    return $ids;
}


function deleteRecord($id) {
    $conn = connectToDatabase();

    if (!$conn) {
        die("Connection failed");
    }

    try {
        // Удаление записей из таблицы kurs, где prep_id равен заданному id
        $sql1 = "DELETE FROM kurs WHERE prep_id = ?";
        $stmt1 = $conn->prepare($sql1);
        $stmt1->bindParam(1, $id);
        $stmt1->execute();


        // Удаление записи из таблицы prep по заданному id
        $sql2 = "DELETE FROM prep WHERE id = ?";
        $stmt2 = $conn->prepare($sql2);
        $stmt2->bindParam(1, $id);
        $stmt2->execute();


        // Удаление файла с фотографией
        $filename = "im/" . $id . ".png";
        if (file_exists($filename)) {
            if (unlink($filename)) {
            } else {
                echo "Error deleting photo";
            }
        } else {
            echo "Photo does not exist";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

    $conn = null;
}

function getKurs_type() {
    $conn = connectToDatabase();

    if (!$conn) {
        die("Connection failed");
    }

    $data = array(); // Массив для хранения результатов

    try {
        $sql = "SELECT * FROM kurs_type";
        $stmt = $conn->query($sql);

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row;
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

    $conn = null;

    return $data;
}

function searchDb($search, $prep, $type, $date) {
    $db = connectToDatabase();
    $conditions = [];
    $params = [];

    if (!empty($search)) {
        $conditions[] = "(name LIKE ? OR opis LIKE ?)";
        $params[] = "%$search%";
        $params[] = "%$search%";
    }

    if (!empty($prep)) {
        $conditions[] = "prep_id = ?";
        $params[] = $prep;
    }

    if (!empty($type)) {
        $conditions[] = "type = ?";
        $params[] = $type;
    }

    if (!empty($date)) {
        $conditions[] = "date = ?";
        $params[] = $date;
    }

    $query = "SELECT * FROM kurs";
    if (!empty($conditions)) {
        $query .= " WHERE " . implode(" AND ", $conditions);
    }

    $stmt = $db->prepare($query);
    if (!empty($params)) {
        foreach ($params as $key => $param) {
            $stmt->bindValue($key + 1, $param);
        }
    }
    
    $stmt->execute();

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $rowCount = count($result);

    $stmt->closeCursor();
    $db = null;

    return ['data' => $result, 'count' => $rowCount > 0 ? $rowCount : 0];
}
?>