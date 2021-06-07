<?php
$putanja = dirname($_SERVER['REQUEST_URI'], 2);
$direktorij = dirname(getcwd());

include '../sesija.class.php';
include '../baza.class.php';
$postojeci = false;
$lozinkeIste = false;
$captchaDobra =false;
$capcha = rand();
$veza = new Baza();


if (isset($_POST['korimeReg'])) {
    $veza->spojiDB();
    Sesija::dajKorisnika();
    $korimeReg = $_POST['korimeReg'];
    $email = $_POST['email'];
    $lozinka1 = $_POST['lozinka1'];
    $lozinka2 = $_POST['lozinka2'];
    $captchaUnesena = $_POST['captcha'];

    $query = "select count(*) as cntUser from webdip2020x073.korisnik where korisnik_naziv='" . $korimeReg . "'";

    $result = $veza->selectDB($query);
    if ($lozinka1 != $lozinka2) {
        $lozinkeIste = true;
    }
    
    if($captchaUnesena == $capcha){
        $captchaDobra=true;
        echo "radi";
    }
    
    if (mysqli_num_rows($result)) {
        $row = mysqli_fetch_array($result);

        $count = $row['cntUser'];

        if ($count > 0) {
            $postojeci = true;
        }

        if ($count == 0 && $korimeReg != "" && !$lozinkeIste && $captchaDobra) {
            $dodaj = "INSERT INTO KORISNIK (tipkorisnika_id, korisnik_email, korisnik_naziv, korisnik_lozinka) VALUES ('3', '{$email}', '{$korimeReg}', '{$lozinka1}')";
            $veza->selectDB($dodaj);
        }
    }
   

    $veza->zatvoriDB();
}
?>