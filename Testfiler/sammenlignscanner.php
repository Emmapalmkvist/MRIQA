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
    <link rel="stylesheet" href="newstyle.css" />
     <meta charset="UTF-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
    body {
  background-color: #A6B9C0;
}
    </style>
<body>
    <!doctype html>
<html>
<head><title>Hjem</title></head>
<body>
<header>
      <h1>MRI-SCANNING - REGION MIDT</h1>
    </header>

    <div class="topnav">
            <a href ="nyhjemside.php" id="onlink">HJEM</a>
            <a href="overblikscannere.php">OVEBLIK OVER SCANNERE</a>
            <a class="active" href="sammenlignscanner.php">SAMMENLIGN SCANNERE</a>
        <li style="float:right"><a href="location: ../Logind/logud.php">LOG UD</a></li>
    </div>

    <body>

</body>
</html>
