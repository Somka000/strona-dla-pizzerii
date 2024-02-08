<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/main.css">
    <title>Pizzeria - strona</title>
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
    <?php
    ?>
    <main>
        <form class="glownastrona" action="../skrypty/ofka.php" method="post">
            <h2 class="sg">Dodaj Zamówienie</h2>
            Imię: <br><input type="text" name="imie"><br>
            Nazwisko: <br><input type="text" name="nazwisko"><br>
            Wybierz Pizzę:<br>
            <select class="" name="id_pizzy">
                <option value="1">Ananasowa 70cm</option>
                <option value="2">Babciowa 45cm</option>
                <option value="3">Hawajska 31cm</option>
                <option value="4">Smaczna 60cm</option>
                <option value="5">Gigant 140cm</option>
                <option value="6">Mirko 5cm</option>
                <option value="7">Gwiezdna 66cm</option>
            </select><br>
            Adres: <br><input type="text" name="adres"><br>
            Miejscowość:<br>
            <select name="Id_miejscowosc">
                <option value="1">Grzybowo</option>
                <option value="2">Paryż</option>
                <option value="3">Kraków</option>
                <option value="4">Berlin</option>
                <option value="5">Ulały</option>
            </select><br>
            Uwagi: <br><select name="uwagi">
                <option value="wynos">Na wynos</option>
                <option value="miejscu">Na miejscu</option>
                <option value="dowoz">Na dowoz</option>
            </select><br>
            <input type="hidden" name="action" value="Dodaj Zamówienie">
            <input type="submit" value="Dodaj Zamówienie">
        </form>
        <form class="glownastrona" action="../skrypty/usuwanie.php" method="post">
    <h2 class="sg">Usuń Zamówienie</h2>
    Id Zamówienia: <br><input type="number" name="id_zamowienia_delete"><br>
    <input type="hidden" name="action" value="Usuń Zamówienie">
    <input type="submit" value="Usuń Zamówienie">
</form>
        <form class="glownastrona" action="../skrypty/ofkaa.php" method="post">
        <h2 class="sg">Modyfikuj Zamówienie</h2>
            Id Zamówienia: <br><input type="number" name="id_zamowienia_edit" required><br>
            Imię: <br><input type="text" name="imie_edit"><br>
            Nazwisko: <br><input type="text" name="nazwisko_edit"><br>
            Wybierz Pizzę:<br>
            <select name="id_pizzy_edit">
              <option value="1">Ananasowa 70cm</option>
                <option value="2">Babciowa 45cm</option>
                <option value="3">Hawajska 31cm</option>
                <option value="4">Smaczna 60cm</option>
                <option value="5">Gigant 140cm</option>
                <option value="6">Mirko 5cm</option>
                <option value="7">Gwiezdna 66cm</option>
            </select><br>
            Adres: <br><input type="text" name="adres_edit"><br>
            Miejscowość:<br>
            <select name="Id_miejscowosc_edit">
                <option value="1">Grzybowo</option>
                <option value="2">Paryż</option>
                <option value="3">Kraków</option>
                <option value="4">Berlin</option>
                <option value="5">Ulały</option>
            </select><br>
            Uwagi: <br><select name="uwagi_edit">
                <option value="wynos">Na wynos</option>
                <option value="miejscu">Na miejscu</option>
                <option value="dowoz">Na dowóz</option>
            </select><br>
            <input type="hidden" name="action" value="Modyfikuj Zamówienie">
            <input type="submit" value="Modyfikuj Zamówienie">
        </form>

    </main>
    <div class="copyright">
            <p>2024. © Pizzeria XYZ</p>
</div>
</body>

</html> 