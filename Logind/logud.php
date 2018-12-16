<?php
// Koden i denne fil kommer fra hjemmesiden TutorialRepublic hentet den 24.09.2018 via følgende link: https://www.tutorialrepublic.com/php-tutorial/php-mysql-login-system.php.

session_start();

$_SESSION = array();

session_destroy();

// Omdiriger til log ind side
header("location: ../Logind/index.php");

exit;
?>
