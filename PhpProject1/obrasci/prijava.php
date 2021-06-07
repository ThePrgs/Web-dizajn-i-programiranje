<?php
require '../sesija.class.php';
require '../baza.class.php';
Sesija::kreirajSesiju();
$blokiran = false;

if (isset($_GET["submit"])) {
    $veza = new Baza();
    $veza->spojiDB();


    $korime = $_GET['korime'];
    $lozinka = $_GET['lozinka'];
    if (isset($_GET['zapamtiMe'])) {
        $zapamtiMe = $_GET['zapamtiMe'];
    } else {
        $zapamtiMe = 0;
    }

    if ($zapamtiMe == 1) {
        $kukiNaziv = "user";
        $kukiValue = $korime;
        setcookie($kukiNaziv, $kukiValue);
    }



    $upit = "SELECT *FROM `korisnik` WHERE "
            . "`korisnik_naziv`='{$korime}' AND "
            . "`korisnik_lozinka`='{$lozinka}' AND `korisnik_blokiran`<3";

    $rezultat = $veza->selectDB($upit);

    $autenticiran = false;
    while ($red = mysqli_fetch_array($rezultat)) {
        if ($red) {
            $autenticiran = true;
            $veza->updateDB("UPDATE `webdip2020x073`.`korisnik` SET `korisnik_blokiran` = 0 WHERE (`korisnik_naziv` = '{$korime}');");
            $uloga = $red["tipkorisnika_id"];
            Sesija::kreirajKorisnika($korime, $uloga);
        }
    }
    $upitZaBlokiranje = "SELECT korisnik_blokiran FROM `korisnik` WHERE "
            . "`korisnik_naziv`='{$korime}' AND "
            . "`korisnik_lozinka`!='{$lozinka}'";

    $rezultatZaBlokiranje = $veza->selectDB($upitZaBlokiranje);

    while ($redZaBlok = mysqli_fetch_array($rezultatZaBlokiranje)) {
        if ($redZaBlok) {
            $blok = $redZaBlok['korisnik_blokiran'] + 1;
            $veza->updateDB("UPDATE `webdip2020x073`.`korisnik` SET `korisnik_blokiran` = '{$blok}' WHERE (`korisnik_naziv` = '{$korime}');");
        }
        if($redZaBlok['korisnik_blokiran']>3){
            $blokiran=true;
        }
    }


    $veza->zatvoriDB();

    if ($autenticiran && $uloga == 1) {
        header("Location: ../index.php");
    }

    if ($autenticiran && $uloga == 3) {
        header("Location: ../pocetnaRK.php");
    }

    if ($autenticiran && $uloga == 2) {
        header("Location: ../pocetnaMod.php");
    }
}
?>

<html>
    <head>
        <title>Prijava</title>
        <meta charset="utf-8">       
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="naslov" content="Prijavna stranica">
        <meta name="autor" content="Josip Prga">
        <meta name="opis" content="Prijavna stranica naše web stranice">
        <meta name="kljucne_rijeci" content="prijava, stranica, web">
        <meta http-equiv=”Refresh” content=”0;URL=https://http://barka.foi.hr/WebDiP/2020/zadaca_04/jprga/obrasci/prijava.php>
        <link href="../CSS/jprga.css" type = "text/css" rel = "stylesheet" id="stylesheet"/>
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js" defer></script>
        <script src="//code.jquery.com/jquery-1.12.4.js" defer></script>
        <script src="//code.jquery.com/ui/1.12.1/jquery-ui.js" defer></script>       
        <script type="text/javascript" src='../javascript/jprga_jquery.js' defer></script>
        <script src="../javascript/jprga.js" defer></script>

    </head>
    <body>

        <header>
            <a href="../odjava.php"><p style="float:right">Odjava</p></a>
            <a href="#pocetakPrijave"> <h1>Prijava</h1></a>

            <a href="#"><img src="../multimedija/ikona_pristupacnosti.png" id="ikonaPri" alt="pristupanost" width="20" style="float:right"/></a>
            <img src="../multimedija/rss.png" alt="RSS" width="20" style="float:right"/>
            <img src="../multimedija/twitter.png" alt="twitter" width="20" style="float:right"/>
            <img src="../multimedija/instagram.png" alt="instgram" width="20" style="float:right" />
        </header>
        <nav>
            <ul>
                <li><a href="../index.php">Početna</a></li>       
                <li><a href="registracija.php">Registracija</a> </li>

            </ul>
        </nav>
        <section id="pocetakPrijave">
            <form name="prijava" id="prijava" method="get" action=prijava.php>
                <label for="korime">Korsiničko ime: </label>
                <input id="korime" name="korime" value="<?php if (isset($_COOKIE['user'])) { echo $_COOKIE['user'];} else { echo '';} ?>" type="text" autofocus maxlength="15" size="15" /><br>
                <label for="lozinka">Lozinka: </label>
                <input id="lozinka" name="lozinka" type="password"  /><br>
                <label for="zapamtiMe">Zapamti me: </label>
                <input id="zapamtiMe" name="zapamtiMe" type="checkbox" value="1" /><br>
                <input name="submit" type="submit" value="Prijavi se" />

            </form>
            <?php if($blokiran){
                echo "<p>Vas racun je blokiran</p>";
            } ?>
            <a href="../Pomocni/zaboravljenaSifra.php"><p>Zaboravljena sifra?</p></a>
        </section>
        <footer>
            <a href="https://validator.w3.org/check?uri=http://barka.foi.hr/WebDiP/2020/zadaca_03/jprga/obrasci/prijava.html"><img src="../multimedija/HTML5.png" width="50" alt="HTML5"/></a>
            <a href="https://jigsaw.w3.org/css-validator/validator?uri=http://barka.foi.hr/WebDiP/2020/zadaca_03/jprga/CSS/jprga.css"><img src="../multimedija/CSS3.png" width="50" alt="CSS3"/></a>
            <a href="autor.html"><p>&copy; 2021 Josip Prga</p></a>
        </footer>   
    </body>
</html>