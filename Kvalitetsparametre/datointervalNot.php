<?php
// sæt datointerval der ønskes notifications for

$dtz = new DateTimeZone("Europe/Madrid"); //Your timezone
$now = new DateTime(date("Y-m-d"), $dtz);
$date1 = $now->format("Y-m-d");

$date = (new \DateTime())->modify('-1000 days'); // hardcode 7 dage - skal tilpasses
$date2 = $date->format("Y-m-d");

?>
