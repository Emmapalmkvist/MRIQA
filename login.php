<?php

 session_start();


// Inkluder fil med adgang til server/db
require_once "DB_adgang.php";

// Definer variable
$brugernavn = "";
$bdgangskode = "";
$brugernavn_error = "";
$adgangskode_error = "";

// Behandling af data indtastet når "Log ind" knappen trykkes på
if($_SERVER["REQUEST_METHOD"] == "POST")
{

    // Check om brugernavn er tom
    if(empty(trim($_POST["Brugernavn"]))){
        $brugernavn_error = "Indtast venligst brugernavn.";
    }
    else
    {
        $brugernavn = trim($_POST["Brugernavn"]);
    }

    // Check om adgangskode er tom
    if(empty(trim($_POST["Adgangskode"]))){
        $adgangskode_error = "Indtast venligst adgangskode.";
    }
    else
    {
        $adgangskode = trim($_POST["Adgangskode"]);
    }

    // Valider oplysninger: hvis "error" variablerne er tomme, så er der indtastet data i brugernavn- og adgangskode felterne
    if(empty($brugernavn_error) && empty($adgangskode_error)){

        // Select statement
        $sql = "SELECT id, Brugernavn, Adgangskode FROM Logind WHERE Brugernavn = ?";

        // Forbereder et statement for execution og returnere et statement objekt
        if($stmt = $mysqli->prepare($sql))
        {

            // Binder variable til "prepared statement" som parametre
            // "s" angiver type af den ene parameter (param_username), som er string
            $stmt->bind_param("s", $param_brugernavn);

            // Sæt parametre
            $param_brugernavn = $brugernavn;

            // Execute prepared statement
            if($stmt->execute())
            {
                $stmt->store_result();

                // Check om brugernavn eksisterer
                if($stmt->num_rows == 1)
                {
                    // Bind resulater
                    $stmt->bind_result($id, $brugernavn, $hashed_password);
                    if($stmt->fetch())
                    {
                        // Anvend indbygget php funktion: "password_verify"
                        if(password_verify($adgangskode, $hashed_password))
                        {

                            session_start();

                            // Gem data fre session
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["Brugernavn"] = $brugernavn;

                            // Direct bruger til ny side
                            header("location: nyhjemside.php");
                        }
                        else
                        {
                            // Angiv fejl, hvis password er forkert men indikerer ikke at det er password. Kan også være brugernavn
                            $adgangskode_error = "Adgangskoden eller brugernavn er ikke gyldig.";
                            $brugernavn_error = "Adgangskoden eller brugernavn er ikke gyldig.";
                        }
                    }

                }
                else
                {
                    // Angiv fejl, hvis password er forkert men indikerer ikke at det er password. Kan også være brugernavn
                    $brugernavn_error = "Adgangskoden eller brugernavn er ikke gyldig.";
                    $adgangskode_error = "Adgangskoden eller brugernavn er ikke gyldig.";
                }
            }
            else echo "Fejl er opstået. Prøv igen.";
        }

        // Luk statement
        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Log ind</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; }
    </style>
</head>
<body>
    <div class="wrapper">
        <h2>Log ind til MRI-kvalitetssikringssystem</h2>
        <p>Udfyld venligst dine log ind oplysninger nedenfor.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

            <div class="form-group <?php echo (!empty($brugernavn_error)) ? 'has-error' : ''; ?>">

                <label>Brugernavn: </label>
                <input type="text" name="Brugernavn" class="form-control" value="<?php echo $brugernavn; ?>">
                <span class="help-block"><?php echo $brugernavn_error; ?></span>

            </div>
            <div class="form-group <?php echo (!empty($adgangskode_error)) ? 'has-error' : ''; ?>">

                <label>Adgangskode: </label>
                <input type="password" name="Adgangskode" class="form-control">
                <span class="help-block"><?php echo $adgangskode_error; ?></span>

            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Log ind">
            </div>

        </form>
    </div>
</body>
</html>
