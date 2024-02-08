<?php
include '../baza.php'; 

$wyniki = [];
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['imie_k'])) {
    $imie_k = $_GET['imie_k'] ?? '';
    $nazwisko_k = $_GET['nazwisko_k'] ?? '';
    $nazwa = $_GET['nazwa'] ?? '';
    $rozmiarcm = $_GET['wielkosc_pizzy'] ?? '';
    $data_zamowienia = $_GET['data_zamowienia'] ?? '';
    $uwagi = $_GET['uwagi'] ?? '';
    $query = "SELECT z.*, k.Imię, k.Nazwisko, p.Nazwa, p.Rozmiar
              FROM zamowienia z
              JOIN klienci k ON z.Id_klienta = k.Id_klienta
              JOIN menu p ON z.Id_pizzy = p.Id_pizzy
              WHERE (:imie_k = '' OR k.Imię LIKE :imie_k)
              AND (:nazwisko_k = '' OR k.Nazwisko LIKE :nazwisko_k)
              AND (:nazwa = '' OR p.Nazwa = :nazwa)
              AND (:wielkosc_pizzy = '' OR p.Rozmiar = :wielkosc_pizzy)
              AND (:data_zamowienia = '' OR z.Data_zamowienia = :data_zamowienia)
              AND (:uwagi = '' OR z.Uwagi LIKE :uwagi)";
    $stmt = $pdo->prepare($query);
    $stmt->execute([
        'imie_k' => '%' . $imie_k . '%',
        'nazwisko_k' => '%' . $nazwisko_k . '%',
        'nazwa' => $nazwa,
        'wielkosc_pizzy' => $rozmiarcm,
        'data_zamowienia' => $data_zamowienia,
        'uwagi' => '%' . $uwagi . '%'
    ]);
    $wyniki = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
$pdo = null;
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/main.css">
    <title>Pizzeria - Wyszukiwarka</title>
</head><body>
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
	<main>
        <h2 class="glownastrona">Wyszukiwanie zamówień</h2>
        <form class="glownastrona" action="wyszukiwanie.php" method="get">
            Imię Klienta: <input type="text" name="imie_k"><br>
            Nazwisko Klienta: <input type="text" name="nazwisko_k"><br>
            Nazwa Pizzy: <select name="nazwa">
                <option value="">Wszystkie</option>
                <option value="1">Ananasowa</option>
                <option value="2">Babciowa</option>
                <option value="3">Hawajska</option>
                <option value="4">Smaczna</option>
                <option value="5">Gigant</option>
                <option value="6">Mirko</option>
                <option value="7">Gwiezdna</option>
            </select><br>
            Wielkość Pizzy: <select name="wielkosc_pizzy">
                <option value="">Wszystkie</option>
                <option value="70">70cm</option>
                <option value="45">45cm</option>
                <option value="31">31cm</option>
                <option value="60">60cm</option>
                <option value="140">140cm</option>
                <option value="5">5cm</option>
                <option value="66">66cm</option>
            </select><br>
            Data Zamówienia: <input type="date" name="data_zamowienia"><br>
            Uwagi: <select name="uwagi">
                <option value="">Wszystkie</option>
                <option value="miejscu">Na miejscu</option>
                <option value="dowoz">Na wywóz</option>
                <option value="wynos">Na wynos</option>
           
            </select><br><br>
            <input type="submit" value="Wyszukaj">
        

      
        <?php
        if ($wyniki) {
            echo "<table border='1'>";
            echo "<tr><th>Imię</th><th>Nazwisko</th><th>Nazwa Pizzy</th><th>Rozmiar</th><th>Data Zamówienia</th><th>Uwagi</th></tr>";
            foreach ($wyniki as $row) {
                echo "<tr><td>".htmlspecialchars($row['Imię']) . "</td><td>" . htmlspecialchars($row['Nazwisko']) . "</td><td>" . htmlspecialchars($row['Nazwa']) . "</td><td>" . htmlspecialchars($row['Rozmiar']) . "</td><td>" . htmlspecialchars($row['Data_zamowienia']) . "</td><td>" . htmlspecialchars($row['Uwagi']) . "</td></tr>";
            }
            echo "</table>";
        } elseif ($_SERVER["REQUEST_METHOD"] == "GET") {
            echo "";
        }
        ?>
        </form>
        </div>
    </main>
    <div class="copyright">
            <p>2024. © Pizzeria XYZ</p>
</div>
</body>
</html>
