document.getElementById('login-form').addEventListener('submit', async (event) => {
    event.preventDefault(); // Estä lomakkeen oletuslähetys

    const username = document.getElementById('username').value; // Hakee käyttäjänimen lomakkeesta
    const password = document.getElementById('password').value; // Hakee salasanan

    try {
        const response = await fetch('auth.php', { // Lähetä pyyntö 'auth.php' -tiedostolle
            method: 'POST', // Käyterään POST-metodia
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded', // Asetetaan sisältötyyppi
            },
            body: `username=${encodeURIComponent(username)}&password=${encodeURIComponent(password)}`, // Muodostetaan pyynnön sisältö
        });

        const result = await response.json(); // Muunnetaan vastaus JSON-muotoon

        if (result.success) { // Jos kirjautuminen onnistuu
            if (result.role === 'admin') { // Jos käyttäjä on admin niin siirrytääm admin dashboardille
                window.location.href = 'admin_dashboard/admin_dashboard.php';
            } else if (result.role === 'museum') { // Jos käyttäjä on museo niin siirrytään perus dashboardille
                window.location.href = 'user_dashboard/user_dashboard.php';
            }
        } else { // Jos kirjautuminen epäonnistuu niin ilmoitaan erroreista
            alert('Error logging in: ' + result.error);
        }
    } catch (error) { // Jos tapahtuu virheitä niin ilmoitetaan niistä
        console.error('Error:', error);
    }
});