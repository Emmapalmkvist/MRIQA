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
$conn = new mysqli($servername, $username, $password, $db, 8085); // 8085 port

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";


$sql = "INSERT INTO qaspeciale.Logind (Brugernavn, Adgangskode)
VALUES ('idarasmusen', 'kode1234')";


$sql = "SELECT Brugernavn, Adgangskode FROM Logind";
$result = $conn->query($sql);

    if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "Brugernavn: " . $row["Brugernavn"]. " - Adgangskode: " . $row["Adgangskode"];
    }
} else {
    echo "0 results";
}
$conn->close();
?>
