<?php
function rfdata($sn1, $model1, $start, $slut)
{
    include "../Database/DB_adgang.php";
    $sn = $sn1;
    $model = $model1;
    $startdato = $start;
    $slutdato = $slut;
    $sql = "SELECT Resonansfrekvens, Model, Dato, Serienummer, Resonansfrekvensbillede FROM Maaling WHERE Serienummer='$sn' AND Dato BETWEEN '$startdato' AND '$slutdato' GROUP BY Dato";

$result = mysqli_query($mysqli, $sql);

$rf= array();

while($row = mysqli_fetch_array($result))
{
    $rf[] = array(
    "y" => $row["Resonansfrekvens"],
    "label" =>$row["Dato"],
    "sti" => "../billeder/" . $row["Resonansfrekvensbillede"]
    );
    $model = $row["Model"];

}

$sql1 = "SELECT Model, AVG(Resonansfrekvens) as avgRf, Dato FROM Maaling WHERE Model='$model' AND Dato BETWEEN '$startdato' AND '$slutdato' GROUP BY Dato";


$result1 = mysqli_query($mysqli, $sql1);

$avgRf= array();


    while($row = mysqli_fetch_array($result1))
    {
    $avgRf[] = array(
    "y" => $row["avgRf"],
    "label" => $row["Dato"]
    );
    }


?>



<script>


function displayRfAvg () {

var chartRfAvg = new CanvasJS.Chart("chartContainerRfAvg", {
	title: {
		text: "Resonansfrekvens over tid"
	},
	axisY:{

        title: "Resonansfrekvens",
        minimum: 55,
        maximum: 70,


        stripLines:[
        {
        value:64,
        label:"Max",
        color:"red",
        labelFontColor:"red"
        },
        {
        value:63,
        label:"Min",
        color:"red",
        labelFontColor:"red"
        }
        ],
      },
    data: [

        {
        name: "Resonansfrekvens for valgt scanner",
		type: "line",
        showInLegend: true,
        toolTipContent:"Dato: {label}<br/> Resonansfrekvens: {y}",
		dataPoints: <?php echo json_encode($rf, JSON_NUMERIC_CHECK); ?>



	    },
        {
        name: "Resonansfrekvensgennemsnit for valgt scanners modeltype",
        type: "line",
        showInLegend: true,
        toolTipContent:"Dato: {label}<br/> Resonansfrekvens: {y}",
		dataPoints: <?php echo json_encode($avgRf, JSON_NUMERIC_CHECK); ?>

        }

        ]
});


chartRfAvg.render();

}



function displayRF () {

var chartRf = new CanvasJS.Chart("chartContainerRf", {
	title: {
		text: "Resonansfrekvens over tid"
	},
	axisY: {
		title: "Resonansfrekvens"
	},
    data: [{
		type: "line",
        toolTipContent:"Dato: {label}<br/> Resonansfrekvens: {y}<br/> Billede: <img src= {sti} height=120 width=$150>",
		dataPoints: <?php echo json_encode($rf, JSON_NUMERIC_CHECK); ?>
	}]
});

chartRf.render();
}

</script>
<?php }

function notificationsRf()
{
    include "../Hjem/datointervalNot.php";
    include "../Database/DB_adgang.php";


    $sql_rf = "SELECT Resonansfrekvens, Dato, Serienummer FROM Maaling WHERE Dato BETWEEN '$date2' AND '$date1' GROUP BY Dato";

    $result_rf = mysqli_query($mysqli, $sql_rf);

    $data_rf = array();

while($row = mysqli_fetch_array($result_rf))
{
    $data_rf[] = array(
    "y" => $row["Resonansfrekvens"],
    "label" =>$row["Dato"],
    "serienummer" =>$row["Serienummer"]
    );
}

// hardcode min og max
$maxRf= 64.0;
$minRf = 63.0;

for ($i = 0; $i < count($data_rf); ++$i) {

if (($data_rf[$i]['y']) > $maxRf)
{
    $serienummer = ($data_rf[$i]['serienummer']);
    $dato = ($data_rf[$i]['label']);
    $msg = "Resonansfrekvens over max d. $dato på scanneren med serienummer: $serienummer"."<br>";
    echo $msg;
}

if (($data_rf[$i]['y']) < $minRf)
{
    $serienummer = ($data_rf[$i]['serienummer']);
    $dato = ($data_rf[$i]['label']);
    $msg = "Resonansfrekvens under min d. $dato på scanneren med serienummer: $serienummer"."<br>";
    echo $msg;
}
}

}


?>





















