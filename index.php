<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Databaseverbinding</title>
</head>
<body>
    <h1>Database Status</h1>

    <?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    $conn = mysqli_connect("10.0.2.4", "sqlmaximeadmin", "Welkom01!", "testctidatabase", 3306);
    echo "<p style='color: green;'>✅ Connectie is gelukt.</p>";

    // Query uitvoeren
    $result = mysqli_query($conn, "SELECT * FROM verbindingen");

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

    mysqli_close($conn);

} catch (mysqli_sql_exception $e) {
    echo "<p style='color: red;'>❌ Databasefout: " . htmlspecialchars($e->getMessage()) . "</p>";
}
?>



</body>
</html>
