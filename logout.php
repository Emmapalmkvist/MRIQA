<?php

session_start();

// Sluk alle session variablerne
$_SESSION = array();

// Destroy session
session_destroy();

// Omdiriger til log ind side
header("location: login.php");

exit;
?>
