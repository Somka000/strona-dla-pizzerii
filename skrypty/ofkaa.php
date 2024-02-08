<?php
session_start(); 
include '../baza.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = $_POST['action'];
    
    if ($action == 'Modyfikuj Zamówienie') {
        $id_zamowienia = $_POST['id_zamowienia_edit'];
        $imie_edit = $_POST['imie_edit'];
        $nazwisko_edit = $_POST['nazwisko_edit'];
        $id_pizzy = $_POST['id_pizzy_edit'];
        $adres = $_POST['adres_edit'];
        $Id_miejscowosc = $_POST['Id_miejscowosc_edit'];
        $uwagi = $_POST['uwagi_edit'];
        $sql = "SELECT Id_klienta FROM zamowienia WHERE Id_zamowienia = :id_zamowienia";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['id_zamowienia' => $id_zamowienia]);
        $zamowienie = $stmt->fetch();
        $sql = '';
        if ($zamowienie) {
            $id_klienta = $zamowienie['Id_klienta'];
            $sql = "UPDATE klienci SET Imię = :imie, Nazwisko = :nazwisko WHERE Id_klienta = :id_klienta";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(['imie' => $imie_edit, 'nazwisko' => $nazwisko_edit, 'id_klienta' => $id_klienta]);
            //$zamowienie = $stmt->fetch();
            if ($stmt->errorCode() == '00000') {
                $sql = "UPDATE zamowienia SET Id_pizzy = :id_pizzy, Adres = :adres, Id_miejscowosc = :Id_miejscowosc, Uwagi = :uwagi WHERE Id_zamowienia = :id_zamowienia";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([
                    'id_pizzy' => $id_pizzy,
                    'adres' => $adres,
                    'Id_miejscowosc' => $Id_miejscowosc,
                    'uwagi' => $uwagi,
                    'id_zamowienia' => $id_zamowienia
                ]);
                if ($stmt->errorCode() == '00000') {
                    $_SESSION['sukces'] = "Zamówienie zostało zaktualizowane.";
                } else {
                    $error = $stmt->errorInfo();
                    $_SESSION['bład'] = "Wystąpił błąd";
                }
            } else {
                $error = $stmt->errorInfo();
                $_SESSION['bład'] = "Błąd aktualizacji";
            }
        } else {
            $_SESSION['bład'] = "Nie znaleziono zamówienia o podanym ID.";
        }
        header('Location: ../widoki/Menu.php');    exit;}}$pdo = null;
?>