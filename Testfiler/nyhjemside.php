<?php

session_start();

// Check om bruger er logget ind
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>

<!doctype html>
<html>

    <title>Hjem</title>
    <link rel="stylesheet" href="newstyle.css" />
     <meta charset="UTF-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
    body {
  background-color: #A6B9C0;
}
    </style>
    <header>
     <h1>MRI-SCANNING - REGION MIDT</h1>
    </header>

    <div class="topnav">
            <a class="active" href ="nyhjemside.php" id="onlink">HJEM</a>
            <a href="overblikscannere.php">OVEBLIK OVER SCANNERE</a>
            <a href="sammenlignscanner.php">SAMMENLIGN SCANNERE</a>
        <li style="float:right"><a href="location: ../Logind/logud.php">LOG UD</a></li>
    </div>

    <br /> <br />

    <div class= head_container style= "font-family: sans-serif; font-size: 16px; padding: 5px; background-color: white; border: 1px solid darkgrey; width: 750px; margin-left: 2%;" >
        <?php
        echo "Notifikationer"
        ?>
    </div>

    <div class="main_container" style= "font-family: sans-serif; background-color: white; border: 1px solid darkgrey; width: 750px; margin-left: 2%;">
        <?php

$servername = "5.104.105.222";
$username = "iha";
$password = "specialeprojekt";
$db = "qaspeciale";

// Create connection
$conn = new mysqli($servername, $username, $password, $db, 8085); // 8085 port

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
    $msg = "Resonansfrekvensen er over max-værdien d. $dato på MRI-scanneren med serienummer: $serienummer"."<br>";
    echo $msg;
    wordwrap($msg, 70, "\r\n");
    mail("palmkvistemma@hotmail.com","Notifikation",$msg);
}

if (($data[$i]['y']) < $minRF)
{
    $serienummer = ($data[$i]['serienummer']);
    $dato = ($data[$i]['label']);
    $msg = "Resonansfrekvensen er under min-værdien d. $dato på MRI-scanneren med serienummer: $serienummer"."<br>";
    echo $msg;
    wordwrap($msg, 70, "\r\n");
    mail("palmkvistemma@hotmail.com","Notifikation",$msg);
}

}
?>
    </div>

</html>
