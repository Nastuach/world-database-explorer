<?php
require_once 'db_connection.php';

function execute_capitals_query($min_population, $min_languages) {
    $conn = get_pdo_connection();
    
    try {
        $stmt = $conn->prepare("SELECT GetCitiesCountWithLanguageCondition(:min_pop, :min_lang) AS result");
        $stmt->bindParam(':min_pop', $min_population, PDO::PARAM_INT);
        $stmt->bindParam(':min_lang', $min_languages, PDO::PARAM_INT);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return "Количество столиц: " . ($row["result"] ?? 0);
    } catch(PDOException $e) {
        return "Ошибка при выполнении запроса: " . $e->getMessage();
    }
}
?>