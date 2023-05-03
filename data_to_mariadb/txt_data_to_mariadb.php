<?php
$servername = "mariadb.vamk.fi";
$username = "USERNAME"; // placeholder tiedot GitHubia varten
$password = "PASSWORD"; // placeholder tiedot GitHubia varten
$dbname = "DATABASENAME"; // placeholder tiedot GitHubia varten

ini_set('display_errors', 1);
error_reporting(E_ALL);

// Uusi yhteys
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Avataan txt tiedosto palvelimelta (teoriassa voisi muokata avaaman suoran linkin myös, mutta en tiedä tuoko ongelmia.
// riippuu varmaan miten serveri on configuroitu, että salliiko ulkopuolisia linkkejä...
$file = fopen('museum_data.txt', 'r');

// Luetaan riviriviltä
while (($line = fgets($file)) !== false) {
  // Hajotetaan rivi kohdista jossa on pilkku
  $parts = explode(",", $line);

  // Poistetaan tylimääräisen välit
  $parts = array_map('trim', $parts);

  // Prepare SQL statement
  $stmt = $conn->prepare("INSERT INTO _museums (museum_id, ticket_type, date_time, employee_id, customer_id, payment_method) 
                          VALUES (?, ?, ?, ?, ?, ?)");
  $stmt->bind_param("ssssss", $parts[0], $parts[1], $parts[2], $parts[3], $parts[4], $parts[5]);

  // Suoritetaan prepared statement
  if ($stmt->execute()) {
    echo "New record created successfully";
  } else {
    echo "Error: " . $stmt->error;
  }
}

// Tiedosto kiinni
fclose($file);

// Yhteyden lopetus
$conn->close();
?>