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
<head>
    <title>Hjem</title>
    <link rel="stylesheet" href="stylecss.css" />
</head>
<body>
 <h1>MR-Scanning - Region Midt</h1>
    <p>
        <a href="logout.php" class="btn btn-danger">Sign Out of Your Account
        </a>

    </p>
    <div class="nav_bar">
        <ul>
            <li><a href="nyhjemside.php" id="onlink">Hjem</a></li>
            <li><a href="overblikscannere.php">Overblik over scannere</a></li>
            <li><a href="sammenlignscanner.php">Sammenlign scannere</a></li>
        </ul>
    </div>

    <div class="main_container">
        <?php
	echo'Hjem';
        ?>
    </div>

</body>
</html>
