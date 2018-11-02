<?php
include "../Modeloverblik/hentdatamodel.php";
?>

<html>
<head>
</head>
<body onload="displayDefdef();displayDriftModel();displayGhostingModel();displayRfModel();displaySnrModel();displayUniModel();">
<br/>
<div id="chartDefdef" style="width: 30%; height: 300px;display: inline-block;"></div>
<div id="chartDriftModel" style="width: 30%; height: 300px;display: inline-block;"></div>
<div id="chartGhostingModel" style="width: 30%; height: 300px;display: inline-block;"></div>
<div id="chartRfModel" style="width: 30%; height: 300px;display: inline-block;"></div>
<div id="chartSnrModel" style="width: 30%; height: 300px;display: inline-block;"></div>
<div id="chartUniModel" style="width: 30%; height: 300px;display: inline-block;"></div>


<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

</body>
</html>
