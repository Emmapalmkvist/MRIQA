<?php
function ghostingmodel($model1, $start, $slut)
{
    include "../Database/DB_adgang.php";
    $model = $model1;
    $startdato = $start;
    $slutdato = $slut;

  $sql2 = "SELECT s.Serienummer, s.Model, m.Ghostingmean, m.Model, m.Dato, m.Serienummer, m.Ghostingbillede FROM Scannere as s, Maaling as m WHERE s.Serienummer = m.Serienummer AND s.Model='$model' AND m.Dato BETWEEN '$startdato' AND '$slutdato' GROUP BY m.Serienummer;";

$result2 = mysqli_query($mysqli, $sql2);
$scanner = array();

    while($row = mysqli_fetch_array($result2))
{

    $scanner[] = array(
                "sn1" => $row["Serienummer"]
    );

}
    $line='';

    foreach($scanner as $value)
    {
        $scannerny[] = array();

        extract($value);

        $sql3 = "SELECT Ghostingmean, Model, Dato, Serienummer, Ghostingbillede FROM Maaling WHERE Serienummer='$sn1' AND Dato BETWEEN '$startdato' AND '$slutdato' ORDER BY Dato";
        $scannerny = array();
        $result3 = mysqli_query($mysqli, $sql3);
            while($row = mysqli_fetch_array($result3))
                {
                    $scannerny[] = array(
                    "y" => $row["Ghostingmean"],
                    "label" => $row["Dato"],
                    "sn" => $row["Serienummer"]
                    );
                }
        $dataset = json_encode($scannerny, JSON_NUMERIC_CHECK);
        if(strlen($line) > 0)
        {
            $line .= ',';
        }
        $line .= '{
		type: "line",
        legend: "$sn",
        toolTipContent:"Dato: {label}<br/> Ghosting: {y}<br/>Serienummer: {sn} <br/> Billede: <img src= {sti} height=120 width=$150>",
		dataPoints: '.$dataset.'
	}';
    }


?>
<script>
    function displayGhostingModel() {

var chartGhostingModel = new CanvasJS.Chart("chartGhostingModel", {
	title: {
		text: "Ghosting over tid"
	},
	axisY: {
		title: "Ghosting"
	},
    data: [<?php echo $line; ?>]
});


chartGhostingModel.render();

}
</script>
<?php
}
?>
