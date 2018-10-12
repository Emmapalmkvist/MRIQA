

<?php
function rfdata($sn1, $start, $slut)
{
    include "../Database/DB_adgang.php";
    $sn = $sn1;
    $startdato = $start;
    $slutdato = $slut;
    $sql = "SELECT Resonansfrekvens, Dato, Serienummer, Resonansfrekvensbillede FROM Maaling WHERE Serienummer='$sn' AND Dato BETWEEN '$startdato' AND '$slutdato'";

$result = mysqli_query($mysqli, $sql);

$rf= array();

while($row = mysqli_fetch_array($result))
{
    $rf[] = array(
    "y" => $row["Resonansfrekvens"],
    "label" =>$row["Dato"],
    "sti" => "../billeder/" . $row["Resonansfrekvensbillede"]
    );

} ?>
    <script>
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





















