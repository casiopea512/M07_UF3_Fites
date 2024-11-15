<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fita 4 - ex 4.1 - Marta</title>
</head>
<body>

    <h1>Selecciona un pais per veure les seves ciutats</h1>

    <?php

    $conn = mysqli_connect('localhost','admin','admin');
    mysqli_select_db($conn, 'mundo');

    $consulta = "SELECT Continent FROM country GROUP BY Continent";
    $resultat = mysqli_query($conn, $consulta); 

    if (!$resultat) {
        $message  = 'Consulta 1 invàlida: ' . mysqli_error($conn) . "\n";
        $message .= 'Consulta 1 realitzada: ' . $consulta;
        die($message);
    }

    // Obtener la opción seleccionada si se ha enviado el formulario
    $continentSeleccionado = $_POST["selectedOption"] ?? '';
    ?>


    <form method="POST">
        <select name="selectedOption" id="dropdown">
            <?php
                echo "<option value=' '</option>";
                while (($registre = mysqli_fetch_assoc($resultat)) != null) {
                    $continent = $registre['Continent'];
                    // Verificar si este continente es el seleccionado y agregar `selected` si es así
                    $selected = ($continent == $continentSeleccionado) ? 'selected' : '';
                    echo "<option value='$continent' $selected>$continent</option>";
                }
            ?>
        </select>
        <input type="submit"/>

    </form>
    
    <?php

        $continent = $_POST["selectedOption"];
        //echo "Has seleccionado: " .$continent;

        $consulta = "SELECT Name,Continent FROM country WHERE Continent='$continent';";

 		$resultat = mysqli_query($conn, $consulta); 
		

 		if (!$resultat) {
     			$message  = 'Consulta invàlida: ' . mysqli_error($conn) . "\n";
     			$message .= 'Consulta realitzada: ' . $consulta;
     			die($message);
 		}

        echo '<ul>';

        while( ($registre = mysqli_fetch_assoc($resultat)) != null ) {
            echo "\t\t<li>".$registre["Name"]."</li>\n";
        }

        echo '</ul>';

    ?>

</body>
</html>