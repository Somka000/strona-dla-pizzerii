<?php
require '../baza.php';

if (isset($_POST['submit'])) {
    $sql = 'SELECT Count(IdAuta) FROM samochody WHERE IdAuta = :IdAuta';
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':IdAuta', $_POST['IdAuta'], PDO::PARAM_STR);
    $stmt->execute();
    $ilosc_id = $stmt->fetchColumn();

    if ($ilosc_id !== 0) {
        $setClause = '';
        $parameters = [];
        if (!empty($_POST['Marka'])) {
            $setClause .= 'Marka = :Marka, ';
            $parameters[':Marka'] = $_POST['Marka'];
        }

        if (!empty($_POST['Kolor'])) {
            $setClause .= 'Kolor = :Kolor, ';
            $parameters[':Kolor'] = $_POST['Kolor'];
        }

        if (!empty($_POST['NrRejestracyjny'])) {
            $setClause .= 'NrRejestracyjny = :NrRejestracyjny, ';
            $parameters[':NrRejestracyjny'] = $_POST['NrRejestracyjny'];
        }

        if (!empty($_POST['RokProdukcji'])) {
            $setClause .= 'RokProdukcji = :RokProdukcji, ';
            $parameters[':RokProdukcji'] = $_POST['RokProdukcji'];
        }

        if (!empty($_POST['Cena'])) {
            $setClause .= 'Cena = :Cena, ';
            $parameters[':Cena'] = $_POST['Cena'];
        }
        $setClause = rtrim($setClause, ', ');
        if (!empty($setClause)) {
            $sql1 = 'UPDATE samochody SET ' . $setClause . ' WHERE IdAuta = :IdAuta';
            $stmt1 = $pdo->prepare($sql1);
            $stmt1->bindValue(':IdAuta', $_POST['IdAuta'], PDO::PARAM_INT);

            foreach ($parameters as $key => $value) {
                $stmt1->bindValue($key, $value);
            }

            $stmt1->execute();

            $IdAuta = $_POST['IdAuta'];
            if ($stmt1->rowCount() > 0) {
                echo '<h3>Zaktualizowano dane auta o ID = ' . $IdAuta . '</h3>';
            } else {
                echo '<h3>Nie dokonano zmian</h3>';
            }
        } else {
            echo '<h3>Nie wprowadzono żadnych zmian</h3>';
        }
    } else {
        echo 'Podany samochód o ID nie istnieje.';
    }
}
?>
