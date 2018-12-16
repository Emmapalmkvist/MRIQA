<?php

include "../Database/DB_adgang.php";
$sql1 = "SELECT distinct Model FROM Scannere";
$result1 = mysqli_query($mysqli, $sql1);


    if (isset($_POST["date1"])) {$startdato = $_POST['date1'];} else {$startdato = "";}
    if (isset($_POST["date2"])) {$slutdato = $_POST['date2'];} else {$slutdato = "";}
    if (isset($_POST["select1"])) {$model = $_POST['select1'];} else {$model = "";}
?>


<!DOCTYPE html>
<html>
<body>

<form action="" method="post">

<script type="text/javascript" src="http://services.iperfect.net/js/IP_generalLib.js"></script>
    <br/>
<input type="date" name="date1" id="date1" style= "margin-left:27%; margin-right: 27% height: 25px margin-top: 5px"class="IP_calendar" value="<? print $startdato;?>">
<input type="date" name="date2" id="date2" style= "height: 25px" class="IP_calendar" value="<? print $slutdato;?>">

<select name="select1" style= "height: 25px">
 <option value="">Vælg modeltype</option>

<?php

    while ($row = mysqli_fetch_array($result1)) {
    echo "<option value='" . $row['Model'] . "'>" . $row['Model'] . "</option>";
}


?>
<?php

    //POST tager det, som ligger i dropdownmenyen og gemmer det i variablen //$sn, som puttes i SQL queryen.

$sql = "SELECT Scannernavn, Serienummer, Model FROM Scannere WHERE Model='$model'";


$result = mysqli_query($mysqli, $sql);

$scannersn = array();

while($row = mysqli_fetch_array($result))
{
    $scannersn[] = array(
    "sn" => $row["Serienummer"],
        "model" => $row["Model"]
    );
}
    ?>
    </select>
    <button type ="submit" id="submit"> Vis scannere af modeltype</button>
 </form>

</body>
</html>
