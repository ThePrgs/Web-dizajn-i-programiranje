<?php

require 'sesija.class.php';
require 'baza.class.php';
Sesija::dajKorisnika();

Sesija::obrisiSesiju();

header("Location: pocetkaNRK.php");



?>
