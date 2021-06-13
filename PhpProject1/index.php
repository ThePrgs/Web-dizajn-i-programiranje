<?php
$putanja = dirname($_SERVER['REQUEST_URI'], 2);
$direktorij = dirname(getcwd());

include 'sesija.class.php';
include 'baza.class.php';

Sesija::dajKorisnika();

if (!isset($_SESSION["uloga"])) {

    header("Location: pocetkaNRK.php");
}

if($_SESSION["uloga"]==3){
    header("Location: pocetnaRK.php");
}

if($_SESSION["uloga"]==2){
    header("Location: pocetnaMod.php");
}

if($_SESSION["uloga"]==1){
    header("Location: administratorPS.php");
}
?>
