<?php
    //POST tager det, som ligger i dropdownmenyen og gemmer det i variablen //$sn, som puttes i SQL queryen.
function driftdata($sn1, $start, $slut)
{
    include "../Database/DB_adgang.php";
    $sn = $sn1;
    $startdato = $start;
    $slutdato = $slut;
    //$sn = $_POST['select1'];
    $sql = "SELECT Drift, Dato, Serienummer, Driftbillede FROM Maaling WHERE Serienummer='$sn' AND Dato BETWEEN '$startdato' AND '$slutdato'";

$result = mysqli_query($mysqli, $sql);

$drift= array();

while($row = mysqli_fetch_array($result))
{
    $drift[] = array(
    "y" => $row["Drift"],
    "label" =>$row["Dato"],
    "sti" => "../billeder/" . $row["Driftbillede"]
    );

} ?>
<script>
//window.onload =
    function displayDrift () {

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



