<?php
    //POST tager det, som ligger i dropdownmenyen og gemmer det i variablen //$sn, som puttes i SQL queryen.
function snrdata($sn1, $model1, $start, $slut)
{
    include "../Database/DB_adgang.php";
    $sn = $sn1;
    $model = $model1;
    $startdato = $start;
    $slutdato = $slut;
    $sql = "SELECT SNR, Model, Dato, Serienummer, SNRbillede FROM Maaling WHERE Serienummer='$sn' AND Dato BETWEEN '$startdato' AND '$slutdato' GROUP BY Dato";

$result = mysqli_query($mysqli, $sql);

$snr= array();

while($row = mysqli_fetch_array($result))
{
    $snr[] = array(
    "y" => $row["SNR"],
    "label" =>$row["Dato"],
    "sti" => "../billeder/" . $row["SNRbillede"]
    );
    $model = $row["Model"];

}

$sql1 = "SELECT Model, AVG(SNR) as avgSNR, Dato FROM Maaling WHERE Model='$model' AND Dato BETWEEN '$startdato' AND '$slutdato' GROUP BY Dato";


$result1 = mysqli_query($mysqli, $sql1);

$avgSNR= array();


    while($row = mysqli_fetch_array($result1))
    {
    $avgSNR[] = array(
    "y" => $row["avgSNR"],
    "label" => $row["Dato"]
    );

    }

?>
<script>

function displaySNRAvg ()
{

var chartSNRAvg = new CanvasJS.Chart("chartContainerSNRAvg",
{
	title: {
		text: "SNR over tid"
	},
	axisY: {
		title: "SNR"
    },
    data: [

        {
        name: "SNR for valgt scanner",
		type: "line",
        showInLegend: true,
        toolTipContent:"Dato: {label}<br/> SNR: {y}",
		dataPoints: <?php echo json_encode($snr, JSON_NUMERIC_CHECK); ?>



	    },
        {
        name: "SNR-gennemsnit for valgt scanners modeltype",
        type: "line",
        showInLegend: true,
        toolTipContent:"Dato: {label}<br/> SNR: {y}",
		dataPoints: <?php echo json_encode($avgSNR, JSON_NUMERIC_CHECK); ?>

        }

        ]
}
                                         );
chartSNRAvg.render();

}




function displaySNR () {

var chartSNR = new CanvasJS.Chart("chartContainerSNR", {
	title: {
		text: "SNR over tid"
	},
	axisY: {
		title: "SNR"
	},
    data: [{
		type: "line",
        toolTipContent:"Dato: {label}<br/> SNR: {y}<br/> Billede: <img src= {sti} height=120 width=$150>",
		dataPoints: <?php echo json_encode($snr, JSON_NUMERIC_CHECK); ?>
	}]
});


chartSNR.render();

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
    $sql = "SELECT SNR, Dato, Serienummer, SNRbillede FROM Maaling WHERE Serienummer='$sn' AND Dato BETWEEN '$startdato' AND '$slutdato'";

$result = mysqli_query($mysqli, $sql);

$snr= array();

while($row = mysqli_fetch_array($result))
{
    $snr[] = array(
    "y" => $row["SNR"],
    "label" =>$row["Dato"],
    "sti" => "../billeder/" . $row["SNRbillede"]
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

var chartSnr = new CanvasJS.Chart("chartContainerSnr", {
	title: {
		text: "SNR over tid"
	},
	axisY: {
		title: "SNR"
	},
    data: [{
		type: "line",
        toolTipContent:"Dato: {label}<br/> SNR: {y}<br/> Billede: <img src= {sti} height=120 width=$150>",
		dataPoints: <?php echo json_encode($snr, JSON_NUMERIC_CHECK); ?>
	}]
});


chartSnr.render();

}

</script>
</head>
<body>
<br/><div id="chartContainerSnr" style="width: 30%; height: 300px;display: inline-block;"></div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</body>
</html>

*/
?>
















