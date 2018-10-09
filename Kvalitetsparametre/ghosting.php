<?php
require_once "../Database/DB_adgang.php";




$sn = "21393";





$sql = "SELECT Ghostingmean, Dato, Serienummer FROM Maaling WHERE Serienummer='$sn'";
$result = mysqli_query($mysqli, $sql);

$ghosting= array();


while($row = mysqli_fetch_array($result))
{
    $ghosting[] = array(
    "y" => $row["Ghostingmean"],
    "label" =>$row["Dato"]
    );

}
?>


<!DOCTYPE HTML>
<html>
<head>

<script>
window.onload = function () {

var chart1 = new CanvasJS.Chart("chartContainer1", {
	title: {
		text: "Ghosting over tid"
	},
	axisY: {
		title: "Ghosting"
	},
	data: [{
		type: "line",
		dataPoints: <?php echo json_encode($ghosting, JSON_NUMERIC_CHECK); ?>
	}]
});


chart1.render();

}

</script>
</head>
<body>
<br/><div id="chartContainer1" style="width: 30%; height: 300px;display: inline-block;"></div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js">

    </script>
</body>
</html>






<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
.dropbtn {
    background-color: #4CAF50;
    color: white;
    padding: 16px;
    font-size: 16px;
    border: none;
}

.dropdown {
    position: relative;
    display: inline-block;
}

.dropdown-content {
    display: none;
    position: absolute;
    background-color: #f1f1f1;
    min-width: 160px;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    z-index: 1;
}

.dropdown-content a {
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
}

.dropdown-content a:hover {background-color: #ddd;}

.dropdown:hover .dropdown-content {display: block;}

.dropdown:hover .dropbtn {background-color: #3e8e41;}
</style>
</head>
<body>

<h2>Hoverable Dropdown</h2>
<p>Move the mouse over the button to open the dropdown menu.</p>

<div class="dropdown">
  <button class="dropbtn">Dropdown</button>
  <div class="dropdown-content">
    <a href="https://www.idenyt.dk/kaeledyr/oevrige-kaeledyr/anskaffelse-af-kanin-dette-skal-du-vide-inden/">Link 1</a>
    <a href="#">Link 2</a>
    <a href="#">Link 3</a>
  </div>
</div>

</body>
</html>











