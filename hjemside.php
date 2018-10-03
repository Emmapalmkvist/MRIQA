<?php

session_start();

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>


<!doctype html>
<html>
<head><title>Hjem</title></head>
<body>
<h1>MR-Scanning - Region Midt</h1>
<div class="tabContainer">
    <div class="buttonContainer">
        <button onclick="window.location.href='hjemside.php'">Hjem</button>
        <button onclick="window.location.href='sammenlignscanner.php'">Sammenlign Scannere</button>
        <button onclick="window.location.href='overblikscannere.php'">Overblik over Scannere</button>
    </div>
    <div class="tabPanel"></div>
    <div class="tabPanel"></div>
    <div class="tabPanel"></div>
    </div>
<?php
	echo'Hjem';
?>


    <script src="myScripttest.js"></script>
</body>
</html>
