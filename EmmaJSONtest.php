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

$data = array();

while($row = mysqli_fetch_array($result))
{
    $data[] = array(
    'Lokation' => $row["Lokation"],
    'Fabrikant' => $row["Fabrikant"],
    'Dato' => $row["Dato"],
    'SNR' =>$row["SNR"]
    );
}

/*$array = ['items' => ['Milk', 'Eggs', 'Bread']]; */

$object = json_decode(json_encode($data));

echo '<pre>';
print_r($object);
echo '</pre>';

?>

<?php

$dataPoints = array(
	array("y" => 25, "label" => "Sunday"),
	array("y" => 15, "label" => "Monday"),
	array("y" => 25, "label" => "Tuesday"),
	array("y" => 5, "label" => "Wednesday"),
	array("y" => 10, "label" => "Thursday"),
	array("y" => 0, "label" => "Friday"),
	array("y" => 20, "label" => "Saturday")
);

?>
<!DOCTYPE HTML>
<html>
<head>
<script>
window.onload = function () {

var chart = new CanvasJS.Chart("chartContainer", {
	title: {
		text: "SNR over tid"
	},
	axisY: {
		title: "SNR"
	},
	data: [{
		type: "line",
		dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
	}]
});
chart.render();

}
</script>
</head>
<body>
<div id="chartContainer" style="height: 370px; width: 100%;"></div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</body>
</html>
