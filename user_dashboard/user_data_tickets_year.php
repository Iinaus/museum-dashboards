<?php
// yhteydenotto databaseen ja filttereiden haku
require_once("../config.php");
require_once("user_filtering.php");

// SQL prepared statemet millä estetään injektio
$stmt = $conn->prepare("SELECT DATE_FORMAT(STR_TO_DATE(date_time, '%d%m%Y %H:%i'), '%Y') AS year, COUNT(ticket_type)
                        FROM museums
                        WHERE DATE_FORMAT(STR_TO_DATE(date_time, '%d%m%Y %H:%i'), '%Y-%m-%d') BETWEEN '$start_date_formatted' AND '$end_date_formatted' 
                        AND museum_id = '$mid'
                        GROUP BY year;");

if (!$stmt) {
    die("Prepare failed: " . $conn->error);
}

// Ajetaan statementti
if (!$stmt->execute()) {
    die("Execute failed: " . $stmt->error);
}

// Kiinnitetään tulokset muuttujiin
$stmt->bind_result($year, $tickets);

// Muutetaan data arrayksi
$data = array();
while ($stmt->fetch()) {
    $row = array(
        "year" => $year,
        "tickets" => (int) $tickets,
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