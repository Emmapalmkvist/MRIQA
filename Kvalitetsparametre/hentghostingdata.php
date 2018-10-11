<?php

function testfunktion ($sn, $startdato, $slutdato)
{
    include "../Database/DB_adgang.php";

    //$sn = "";
    //$startdato = "";
    //$slutdato = "";

    $sql = "SELECT Ghostingmean, Dato, Serienummer, Ghostingbillede FROM Maaling WHERE Serienummer='$sn' AND Dato BETWEEN '$startdato' AND '$slutdato'";

    $result = mysqli_query($mysqli, $sql);

    $ghosting= array();

    while($row = mysqli_fetch_array($result))
    {
    $ghosting[] = array(
    "y" => $row["Ghostingmean"],
    "label" =>$row["Dato"],
    "sti" => "../billeder/" . $row["Ghostingbillede"]
    );

    }
    //print_r($ghosting);


}

?>


