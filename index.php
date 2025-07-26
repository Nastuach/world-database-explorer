<?php
require_once 'db_connection.php';
require_once 'pdo_operations.php';
require_once 'capitals_operations.php';
require_once 'life_expectancy_operations.php';

$result = "";
$showForm1 = false;
$showForm2 = false;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["show_capitals_form"])) {
        $showForm1 = true;
    } elseif (isset($_POST["show_life_expectancy_form"])) {
        $showForm2 = true;
    } elseif (isset($_POST["run_capitals"])) {
        $min_population = (int)$_POST["min_population"];
        $min_languages = (int)$_POST["min_languages"];
        $result = execute_capitals_query($min_population, $min_languages);
    } elseif (isset($_POST["run_life_expectancy"])) {
        $gov_form = $_POST["gov_form"];
        $continent = $_POST["continent"];
        $result = execute_life_expectancy_query($gov_form, $continent);
    } elseif (isset($_POST["continent_areas"])) {
        $result = execute_continent_areas_query();
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Лабораторная 5 — Работа с MySQL</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Интерактив с базой данных</h1>

    <form method="post">
        <button type="submit" name="show_capitals_form">1. Кол-во столиц с языками</button>
        <button type="submit" name="show_life_expectancy_form">2. Страны с ВНД и жизнью</button>
        <button type="submit" name="continent_areas">3. Площадь континентов</button>
    </form>

    <?php if ($showForm1): ?>
        <form method="post">
            <h3>Введите параметры для столиц:</h3>
            <input type="number" name="min_population" placeholder="Минимальное население столицы" required min="0"><br>
            <input type="number" name="min_languages" placeholder="Минимальное кол-во языков" required min="1"><br>
            <button type="submit" name="run_capitals">Выполнить запрос</button>
        </form>
    <?php endif; ?>

    <?php if ($showForm2): ?>
        <form method="post">
            <h3>Введите параметры для стран с ВНД:</h3>
            <input type="text" name="gov_form" placeholder="Форма правления (напр. Republic)" required><br>
            <input type="text" name="continent" placeholder="Континент (напр. Europe)" required><br>
            <button type="submit" name="run_life_expectancy">Выполнить запрос</button>
        </form>
    <?php endif; ?>

    <?php if (!empty($result)): ?>
        <div class="result-box">
            <h3>Результат:</h3>
            <div><?= $result ?></div>
        </div>
    <?php endif; ?>
</body>
</html>