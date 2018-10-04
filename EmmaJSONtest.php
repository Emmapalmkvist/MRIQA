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
    "label" => $row["Dato"],
    "y" => $row["Ghostingmean"],
    "driftbillede" => $row["Driftbillede"],
    "sti" => "billeder/" . $row["Driftbillede"]
    );
}

$object = json_decode(json_encode($data));

echo '<pre>';
print_r($data);
echo '</pre>';

  foreach ($data as $key => $part) {
       $sort[$key] = "label";
  }
  array_multisort($sort, SORT_DESC, $data);

?>

<?php

$dataPoints = array(
	array("y" => 25, "label" => new DateTime('01-01-2014')),
	array("y" => 15, "label" => "Monday"),
	array("y" => 25, "label" => "Tuesday"),
	array("y" => 5, "label" => "Wednesday"),
	array("y" => 10, "label" => "Thursday"),
	array("y" => 0, "label" => "Friday"),
	array("y" => 20, "label" => "Saturday")
);

echo '<pre>';
print_r($dataPoints);
echo '</pre>';

?>
<!DOCTYPE HTML>
<html>
<head>
<script>
window.onload = function () {

var chart = new CanvasJS.Chart("chartContainer", {
	title: {
		text: "Ghosting over tid"
	},
	axisY: {
		title: "Ghosting"
	},
	data: [{
		type: "line",
		dataPoints: <?php echo json_encode($data, JSON_NUMERIC_CHECK); ?>
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
