<?php
    //POST tager det, som ligger i dropdownmenyen og gemmer det i variablen //$sn, som puttes i SQL queryen.
function deftest($sn1, $start, $slut)
{
    include "../Database/DB_adgang.php";
    $sn = $sn1;
    $startdato = $start;
    $slutdato = $slut;
    //$sn = $_POST['select1'];
    $sql = "SELECT Deformation, Dato, Serienummer, Deformationbillede FROM Maaling WHERE Serienummer='$sn' AND Dato BETWEEN '$startdato' AND '$slutdato'";

$result = mysqli_query($mysqli, $sql);

$deformation= array();

while($row = mysqli_fetch_array($result))
{
    $deformation[] = array(
    "y" => $row["Deformation"],
    "label" =>$row["Dato"],
    "sti" => "../billeder/" . $row["Deformationbillede"]
    );

} ?>
<script>
//window.onload =
    function hej () {

var chartDeformation = new CanvasJS.Chart("chartContainerDeformation", {
	title: {
		text: "Deformation over tid"
	},
	axisY: {
		title: "Deformation"
	},
    data: [{
		type: "line",
        toolTipContent:"Dato: {label}<br/> Deformation: {y}<br/> Billede: <img src= {sti} height=120 width=$150>",
		dataPoints: <?php echo json_encode($deformation, JSON_NUMERIC_CHECK); ?>
	}]
});


chartDeformation.render();

}

</script>
<?php }
?>
















