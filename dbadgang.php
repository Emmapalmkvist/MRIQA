<html>
<head><title>PHP test</title></head>
<body>
<?php
    echo 'Hej database';
?>
    </body>

<?php
$servername = "5.104.105.222";
$username = "iha";
$password = "specialeprojekt";
$db = "qaspeciale";

// Create connection
$conn = new mysqli($servername, $username, $password, $db, 8085);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";

$sql = "SELECT Dato, Lokation, Fabrikant, SNR, Uniformitet, Drift FROM Maaling";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "Dato: " . $row["Dato"]. " - Lokation: " . $row["Lokation"]. " - Fabrikant: " . $row["Fabrikant"]. " - SNR: " . $row["SNR"]. " - Uniformitet: " . $row["Uniformitet"]. " - Drift: " . $row["Drift"]. "<br>";
    }
} else {
    echo "0 results";
}
$conn->close();
?>


</html>
