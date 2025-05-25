<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Databaseverbinding</title>
</head>
<body>
    <h1>Database Status</h1>

    <?php
    // Verbinding maken met Azure SQL Database (sqlsrv-driver vereist)
    $serverName = "10.0.2.4,1433"; // IP + poort
    $connectionOptions = array(
        "Database" => "mijnsqldb123", // Let op: NIET "dbo.testctidatabase"
        "Uid" => "sqlmaximeadmin",
        "PWD" => "Welkom01!",
        "Encrypt" => true,
        "TrustServerCertificate" => true // Alleen voor testdoeleinden
    );

    $conn = sqlsrv_connect($serverName, $connectionOptions);

    if ($conn) {
        echo "<p style='color: green;'>✅ Connectie is gelukt.</p>";

        // Query uitvoeren
        $sql = "SELECT verbonden, niet_verbonden FROM verbindingen";
        $stmt = sqlsrv_query($conn, $sql);

        if ($stmt && sqlsrv_has_rows($stmt)) {
            echo "<table border='1'>";
            echo "<tr><th>Verbonden</th><th>Niet Verbonden</th></tr>";

            while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row['verbonden']) . "</td>";
                echo "<td>" . htmlspecialchars($row['niet_verbonden']) . "</td>";
                echo "</tr>";
            }

            echo "</table>";
        } else {
            echo "<p>📭 Geen gegevens gevonden in de tabel.</p>";
        }

        sqlsrv_free_stmt($stmt);
        sqlsrv_close($conn);
    } else {
        echo "<p style='color: red;'>❌ Verbindingsfout:</p>";
        die(print_r(sqlsrv_errors(), true));
    }
    ?>
</body>
</html>
