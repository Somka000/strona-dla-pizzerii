<?php
session_start();
include '../baza.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = $_POST['action'] ?? '';
    if ($action == 'Dodaj Zamówienie') {
        $imie = $_POST['imie'] ?? '';
        $nazwisko = $_POST['nazwisko'] ?? '';
        $id_pizzy = $_POST['id_pizzy'] ?? null;
        $adres = $_POST['adres'] ?? '';
        $Id_miejscowosc = $_POST['Id_miejscowosc'] ?? null;
        $uwagi = $_POST['uwagi'] ?? '';
        $data_zamowienia = date('Y-m-d');
        $sql = "SELECT Id_klienta 
        FROM klienci 
        WHERE Imię=:imie 
        AND Nazwisko=:nazwisko";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['imie' => $imie, 'nazwisko' => $nazwisko]);
        $klient = $stmt->fetch();
        if (!$klient) {
            $sql = "INSERT INTO klienci (Imię, Nazwisko) 
            VALUES (:imie, :nazwisko)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(['imie' => $imie, 'nazwisko' => $nazwisko]);
            $Id_klienta = $pdo->lastInsertId(); 
        } else {
            $Id_klienta = $klient['Id_klienta'] ??'';
        }
        $sql = "INSERT INTO zamowienia (Id_klienta, Id_pizzy, Data_zamowienia, Adres, Id_miejscowosc, Uwagi) 
        VALUES (:Id_klienta, :id_pizzy, :data_zamowienia, :adres, :Id_miejscowosc, :uwagi)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['Id_klienta' => $Id_klienta,'id_pizzy' => $id_pizzy,'data_zamowienia' => $data_zamowienia,'adres' => $adres,'Id_miejscowosc' => $Id_miejscowosc,'uwagi' => $uwagi]);
        if ($stmt->errorCode() == '00000') {
            $_SESSION['status_message'] = "Nowe zamówienie dodane.";
        } else {
            $error = $stmt->errorInfo();
            $_SESSION['status_message'] = "Wystąpił błąd: " . $error[2];
        }
        header('Location: ../widoki/Menu.php'); 
        exit;
    }
}
$pdo = null;
?>
