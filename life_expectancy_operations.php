<?php
require_once 'db_connection.php';

function execute_life_expectancy_query($gov_form, $continent) {
    $conn = get_pdo_connection();
    
    try {
        $stmt = $conn->prepare("CALL FindCountriesWithLifeExpectancy(:gov_form, :continent, @count)");
        $stmt->bindParam(':gov_form', $gov_form);
        $stmt->bindParam(':continent', $continent);
        $stmt->execute();

        $res = $conn->query("SELECT @count AS result");
        $row = $res->fetch(PDO::FETCH_ASSOC);
        return "Количество стран: " . ($row["result"] ?? 0);
    } catch(PDOException $e) {
        return "Ошибка: " . $e->getMessage();
    }
}
?>