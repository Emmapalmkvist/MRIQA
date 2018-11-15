<?php

function getService()
{
    //require_once "../Scanneroverblik/service.php";
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
}
?>
