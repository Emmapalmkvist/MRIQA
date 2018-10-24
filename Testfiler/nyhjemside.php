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
    <link rel="stylesheet" href="newstyle.css" />
     <meta charset="UTF-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; }
    </style>
</head>
<body>
 <h1>MR-Scanning - Region Midt</h1>
    <p>
        <a href="logout.php" class="btn btn-danger">Sign Out of Your Account
        </a>

    </p>
    <div class="topnav">
            <a class="active" href ="nyhjemside.php" id="onlink">HJEM</a>
            <a href="overblikscannere.php">OVEBLIK OVER SCANNERE</a>
            <a href="sammenlignscanner.php">SAMMENLIGN SCANNERE</a>
    </div>

    <div class="main_container">
        <?php
	echo'Hjem';
        ?>
    </div>

</body>
</html>
