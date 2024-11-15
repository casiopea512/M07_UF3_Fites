<!--Amb la BD world.sql: Llistat de ciutats filtrades per nombre d'habitants.-->
<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fita 3 - ex 3.1 - Marta</title>
</head>

<body>

    <form method="POST">

        <label for="min">Mínim: </label>
        <input type="number" name="min"/>

        <label for="max">Màxim: </label>
        <input type="number" name="max"/>

        <input type="submit"/>

    </form>
    
    <?php

        $min = $_POST["min"];
        $max = $_POST["max"];

 		$conn = mysqli_connect('localhost','admin','admin');
 		mysqli_select_db($conn, 'mundo');
 
        
 		$consulta = "SELECT * FROM city where population>= $min and population<= $max ORDER BY population DESC;";

 		$resultat = mysqli_query($conn, $consulta); 
		

 		if (!$resultat) {
     			$message  = 'Consulta invàlida: ' . mysqli_error($conn) . "\n";
     			$message .= 'Consulta realitzada: ' . $consulta;
     			die($message);
 		}
 	?>

    <table>
 	<!-- la capçalera de la taula l'hem de fer nosaltres -->
 	<thead><td colspan="4" align="center" bgcolor="cyan">Llistat de ciutats</td></thead>
 	<?php

		$count = 0;
		
 		# (3.2) Bucle while
 		while( ($registre = mysqli_fetch_assoc($resultat)) != null ) { # Te devuelve por diccionario y no por array.
 		
 			# els \t (tabulador) i els \n (salt de línia) son perquè el codi font quedi llegible
  
 			# (3.3) obrim fila de la taula HTML amb <tr>
 			echo "\t<tr>\n";
 
 			# (3.4) cadascuna de les columnes ha d'anar precedida d'un <td>
 			#	després concatenar el contingut del camp del registre
 			#	i tancar amb un </td>
			echo "\t\t<td>".$count."</td>\n";
 			echo "\t\t<td>".$registre["Name"]."</td>\n"; # El \t es para que el código al verlo en el navegaro sea legible
 			echo "\t\t<td>".$registre['CountryCode']."</td>\n";
 			echo "\t\t<td>".$registre["District"]."</td>\n";
 			echo "\t\t<td>".$registre['Population']."</td>\n";
 
 			# (3.5) tanquem la fila
 			echo "\t</tr>\n";

			$count ++;
 		}
 	?>
 	</table>	

</body>

</html>