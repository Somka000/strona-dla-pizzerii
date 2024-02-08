<?php
session_start();
require '../baza.php';
require 'loguj_u_s.php';

// Sprawdzenie czy sesja istnieje
if (isset($_SESSION['sesja'])) {
    // Usunięcie sesji
    unset($_SESSION['sesja']);
    
    // Przekierowanie na stronę "index.html"
	header('Location: ../widoki/login.php');
    exit; // Upewnij się, że zakończysz skrypt po przekierowaniu
} else {
	header('Location: ../widoki/login.php');
	
}
?>