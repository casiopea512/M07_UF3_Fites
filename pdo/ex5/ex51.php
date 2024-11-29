<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fita 5 - ex 5.1 - Marta cpErik2024</title>
    <style>

        table,
        td {
            border: 1px solid black;
            border-spacing: 0px;
        }

    </style>
</head>

<body>
    <?php
    echo "\t<form method='POST'>\n";
    echo "\t\t<input type='text' name='country' id='country' value=''>\n";
    echo "\t\t<input type='submit'>\n";

    echo "\t</form>\n";

    ?>
    </table>

    <?php
    if (isset($_POST["country"])) {
        $country_selected = $_POST["country"];

        try {
            $hostname = "localhost";
            $dbname = "mundo";
            $username = "admin";
            $pw = "admin";
            $pdo = new PDO("mysql:host=$hostname;dbname=$dbname", "$username", "$pw");
        } catch (PDOException $e) {
            echo "Failed to get DB handle: " . $e->getMessage() . "\n";
            exit;
        }
        $query = $pdo->prepare("SELECT city.Name FROM city JOIN country ON city.CountryCode = country.Code WHERE country.Name LIKE('%$country_selected%') ORDER BY city.Name ASC;");
        $query->execute();

        echo "<table>\n";
        $row = $query->fetch();


        while ($row) {
            echo "\t<tr>\n";
            echo "\t\t<td>" . $row["Name"] . "</td>\n";
            echo "\t</tr>\n";
            $row = $query->fetch();
        }
        echo "</table>\n";
        unset($pdo);
        unset($query);
    }
    ?>

</body>

</html>