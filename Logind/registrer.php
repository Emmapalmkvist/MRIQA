<?php
// Koden i denne fil kommer fra hjemmesiden TutorialRepublic hentet den 24.09.2018 via følgende link: https://www.tutorialrepublic.com/php-tutorial/php-mysql-login-system.php. Der er foretaget modificeringer ift. design og muligheder. Sprog er ændret til dansk.


// Inkluder adgangsfil
include "../Database/DB_adgang.php";

// Definer variable
$brugernavn = "";
$adgangskode = "";
$confirm_adgangskode = "";
$brugernavn_error = "";
$adgangskode_error = "";
$confirm_adgangskode_error = "";

// Behandling af data indtastet når "Opret" knappen trykkes på
if($_SERVER["REQUEST_METHOD"] == "POST")
{

    // Valider brugernavn, trim fjerner whitespace før og efter streng
    if(empty(trim($_POST["Brugernavn"])))
    {
        $brugernavn_error = "Indtast venligst brugernavn.";
    }
    else
    {
        // Select statement
        $sql = "SELECT id FROM Logind WHERE Brugernavn = ?";

        if($stmt = $mysqli->prepare($sql)){

            // Binder variable til "prepared statement" som parametre
            // "s" angiver type af den ene parameter (param_brugernavn), som er string
            $stmt->bind_param("s", $param_brugernavn);

            // Sæt parameters
            $param_brugernavn = trim($_POST["Brugernavn"]);

            // Execute prepared statement
            if($stmt->execute()){

                $stmt->store_result();

                // Check om brugernavn eksisterer
                if($stmt->num_rows == 1)
                {
                    $brugernavn_error = "Dette brugernavn eksisterer allerede. Vælg et andet.";
                }
                else
                {
                    $brugernavn = trim($_POST["Brugernavn"]);
                }
            }
            else
            {
                echo "Noget gik galt. Prøv igen.";
            }
        }

        // Luk statement
        $stmt->close();
    }

    // Valider adgangsskode
    if(empty(trim($_POST["Adgangskode"])))
    {
        $adgangskode_error = "Indtast venligst adgangskode.";
    }
    elseif(strlen(trim($_POST["Adgangskode"])) < 6)
    {
        $adgangskode_error = "Adgangskode skal bestå af mindst 6 tegn.";
    }
    else
    {
        $adgangskode = trim($_POST["Adgangskode"]);
    }

    // Valider "gentag adgangskode"
    if(empty(trim($_POST["confirm_adgangskode"])))
    {
        $confirm_password_err = "Bekræft adgangskode.";
    }
    else
    {
        $confirm_password = trim($_POST["confirm_password"]);

        if(empty($adgangskode_error) && ($adgangskode != $confirm_adgangskode))
        {
            $confirm_adgangskode_error = "Der er ikke match mellem adgangskoderne.";
        }
    }

    // Check at alle error variabler er tomme før data indsættet i db.
    if(empty($brugernavn_error) && empty($adgangskode_error) && empty($confirm_adgangskode_error))
    {

        // Insert statement
        $sql = "INSERT INTO Logind (Brugernavn, Adgangskode) VALUES (?, ?)";

        if($stmt = $mysqli->prepare($sql)){

            // Bind variabler til prepared statement som parametre
            // "ss" angiver to parametre af typen string
            $stmt->bind_param("ss", $param_brugernavn, $param_adgangskode);

            // Sæt parameters
            $param_brugernavn = $brugernavn;

            // Opret password hash: password_hash er en indbygget funtion i php
            $param_adgangskode = password_hash($adgangskode, PASSWORD_DEFAULT);

            // Execute prepared statement
            if($stmt->execute())
            {
                // Omdiriger til log ind side
                header("location: ..\Logind\index.php");
            } else
            {
                echo "Noget gik galt. Prøv igen.";
            }
        }

        // Close statement
        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Opret ny bruger</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; }
    </style>
</head>
<body>
    <div class="wrapper">
        <h2>Opret ny bruger</h2>
        <p>Udfyld formen nedenfor.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($brugernavn_error)) ? 'has-error' : ''; ?>">
                <label>Brugernavn:</label>
                <input type="text" name="Brugernavn" class="form-control" value="<?php echo $brugernavn; ?>">
                <span class="help-block"><?php echo $brugernavn_error; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($adgangskode_error)) ? 'has-error' : ''; ?>">
                <label>Adgangskode: </label>
                <input type="password" name="Adgangskode" class="form-control" value="<?php echo $adgangskode; ?>">
                <span class="help-block"><?php echo $adgangskode_error; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($confirm_adgangskode_error)) ? 'has-error' : ''; ?>">
                <label>Gentag adgangskode: </label>
                <input type="password" name="confirm_password" class="form-control" value="<?php echo $confirm_adgangskode; ?>">
                <span class="help-block"><?php echo $confirm_adgangskode_error; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Opret">
            </div>
            <p>Har du allerede en bruger? <a href="../Logind/index.php">Log ind</a></p>
        </form>
    </div>
</body>
</html>
