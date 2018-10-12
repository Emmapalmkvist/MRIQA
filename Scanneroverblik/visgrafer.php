<?php
include "../Scanneroverblik/scannervalg.php";
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



<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

</body>
</html>
