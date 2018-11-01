<?
// sæt datointerval der ønskes notificationer for

$dtz = new DateTimeZone("Europe/Madrid"); //Your timezone
$now = new DateTime(date("Y-m-d"), $dtz);
$date1 = $now->format("Y-m-d");

$date = (new \DateTime())->modify('-1200 days'); // hardcode 1200 dage - skal tilpasses
$date2 = $date->format("Y-m-d");

?>
