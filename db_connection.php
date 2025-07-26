<?php
define('DB_HOST', 'localhost');
define('DB_NAME', 'world');
define('DB_USER', 'root');
define('DB_PASS', 'vertrigo');

//Процедурное 
function get_procedural_connection() {
    if (!function_exists('mysqli_connect')) {
        die("Ошибка: расширение MySQLi не установлено.");
    }
    $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

    if (!$conn) {
        die("Ошибка процедурного подключения: " . mysqli_connect_error());
    }
    mysqli_set_charset($conn, "utf8");
    return $conn;
}
//Объектное
function get_oop_connection() {
    if (!class_exists('mysqli')) {
        die("Ошибка: класс mysqli не найден.");
    }
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    if ($conn->connect_error) {
        die("Ошибка OOP подключения: " . $conn->connect_error);
    }
    $conn->set_charset("utf8");
    return $conn;
}
//PDO
function get_pdo_connection() {
    if (!extension_loaded('pdo_mysql')) {
        die("Ошибка: расширение PDO MySQL не установлено.");
    }

    try {
        $conn = new PDO(
            "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8",
            DB_USER,
            DB_PASS
        );
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    } catch (PDOException $e) {
        die("Ошибка PDO подключения: " . $e->getMessage());
    }
}
function safe($value) {
    return htmlspecialchars($value ?? '', ENT_QUOTES, 'UTF-8');
}
?>
