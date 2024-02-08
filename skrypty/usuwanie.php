<?php
session_start(); 
include '../baza.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = $_POST['action'];
    if ($action == 'Usuń Zamówienie') {
        $id_zamowienia = $_POST['id_zamowienia_delete']; 
        $sql = "DELETE FROM zamowienia WHERE Id_zamowienia = :id_zamowienia";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['id_zamowienia' => $id_zamowienia]);

        if ($stmt->errorCode() == '00000') {
            $_SESSION['sukces'] = "Zamówienie zostało usunięte.";
        } else {
            $error = $stmt->errorInfo();
            $_SESSION['bład'] = "Błąd usuwania zamówienia: " . $error[2];
        }
        header('Location: ../widoki/Menu.php');
        exit;
    }
}
$pdo = null;
?>