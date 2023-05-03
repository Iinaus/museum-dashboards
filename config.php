<?php
    $servername = "mariadb.vamk.fi";
    $username = "USERNAME"; // placeholder tiedot GitHubia varten
    $password = "PASSWORD"; // placeholder tiedot GitHubia varten
    $dbname = "DATABASENAME"; // placeholder tiedot GitHubia varten

// Luodaan yhteys
$conn = new mysqli($servername, $username, $password, $dbname);

// Tarkistetaan yhteys ja ilmoitetaan erroreista
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>