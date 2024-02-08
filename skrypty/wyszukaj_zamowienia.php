<?php
include '../baza.php';


$imie_k = $_GET['imie_k'] ?? '';
$nazwisko_k = $_GET['nazwisko_k'] ?? '';
$nazwa = $_GET['nazwa'] ?? '';
$data_zamowienia = $_GET['data_zamowienia'] ?? '';
$rozmiarcm = $_GET['wielkosc_pizzy'] ?? '';


$query = "SELECT z.*, k.Imię, k.Nazwisko, p.Nazwa, p.Rozmiar FROM zamowienia z JOIN klienci k ON z.Id_klienta = k.Id_klienta JOIN menu p ON z.Id_pizzy = p.Id_pizzy WHERE (:imie_k = '' OR k.Imię LIKE :imie_k) AND (:nazwisko_k = '' OR k.Nazwisko LIKE :nazwisko_k) AND (:nazwa = '' OR p.Nazwa = :nazwa) AND (:wielkosc_pizzy = '' OR p.Rozmiar = :wielkosc_pizzy) AND (:data_zamowienia = '' OR z.Data_zamowienia = :data_zamowienia)";

$stmt = $pdo->prepare($query);
$stmt->execute([
    'imie_k' => '%' . $imie_k . '%',
    'nazwisko_k' => '%' . $nazwisko_k . '%',
    'nazwa' => $nazwa,
    'wielkosc_pizzy' => $rozmiarcm,
    'data_zamowienia' => $data_zamowienia
]);


echo "<h2>Wyniki Wyszukiwania</h2>";
$wyniki = $stmt->fetchAll(PDO::FETCH_ASSOC);
if ($wyniki) {
    echo "<table border='1'>";
    echo "<tr><th>Imię</th><th>Nazwisko</th><th>Nazwa Pizzy</th><th>Rozmiar</th><th>Data Zamówienia</th></tr>";
    foreach ($wyniki as $row) {
        echo "<tr><td>" . htmlspecialchars($row['Imię']) . "</td><td>" . htmlspecialchars($row['Nazwisko']) . "</td><td>" . htmlspecialchars($row['Nazwa']) . "</td><td>" . htmlspecialchars($row['Rozmiar']) . "</td><td>" . htmlspecialchars($row['Data_zamowienia']) . "</td></tr>";
    }
    echo "</table>";
} else {
    echo "Nie znaleziono wyników.";
}

$pdo = null;
?>