<?php
session_start();

//Tarkistaa roolin, jos peruskäyttäjä niin ohjaa index.html
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'museum') {
    header("Location: ../index.html");
    exit();
}

$_SESSION['start_date'] = $_GET['start_date'];
$_SESSION['end_date'] = $_GET['end_date'];

$start_date = $_SESSION['start_date'];
$end_date = $_SESSION['end_date'];
?>

<!-- Alert, aloituspäivä ei voi olla ennen lopetuspäivää -->
<script>
    let startDate = new Date('<?php echo $start_date; ?>');
    let endDate = new Date('<?php echo $end_date; ?>');

    if (endDate < startDate) {
        alert("Invalid date range.");
    }
</script>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/dashboard_styles.css">

    <script src="https://www.gstatic.com/charts/loader.js"></script>
    <title>User Dashboard</title>
</head>

<body>
    <header>
        <div class='header-flex'>
            <h1>User Dashboard</h1>
            <nav>
                <?php echo $_SESSION['username']; ?>
                <button id="logOutButton">Logout</button>
            </nav>
        </div>
    </header>

    <div class='filters'>
        <form name="Filter" method="GET" class='filterarea'>
            <div>
                <p>Filter by days</p>
                <label for="start_date">Start date:</label>
                <input type="date" id="start_date" name="start_date" value="<?php echo $start_date ?>">
                <label for="end_date">End date:</label>
                <input type="date" id="end_date" name="end_date" value="<?php echo $end_date ?>">
            </div>

            <button type="submit">Apply</button>
        </form>
    </div>

    <div class='dashboard'>
        <div id="ticketsByMonth" class='graph'></div>
        <div id="ticketsByYear" class='graph'></div>
        <div id="visitorType" class='graph'></div>
        <div id="ticketType" class='graph'></div>
        <div id="visitingTimes" class='graph'></div>
        <div id="paymentMethods" class='graph'></div>
        <div id="ticketsByEmployees" class='graph'></div>
    </div>

    <script src="user_dashboard.js"></script>
</body>

</html>