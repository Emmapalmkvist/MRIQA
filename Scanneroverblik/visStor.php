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
    <link rel="stylesheet" href="../Hjem/newstyle.css" />
     <meta charset="UTF-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
    body {
  background-color: #A6B9C0;
}
    </style>
    <header>
     <h1>MRI-KVALITETSSIKRING - REGION MIDT</h1>
    </header>

    <div class="topnav">
            <a class="active" href ="../Hjem/hjemside.php" id="onlink">HJEM</a>
            <a href="../Scanneroverblik/visgrafer.php">OVEBLIK OVER SCANNERE</a>
            <a href="../Modeloverblik/visgrafermodel.php">SAMMENLIGN SCANNERE</a>
        <li style="float:right"><a href="../Logind/logud.php">LOG UD</a></li>
    </div>

    <div class= head_container style= "font-family: sans-serif; font-size: 16px; padding: 7px; background-color: white; border: 1px solid darkgrey; width: 750px;  float: left; margin-left: 2%; margin-top: 2%" >
        <?php
        echo "Servicetidspunkter for specific scanner: "
        ?>
    </div>


    <div class="main_container" style= "font-family: sans-serif; background-color: white; border: 1px solid darkgrey; width: 750px; margin-left: 2%; margin-top:4%;">

<?php

//include "../Database/DB_adgang.php";

// kalder notifikationsfunktioner i der ligger i kvalitetsparametre
include "../Kvalitetsparametre/deformation.php";
include "../Kvalitetsparametre/drift.php";
include "../Kvalitetsparametre/ghosting.php";
include "../Kvalitetsparametre/rf.php";
include "../Kvalitetsparametre/snr.php";
include "../Kvalitetsparametre/uniformitet.php";
include "../Scanneroverblik/service.php";

getService();
notificationsDef();
notificationsDrift();
notificationsGhosting();
notificationsRf();
notificationsSNR();
notificationsUniformitet();

?>
</div>
<?php
    $datatype = $_GET['datatype'];
    $sn = $_GET['sn'];
    $model = $_GET['model'];
    $startdato = $_GET['startdato'];
    $slutdato = $_GET['slutdato'];
    switch($datatype) {
        case "Deformation":
            deformationdata($sn, $model, $startdato, $slutdato);
            ?>
            <body  onload="displayDefAvg();">
            <br/>
            <div id="chartContainerDefAvg" style="width: 100%; height: 600px;display: inline-block;"></div>
            <?php
        case "Drift":
            driftdata($sn, $model, $startdato, $slutdato);
            ?>
            <body  onload="displayDriftAvg();">
            <br/>
            <div id="chartContainerDriftAvg" style="width: 100%; height: 600px;display: inline-block;"></div>
            <?php
        case "Ghosting":
            ghostingdata($sn, $model, $startdato, $slutdato);
            ?>
            <body  onload="displayGhostingAvg();">
            <br/>
            <div id="chartContainerGhostingAvg" style="width: 100%; height: 600px;display: inline-block;"></div>
            <?php
        case "Rf":
            rfdata($sn, $model, $startdato, $slutdato);
            ?>
            <body  onload="displayRfAvg();">
            <br/>
            <div id="chartContainerRfAvg" style="width: 100%; height: 600px;display: inline-block;"></div>
            <?php
        case "SNR":
            snrdata($sn, $model, $startdato, $slutdato);
            ?>
            <body  onload="displaySNRAvg();">
            <br/>
            <div id="chartContainerSNRAvg" style="width: 100%; height: 600px;display: inline-block;"></div>
            <?php
        case "Uniformitet":
            uniformitetdata($sn, $model, $startdato, $slutdato);
            ?>
            <body  onload="displayUniformitetAvg();">
            <br/>
            <div id="chartContainerUniformitetAvg" style="width: 100%; height: 600px;display: inline-block;"></div>
            <?php

        default:;}


?>
 <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

    </body>

</html>







































<?php /*

session_start();


// Check om bruger er logget ind
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: ../Logind/login.php");
    exit;
}
?>


<?php
include "../Kvalitetsparametre/deformation.php";
include "../Kvalitetsparametre/drift.php";
include "../Kvalitetsparametre/ghosting.php";
include "../Kvalitetsparametre/rf.php";
include "../Kvalitetsparametre/snr.php";
include "../Kvalitetsparametre/uniformitet.php";

?>



<html>
<head>
</head>
    <a href="../Scanneroverblik/visgrafer.php">Tilbage til scanneroverblik</a>
<?php
    $datatype = $_GET['datatype'];
    $sn = $_GET['sn'];
    $model = $_GET['model'];
    $startdato = $_GET['startdato'];
    $slutdato = $_GET['slutdato'];
    switch($datatype) {
        case "Deformation":
            deformationdata($sn, $model, $startdato, $slutdato);
            ?>
            <body  onload="displayDefAvg();">
            <br/>
            <div id="chartContainerDefAvg" style="width: 100%; height: 600px;display: inline-block;"></div>
            <?php
        case "Drift":
            driftdata($sn, $model, $startdato, $slutdato);
            ?>
            <body  onload="displayDriftAvg();">
            <br/>
            <div id="chartContainerDriftAvg" style="width: 100%; height: 600px;display: inline-block;"></div>
            <?php
        case "Ghosting":
            ghostingdata($sn, $model, $startdato, $slutdato);
            ?>
            <body  onload="displayGhostingAvg();">
            <br/>
            <div id="chartContainerGhostingAvg" style="width: 100%; height: 600px;display: inline-block;"></div>
            <?php
        case "Rf":
            rfdata($sn, $model, $startdato, $slutdato);
            ?>
            <body  onload="displayRfAvg();">
            <br/>
            <div id="chartContainerRfAvg" style="width: 100%; height: 600px;display: inline-block;"></div>
            <?php
        case "SNR":
            snrdata($sn, $model, $startdato, $slutdato);
            ?>
            <body  onload="displaySNRAvg();">
            <br/>
            <div id="chartContainerSNRAvg" style="width: 100%; height: 600px;display: inline-block;"></div>
            <?php
        case "Uniformitet":
            uniformitetdata($sn, $model, $startdato, $slutdato);
            ?>
            <body  onload="displayUniformitetAvg();">
            <br/>
            <div id="chartContainerUniformitetAvg" style="width: 100%; height: 600px;display: inline-block;"></div>
            <?php

        default:;}


*/?> <? /*
 <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

    </body>
</html>
*/?>
