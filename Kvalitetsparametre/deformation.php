<?php


function deformationdata($sn1, $model1, $start, $slut)
{
    include "../Database/DB_adgang.php";
    $sn = $sn1;
    $model = $model1;
    $startdato = $start;
    $slutdato = $slut;
    $sql = "SELECT Deformation, Model, Dato, Serienummer, Deformationbillede FROM Maaling WHERE Serienummer='$sn' AND Dato BETWEEN '$startdato' AND '$slutdato' GROUP BY Dato";


$result = mysqli_query($mysqli, $sql);

$deformation= array();

    while($row = mysqli_fetch_array($result))
{
    $deformation[] = array(
    "y" => $row["Deformation"],
    "label" =>$row["Dato"],
    "sti" => "../billeder/" . $row["Deformationbillede"]
    );
    $model = $row["Model"];
}


$sql1 = "SELECT Model, AVG(Deformation) as avgDef, Dato FROM Maaling WHERE Model='$model' AND Dato BETWEEN '$startdato' AND '$slutdato' GROUP BY Dato";


$result1 = mysqli_query($mysqli, $sql1);

$avgDef= array();


    while($row = mysqli_fetch_array($result1))
    {
    $avgDef[] = array(
    "y" => $row["avgDef"],
    "label" => $row["Dato"]
    );

    }

?>




<script>
//window.onload =


function displayDefAvg ()
{

var chartDefAvg = new CanvasJS.Chart("chartContainerDefAvg",
{
	title: {
		text: "Deformation over tid"
	},
	axisY: {
		title: "Deformation"
    },
    data: [

        {
        name: "Deformation for valgt scanner",
		type: "line",
        showInLegend: true,
        toolTipContent:"Dato: {label}<br/> Deformation: {y}",
		dataPoints: <?php echo json_encode($deformation, JSON_NUMERIC_CHECK); ?>



	    },
        {
        name: "Deformationsgennemsnit for valgt scanners modeltype",
        type: "line",
        showInLegend: true,
        toolTipContent:"Dato: {label}<br/> Deformation: {y}",
		dataPoints: <?php echo json_encode($avgDef, JSON_NUMERIC_CHECK); ?>

        }

        ]
}
                                         );
chartDefAvg.render();

}


function displayDeformation ()
{

var chartDeformation = new CanvasJS.Chart("chartContainerDeformation",
{
	title: {
		text: "Deformation over tid"
	},

	axisY: {
		title: "Deformation"
    },
    data: [

        {
		type: "line",
        //axisYType: "first",
        toolTipContent:"Dato: {label}<br/> Drift: {y}<br/> Billede: <img src= {sti} height=120 width=$150>",
		dataPoints: <?php echo json_encode($deformation, JSON_NUMERIC_CHECK); ?>

	    }


        ]
}
                                         );
chartDeformation.render();

}

</script>
<?php
} // afslutning på deformationdata() funktionen
?>

