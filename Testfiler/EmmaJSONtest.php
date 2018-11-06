<?php
$servername = "5.104.105.222";
$username = "iha";
$password = "specialeprojekt";
$db = "qaspeciale";

// Create connection
$conn = new mysqli($servername, $username, $password, $db, 8085); // 8085 port

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";

$dtz = new DateTimeZone("Europe/Madrid"); //Your timezone
$now = new DateTime(date("Y-m-d"), $dtz);
$date1 = $now->format("Y-m-d");

$date = (new \DateTime())->modify('-1897 days');
$date2 = $date->format("Y-m-d");


$sql = "SELECT Resonansfrekvens, Dato, Serienummer, Starttidspunkt FROM Maaling WHERE Dato BETWEEN '$date2' AND '$date1' GROUP BY Dato";

$result = mysqli_query($conn, $sql);

$data = array();

while($row = mysqli_fetch_array($result))
{
    $data[] = array(
    "y" => $row["Resonansfrekvens"],
    "t" => $row["Starttidspunkt"],
    );
}

$maxRF = 64.1;
$minRF = 63.7;


for ($i = 0; $i < count($data); ++$i) {

if (($data[$i]['y']) > $maxRF)
{
    $serienummer = ($data[$i]['serienummer']);

    echo "Resonansfrekvensen er over max-værdien på $maxRF - på MRI-scanneren med serienummer: $serienummer"."<br>";
}

if (($data[$i]['y']) < $minRF)
{
    $serienummer = ($data[$i]['serienummer']);

    echo "Resonansfrekvensen er under min-værdien på $minRF - på MRI-scanneren med serienummer: $serienummer"."<br>";
}

}

$object = json_decode(json_encode($data));

echo '<pre>';
print_r($data[2]['t'][0]);
print_r($data[2]['t'][1]);
echo '</pre>';


?>
