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
            <a class="active" href ="../Hjem/hjemside.php" id="onlink">HJEM</a>
            <a href="../Scanneroverblik/visgrafer.php">OVEBLIK OVER SCANNERE</a>
            <a href="sammenlignscanner.php">SAMMENLIGN SCANNERE</a>
        <li style="float:right"><a href="../Logind/logud.php">LOG UD</a></li>
    </div>

    <div class= head_container style= "font-family: sans-serif; font-size: 16px; padding: 7px; background-color: white; border: 1px solid darkgrey; width: 750px;  float: left; margin-left: 2%; margin-top: 2%" >
        <?php
        echo "Notifikationer"
        ?>
    </div>


    <div class="main_container" style= "font-family: sans-serif; background-color: white; border: 1px solid darkgrey; width: 750px; margin-left: 2%; margin-top:4%;">

<?php

include "../Database/DB_adgang.php";

// kalder notifikationsfunktioner i der ligger i kvalitetsparametre
include "../Kvalitetsparametre/deformation.php";
include "../Kvalitetsparametre/drift.php";
include "../Kvalitetsparametre/ghosting.php";
include "../Kvalitetsparametre/rf.php";
include "../Kvalitetsparametre/snr.php";
include "../Kvalitetsparametre/uniformitet.php";


notificationsDef();
notificationsDrift();
notificationsGhosting();
notificationsRf();
notificationsSNR();
notificationsUniformitet();

?>
</div>


<div class= head_container2 style= "font-family: sans-serif; font-size: 16px; padding: 7px; background-color: white; border: 1px solid darkgrey; width: 750px; margin-left: 2%; margin-top: 2%" >
<?php
echo "Indtast servicedato for scannere"
?>
</div>

<div class="main_container" style= "font-family: sans-serif; background-color: white; border: 1px solid darkgrey; width: 750px; margin-left: 2%;">

<form action="" method="post">

<input type="date" name="date" id="date" style= "margin-left:0.5%; height: 25px; margin-top: 5px"class="IP_calendar">

<select name="select1" id="scannerid" style= "height: 25px" conchange="myFunction()">
    <option value="">Vælg scanner..</option>

<?php
require_once "../Database/DB_adgang.php";
$sql1 = "SELECT Serienummer, Model, Scannernavn FROM Scannere";
$result1 = mysqli_query($mysqli, $sql1);

while ($row = mysqli_fetch_array($result1))
{
    echo "<option value='" . $row['Serienummer'] . "'>" . $row['Scannernavn'] . "</option>";
}

$dato = $_POST['date'];
$sn = $_POST['select1'];

/*
if (isset($_POST["date"])) {$dato = $_POST['date'];} else {$dato = "";}
if (isset($_POST["select1"])) {$sn = $_POST['select1'];} else {$sn = "";}
*/


$sql = "INSERT INTO Servicetidspunkt (Servicetidspunkt, serienummer)
VALUES('$dato', '$sn')";

?>
</select>

<?php
// check om servicedato bliver gemt
if ($mysqli->query($sql) === TRUE) {
    echo " Servicetidspunkt er gemt";
} else {
    echo "Error: " . $sql . "<br>" . $mysqli->error;
}

?>

<button type ="submit" id="submit">Gem dato</button>


</form>
</div>
</html>