<?php

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


?>
 <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

    </body>
</html>
