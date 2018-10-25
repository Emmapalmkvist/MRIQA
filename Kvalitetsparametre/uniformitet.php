<?php
    //POST tager det, som ligger i dropdownmenyen og gemmer det i variablen //$sn, som puttes i SQL queryen.
function uniformitetdata($sn1, $start, $slut)
{
    include "../Database/DB_adgang.php";
    $sn = $sn1;
    $startdato = $start;
    $slutdato = $slut;
    $sql = "SELECT Uniformitet, Dato, Serienummer, Uniformitetbillede FROM Maaling WHERE Serienummer='$sn' AND Dato BETWEEN '$startdato' AND '$slutdato' GROUP BY Dato";

$result = mysqli_query($mysqli, $sql);

$uniformitet = array();

while($row = mysqli_fetch_array($result))
{
    $uniformitet[] = array(
    "y" => $row["Uniformitet"],
    "label" =>$row["Dato"],
    "sti" => "../billeder/" . $row["Uniformitetbillede"]
    );

} ?>
<script>
//window.onload =
    function displayUniformitet () {

var chartUniformitet = new CanvasJS.Chart("chartContainerUniformitet", {
	title: {
		text: "Uniformitet over tid"
	},
	axisY: {
		title: "Uniformitet"
	},
    data: [{
		type: "line",
        toolTipContent:"Dato: {label}<br/> Uniformitet: {y}<br/> Billede: <img src= {sti} height=120 width=$150>",
		dataPoints: <?php echo json_encode($uniformitet, JSON_NUMERIC_CHECK); ?>
	}]
});


chartUniformitet.render();

}
</script>
<?php }
?>




<?php
/*

<!DOCTYPE html>
<html>
<body>
<form action="" method="post">

<script type="text/javascript" src="http://services.iperfect.net/js/IP_generalLib.js"></script>
<input type="date" name="date1" id="date1" alt="date" class="IP_calendar" title="Y-m-d">
<input type="date" name="date2" id="date2" alt="date" class="IP_calendar" title="Y-m-d">

<select name="select1">
<?php
require_once "../Database/DB_adgang.php";
$sql1 = "SELECT Serienummer, Scannernavn FROM Scannere";
$result1 = mysqli_query($mysqli, $sql1);

?>
<?php
while ($row = mysqli_fetch_array($result1)) {
    echo "<option value='" . $row['Serienummer'] . "'>" . $row['Scannernavn'] . "</option>";
}
    $startdato = $_POST['date1'];
    $slutdato = $_POST['date2'];
    $sn = $_POST['select1'];
?>
</select>

<?php
    //POST tager det, som ligger i dropdownmenyen og gemmer det i variablen //$sn, som puttes i SQL queryen.

    //$sn = $_POST['select1'];
    $sql = "SELECT Uniformitet, Dato, Serienummer, Uniformitetbillede FROM Maaling WHERE Serienummer='$sn' AND Dato BETWEEN '$startdato' AND '$slutdato'";

$result = mysqli_query($mysqli, $sql);

$uniformitet= array();

while($row = mysqli_fetch_array($result))
{
    $uniformitet[] = array(
    "y" => $row["Uniformitet"],
    "label" =>$row["Dato"],
    "sti" => "../billeder/" . $row["Uniformitetbillede"]
    );

}
?>
<button type ="submit" id="submit"> Vis scanner</button>

</form>
</body>
</html>
<?php
// https://stackoverflow.com/questions/45157149/creating-dropdown-list-from-sql-database-in-php
?>

<!DOCTYPE HTML>
<html>
<head>

<script>
window.onload = function () {

var chartUni = new CanvasJS.Chart("chartContainerUni", {
	title: {
		text: "Uniformitet over tid"
	},
	axisY: {
		title: "Uniformitet"
	},
    data: [{
		type: "line",
        toolTipContent:"Dato: {label}<br/> Uniformitet: {y}<br/> Billede: <img src= {sti} height=120 width=$150>",
		dataPoints: <?php echo json_encode($uniformitet, JSON_NUMERIC_CHECK); ?>
	}]
});


chartUni.render();

}

</script>
</head>
<body>
<br/><div id="chartContainerUni" style="width: 30%; height: 300px;display: inline-block;"></div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</body>
</html>

*/
?>

















