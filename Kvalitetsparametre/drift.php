<?php
    //POST tager det, som ligger i dropdownmenyen og gemmer det i variablen //$sn, som puttes i SQL queryen.
function driftdata($sn1, $model1, $start, $slut)
{
    include "../Database/DB_adgang.php";
    $sn = $sn1;
    $model = $model1;
    $startdato = $start;
    $slutdato = $slut;
    $sql = "SELECT Drift, Model, Dato, Serienummer, Driftbillede, Starttidspunkt FROM Maaling WHERE Serienummer='$sn' AND Dato BETWEEN '$startdato' AND '$slutdato' GROUP BY Dato";

$result = mysqli_query($mysqli, $sql);

$drift= array();

while($row = mysqli_fetch_array($result))
{
    $drift[] = array(
    "y" => $row["Drift"],
    "label" =>$row["Dato"],
    "tidspunkt" =>$row["Starttidspunkt"][0],
    "tidspunkt1" =>$row["Starttidspunkt"][1],
    "tidspunkt2" =>$row["Starttidspunkt"][2],
    "tidspunkt3" =>$row["Starttidspunkt"][3],
    "sti" => "../billeder/" . $row["Driftbillede"]
    );
    $model = $row["Model"];


}


$sql1 = "SELECT Model, AVG(Drift) as avgDrift, Dato FROM Maaling WHERE Model='$model' AND Dato BETWEEN '$startdato' AND '$slutdato' GROUP BY Dato";


$result1 = mysqli_query($mysqli, $sql1);

$avgDrift= array();


    while($row = mysqli_fetch_array($result1))
    {
    $avgDrift[] = array(
    "y" => $row["avgDrift"],
    "label" => $row["Dato"]
    );
    }

?>




<script>


function displayDriftAvg ()
{

var chartDriftAvg = new CanvasJS.Chart("chartContainerDriftAvg",
{
	title: {
		text: "Drift over tid"
	},
	axisY:{

        title: "Drift",


        stripLines:[
        {
        value:4,
        label:"Max",
        color:"red",
        thickness: 3,
        labelFontColor:"red"
        }
        ],
      },
    data: [

        {
        name: "Drift for valgt scanner",
		type: "line",
        showInLegend: true,
        toolTipContent:"Dato: {label}<br/> Drift: {y}",
		dataPoints: <?php echo json_encode($drift, JSON_NUMERIC_CHECK); ?>



	    },
        {
        name: "Driftsgennemsnit for valgt scanners modeltype",
        type: "line",
        showInLegend: true,
        toolTipContent:"Dato: {label}<br/> Drift: {y}",
		dataPoints: <?php echo json_encode($avgDrift, JSON_NUMERIC_CHECK); ?>

        }

        ]
}
                                         );
chartDriftAvg.render();

}




function displayDrift ()
{

var chartDrift = new CanvasJS.Chart("chartContainerDrift", {
	title: {
		text: "Drift over tid"
	},
	axisY: {
		title: "Drift"
	},
    data: [{
		type: "line",
        toolTipContent:"Dato: {label}<br/> Drift: {y}<br/>Starttidspunkt: {tidspunkt}{tidspunkt1}:{tidspunkt2}{tidspunkt3}<br/> Billede: <img src= {sti} height=120 width=$150>",
		dataPoints: <?php echo json_encode($drift, JSON_NUMERIC_CHECK); ?>
	}]
});


chartDrift.render();

}


</script>
<?php }

function notificationsDrift()
{
    include "../Kvalitetsparametre/datointervalNot.php";
    include "../Database/DB_adgang.php";


    $sql_drift = "SELECT Drift, Dato, Serienummer FROM Maaling WHERE Dato BETWEEN '$date2' AND '$date1' GROUP BY Dato";

    $result_drift = mysqli_query($mysqli, $sql_drift);

    $data_drift = array();

while($row = mysqli_fetch_array($result_drift))
{
    $data_drift[] = array(
    "y" => $row["Drift"],
    "label" =>$row["Dato"],
    "serienummer" =>$row["Serienummer"]
    );
}

// hardcode min og max
$maxDrift = 5.0;
//$minDrift = 0.5;

for ($i = 0; $i < count($data_drift); ++$i) {

if (($data_drift[$i]['y']) > $maxDrift)
{
    $serienummer = ($data_drift[$i]['serienummer']);
    $dato = ($data_drift[$i]['label']);
    $msg = "Drift over max d. $dato på scanneren med serienummer: $serienummer"."<br>";
    echo $msg;
}

/*if (($data_def[$i]['y']) < $minDef)
{
    $serienummer = ($data_def[$i]['serienummer']);
    $dato = ($data_def[$i]['label']);
    $msg = "Deformation under min d. $dato på scanneren med serienummer: $serienummer"."<br>";
    echo $msg;
}*/
}

}




?>



