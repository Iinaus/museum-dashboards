<?php

$museum = $_GET['museum'];

// yhteydenotto databaseen ja filttereiden haku
require_once("../config.php");
require_once("admin_filtering.php");

// SQL prepared statemet mill� estet��n injektio
$stmt = $conn->prepare("SELECT DATE_FORMAT(STR_TO_DATE(date_time, '%d%m%Y %H:%i'), '%m-%Y') AS month,
                SUM(CASE WHEN employee_id = 'eid1' THEN 1 ELSE 0 END) AS eid1_tickets, 
                SUM(CASE WHEN employee_id = 'eid2' THEN 1 ELSE 0 END) AS eid2_tickets,
                SUM(CASE WHEN employee_id = 'eid3' THEN 1 ELSE 0 END) AS eid3_tickets, 
                SUM(CASE WHEN employee_id = 'eid4' THEN 1 ELSE 0 END) AS eid4_tickets,
                SUM(CASE WHEN employee_id = 'eid5' THEN 1 ELSE 0 END) AS eid5_tickets, 
                SUM(CASE WHEN employee_id = 'eid6' THEN 1 ELSE 0 END) AS eid6_tickets,
                SUM(CASE WHEN employee_id = 'eid7' THEN 1 ELSE 0 END) AS eid7_tickets                        
                FROM museums 
                            WHERE DATE_FORMAT(STR_TO_DATE(date_time, '%d%m%Y %H:%i'), '%Y-%m-%d') BETWEEN '$start_date_formatted' AND '$end_date_formatted'
                            AND (museum_id LIKE '$filter_mid1'
                                OR museum_id LIKE '$filter_mid2'
                                OR museum_id LIKE '$filter_mid3'
                                OR museum_id LIKE '$filter_mid4'
                                OR museum_id LIKE '$filter_default')
                            AND (museum_id LIKE '$museum')
                            GROUP BY month;");

if (!$stmt) {
    die("Prepare failed: " . $conn->error);
}

// Ajetaan statementti
if (!$stmt->execute()) {
    die("Execute failed: " . $stmt->error);
}

// Kiinnitet��n tulokset muuttujiin
$stmt->bind_result($month, $eid1_tickets, $eid2_tickets, $eid3_tickets, $eid4_tickets, $eid5_tickets, $eid6_tickets, $eid7_tickets);

// Muutetaan data arrayksi
$data = array();
while ($stmt->fetch()) {
    $row = array(
        "month" => $month,
        "eid1_tickets" => (int)$eid1_tickets,
        "eid2_tickets" => (int)$eid2_tickets,
        "eid3_tickets" => (int)$eid3_tickets,
        "eid4_tickets" => (int)$eid4_tickets,
        "eid5_tickets" => (int)$eid5_tickets,
        "eid6_tickets" => (int)$eid6_tickets,
        "eid7_tickets" => (int)$eid7_tickets
    );
    $data[] = $row;
}

// Suljetaan statement ja SQL -yhteys
$stmt->close();
$conn->close();

// L�hetet��n data Jasonina
header("Content-Type: application/json");
echo json_encode($data);
?>