


<?php
$servername = "5.104.105.222";
$username = "iha";
$password = "specialeprojekt";
$db = "qaspeciale";
$port = "8085";

// Opret connection til MySQL database
$mysqli = new mysqli($servername, $username, $password, $db, $port);

/*$sql = "SELECT Dato, Lokation, Fabrikant, SNR, Uniformitet, Drift FROM Maaling";*/

$sql = "SELECT Model, AVG(Deformation) as avgDef ,  Dato FROM Maaling WHERE Model='Achieva' AND Dato BETWEEN '2014-01-01' AND '2014-10-10' GROUP BY Dato";


$result = mysqli_query($mysqli, $sql);

//$data = array(. $row["Deformation"], . $row["Dato"]);

/*if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "Dato: " . $row["Dato"]. " - Deformation: " . $row["avgDef"]. "<br>";
    }
} else {
    echo "0 results";
}*/




    //$conn->close();

$avgDef= array();

while($row = mysqli_fetch_array($result))
{
    $avgDef[] = array(
    //"y" => $row["avgDef"],
    "label" =>$row["Dato"],
    "y" => $row["avgDef"]

    );

    $model = $row["Model"];
}

echo json_encode($avgDef, JSON_PRETTY_PRINT);

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
        toolTipContent:"Dato: {label}<br/> Drift: {y}<br/> Billede: <img src= {sti} height=120 width=$150>",
		dataPoints: <?php echo json_encode($avgDef, JSON_PRETTY_PRINT); ?>
	}]
});


chart1.render();

}

           //chart1.render();

</script>
</head>
<body>
<br/><div id="chartContainer1" style="width: 30%; height: 300px;display: inline-block;"></div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</body>
</html>




<?php

/*while ($data = mysqli_fetch_array($result, MYSQLI_ASSOC))
{
	$test [$data['MaaleeID'] ] =
        array('Deformation' => $data['Deformation'],
				'Dato' => $data['Dato']
				);
}










// create an array to feed all my results into
/*$multidim_array = array();

// get data one row at a time and push it into the array
while ($row = mysqli_fetch_array($result))
		array_push($multdim_array, $row);*/


//print_r($data);


/*foreach ($data as $elem)
{
      // Initialize a new element in the output if it doesn't already exist
      if (!isset($out[$elem['Dato']]))
      {
        $out[$elem['Dato'] = array(
          // Set the date keys...
          'Dato' => $elem['Dato'],
          // With the current value...
          'Deformation' => $elem['Deformation']
        );
             }

      else {
        $out[$elem['Dato']]['Deformation'] += $elem['Deformation'];
      }

             }*/



?>


