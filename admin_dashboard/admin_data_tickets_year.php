<?php
// yhteydenotto databaseen ja filttereiden haku
require_once("../config.php");
require_once("admin_filtering.php");

// SQL prepared statemet millä estetään injektio
$stmt = $conn->prepare("SELECT DATE_FORMAT(STR_TO_DATE(date_time, '%d%m%Y %H:%i'), '%Y') AS year,
                        SUM(CASE WHEN museum_id = 'mid1' THEN 1 ELSE 0 END) AS mid1_tickets,
                        SUM(CASE WHEN museum_id = 'mid2' THEN 1 ELSE 0 END) AS mid2_tickets,
                        SUM(CASE WHEN museum_id = 'mid3' THEN 1 ELSE 0 END) AS mid3_tickets,
                        SUM(CASE WHEN museum_id = 'mid4' THEN 1 ELSE 0 END) AS mid4_tickets
                        FROM museums
                        WHERE DATE_FORMAT(STR_TO_DATE(date_time, '%d%m%Y %H:%i'), '%Y-%m-%d') BETWEEN '$start_date_formatted' AND '$end_date_formatted' 
                        AND (museum_id LIKE '$filter_mid1'
                            OR museum_id LIKE '$filter_mid2'
                            OR museum_id LIKE '$filter_mid3'
                            OR museum_id LIKE '$filter_mid4'
                            OR museum_id LIKE '$filter_default')
                        GROUP BY year;");
if (!$stmt) {
    die("Prepare failed: " . $conn->error);
}

// Ajetaan statementti
if (!$stmt->execute()) {
    die("Execute failed: " . $stmt->error);
}

// Kiinnitetään tulokset muuttujiin
$stmt->bind_result($year, $mid1_tickets, $mid2_tickets, $mid3_tickets, $mid4_tickets);

// Muutetaan data arrayksi
$data = array();
while ($stmt->fetch()) {
    $row = array(
        "year" => $year,
        "mid1_tickets" => (int)$mid1_tickets,
        "mid2_tickets" => (int)$mid2_tickets,
        "mid3_tickets" => (int)$mid3_tickets,
        "mid4_tickets" => (int)$mid4_tickets
    );
    $data[] = $row;
}

// Suljetaan statement ja SQL -yhteys
$stmt->close();
$conn->close();

// Lähetetään data Jasonina
header("Content-Type: application/json");
echo json_encode($data);
?>