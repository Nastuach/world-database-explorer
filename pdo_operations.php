<?php
require_once 'db_connection.php';

function execute_continent_areas_query() {
    $conn = get_pdo_connection();
    
    try {
        $stmt = $conn->query("SELECT * FROM ContinentAreaWithLargeCapitals");
        if ($stmt->rowCount() > 0) {
            $result = "<table><tr><th>Континент</th><th>Суммарная площадь</th></tr>";
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $result .= "<tr><td>" . safe($row["continent"]) . "</td><td>" 
                         . safe($row["total_surface_area"]) . "</td></tr>";
            }
            $result .= "</table>";
            return $result;
        }
        return "Нет данных";
    } catch(PDOException $e) {
        return "Ошибка: " . $e->getMessage();
    }
}
?>