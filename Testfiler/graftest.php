<?php
$servername = "5.104.105.222";
$username = "iha";
$password = "specialeprojekt";
$db = "qaspeciale";

// Create connection
$conn = new mysqli($servername, $username, $password, $db, 8085); // 8085 port

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";

$sql = "SELECT * FROM Maaling";
$result = mysqli_query($conn, $sql);

$ghosting= array();
$snr = array();
$uniformitet = array();
$deformation = array();
$rf = array();
$drift = array();

while($row = mysqli_fetch_array($result))
{
    $ghosting[] = array(
    "y" => $row["Ghostingmean"],
    "label" =>$row["Dato"]
    );
     $snr[] = array(
    "y" => $row["SNR"],
    "label" =>$row["Dato"]
    );
    $uniformitet[] = array(
    "y" => $row["Uniformitet"],
    "label" =>$row["Dato"]
    );
    $deformation[] = array(
    "y" => $row["Deformation"],
    "label" =>$row["Dato"]
    );
    $rf[] = array(
    "y" => $row["Resonansfrekvens"],
    "label" =>$row["Dato"]
    );
    $drift[] = array(
    "y" => $row["Drift"],
    "label" =>$row["Dato"],
    "driftbillede" =>$row["Driftbillede"],
    "sti" => "billeder/" . $row["Driftbillede"]
    );

    $driftbillede[] = array(
    "billeder/" . $row["Driftbillede"]
    );

    $jsarray = json_encode($driftbillede);

    echo "var javascript_array = ". $jsarray . ";\n";
}




/*
while($row = mysqli_fetch_array($result))
{
    $data2[] = array(
    "y" => $row["SNR"],
    "label" =>$row["Dato"]
    );
}

$object = json_decode(json_encode($data2));
*/
/*
echo '<pre>';
print_r($data);
echo '</pre>';
*/

?>


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
		dataPoints: <?php echo json_encode($ghosting, JSON_NUMERIC_CHECK); ?>
	}]
});

var chart2 = new CanvasJS.Chart("chartContainer2", {
	title: {
		text: "SNR over tid"
	},
	axisY: {
		title: "SNR"
	},
	data: [{
		type: "line",
		dataPoints: <?php echo json_encode($snr, JSON_NUMERIC_CHECK); ?>
	}]
});

var chart3 = new CanvasJS.Chart("chartContainer3", {
	title: {
		text: "Uniformitet over tid"
	},
	axisY: {
		title: "Uniformitet"
	},
	data: [{
		type: "line",
		dataPoints: <?php echo json_encode($uniformitet, JSON_NUMERIC_CHECK); ?>
	}]
});

var chart4 = new CanvasJS.Chart("chartContainer4", {
	title: {
		text: "Deformation over tid"
	},
	axisY: {
		title: "Deformation"
	},
	data: [{
		type: "line",
		dataPoints: <?php echo json_encode($deformation, JSON_NUMERIC_CHECK); ?>
	}]
});

var chart5 = new CanvasJS.Chart("chartContainer5", {
	title: {
		text: "Resonansfrekvens over tid"
	},
	axisY: {
		title: "Resonansfrekvens"
	},
	data: [{
		type: "line",
		dataPoints: <?php echo json_encode($rf, JSON_NUMERIC_CHECK); ?>
	}]
});

var i;
var chart6 = new CanvasJS.Chart("chartContainer6", {
	title: {
		text: "Drift over tid"
	},

	axisY: {
		title: "Drift"
	},
	data: [{
		type: "line",
        toolTipContent:"Dato: {label}<br/> Drift: {y}<br/> Billede: <img src= {sti} height=120 width=$150>",
		dataPoints: <?php echo json_encode($drift, JSON_NUMERIC_CHECK); ?>


	}]
});

    /*
        type: "column",

toolTipContent: "{label}<br/>{name}, <strong>{y}</strong>mn Units",
        showInLegend: true,
        name: "Apple Q1 2012",
        dataPoints: [
        {y: 15.40, label: "iPads" },
        {y: 37.00, label: "iPhones" },
        {y: 15.40, label: "iPod" },
        {y: 5.20, label: "Macs" } */
chart1.render();
chart2.render();
chart3.render();
chart4.render();
chart5.render();
chart6.render();



}
</script>
</head>
<body>
<br/><div id="chartContainer1" style="width: 30%; height: 300px;display: inline-block;"></div>
<div id="chartContainer2" style="width: 30%; height: 300px;display: inline-block;"></div>
<div id="chartContainer3" style="width: 30%; height: 300px;display: inline-block;"></div>
<br/><div id="chartContainer4" style="width: 30%; height: 300px;display: inline-block;"></div>
<div id="chartContainer5" style="width: 30%; height: 300px;display: inline-block;"></div>
<div id="chartContainer6" style="width: 30%; height: 300px;display: inline-block;"></div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</body>
</html>
