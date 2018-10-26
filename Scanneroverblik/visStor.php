<?php
include "../Kvalitetsparametre/deformation.php";

?>

<html>
<head>
</head>
<?php
    $datatype = $_GET['datatype'];
    $sn = $_GET['sn'];
    $model = $_GET['model'];
    $startdato = $_GET['startdato'];
    $slutdato = $_GET['slutdato'];

    switch($datatype) {
        case "Deformation":

            deformationdata($sn, $model, $startdato, $slutdato);
            ?>
            <body  onload="displayDefGns();">
            <br/>
            <div id="chartContainerDefGns" style="width: 100%; height: 600px;display: inline-block;"></div>
            <?php
        default:;}





?>
 <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
    </body>
</html>
