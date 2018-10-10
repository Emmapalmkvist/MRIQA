<!DOCTYPE html>
<html>
<body>
<form action="" method="post">
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
?>
</select>

<?php
    //POST tager det, som ligger i dropdownmenyen og gemmer det i variablen $sn, som puttes i SQL queryen.
    $sn = $_POST['select1'];
    $sql = "SELECT Ghostingmean, Dato, Serienummer, Ghostingbillede FROM Maaling WHERE Serienummer='$sn'";

$result = mysqli_query($mysqli, $sql);

$ghosting= array();

while($row = mysqli_fetch_array($result))
{
    $ghosting[] = array(
    "y" => $row["Ghostingmean"],
    "label" =>$row["Dato"],
    "sti" => "../billeder/" . $row["Ghostingbillede"]
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

var chart1 = new CanvasJS.Chart("chartContainer1", {
	title: {
		text: "Ghosting over tid"
	},
	axisY: {
		title: "Ghosting"
	},
	data: [{
		type: "line",
        toolTipContent:"Dato: {label}<br/> Drift: {y}<br/> Billede: <img src= {sti} height=120 width=$150>",
		dataPoints: <?php echo json_encode($ghosting, JSON_NUMERIC_CHECK); ?>
	}]
});


chart1.render();

}

</script>
</head>
<body>
<br/><div id="chartContainer1" style="width: 30%; height: 300px;display: inline-block;"></div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js">

    </script>
</body>
</html>

















