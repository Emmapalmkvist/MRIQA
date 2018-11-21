<?php
function deformationmodel($model1, $start, $slut)
{
    include "../Database/DB_adgang.php";
    $model = $model1;
    $startdato = $start;
    $slutdato = $slut;

  $sql2 = "SELECT s.Serienummer, s.Model, m.Deformation, m.Model, m.Dato, m.Serienummer, m.Deformationbillede FROM Scannere as s, Maaling as m WHERE s.Serienummer = m.Serienummer AND s.Model='$model' AND m.Dato BETWEEN '$startdato' AND '$slutdato' GROUP BY m.Serienummer;";

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

        $sql3 = "SELECT Deformation, Model, Dato, Serienummer, Starttidspunkt, Deformationbillede FROM Maaling WHERE Serienummer='$sn1' AND Dato BETWEEN '$startdato' AND '$slutdato' ORDER BY Dato";
        $scannerny = array();
        $result3 = mysqli_query($mysqli, $sql3);
            while($row = mysqli_fetch_array($result3))
                {
                    $scannerny[] = array(
                    "y" => $row["Deformation"],
                    "label" => $row["Dato"],
                    "sn" => $row["Serienummer"],
                    "tidspunkt" =>$row["Starttidspunkt"][0],
                    "tidspunkt1" =>$row["Starttidspunkt"][1],
                    "tidspunkt2" =>$row["Starttidspunkt"][2],
                    "tidspunkt3" =>$row["Starttidspunkt"][3],
                    );

                }
        $dataset = json_encode($scannerny, JSON_NUMERIC_CHECK);
        if(strlen($line) > 0)
        {
            $line .= ',';
        }
        $line .= '{
		type: "line",
        toolTipContent:"Dato: {label}<br/> Deformation: {y}<br/>Serienummer: {sn}<br/> Starttidspunkt: {tidspunkt}{tidspunkt1}:{tidspunkt2}{tidspunkt3}",
		dataPoints: '.$dataset.'
	}';
    }


?>
<script>
function displayDefModel()
{

var chartDefModel = new CanvasJS.Chart("chartDefModel", {
	title: {
		text: "Deformation over tid"
	},
	axisY: {
		title: "Ghosting"
	},
    data: [

        <?php echo $line; ?>
    ]

});


chartDefModel.render();

}


</script>
<?php
}
?>
