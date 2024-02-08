<?php
include '../baza.php';
function getYearMonth($monthYear) {
    $parts = explode('-', $monthYear);
    $year = $parts[0];
    $month = $parts[1];
    return [$year, $month];
}
$selectedDay = $_GET['day'] ?? '';
$selectedMonth = $_GET['selectedMonth'] ?? '';
$topPizza = '';
if (isset($_GET['submit'])) {
    $statistic = $_GET['statistic'];
//dzien
    switch ($statistic) {
        case 'dailySales':
            if ($selectedDay) {
                $query = "SELECT Data_zamowienia, COUNT(*) as Ilosc, SUM(m.Cena) as Wartosc
                          FROM zamowienia z
                          JOIN menu m ON z.Id_pizzy = m.Id_pizzy
                          WHERE Data_zamowienia = :date
                          GROUP BY Data_zamowienia";
                $stmt = $pdo->prepare($query);
                $stmt->bindParam(':date', $selectedDay);
                $stmt->execute();
                $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            }
            break;
//miesiac
        case 'monthlySales':
            if ($selectedMonth) {
                list($year, $month) = getYearMonth($selectedMonth);
                $query = "SELECT YEAR(Data_zamowienia) as Rok, MONTH(Data_zamowienia) as Miesiac, COUNT(*) as Ilosc, SUM(m.Cena) as Wartosc
                          FROM zamowienia z
                          JOIN menu m ON z.Id_pizzy = m.Id_pizzy
                          WHERE YEAR(Data_zamowienia) = :year AND MONTH(Data_zamowienia) = :month
                          GROUP BY YEAR(Data_zamowienia), MONTH(Data_zamowienia)";
                $stmt = $pdo->prepare($query);
                $stmt->bindParam(':year', $year);
                $stmt->bindParam(':month', $month);
                $stmt->execute();
                $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            }
            break;
//dzien r
        case 'dailySizeSales':
            if ($selectedDay) {
                $query = "SELECT Data_zamowienia, m.Rozmiar, COUNT(*) as Ilosc, SUM(m.Cena) as Wartosc
                          FROM zamowienia z
                          JOIN menu m ON z.Id_pizzy = m.Id_pizzy
                          WHERE Data_zamowienia = :date
                          GROUP BY Data_zamowienia, m.Rozmiar";
                $stmt = $pdo->prepare($query);
                $stmt->bindParam(':date', $selectedDay);
                $stmt->execute();
                $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            }
            break;
//dzien r
        case 'monthlySizeSales':
            if ($selectedMonth) {
                list($year, $month) = getYearMonth($selectedMonth);
                $query = "SELECT YEAR(Data_zamowienia) as Rok, MONTH(Data_zamowienia) as Miesiac, m.Rozmiar, COUNT(*) as Ilosc, SUM(m.Cena) as Wartosc
                          FROM zamowienia z
                          JOIN menu m ON z.Id_pizzy = m.Id_pizzy
                          WHERE YEAR(Data_zamowienia) = :year AND MONTH(Data_zamowienia) = :month
                          GROUP BY YEAR(Data_zamowienia), MONTH(Data_zamowienia), m.Rozmiar";
                $stmt = $pdo->prepare($query);
                $stmt->bindParam(':year', $year);
                $stmt->bindParam(':month', $month);
                $stmt->execute();
                $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            }
            break;
//toppizza(najczestsza)
        case 'topPizza':
            if ($selectedMonth) {
                list($year, $month) = getYearMonth($selectedMonth);
                $query = "SELECT m.Nazwa as RodzajPizzy, COUNT(*) as Ilosc
                          FROM zamowienia z
                          JOIN menu m ON z.Id_pizzy = m.Id_pizzy
                          WHERE YEAR(Data_zamowienia) = :year AND MONTH(Data_zamowienia) = :month
                          GROUP BY m.Nazwa
                          ORDER BY Ilosc DESC
                          LIMIT 1";
                $stmt = $pdo->prepare($query);
                $stmt->bindParam(':year', $year);
                $stmt->bindParam(':month', $month);
                $stmt->execute();
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                $topPizza = $result['RodzajPizzy'] ?? '';
            }
            break;

        default:
            $results = [];
            break;
    }
}
?>
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
    <main>
    <form class="glownastrona" method="GET">
        <h1 class="sg">Statystyki Sprzedaży Pizzy</h1>


            <label for="statistic">Wybierz opcję:</label>
            <select id="statistic" name="statistic">
            <option value="">wybierz odpowiednią opcje</option>
                <option value="topPizza">Najczęściej sprzedawana pizza w wybranym miesiącu:</option>
                <option value="dailySales">Zliczanie ilości i wartości sprzedanej pizzy po każdym dniu</option>
                <option value="monthlySales">Zliczanie ilości i wartości sprzedanej pizzy po każdym miesiącu</option>
                <option value="dailySizeSales">Zliczanie ilości i wartości sprzedanej pizzy według rozmiaru pizzy po każdym dniu</option>
                <option value="monthlySizeSales">Zliczanie ilości i wartości sprzedanej pizzy według rozmiaru pizzy po każdym miesiącu</option>
            </select>
            <div id="dateInput" style="display: none;">
                <label for="day">Wybierz dzień:</label>
                <input type="date" id="day" name="day">
            </div>
            <div id="monthInput" style="display: none;">
                <label for="selectedMonth">Wybierz miesiąc:</label>
                <input type="month" id="selectedMonth" name="selectedMonth">
            </div>
            <input type="submit" name="submit" value="Pokaż Statystyki">
        <h2 class="sg">Wyniki:</h2>
        </form>
        <?php if (isset($results) && !empty($results)) : ?>
            <table class="sg" border="1">
                <tr>
                    <th>Data</th>
                    <th>Rozmiar</th>
                    <th>Ilość</th>
                    <th>Wartość</th>
                </tr>
                <?php foreach ($results as $row) : ?>
                    <tr>
                        <td><?= $row['Data_zamowienia'] ?? '' ?></td>
                        <td><?= $row['Rozmiar'] ?? '' ?></td>
                        <td><?= $row['Ilosc'] ?? '' ?></td>
                        <td><?= $row['Wartosc'] ?? '' ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php else : ?>
            <p></p>
        <?php endif; ?>
        <?php if ($topPizza) : ?>
            <h1 class="najczestsza">Najczęściej sprzedawana pizza w miesiącu:</h1>
            <div class="ramka">
            <p><?= $topPizza ?></p>
            </div>
        <?php endif; ?>
        <script src="../skrypty/elementystaty.js"></script>
    </main>
</body>
<div class="copyright">
            <p>2024. © Pizzeria XYZ</p>
</div>
</html>
