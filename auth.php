<?php
session_start(); // Aloita sessio mihinkä tallennetaan käyttäjätieto
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') { // Tarkastetaan, että metodi on POST
    login(); //kutsutaan login funktio
}

function login() {
    global $conn; // Yhteys globaalin yhteus objectiin

    // Otetaan loggaus info tekstikentistä
    $username = $_POST['username'];
    $password = $_POST['password']; 
    $hashed_input_password = hash('sha256', $password); // Tehdään Hash loggauksessa annetulle salasanalle

    // SQL haku käyttäjätunnukselle. Binary tekee hausta Casesensitiven
    $sql = "SELECT * FROM users WHERE BINARY user_id = ?";
    
    // SQL valmistelu
    $stmt = $conn->prepare($sql);

    // Liitetään username valmisteluun
    $stmt->bind_param("s", $username);

    // Suoritetaan statementti
    $stmt->execute();

    // Tallennetaan tulos
    $result = $stmt->get_result();

    // Tarkistaan, että rivien määrä enenmmäm kuin nolla
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc(); // Otetaan user data
        $stored_hashed_password = $user['password']; // Otetaan Hashattu salasana

        // Tarkistetaan, että databasen hash-sasalana natsaa hashatun loggaus salasanan kanssa
        if (hash_equals($stored_hashed_password, $hashed_input_password)) {
            // Tallennetaan user_id, rooli ja username sessiodataan
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['role'] = $user['role'];
            $_SESSION['username'] = $username;

            // Lähetetään JSON vastaus onnistuneesta loggauksesta ja roolista
            echo json_encode(['success' => true, 'role' => $user['role']]);
        } else {
            // Lähetetään JSON, jos väärät tunnukset
            echo json_encode(['success' => false, 'error' => 'Invalid credentials']);
        }
    } 
    
    else {
        echo json_encode(['success' => false, 'error' => 'Invalid credentials']);
    }

    // Suljetaan statementti
    $stmt->close();
}
?>