<html>
<head><title>PHP test</title></head>


<?php
$servername = "5.104.105.222";
$username = "iha";
$password = "specialeprojekt";
$db = "qaspeciale";
$port = "8085";

// Opret connection til MySQL database
$mysqli = new mysqli($servername, $username, $password, $db, $port);

/*$sql = "SELECT Dato, Lokation, Fabrikant, SNR, Uniformitet, Drift FROM Maaling";*/

$sql = "SELECT Model, AVG(Deformation) as avgDef ,  Dato FROM Maaling WHERE Model='Achieva' AND Dato BETWEEN '2010-01-01' AND '2014-06-17' GROUP BY Dato";


$result = mysqli_query($mysqli, $sql);

//$data = array(. $row["Deformation"], . $row["Dato"]);

/*if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "Dato: " . $row["Dato"]. " - Deformation: " . $row["avgDef"]. "<br>";
    }
} else {
    echo "0 results";
}*/

    //$conn->close();

$averagedeformation= array();

while($row = mysqli_fetch_array($result))
{
    $averagedeformation[] = array(
    "y" => $row["avgDef"],
    "label" =>$row["Dato"]
    );

    $model = $row["Model"];

    return $averagedeformation;

}


    print_r($averagedeformation);




/*while($row = mysqli_fetch_array($result))
{
    //$data[] =$row['Data'];
    //$data['Test'] = $result;
    //return $data;

    //foreach data.field_count

}*/



/*while ($data = mysqli_fetch_array($result, MYSQLI_ASSOC))
{
	$test [$data['MaaleeID'] ] =
        array('Deformation' => $data['Deformation'],
				'Dato' => $data['Dato']
				);
}

echo "<pre>\n";
print_r($test);
echo "</pre>\n";   */

//foreach (item )








// create an array to feed all my results into
/*$multidim_array = array();

// get data one row at a time and push it into the array
while ($row = mysqli_fetch_array($result))
		array_push($multdim_array, $row);*/


//print_r($data);


/*foreach ($data as $elem)
{
      // Initialize a new element in the output if it doesn't already exist
      if (!isset($out[$elem['Dato']]))
      {
        $out[$elem['Dato'] = array(
          // Set the date keys...
          'Dato' => $elem['Dato'],
          // With the current value...
          'Deformation' => $elem['Deformation']
        );
             }

      else {
        $out[$elem['Dato']]['Deformation'] += $elem['Deformation'];
      }

             }*/



?>


</html>
