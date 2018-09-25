<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>

    <style type="text/css">
        body{ font: 14px sans-serif; text-align: center; }
    </style>
</head>
<body>
    <div class="page-header">
        <h1>Hi, <b><?php echo htmlspecialchars($_SESSION["Brugernavn"]); ?></b>. Welcome to our site.</h1>
    </div>
</body>
</html>
