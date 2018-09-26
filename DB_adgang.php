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
//else echo "Forbindelse oprettet."

?>
