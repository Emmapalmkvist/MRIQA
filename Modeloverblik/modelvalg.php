<?php
include "../Kvalitetsparametre/deformation.php";
include "../Kvalitetsparametre/drift.php";
include "../Kvalitetsparametre/ghosting.php";
include "../Kvalitetsparametre/rf.php";
include "../Kvalitetsparametre/snr.php";
include "../Kvalitetsparametre/uniformitet.php";
?>
<!DOCTYPE html>
<html>
<body >

<form action="" method="post">

<script type="text/javascript" src="http://services.iperfect.net/js/IP_generalLib.js"></script>
<input type="date" name="date1" id="date1" class="IP_calendar">
<input type="date" name="date2" id="date2" class="IP_calendar" value="">

<select name="select1">
 <option value="">Vælg modeltype..</option>

<?php
include "../Database/DB_adgang.php";
$sql1 = "SELECT distinct Model FROM Scannere";
$result1 = mysqli_query($mysqli, $sql1);

while ($row = mysqli_fetch_array($result1)) {
    echo "<option value='" . $row['Model'] . "'>" . $row['Model'] . "</option>";
}
    $startdato = $_POST['date1'];
    $slutdato = $_POST['date2'];
    $model = $_POST['select1'];
?>
</select>

<?php
    //POST tager det, som ligger i dropdownmenyen og gemmer det i variablen //$sn, som puttes i SQL queryen.

$sql = "SELECT Scannernavn, Serienummer, Model FROM Scannere WHERE Model='$model'";


//$sql = "SELECT Deformation, Model, Dato, Serienummer, Deformationbillede FROM Maaling WHERE Model='$model' AND Dato BETWEEN '$startdato' AND '$slutdato' GROUP BY Dato";

$result = mysqli_query($mysqli, $sql);

$scannersn = array();

while($row = mysqli_fetch_array($result))
{
    $scannersn[] = array(
    "sn" => $row["Serienummer"],
        "model" => $row["Model"]
    );
}

//måske en foreach serienummer et eller andet. Ellers skal der stå noget andet i while
    while($row = mysqli_fetch_array($result))
{
    $sql = "SELECT Deformation, Model, Dato, Serienummer, Deformationbillede FROM Maaling WHERE Serienummer='".sn."' AND Dato BETWEEN '".$_POST['date1']."' AND '".$_POST['date2']."' GROUP BY Dato";
    $scanner[] = array(
    "y" => $row["Derformatio"],
    "label" =>$row["Dato"],
    displayGhosting(scanner)
    );
}

?>
<button type ="submit" id="submit"> Vis scannere af modeltype</button>
<script>
//window.onload =
    function displayGhosting($scanner1[]) {
    $scanner1=$scannersn;

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
		dataPoints: <?php echo json_encode($scannersn, JSON_NUMERIC_CHECK); ?>
	}]
});


chartGhosting.render();

}
</script>

</form>

</body>
</html>


