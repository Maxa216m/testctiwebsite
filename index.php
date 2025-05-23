<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Hallo Wereld!!!</title>
</head>
<body>
    <h1>Hallo wereld!!! :D</h1>

    <?php
    function databaseconnectie() {
        $host = "10.0.2.4";
        $user = "sqlmaximeadmin";
        $pass = "Welkom01!"; // Vul je wachtwoord in indien nodig
        $databasename = "testctidatabase";
        $port = 3306;

        $connection = mysqli_connect($host, $user, $pass, $databasename, $port);

        if (!$connection) {
            return false; // Verbinding mislukt
        }

        return $connection;
    }

    function databaseConnectieSluiten($conn) {
        if ($conn) {
            mysqli_close($conn);
        }
    }

    $conn = databaseconnectie();

    if (!$conn) {
        echo "<p style='color: red;'>❌ Er is geen verbinding met de database.</p>";
    } else {
        $query = "SELECT * FROM verbindingen";
        $result = mysqli_query($conn, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            echo "<table border='1'>";
            echo "<tr><th>Verbonden</th><th>Niet Verbonden</th></tr>";
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row['verbonden']) . "</td>";
                echo "<td>" . htmlspecialchars($row['niet_verbonden']) . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "<p>📭 Geen gegevens gevonden in de tabel.</p>";
        }

        databaseConnectieSluiten($conn);
    }
    ?>

</body>
</html>
