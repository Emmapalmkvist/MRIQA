<?php

session_start();

// Check om bruger er logget ind
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: ../Logind/login.php");
    exit;
}
?>

<!doctype html>
<html>
    <title>Sammenlign scannere</title>
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
            <a href ="../Hjem/hjemside.php" id="onlink">HJEM</a>
            <a href="../Scanneroverblik/visgrafer.php">OVEBLIK OVER SCANNERE</a>
            <a class="active" href="../Modeloverblik/visgrafermodel.php">SAMMENLIGN SCANNERE</a>
        <li style="float:right"><a href="../Logind/logud.php">LOG UD</a></li>
    </div>
<?php
include "../Modeloverblik/hentdatamodel.php";
?>

<html>
<head>
</head>
<body onload="displayDefModel();displayDriftModel();displayGhostingModel();displayRfModel();displaySnrModel();displayUniModel();">

<br/>
<div id="chartDefModel" style="width: 30%; height: 300px;display: inline-block; margin-left: 5%"></div>
<div id="chartDriftModel" style="width: 30%; height: 300px;display: inline-block;"></div>
<div id="chartGhostingModel" style="width: 30%; height: 300px;display: inline-block;"></div>
<div id="chartRfModel" style="width: 30%; height: 300px;display: inline-block; margin-left: 5%"></div>
<div id="chartSnrModel" style="width: 30%; height: 300px;display: inline-block;"></div>
<div id="chartUniModel" style="width: 30%; height: 300px;display: inline-block;"></div>


<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>


</body>
</html>

