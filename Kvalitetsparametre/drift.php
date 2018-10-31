<?php
    //POST tager det, som ligger i dropdownmenyen og gemmer det i variablen //$sn, som puttes i SQL queryen.
function driftdata($sn1, $model1, $start, $slut)
{
    include "../Database/DB_adgang.php";
    $sn = $sn1;
    $model = $model1;
    $startdato = $start;
    $slutdato = $slut;
    $sql = "SELECT Drift, Model, Dato, Serienummer, Driftbillede FROM Maaling WHERE Serienummer='$sn' AND Dato BETWEEN '$startdato' AND '$slutdato' GROUP BY Dato";

$result = mysqli_query($mysqli, $sql);

$drift= array();

while($row = mysqli_fetch_array($result))
{
    $drift[] = array(
    "y" => $row["Drift"],
    "label" =>$row["Dato"],
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
        toolTipContent:"Dato: {label}<br/> Drift: {y}<br/> Billede: <img src= {sti} height=120 width=$150>",
		dataPoints: <?php echo json_encode($drift, JSON_NUMERIC_CHECK); ?>
	}]
});


chartDrift.render();

}


</script>
<?php }
?>



