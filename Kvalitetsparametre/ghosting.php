<?php
    //POST tager det, som ligger i dropdownmenyen og gemmer det i variablen //$sn, som puttes i SQL queryen.
function ghostingdata($sn1, $start, $slut)
{
    include "../Database/DB_adgang.php";
    $sn = $sn1;
    $startdato = $start;
    $slutdato = $slut;
    $sql = "SELECT Ghostingmean, Dato, Serienummer, Ghostingbillede FROM Maaling WHERE Serienummer='$sn' AND Dato BETWEEN '$startdato' AND '$slutdato' GROUP BY Dato";

$result = mysqli_query($mysqli, $sql);

$ghosting = array();

while($row = mysqli_fetch_array($result))
{
    $ghosting[] = array(
    "y" => $row["Ghostingmean"],
    "label" =>$row["Dato"],
    "sti" => "../billeder/" . $row["Ghostingbillede"]
    );

} ?>
<script>
//window.onload =
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

