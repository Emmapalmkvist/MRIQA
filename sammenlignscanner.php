<?php

session_start();

// Check om bruger er logget ind
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>

<!doctype html>
<html>
    <title>Sammenlign scannere</title>
    <link rel="stylesheet" href="stylecss.css" />
<body>
    <!doctype html>
<html>
<head><title>Hjem</title></head>
<body>
<h1>MR-Scanning - Region Midt</h1>
    <p>
        <a href="logout.php" class="btn btn-danger">Sign Out of Your Account</a>
    </p>
    <div class="nav_bar">
        <ul>
            <li><a href="nyhjemside.php">Hjem</a></li>
            <li><a href="overblikscannere.php">Overblik over scannere</a></li>
            <li><a href="sammenlignscanner.php" id="onlink">Sammenlign scannere</a></li>
        </ul>
    </div>
    <div class="main_container">
        <?php
	echo'Sammenlign scannere';
        ?>
    </div>


</body>
</html>
