<?php
    //POST tager det, som ligger i dropdownmenyen og gemmer det i variablen //$sn, som puttes i SQL queryen.
function ghostingdata($sn1, $model1, $start, $slut)
{
    include "../Database/DB_adgang.php";
    $sn = $sn1;
    $model = $model1;
    $startdato = $start;
    $slutdato = $slut;
    $sql = "SELECT Ghostingmean, Model, Dato, Serienummer, Ghostingbillede FROM Maaling WHERE Serienummer='$sn' AND Dato BETWEEN '$startdato' AND '$slutdato' GROUP BY Dato";

$result = mysqli_query($mysqli, $sql);

$ghosting = array();

while($row = mysqli_fetch_array($result))
{
    $ghosting[] = array(
    "y" => $row["Ghostingmean"],
    "label" =>$row["Dato"],
    "sti" => "../billeder/" . $row["Ghostingbillede"]
    );
    $model = $row["Model"];

}


$sql1 = "SELECT Model, AVG(Ghostingmean) as avgGhosting, Dato FROM Maaling WHERE Model='$model' AND Dato BETWEEN '$startdato' AND '$slutdato' GROUP BY Dato";


$result1 = mysqli_query($mysqli, $sql1);

$avgGhosting= array();


    while($row = mysqli_fetch_array($result1))
    {
    $avgGhosting[] = array(
    "y" => $row["avgGhosting"],
    "label" => $row["Dato"]
    );
    }



?>
<script>


function displayGhostingAvg () {

var chartGhostingAvg = new CanvasJS.Chart("chartContainerGhostingAvg", {
	title: {
		text: "Ghosting over tid"
	},
	axisY: {
		title: "Ghosting"
	},
    data: [

        {
        name: "Ghosting for valgt scanner",
		type: "line",
        showInLegend: true,
        toolTipContent:"Dato: {label}<br/> Ghosting: {y}",
		dataPoints: <?php echo json_encode($ghosting, JSON_NUMERIC_CHECK); ?>



	    },
        {
        name: "Ghostingsgennemsnit for valgt scanners modeltype",
        type: "line",
        showInLegend: true,
        toolTipContent:"Dato: {label}<br/> Ghosting: {y}",
		dataPoints: <?php echo json_encode($avgGhosting, JSON_NUMERIC_CHECK); ?>

        }

        ]
});


chartGhostingAvg.render();

}


function displayGhosting () {

var chartGhosting = new CanvasJS.Chart("chartContainerGhosting", {
	title: {
		text: "Ghosting over tid"
	},
	axisY: {
		title: "Ghosting"
	},
    data: [{
		type: "line",
        toolTipContent:"Dato: {label}<br/> Ghosting: {y}<br/> Billede: <img src= {sti} height=120 width=$150>",
		dataPoints: <?php echo json_encode($ghosting, JSON_NUMERIC_CHECK); ?>
	}]
});


chartGhosting.render();

}
</script>
<?php }
?>

