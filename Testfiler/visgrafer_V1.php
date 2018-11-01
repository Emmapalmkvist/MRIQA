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
