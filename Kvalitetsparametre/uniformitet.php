<?php

function uniformitetdata($sn1, $model1, $start, $slut)
{
    include "../Database/DB_adgang.php";
    $sn = $sn1;
    $model = $model1;
    $startdato = $start;
    $slutdato = $slut;
    $sql = "SELECT Uniformitet, Model, Dato, Serienummer, Uniformitetbillede, Starttidspunkt FROM Maaling WHERE Serienummer='$sn' AND Dato BETWEEN '$startdato' AND '$slutdato' GROUP BY Dato";

$result = mysqli_query($mysqli, $sql);

$uniformitet = array();

while($row = mysqli_fetch_array($result))
{
    $uniformitet[] = array(
    "y" => $row["Uniformitet"],
    "label" =>$row["Dato"],
    "tidspunkt" =>$row["Starttidspunkt"][0],
    "tidspunkt1" =>$row["Starttidspunkt"][1],
    "tidspunkt2" =>$row["Starttidspunkt"][2],
    "tidspunkt3" =>$row["Starttidspunkt"][3],
    "sti" => "../billeder/" . $row["Uniformitetbillede"]
    );
    $model = $row["Model"];


}

$sql1 = "SELECT Model, AVG(Uniformitet) as avgUniformitet, Dato FROM Maaling WHERE Model='$model' AND Dato BETWEEN '$startdato' AND '$slutdato' GROUP BY Dato";


$result1 = mysqli_query($mysqli, $sql1);

$avgUniformitet= array();


    while($row = mysqli_fetch_array($result1))
    {
    $avgUniformitet[] = array(
    "y" => $row["avgUniformitet"],
    "label" => $row["Dato"]
    );

    }

?>


<script>

function displayUniformitetAvg ()
{

var chartUniformitetAvg = new CanvasJS.Chart("chartContainerUniformitetAvg",
{
	title: {
		text: "Uniformitet over tid"
	},
	axisY:{

        title: "Uniformitet",


        stripLines:[
        {
        value:60,
        label:"Max",
        color:"red",
        thickness: 3,
        labelFontColor:"red"
        },
        {
        value:35,
        label:"Min",
        color:"red",
        thickness: 3,
        labelFontColor:"red"
        }
        ],
      },
    data: [

        {
        name: "Uniformitet for valgt scanner",
		type: "line",
        showInLegend: true,
        toolTipContent:"Dato: {label}<br/> Uniformitet: {y}",
		dataPoints: <?php echo json_encode($uniformitet, JSON_NUMERIC_CHECK); ?>



	    },
        {
        name: "Uniformitetsgennemsnit for valgt scanners modeltype",
        type: "line",
        showInLegend: true,
        toolTipContent:"Dato: {label}<br/> Uniformitet: {y}",
		dataPoints: <?php echo json_encode($avgUniformitet, JSON_NUMERIC_CHECK); ?>

        }

        ]
}
                                         );
chartUniformitetAvg.render();

}




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
        toolTipContent:"Dato: {label}<br/> Uniformitet: {y}<br/>Starttidspunkt: {tidspunkt}{tidspunkt1}:{tidspunkt2}{tidspunkt3}<br/> Billede: <img src= {sti} height=120 width=$150>",
		dataPoints: <?php echo json_encode($uniformitet, JSON_NUMERIC_CHECK); ?>
	}]
});


chartUniformitet.render();

}
</script>
<?php }


function notificationsUniformitet()
{
    include "../Kvalitetsparametre/datointervalNot.php";
    include "../Database/DB_adgang.php";


    $sql_uni = "SELECT Uniformitet, Dato, Serienummer FROM Maaling WHERE Dato BETWEEN '$date2' AND '$date1' GROUP BY Dato";

    $result_uni = mysqli_query($mysqli, $sql_uni);

    $data_uni = array();

while($row = mysqli_fetch_array($result_uni))
{
    $data_uni[] = array(
    "y" => $row["Uniformitet"],
    "label" =>$row["Dato"],
    "serienummer" =>$row["Serienummer"]
    );
}


$maxUni= 60.0;
$minUni = 35.0;

for ($i = 0; $i < count($data_uni); ++$i) {

if (($data_uni[$i]['y']) > $maxUni)
{
    $serienummer = ($data_uni[$i]['serienummer']);
    $dato = ($data_uni[$i]['label']);
    $msg = "Uniformitet over max d. $dato på scanneren med serienummer: $serienummer"."<br>";
    echo $msg;
}

if (($data_uni[$i]['y']) < $minUni)
{
    $serienummer = ($data_uni[$i]['serienummer']);
    $dato = ($data_uni[$i]['label']);
    $msg = "Uniformitet under min d. $dato på scanneren med serienummer: $serienummer"."<br>";
    echo $msg;
}
}

}


?>
