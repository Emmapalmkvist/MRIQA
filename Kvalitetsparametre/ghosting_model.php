<?php
    //POST tager det, som ligger i dropdownmenyen og gemmer det i variablen //$sn, som puttes i SQL queryen.
function model($model1)
{
    include "../Database/DB_adgang.php";
    $model = $model1;
    $sql = "SELECT Scannernavn, Serienummer, Model FROM Scannere WHERE Model='$model'";


$result = mysqli_query($mysqli, $sql);

$scannersn = array();

while($row = mysqli_fetch_array($result))
{
    $scannersn[] = array(
    "y" => $row["Serienummer"],
    "label" =>$row["Scannernavn"]
    );

}
echo '<pre>'; print_r($scannersn); echo '</pre>';
?>
<script>
//window.onload =
    function displayGhostingmodel () {

var chartGhostingmodel = new CanvasJS.Chart("chartContainerGhostingmodel", {
	title: {
		text: "Ghosting over tid"
	},
	axisY: {
		title: "Ghosting"
	},
    data: [{
		type: "line",
        toolTipContent:"Dato: {label}<br/> Ghosting: {y}<br/> Billede: <img src= {sti} height=120 width=$150>",
		dataPoints: <?php echo json_encode($ghostingmodel, JSON_NUMERIC_CHECK); ?>
	}]
});


chartGhostingmodel.render();

}
</script>
<?php }
?>

