<?php
include "../Scanneroverblik/hentdata.php";
//include "../Scanneroverblik/visStor.php";
?>

<html>
<head>
</head>
<body onload="displayDeformation();displayDrift();displayGhosting();displayRF();displaySNR();displayUniformitet();">

<br/>
<div id="chartContainerDeformation" style="width: 30%; height: 300px;display: inline-block;"></div>
<div id="chartContainerDrift" style="width: 30%; height: 300px;display: inline-block;"></div>
<div id="chartContainerGhosting" style="width: 30%; height: 300px;display: inline-block;"></div>
<div id="chartContainerRf" style="width: 30%; height: 300px;display: inline-block;"></div>
<div id="chartContainerSNR" style="width: 30%; height: 300px;display: inline-block;"></div>
<div id="chartContainerUniformitet" style="width: 30%; height: 300px;display: inline-block;"></div>

    <a href="visStor.php?datatype=Deformation&serienr=$sn&model=$model&start=$startdata&slut=$slutdato" ></a>

<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

</body>
</html>
