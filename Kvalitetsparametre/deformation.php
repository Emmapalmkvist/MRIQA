<?php


function deformationdata($sn1, $model1, $start, $slut)
{
    include "../Database/DB_adgang.php";
    $sn = $sn1;
    $model = $model1;
    $startdato = $start;
    $slutdato = $slut;

$sql = "SELECT Deformation, Model, Dato, Serienummer, Deformationbillede, Starttidspunkt FROM Maaling WHERE Serienummer='$sn' AND Dato BETWEEN '$startdato' AND '$slutdato' GROUP BY Dato";


$result = mysqli_query($mysqli, $sql);

$deformation= array();

    while($row = mysqli_fetch_array($result))
{
    $deformation[] = array(
    "y" => $row["Deformation"],
    "label" =>$row["Dato"],
    "tidspunkt" =>$row["Starttidspunkt"],
    "sti" => "../billeder/" . $row["Deformationbillede"]
    );
    $model = $row["Model"];
}


$sql1 = "SELECT Model, AVG(Deformation) as avgDef, Dato FROM Maaling WHERE Model='$model' AND Dato BETWEEN '$startdato' AND '$slutdato' GROUP BY Dato";

$result1 = mysqli_query($mysqli, $sql1);

$avgDef= array();


    while($row = mysqli_fetch_array($result1))
    {
    $avgDef[] = array(
    "y" => $row["avgDef"],
    "label" => $row["Dato"]
    );
    }

/*$sql2 = "SELECT Servicetidspunkt FROM Servicetidspunkt WHERE Serienummer='$sn' AND Servicetidspunkt BETWEEN '$startdato' AND '$slutdato' GROUP BY Servicetidspunkt";

$result2 = mysqli_query($mysqli, $sql2);

$service= array();


    while($row = mysqli_fetch_array($result2))
    {
    $service[] = array(
    "label" => $row["Servicetidspunkt"]

    );

    }*/
    // test af arrayindhold
    /*echo '<pre>';
    print_r($service);
    echo  '</pre>';

    echo '<pre>';
    print_r($avgDef);
    echo  '</pre>';*/


?>

<script>
//window.onload =


function displayDefAvg ()
{

var chartDefAvg = new CanvasJS.Chart("chartContainerDefAvg",
{
	title: {
		text: "Deformation over tid"
    },


	axisY:{

        title: "Deformation",


        stripLines:[
        {
        value:4,
        label:"Max",
        color:"red",
        thickness: 3,
        labelFontColor:"red"
        },
        {
        value:0.5,
        label:"Min",
        color:"red",
        thickness: 3,
        labelFontColor:"red"
        }
        ],
      },

    data: [

        {
        name: "Deformation for valgt scanner",
		type: "line",
        showInLegend: true,
        toolTipContent:"Dato: {label}<br/> Deformation: {y}",
		dataPoints: <?php echo json_encode($deformation, JSON_NUMERIC_CHECK); ?>



	    },
        {
        name: "Deformationsgennemsnit for valgt scanners modeltype",
        type: "line",
        showInLegend: true,
        toolTipContent:"Dato: {label}<br/> Deformation: {y}",
		dataPoints: <?php echo json_encode($avgDef, JSON_NUMERIC_CHECK); ?>

        }


        ]
}
                                         );
chartDefAvg.render();

}


function displayDeformation ()
{

var chartDeformation = new CanvasJS.Chart("chartContainerDeformation",
{
	title: {
		text: "Deformation over tid"
	},

	axisY: {
		title: "Deformation"
    },
    data: [

        {
		type: "line",
        //axisYType: "first",
        toolTipContent:"Dato: {label}<br/> Drift: {y}<br/> Starttidspunkt: {tidspunkt}[1] <br/> Billede: <img src= {sti} height=120 width=$150>",
		dataPoints: <?php echo json_encode($deformation, JSON_NUMERIC_CHECK); ?>

	    }


        ]
}
                                         );
chartDeformation.render();

}



</script>
<?php

}

function notificationsDef()
{
    include "../Hjem/datointervalNot.php";
    include "../Database/DB_adgang.php";


    $sql_def = "SELECT Deformation, Dato, Serienummer FROM Maaling WHERE Dato BETWEEN '$date2' AND '$date1' GROUP BY Dato";

    $result_def = mysqli_query($mysqli, $sql_def);

    $data_def = array();

while($row = mysqli_fetch_array($result_def))
{
    $data_def[] = array(
    "y" => $row["Deformation"],
    "label" =>$row["Dato"],
    "serienummer" =>$row["Serienummer"]
    );
}

// hardcode min og max
$maxDef = 4.0;
$minDef = 0.5;

for ($i = 0; $i < count($data_def); ++$i) {

if (($data_def[$i]['y']) > $maxDef)
{
    $serienummer = ($data_def[$i]['serienummer']);
    $dato = ($data_def[$i]['label']);
    $msg = "Deformation over max d. $dato på scanneren med serienummer: $serienummer"."<br>";
    echo $msg;
}

if (($data_def[$i]['y']) < $minDef)
{
    $serienummer = ($data_def[$i]['serienummer']);
    $dato = ($data_def[$i]['label']);
    $msg = "Deformation under min d. $dato på scanneren med serienummer: $serienummer"."<br>";
    echo $msg;
}
}

}


/*function getServiceDeformation()
{
    include "../Database/DB_adgang.php";
    $sn = $_GET['sn'];
    $startdato = $_GET['startdato'];
    $slutdato = $_GET['slutdato'];
    $sql2 = "SELECT Servicetidspunkt FROM Servicetidspunkt WHERE Serienummer='$sn' AND Servicetidspunkt BETWEEN '$startdato' AND '$slutdato' GROUP BY Servicetidspunkt";

    $result2 = mysqli_query($mysqli, $sql2);

    $service= array();


    while($row = mysqli_fetch_array($result2))
    {
    $service[] = array(
    "label" => $row["Servicetidspunkt"]

    );

    }

    for ($i = 0; $i < count($service); ++$i) {


    if (($service[$i]['label']) > 0)
{
    $servicetidspunkt = ($service[$i]['label']);
    $msg = "Der er foretaget serviceeftersyn d. $servicetidspunkt </br>";
    echo $msg;
}

}
}*/


?>

