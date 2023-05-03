<?php
session_start();

// Putsataan sessiomuuttujat
$_SESSION = array();

// Putsataan coociet
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Tuhotaan sessio
session_destroy();
?>

<!-- Ilmoitus uloskirjautumisesta -->
<script>
alert("You have been logged out.");
window.location.href = "index.html";
</script>