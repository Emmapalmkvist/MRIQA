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
<body>
<form action="" method="post">

<script type="text/javascript" src="http://services.iperfect.net/js/IP_generalLib.js"></script>
<input type="date" name="date1" id="date1" class="IP_calendar">
<input type="date" name="date2" id="date2" class="IP_calendar" value="">

<select name="select1">
 <option value="">Vælg modeltype..</option>

<?php
require_once "../Database/DB_adgang.php";
$sql1 = "SELECT distinct Model FROM Scannere";
$result1 = mysqli_query($mysqli, $sql1);

while ($row = mysqli_fetch_array($result1)) {
    echo "<option value='" . $row['Model'] . "'>" . $row['Model'] . "</option>";
}
    $startdato = $_POST['date1'];
    $slutdato = $_POST['date2'];
    $model = $_POST['select1'];
?>
</select>

<?php
    //POST tager det, som ligger i dropdownmenyen og gemmer det i variablen //$sn, som puttes i SQL queryen.

$sql = "SELECT Scannernavn, Serienummer, Model FROM Scannere WHERE Model='$model'";

$result = mysqli_query($mysqli, $sql);

$scannersn = array();

while($row = mysqli_fetch_array($result))
{
    $scannersn[] = array(
    "y" => $row["Serienummer"],
    "label" =>$row["Scannernavn"]
    );
}

?>
<button type ="submit" id="submit"> Vis scannere af modeltype</button>
<?php

foreach($scannersn as $scan){
echo '<br/><input type="checkbox" name='scanner[]' value=" . $scan . " />';
echo "<label for name=" . print_r($scan["label"])  . "</label>";

}

if (isset($_POST['scanner']))
{
//echo $_POST['scanner']; // Displays value of checked checkbox.
foreach($_POST['scanner'] as $value){
            echo "value : ".$value.'<br/>';
        }
}

?>

<?php
    /*
    deformationdata($sn, $startdato, $slutdato);
    driftdata($sn, $startdato, $slutdato);
    ghostingdata($sn, $startdato, $slutdato);
    rfdata($sn, $startdato, $slutdato);
    snrdata($sn, $startdato, $slutdato);
    uniformitetdata($sn, $startdato, $slutdato);*/
?>
</form>
<?php
/*
    if(!empty($_POST['scanner'])) {

        foreach($_POST['scanner'] as $value){
            echo "value : ".$value.'<br/>';
        }

    }
*/

?>
</body>
</html>


