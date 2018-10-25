<?php
include "../Kvalitetsparametre/deformation.php";
include "../Kvalitetsparametre/drift.php";
include "../Kvalitetsparametre/ghosting.php";
include "../Kvalitetsparametre/rf.php";
include "../Kvalitetsparametre/snr.php";
include "../Kvalitetsparametre/uniformitet.php";


?>
<!DOCTYPE html>
<html>
    <style type="text/css">
    </style>
<body>
<form action="" method="post">

<script type="text/javascript" src="http://services.iperfect.net/js/IP_generalLib.js"></script>
<br />
<input type="date" name="date1" id="date1" style= "margin-left:27%; margin-right: 27% height: 25px margin-top: 5px"class="IP_calendar">
<input type="date" name="date2" id="date2" style= "height: 25px" class="IP_calendar" value="">

<script>

var x = ""

function myFunction()
    {
        x = document.getElementById("scannerid").value;
    }

function onload()
    {
        document.getElementById("scannerid").value = x;
    }
</script>

 <select name="select1" id="scannerid" style= "height: 25px" conchange="myFunction()">
 <option value="">Vælg scanner..</option>


<?php
require_once "../Database/DB_adgang.php";
$sql1 = "SELECT Serienummer, Model, Scannernavn FROM Scannere";
$result1 = mysqli_query($mysqli, $sql1);

while ($row = mysqli_fetch_array($result1)) {
    echo "<option value='" . $row['Serienummer'] . "'>" . $row['Scannernavn'] . "</option>";
}

    $startdato = $_POST['date1'];
    $slutdato = $_POST['date2'];
    $sn = $_POST['select1'];
    $model = $_POST['select1'];
?>
</select>

<script>
    onload();
</script>

<?php
    deformationdata($sn, $model, $startdato, $slutdato);
    driftdata($sn, $startdato, $slutdato);
    ghostingdata($sn, $startdato, $slutdato);
    rfdata($sn, $startdato, $slutdato);
    snrdata($sn, $startdato, $slutdato);
    uniformitetdata($sn, $startdato, $slutdato);
?>
<button type ="submit" id="submit"> Vis scanner</button>

</form>
</body>
</html>
