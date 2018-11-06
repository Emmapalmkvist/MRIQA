<?php
    //POST tager det, som ligger i dropdownmenyen og gemmer det i variablen //$sn, som puttes i SQL queryen.
function snrdata($sn1, $model1, $start, $slut)
{
    include "../Database/DB_adgang.php";
    $sn = $sn1;
    $model = $model1;
    $startdato = $start;
    $slutdato = $slut;
    $sql = "SELECT SNR, Model, Dato, Serienummer, SNRbillede, Starttidspunkt FROM Maaling WHERE Serienummer='$sn' AND Dato BETWEEN '$startdato' AND '$slutdato' GROUP BY Dato";

$result = mysqli_query($mysqli, $sql);

$snr= array();

while($row = mysqli_fetch_array($result))
{
    $snr[] = array(
    "y" => $row["SNR"],
    "label" =>$row["Dato"],
    "tidspunkt" =>$row["Starttidspunkt"][0],
    "tidspunkt1" =>$row["Starttidspunkt"][1],
    "tidspunkt2" =>$row["Starttidspunkt"][2],
    "tidspunkt3" =>$row["Starttidspunkt"][3],
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
	axisY:{

        title: "SNR",


        stripLines:[
        {
        value:295,
        label:"Max",
        color:"red",
        thickness: 3,
        labelFontColor:"red"
        },
        {
        value:110,
        label:"Min",
        color:"red",
        thickness: 3,
        labelFontColor:"red"
        }
        ],
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
        toolTipContent:"Dato: {label}<br/> SNR: {y}<br/>Starttidspunkt: {tidspunkt}{tidspunkt1}:{tidspunkt2}{tidspunkt3}<br/> Billede: <img src= {sti} height=120 width=$150>",
		dataPoints: <?php echo json_encode($snr, JSON_NUMERIC_CHECK); ?>
	}]
});


chartSNR.render();

}
</script>
<?php }


function notificationsSNR()
{
    include "../Hjem/datointervalNot.php";
    include "../Database/DB_adgang.php";


    $sql_SNR = "SELECT SNR, Dato, Serienummer FROM Maaling WHERE Dato BETWEEN '$date2' AND '$date1' GROUP BY Dato";

    $result_SNR = mysqli_query($mysqli, $sql_SNR);

    $data_SNR = array();

while($row = mysqli_fetch_array($result_SNR))
{
    $data_SNR[] = array(
    "y" => $row["SNR"],
    "label" =>$row["Dato"],
    "serienummer" =>$row["Serienummer"]
    );
}

// hardcode min og max
$maxSNR= 295;
$minSNR= 110;

for ($i = 0; $i < count($data_SNR); ++$i) {

if (($data_SNR[$i]['y']) > $maxSNR)
{
    $serienummer = ($data_SNR[$i]['serienummer']);
    $dato = ($data_SNR[$i]['label']);
    $msg = "SNR over max d. $dato på scanneren med serienummer: $serienummer"."<br>";
    echo $msg;
}

if (($data_SNR[$i]['y']) < $minSNR)
{
    $serienummer = ($data_SNR[$i]['serienummer']);
    $dato = ($data_SNR[$i]['label']);
    $msg = "SNR under min d. $dato på scanneren med serienummer: $serienummer"."<br>";
    echo $msg;
}
}

}


?>

