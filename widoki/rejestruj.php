<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/kolorki.css">
    <title>Pizzeria - Statystyki</title>
</head>

<body>
<header>
<nav class="glownastrona">
            <ul>
                <li><a href="../index.php">Strona Główna</a></li>
                <li><a href="./Menu.php">Zamówienia</a></li>
                <li><a href="./wyszukiwanie.php">Wyszukiwarka</a></li>
                <li><a href="./staty.php">Statystyki</a></li>
                <li class="rejestracja"><a href="./rejestruj.php">Rejestracja</a></li>
            </ul>
        </nav>
        </header>
    <h2>Rejestracja</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label for="imie">Imię:</label><br>
        <input type="text" id="imie" name="imie" required><br>
        <label for="nazwisko">Nazwisko:</label><br>
        <input type="text" id="nazwisko" name="nazwisko" required><br><br>
        <input type="submit" value="Zarejestruj">
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $imie = $_POST["imie"];
        $nazwisko = $_POST["nazwisko"];
        echo "<h3>Zarejestrowano pomyślnie:</h3>";
        echo "<p>Imię: $imie</p>";
        echo "<p>Nazwisko: $nazwisko</p>";
    }
    ?>
</body>
<div class="copyright">
            <p>2024. © Pizzeria XYZ</p>
</div>
</html>
