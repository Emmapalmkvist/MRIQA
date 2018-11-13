<?php
    //POST tager det, som ligger i dropdownmenyen og gemmer det i variablen //$sn, som puttes i SQL queryen.
function ghostingdata($sn1, $model1, $start, $slut)
{
    include "../Database/DB_adgang.php";
    $sn = $sn1;
    $model = $model1;
    $startdato = $start;
    $slutdato = $slut;
    $sql = "SELECT Ghostingmean, Model, Dato, Serienummer, Ghostingbillede, Starttidspunkt FROM Maaling WHERE Serienummer='$sn' AND Dato BETWEEN '$startdato' AND '$slutdato' GROUP BY Dato";

$result = mysqli_query($mysqli, $sql);

$ghosting = array();

while($row = mysqli_fetch_array($result))
{
    $ghosting[] = array(
    "y" => $row["Ghostingmean"],
    "label" =>$row["Dato"],
    "tidspunkt" =>$row["Starttidspunkt"][0],
    "tidspunkt1" =>$row["Starttidspunkt"][1],
    "tidspunkt2" =>$row["Starttidspunkt"][2],
    "tidspunkt3" =>$row["Starttidspunkt"][3],
    "sti" => "../billeder/" . $row["Ghostingbillede"]
    );
    $model = $row["Model"];

}


$sql1 = "SELECT Model, AVG(Ghostingmean) as avgGhosting, Dato FROM Maaling WHERE Model='$model' AND Dato BETWEEN '$startdato' AND '$slutdato' GROUP BY Dato";


$result1 = mysqli_query($mysqli, $sql1);

$avgGhosting= array();


    while($row = mysqli_fetch_array($result1))
    {
    $avgGhosting[] = array(
    "y" => $row["avgGhosting"],
    "label" => $row["Dato"]
    );
    }



?>
<script>


function displayGhostingAvg () {

var chartGhostingAvg = new CanvasJS.Chart("chartContainerGhostingAvg", {
	title: {
		text: "Ghosting over tid"
	},
	axisY:{

        title: "Ghosting",
        stripLines:[
        {
        value:2,
        label:"Max",
        color:"red",
        thickness: 3,
        labelFontColor:"red"
        }
        ],
      },
    data: [

        {
        name: "Ghosting for valgt scanner",
		type: "line",
        showInLegend: true,
        toolTipContent:"Dato: {label}<br/> Ghosting: {y}",
		dataPoints: <?php echo json_encode($ghosting, JSON_NUMERIC_CHECK); ?>



	    },
        {
        name: "Ghostingsgennemsnit for valgt scanners modeltype",
        type: "line",
        showInLegend: true,
        toolTipContent:"Dato: {label}<br/> Ghosting: {y}",
		dataPoints: <?php echo json_encode($avgGhosting, JSON_NUMERIC_CHECK); ?>

        }

        ]
});


chartGhostingAvg.render();

}


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
        toolTipContent:"Dato: {label}<br/> Ghosting: {y}<br/>Starttidspunkt: {tidspunkt}{tidspunkt1}:{tidspunkt2}{tidspunkt3}<br/> Billede: <img src= {sti} height=120 width=$150>",
		dataPoints: <?php echo json_encode($ghosting, JSON_NUMERIC_CHECK); ?>
	}]
});


chartGhosting.render();

}
</script>
<?php }

function notificationsGhosting()
{
    include "../Hjem/datointervalNot.php";
    include "../Database/DB_adgang.php";


    $sql_ghosting = "SELECT Ghostingmean, Dato, Serienummer FROM Maaling WHERE Dato BETWEEN '$date2' AND '$date1' GROUP BY Dato";

    $result_ghosting = mysqli_query($mysqli, $sql_ghosting);

    $data_ghosting = array();

while($row = mysqli_fetch_array($result_ghosting))
{
    $data_ghosting[] = array(
    "y" => $row["Ghostingmean"],
    "label" =>$row["Dato"],
    "serienummer" =>$row["Serienummer"]
    );
}

// hardcode min og max
$maxGhosting = 2.0;

for ($i = 0; $i < count($data_ghosting); ++$i) {

if (($data_ghosting[$i]['y']) > $maxGhosting)
{
    $serienummer = ($data_ghosting[$i]['serienummer']);
    $dato = ($data_ghosting[$i]['label']);
    $msg = "Ghosting over max d. $dato på scanneren med serienummer: $serienummer"."<br>";
    echo $msg;
}

/*if (($data_def[$i]['y']) < $minDef)
{
    $serienummer = ($data_def[$i]['serienummer']);
    $dato = ($data_def[$i]['label']);
    $msg = "Deformation under min d. $dato på scanneren med serienummer: $serienummer"."<br>";
    echo $msg;
}*/
}

}
?>

