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

    <div class= head_container style= "font-family: sans-serif; font-size: 16px; padding: 7px; background-color: white; border: 1px solid darkgrey; width: 750px;  float: left; margin-left: 2%; margin-top: 2%" >
        <?php
        echo "Notifikationer"
        ?>
    </div>


    <div class="main_container" style= "font-family: sans-serif; background-color: white; border: 1px solid darkgrey; width: 750px; margin-left: 2%; margin-top:4%;">
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

$date = (new \DateTime())->modify('-1200 days');
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
$minRF = 63.83;



for ($i = 0; $i < count($data); ++$i) {

if (($data[$i]['y']) > $maxRF)
{
    $serienummer = ($data[$i]['serienummer']);
    $dato = ($data[$i]['label']);
    $msg = "Resonansfrekvensen er over max-værdien d. $dato på MRI-scanneren med serienummer: $serienummer"."<br>";
    echo $msg;
}

if (($data[$i]['y']) < $minRF)
{
    $serienummer = ($data[$i]['serienummer']);
    $dato = ($data[$i]['label']);
    $msg = "Resonansfrekvensen er under min-værdien d. $dato på MRI-scanneren med serienummer: $serienummer"."<br>";
    echo $msg;
}

}
?>
    </div>

    <div class= head_container2 style= "font-family: sans-serif; font-size: 16px; padding: 7px; background-color: white; border: 1px solid darkgrey; width: 750px; margin-left: 2%; margin-top: 2%" >
        <?php
        echo "Indtast servicedato for scannere"
        ?>
    </div>

<div class="main_container" style= "font-family: sans-serif; background-color: white; border: 1px solid darkgrey; width: 750px; margin-left: 2%;">

    <form action="" method="post">

    <input type="date" name="datee" id="datee" style= "margin-left:0.5%; height: 25px; margin-top: 5px"class="IP_calendar">


     <select name="select1" id="scannerid" style= "height: 25px" conchange="myFunction()">
     <option value="">Vælg scanner..</option>
<?php

require_once "../Database/DB_adgang.php";
$sql1 = "SELECT Serienummer, Model, Scannernavn FROM Scannere";
$result1 = mysqli_query($mysqli, $sql1);


while ($row = mysqli_fetch_array($result1)) {
    echo "<option value='" . $row['Serienummer'] . "'>" . $row['Scannernavn'] . "</option>";
}
    if (isset($_POST["datee"])) {$dato = $_POST['datee'];} else {$dato = "";}
    if (isset($_POST["select1"])) {$sn = $_POST['select1'];} else {$sn = "";}
    $model = "";
?>

</select>

<button type ="submit" id="submit">Gem dato</button>
</form>

<?php


$sql = "INSERT INTO Servicetidspunkt (Servicetidspunkt, serienummer)
VALUES('$dato', $sn)";

if ($conn->query($sql) === TRUE) {
    echo " Servicetidspunkt er gemt";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

?>

    </div>


</html>
