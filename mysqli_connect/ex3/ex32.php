<!--Amb la BD world.sql

Crea un formulari per filtrar llengües a partir del nom de la llengua, però que no cal que coincideixi exactament amb el seu nom (pot ser una coincidència parcial).

Extreu un llistat amb:

Nom de la llengua. Només es poden repetir 1 cop, o màxim dos si hi estan oficials i no-oficials en diversos països (usant distinct).
Si és oficial posarem: [OFICIAL] , si no ho és, no posarem res.
NO s’ha de mostrar ni el país ni el percentatge.-->


<!-- NO ESTÁ HECHA!!!!!!!!!!!!! -->
 
<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fita 3 - ex 3.2 - Marta</title>
</head>
<body>

    <form method="POST">

        <label for="idiom">Idioma per buscar: </label>
        <input type="text" name="idiom" placeholder="Spanish"/>

        <input type="submit"/>

    </form>
    
    <?php

        $idiom = $_POST["idiom"];

        $conn = mysqli_connect('localhost','admin','admin');
 		mysqli_select_db($conn, 'mundo');

        $consulta = "SELECT * FROM city where ;";

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