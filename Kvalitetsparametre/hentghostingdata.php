<?php

include "../Kvalitetsparametre/ghosting.php";
    //POST tager det, som ligger i dropdownmenyen og gemmer det i variablen //$sn, som puttes i SQL queryen.

    //$sn = $_POST['select1'];
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
?>
