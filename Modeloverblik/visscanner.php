<!DOCTYPE HTML>
<html>
<head>

<script>
window.onload = function () {

var chart1 = new CanvasJS.Chart("chartContainer1", {
	title: {
		text: "Ghosting over tid"
	},
	axisY: {
		title: "Ghosting"
	},
	data: [{
		type: "line",
        toolTipContent:"Dato: {label}<br/> Drift: {y}<br/> Billede: <img src= {sti} height=120 width=$150>",
		dataPoints: <?php echo json_encode($ghosting, JSON_NUMERIC_CHECK); ?>
	}]
});


chart1.render();

}
</script>

</head>
<body>
<br/><div id="chartContainer1" style="width: 30%; height: 300px;display: inline-block;"></div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</body>
</html>
