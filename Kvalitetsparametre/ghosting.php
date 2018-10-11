<!DOCTYPE html>
<html>
<body>
<form action="" method="post">

<script type="text/javascript" src="http://services.iperfect.net/js/IP_generalLib.js"></script>
<input type="date" name="date1" id="date1" alt="date" class="IP_calendar" title="Y-m-d">
<input type="date" name="date2" id="date2" alt="date" class="IP_calendar" title="Y-m-d">

<select name="select1">
<?php
require_once "../Database/DB_adgang.php";
require_once include "../Kvalitetsparametre/hentghostingdata.php";

$sql1 = "SELECT Serienummer, Scannernavn FROM Scannere";
$result1 = mysqli_query($mysqli, $sql1);

while ($row = mysqli_fetch_array($result1)) {
    echo "<option value='" . $row['Serienummer'] . "'>" . $row['Scannernavn'] . "</option>";
}
    $startdato = $_POST['date1'];
    $slutdato = $_POST['date2'];
    $sn = $_POST['select1'];
?>
</select>



<button type ="submit" id="submit"> Vis scanner</button>

</form>
</body>
</html>
<?php
// https://stackoverflow.com/questions/45157149/creating-dropdown-list-from-sql-database-in-php
?>

<?php
include "../Modeloverblik/visscanner.php";
?>
