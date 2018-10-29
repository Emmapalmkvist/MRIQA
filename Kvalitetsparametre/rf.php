<?php
function rfdata($sn1, $model1, $start, $slut)
{
    include "../Database/DB_adgang.php";
    $sn = $sn1;
    $model = $model1;
    $startdato = $start;
    $slutdato = $slut;
    $sql = "SELECT Resonansfrekvens, Model, Dato, Serienummer, Resonansfrekvensbillede FROM Maaling WHERE Serienummer='$sn' AND Dato BETWEEN '$startdato' AND '$slutdato' GROUP BY Dato";

$result = mysqli_query($mysqli, $sql);

$rf= array();

while($row = mysqli_fetch_array($result))
{
    $rf[] = array(
    "y" => $row["Resonansfrekvens"],
    "label" =>$row["Dato"],
    "sti" => "../billeder/" . $row["Resonansfrekvensbillede"]
    );
    $model = $row["Model"];

}

$sql1 = "SELECT Model, AVG(Resonansfrekvens) as avgRf, Dato FROM Maaling WHERE Model='$model' AND Dato BETWEEN '$startdato' AND '$slutdato' GROUP BY Dato";


$result1 = mysqli_query($mysqli, $sql1);

$avgRf= array();


    while($row = mysqli_fetch_array($result1))
    {
    $avgRf[] = array(
    "y" => $row["avgRf"],
    "label" => $row["Dato"]
    );
    }


?>



<script>


function displayRfAvg () {

var chartRfAvg = new CanvasJS.Chart("chartContainerRfAvg", {
	title: {
		text: "Resonansfrekvens over tid"
	},
	axisY: {
		title: "Resonansfrekvens"
	},
    data: [

        {
        name: "Resonansfrekvens for valgt scanner",
		type: "line",
        showInLegend: true,
        toolTipContent:"Dato: {label}<br/> Resonansfrekvens: {y}",
		dataPoints: <?php echo json_encode($rf, JSON_NUMERIC_CHECK); ?>



	    },
        {
        name: "Resonansfrekvensgennemsnit for valgt scanners modeltype",
        type: "line",
        showInLegend: true,
        toolTipContent:"Dato: {label}<br/> Resonansfrekvens: {y}",
		dataPoints: <?php echo json_encode($avgRf, JSON_NUMERIC_CHECK); ?>

        }

        ]
});


chartRfAvg.render();

}



function displayRF () {

var chartRf = new CanvasJS.Chart("chartContainerRf", {
	title: {
		text: "Resonansfrekvens over tid"
	},
	axisY: {
		title: "Resonansfrekvens"
	},
    data: [{
		type: "line",
        toolTipContent:"Dato: {label}<br/> Resonansfrekvens: {y}<br/> Billede: <img src= {sti} height=120 width=$150>",
		dataPoints: <?php echo json_encode($rf, JSON_NUMERIC_CHECK); ?>
	}]
});

chartRf.render();
}

</script>
<?php }
?>





















