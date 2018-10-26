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
    <title>Overblik over scannere</title>
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
            <a href ="nyhjemside.php" id="onlink">HJEM</a>
            <a class="active" href="overblikscannere.php">OVEBLIK OVER SCANNERE</a>
            <a href="sammenlignscanner.php">SAMMENLIGN SCANNERE</a>
        <li style="float:right"><a href="location: ../Logind/logud.php">LOG UD</a></li>
    </div>

    <?php
include "../Scanneroverblik/scannervalg.php";
?>

<html>
<head>
</head>
<body onload="displayDeformation();displayDrift();displayGhosting();displayRF();displaySNR();displayUniformitet();">
<br/>

<div id = "chartgroup">
    <div id="chartContainerDeformation" style="width: 30%; height: 300px;display: inline-block;"></div>
    <div id="chartContainerDrift" style="width: 30%; height: 300px;display: inline-block;"></div>
    <div id="chartContainerGhosting" style="width: 30%; height: 300px;display: inline-block;"></div>
    <div id="chartContainerRf" style="width: 30%; height: 300px;display: inline-block;"></div>
    <div id="chartContainerSNR" style="width: 30%; height: 300px;display: inline-block;"></div>
    <div id="chartContainerUniformitet" style="width: 30%; height: 300px;display: inline-block;"></div>
</div>



<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

</body>
</html>

