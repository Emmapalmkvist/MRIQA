<?php

session_start();

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: ../Logind/login.php");
    exit;
}
?>

<!doctype html>
<html>
    <title>Overblik over scannere</title>
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
            <a class="active" href="../Scanneroverblik/visgrafer.php">OVEBLIK OVER SCANNERE</a>
            <a href="../Modeloverblik/visgrafermodel.php">SAMMENLIGN SCANNERE</a>
        <li style="float:right"><a href="../Logind/logud.php">LOG UD</a></li>
    </div>
<?php
include "../Scanneroverblik/hentdata.php";
?>

<html>
<head>
</head>
<body onload="displayDeformation();displayDrift();displayGhosting();displayRF();displaySNR();displayUniformitet();">
<br/>



<div onclick="location.href='visStor.php?datatype=Deformation& <?php echo 'sn='.$sn.'&model='.$model.'&startdato='.$startdato.'&slutdato='.$slutdato ?>'" id="chartContainerDeformation" style="width: 30%; height: 300px;display: inline-block;">

</div>

<div onclick="location.href='visStor.php?datatype=Drift& <?php echo 'sn='.$sn.'&model='.$model.'&startdato='.$startdato.'&slutdato='.$slutdato ?>'" id="chartContainerDrift" style="width: 30%; height: 300px;display: inline-block;">

</div>

<div onclick="location.href='visStor.php?datatype=Ghosting& <?php echo 'sn='.$sn.'&model='.$model.'&startdato='.$startdato.'&slutdato='.$slutdato ?>'" id="chartContainerGhosting" style="width: 30%; height: 300px;display: inline-block;">

</div>

<div onclick="location.href='visStor.php?datatype=Rf& <?php echo 'sn='.$sn.'&model='.$model.'&startdato='.$startdato.'&slutdato='.$slutdato ?>'" id="chartContainerRf" style="width: 30%; height: 300px;display: inline-block;">

</div>

<div onclick="location.href='visStor.php?datatype=SNR& <?php echo 'sn='.$sn.'&model='.$model.'&startdato='.$startdato.'&slutdato='.$slutdato ?>'" id="chartContainerSNR" style="width: 30%; height: 300px;display: inline-block;">

</div>

<div onclick="location.href='visStor.php?datatype=Uniformitet& <?php echo 'sn='.$sn.'&model='.$model.'&startdato='.$startdato.'&slutdato='.$slutdato ?>'" id="chartContainerUniformitet" style="width: 30%; height: 300px;display: inline-block;">

</div>



<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

</body>
</html>

