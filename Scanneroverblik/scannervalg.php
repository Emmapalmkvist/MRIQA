<?php
include "../Kvalitetsparametre/deformation.php";
include "../Kvalitetsparametre/drift.php";
include "../Kvalitetsparametre/ghosting.php";
include "../Kvalitetsparametre/rf.php";
include "../Kvalitetsparametre/snr.php";
include "../Kvalitetsparametre/uniformitet.php";

require_once "../Database/DB_adgang.php";
$sql1 = "SELECT Serienummer, Model, Scannernavn FROM Scannere";
$result1 = mysqli_query($mysqli, $sql1);
$data = array();

while ($row = mysqli_fetch_array($result1)) {
    // ligger serienummer ind i array som key og ligger scannernavn ind som value
    $data[$row['Serienummer']] = $row['Scannernavn'];

}
    // sørg at instantier variablerne med tomme værdier
    if (isset($_POST["date1"])) {$startdato = $_POST['date1'];} else {$startdato = "";}
    if (isset($_POST["date2"])) {$slutdato = $_POST['date2'];} else {$slutdato = "";}
    if (isset($_POST["select1"])) {$sn = $_POST['select1'];} else {$sn = "";}
    $model = "";
?>

<!DOCTYPE html>
<html>
    <style type="text/css">
    </style>
<body>
<form action="" method="post">

<script type="text/javascript" src="http://services.iperfect.net/js/IP_generalLib.js"></script>
<br />
<input type="date" name="date1" id="date1" style= "margin-left:27%; margin-right: 27% height: 25px margin-top: 5px"class="IP_calendar" value="<? print $startdato;?>">
<input type="date" name="date2" id="date2" style= "height: 25px" class="IP_calendar" value="<? print $slutdato;?>">

 <select name="select1" id="scannerid" style= "height: 25px">
     <option value="default">Vælg en scanner...</option>
<?
 foreach($data as $serienummer => $scannernavn) {
     echo "<option value=\"" . $serienummer . "\"";
     if ($serienummer == $sn) {
         echo " selected";
     }
     echo ">" . $scannernavn . "</option>\n";
 }

?>
</select>


<button type ="submit" id="submit"> Vis scanner</button>

</form>
</body>
</html>
