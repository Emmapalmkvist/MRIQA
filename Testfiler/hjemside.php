<?php

session_start();

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>


<!doctype html>
<html>
<head><title>Hjem</title></head>
<body>
<h1>MR-Scanning - Region Midt</h1>
<div class="tabContainer">
    <div class="buttonContainer">
        <button onclick="window.location.href='hjemside.php'">Hjem</button>
        <button onclick="window.location.href='sammenlignscanner.php'">Sammenlign Scannere</button>
        <button onclick="window.location.href='overblikscannere.php'">Overblik over Scannere</button>
    </div>
    <div class="tabPanel"></div>
    <div class="tabPanel"></div>
    <div class="tabPanel"></div>
    </div>

<?php

$dtz = new DateTimeZone("Europe/Madrid"); //Your timezone
$now = new DateTime(date("Y-m-d"), $dtz);
$date1 = $now->format("Y-m-d");

$date = (new \DateTime())->modify('-1897 days');
$date2 = $date->format("Y-m-d");


$sql = "SELECT Resonansfrekvens, Dato, Serienummer FROM Maaling WHERE Dato BETWEEN '$date2' AND '$date1' GROUP BY Dato";

$result = mysqli_query($conn, $sql);

$data = array();

while($row = mysqli_fetch_array($result))
{
    $data[] = array(
    "y" => $row["Resonansfrekvens"],
    "label" =>$row["Dato"],
    "serienummer" =>$row["Serienummer"]
    );
}

$maxRF = 64.1;
$minRF = 63.7;


for ($i = 0; $i < count($data); ++$i) {

if (($data[$i]['y']) > $maxRF)
{
    $serienummer = ($data[$i]['serienummer']);
    $dato = ($data[$i]['label']);

    echo "Resonansfrekvensen er over max-værdien d. $dato på MRI-scanneren med serienummer: $serienummer"."<br>";
}

if (($data[$i]['y']) < $minRF)
{
    $serienummer = ($data[$i]['serienummer']);
    $dato = ($data[$i]['label']);
    echo "Resonansfrekvensen er under min-værdien d. $dato på MRI-scanneren med serienummer: $serienummer"."<br>";
}

}
?>


    <script src="myScripttest.js"></script>
</body>
</html>
