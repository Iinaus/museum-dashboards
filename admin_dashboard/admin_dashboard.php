<?php
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../index.html");
    exit();
}

$_SESSION['start_date'] = $_GET['start_date'];
$_SESSION['end_date'] = $_GET['end_date'];

$start_date = $_SESSION['start_date'];
$end_date = $_SESSION['end_date'];

$_SESSION['mid1'] = $_GET['mid1'];
$_SESSION['mid2'] = $_GET['mid2'];
$_SESSION['mid3'] = $_GET['mid3'];
$_SESSION['mid4'] = $_GET['mid4'];

function showDiv($param) {
    // Tarkistetaan että parametri on validi
    if (!isset($_SESSION['mid1']) && !isset($_SESSION['mid2']) && !isset($_SESSION['mid3']) && !isset($_SESSION['mid4'])  ) {
      return true;
    } else if (isset($_SESSION[$param]) && $_SESSION[$param] == $param) {
      return true;
    } else { return false;}
}
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

    <title>Admin dashboard</title>
</head>
<body>
    
    <header>
        <div class='header-flex'>
            <h1>Admin dashboard</h1>
            <nav>
                <?php echo $_SESSION['username'];?>
                <button id="logOutButton">Logout</button>
            </nav>
        </div>
    </header>

    <div class='filters'>
        <form name="Filter" method="GET" class='filterarea'>
            <div>
                <p>Filter by days</p>
                <label for="start_date">Start date:</label>
                <input type="date" id="start_date" name="start_date" value="<?php echo $start_date?>">
                <label for="end_date">End date:</label>
                <input type="date" id="end_date" name="end_date" value="<?php echo $end_date?>">
            </div>

            <div>
                <p>Filter by museum id</p>
                <input type="checkbox" id="mid1" name="mid1" value="mid1" <?php if (isset($_SESSION['mid1']) && $_SESSION['mid1'] == 'mid1') echo 'checked'; ?>>
                <label for="mid1">Mid1</label>
                <input type="checkbox" id="mid2" name="mid2" value="mid2" <?php if (isset($_SESSION['mid2']) && $_SESSION['mid2'] == 'mid2') echo 'checked'; ?>>
                <label for="mid2">Mid2</label>
                <input type="checkbox" id="mid3" name="mid3" value="mid3" <?php if (isset($_SESSION['mid3']) && $_SESSION['mid3'] == 'mid3') echo 'checked'; ?>>
                <label for="mid3">Mid3</label>
                <input type="checkbox" id="mid4" name="mid4" value="mid4" <?php if (isset($_SESSION['mid4']) && $_SESSION['mid4'] == 'mid4') echo 'checked'; ?>>
                <label for="mid4">Mid4</label>
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
        <br>
        <div <?php if (showDiv('mid1')){echo 'style="display:block"'; } else { echo 'style="display:none"'; } ?>>
            <p>Museo 1:</p>
            <div id="ticketsByEmployees1" class='graph'></div>
        </div>
        <div <?php if (showDiv('mid2')){echo 'style="display:block"'; } else { echo 'style="display:none"'; } ?>>
            <p>Museo 2:</p>
            <div id="ticketsByEmployees2" class='graph'></div>
        </div>
        <div <?php if (showDiv('mid3')){echo 'style="display:block"'; } else { echo 'style="display:none"'; } ?>>
            <p>Museo 3:</p>
            <div id="ticketsByEmployees3" class='graph'></div>
        </div>
        <div <?php if (showDiv('mid4')){echo 'style="display:block"'; } else { echo 'style="display:none"'; } ?>>
            <p>Museo 4:</p>
            <div id="ticketsByEmployees4" class='graph'></div>
        </div> 
    </div>     

    <script src="admin_dashboard.js"></script>    
    
</body>
</html>