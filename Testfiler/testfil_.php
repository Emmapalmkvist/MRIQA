<?php

$servername = "5.104.105.222";
$username = "iha";
$password = "specialeprojekt";
$db = "qaspeciale";
$port = "8085";

// Opret connection til MySQL database
$mysqli = new mysqli($servername, $username, $password, $db, $port);

// Check forbindelsen
if($mysqli === false)
{
    die("Kan ikke oprette forbindelse." . $mysqli->connect_error);
}

// Test af succesfuld forbindelse
else echo "Forbindelse oprettet.";




$sql = "SELECT * FROM Maaling";
$result = mysqli_query($mysqli, $sql);

$ghosting= array();
$snr = array();
$uniformitet = array();
$deformation = array();
$rf = array();
$drift = array();

while($row = mysqli_fetch_array($result))
{
    $ghosting[] = array(
    "y" => $row["Ghostingmean"],
    "label" =>$row["Dato"]
    );

}


echo '<pre>';
print_r($ghosting);
echo '</pre>';



?>


