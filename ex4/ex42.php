<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fita 4 - ex 4.2 - Marta</title>
</head>
<body>
    <h1>Selecciona països per veure les seves ciutats</h1>

    <!-- mostrar elecciones -->
    <?php

        $conn = mysqli_connect('localhost','admin','admin');
        mysqli_select_db($conn, 'mundo');

        $consulta = "select Continent from country group by Continent;";
        $resultat = mysqli_query($conn, $consulta); 

        if (!$resultat) {
            $message  = 'Consulta 1 invàlida: ' . mysqli_error($conn) . "\n";
            $message .= 'Consulta 1 realitzada: ' . $consulta;
            die($message);
        }
    ?>

    <form method="post">
        <?php
            while (($registre = mysqli_fetch_assoc($resultat)) != null) {
                $continent = strtolower($registre['Continent']);
                $continentCapitalized = ucfirst($continent);
                echo "<input type='checkbox' name='continent[]' value=$continent> $continentCapitalized </option>";
            }
        ?>
        <input type="submit">
    </form>
    

    <!-- mostrar resultados -->
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["continent"])) {
        // Recoger los continentes seleccionados
        $selectedContinents = $_POST["continent"];

        // Realizar consulta para cada continente seleccionado
        foreach ($selectedContinents as $continent) {
            // Asegurarse que el continente esté en minúsculas para la consulta
            $continent = strtolower($continent);
            
            // Consulta para obtener los países de cada continente
            $consulta = "SELECT Name FROM country WHERE Continent = '$continent';";
            $resultat = mysqli_query($conn, $consulta);

            if (!$resultat) {
                $message  = 'Consulta invàlida: ' . mysqli_error($conn) . "\n";
                $message .= 'Consulta realitzada: ' . $consulta;
                die($message);
            }

            // Mostrar los países en una lista
            echo "<h3>Països del continent " . ucfirst($continent) . ":</h3>";
            echo "<ul>";
            while (($registre = mysqli_fetch_assoc($resultat)) != null) {
                echo "<li>" . htmlspecialchars($registre["Name"]) . "</li>";
            }
            echo "</ul>";
        }
    }
    ?>

    
</body>
</html>