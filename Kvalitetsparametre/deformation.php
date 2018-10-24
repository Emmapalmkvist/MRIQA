<?php

function deformationdata($sn1, $model1, $start, $slut)
{
    include "../Database/DB_adgang.php";
    $sn = $sn1;
    $model = $model1;
    $startdato = $start;
    $slutdato = $slut;
    $sql = "SELECT Deformation, Model, Dato, Serienummer, Deformationbillede FROM Maaling WHERE Serienummer='$sn' AND Dato BETWEEN '$startdato' AND '$slutdato'";

$result = mysqli_query($mysqli, $sql);

$deformation= array();

while($row = mysqli_fetch_array($result))
{
    /*$deformation[] = array(
    "y"=> $row["Deformation"],
    "label" =>$row["Dato"],
    "sti" => "../billeder/" . $row["Deformationbillede"]
    ); */
    $model = $row["Model"];
}

$sql1 = "SELECT Model, AVG(Deformation) as avgDef, Dato FROM Maaling WHERE Model='$model' AND Dato BETWEEN '$startdato' AND '$slutdato'";


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
    function displayDeformation () {

var chartDeformation = new CanvasJS.Chart("chartContainerDeformation", {
	title: {
		text: "Deformation over tid"
	},
	axisY: {
		title: "Deformation"
    },
    data: [
        {
		type: "line",
        toolTipContent:"Dato: {label}<br/> Drift: {y}<br/> Billede: <img src= {sti} height=120 width=$150>",
		dataPoints: <?php echo json_encode($deformation, JSON_NUMERIC_CHECK); ?>

	    }

        ]
});
chartDeformation.render();

}
</script>
<?php
} // afslutning på dateDeformation() funktionen


/*function averageDef($model, $start, $slut)
{
    include "../Database/DB_adgang.php";

    $sql = "SELECT '$model', AVG(Deformation) as avgDef,  Dato FROM Maaling WHERE Model='Achieva' AND Dato BETWEEN '$startdato' AND '$slutdato'";


$result = mysqli_query($mysqli, $sql);


    $averagedeformation= array();

    while($row = mysqli_fetch_array($result))
    {
    $averagedeformation[] = array(
    "y" => $row["avgDef"],
    "label" =>$row["Dato"]
    );


}
}*/



?>

