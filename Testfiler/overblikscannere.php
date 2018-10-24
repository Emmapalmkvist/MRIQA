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
    <title>Overblik over scannere</title>
    <link rel="stylesheet" href="stylecss.css" />
     <meta charset="UTF-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; }
    </style>
<body>
<h1>MR-Scanning - Region Midt</h1>
    <p>
        <a href="logout.php" class="btn btn-danger">Sign Out of Your Account</a>
    </p>
    <div class="nav_bar">
        <ul>
            <li><a href="nyhjemside.php">Hjem</a></li>
            <li><a href="overblikscannere.php"  id="onlink">Overblik over scannere</a></li>
            <li><a href="sammenlignscanner.php">Sammenlign scannere</a></li>
        </ul>
    </div>
    <div class="main_container">
        <?php
	echo'Overblik over scannere';
        ?>
    </div>

</body>
</html>