<?php
$putanja = dirname($_SERVER['REQUEST_URI'], 2);
$direktorij = dirname(getcwd());

include 'sesija.class.php';
include 'baza.class.php';
$blokiran = false;
$veza = new Baza();
if (isset($_GET["submit2"])) {
    $veza->spojiDB();
    Sesija::dajKorisnika();
    $grad = $_GET['gradovi'];
    $naziv = $_GET['naziv'];
    $opis = $_GET['opis'];
    $godina = $_GET['godina'];
    $potvrda = $_GET['status'];
    $korisnikBaza = Sesija::dajKorisnika();
    $korisnikBazaJedan = $korisnikBaza[Sesija::KORISNIK];

    $upitZahtjev = "SELECT zahtjev_naziv from zahtjev;";

    $zahtjevi = $veza->selectDB($upitZahtjev);
    $postojeci = false;

    while ($red1 = mysqli_fetch_array($zahtjevi)) {
        if ($red1['zahtjev_naziv'] == $naziv) {
            $postojeci = true;
        }
    }

    $upitBlokiran = "SELECT korisnik_zahtjevBlokiran as blokiran from WebDiP2020x073.korisnik where korisnik_naziv='{$korisnikBazaJedan}';";
    $blokada = $veza->selectDB($upitBlokiran);

    while ($redBlok = mysqli_fetch_array($blokada)) {
        if ($redBlok['blokiran'] == 1) {
            $blokiran = true;
        }
    }

    if ($postojeci && !$blokiran) {
        $update = "UPDATE WebDiP2020x073.zahtjev SET zahtjev_status = '{$potvrda}' WHERE zahtjev_naziv='{$naziv}';";
    }

    if (!$postojeci && !$blokiran) {
        $update = "INSERT INTO WebDiP2020x073.zahtjev (zahtjev_lokacija, zahtjev_korisnik ,zahtjev_naziv, zahtjev_status, zahtjev_opis, zahtjev_godina) VALUES ('{$grad}', '{$_SESSION['uloga']}', '{$naziv}', '{$potvrda}','{$opis}','{$godina}')";
    }

    if (!$blokiran) {
        $veza->selectDB($update);
    }
    $veza->zatvoriDB();
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Pocetna</title>
        <meta charset="utf-8">       
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="naslov" content="Početna stranica za NRK">
        <meta name="autor" content="Josip Prga">
        <meta name="opis" content="Početna stranica za NRK naše web stranice">
        <meta name="kljucne_rijeci" content="pocetna, stranica, web, neregistrirani korisnik">      
        <link href="CSS/jprga.css" type = "text/css" rel = "stylesheet" id="stylesheet"/>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script type="text/javascript" src="javascript/jprga.js" defer></script>
        <script type="text/javascript" src="javascript/jprga_jquery.js" defer></script>
    </head>
    <body id="tijelo">
        <header>
            <a href="odjava.php"><p style="float:right">Odjava</p></a>

             <h1>Početna stranica</h1></a>
            <a href="#"><img src="multimedija/ikona_pristupacnosti.png" id="ikonaPoc" alt="pristupanost" width="20" style="float:right"/></a>
            <img src="multimedija/rss.png" alt="RSS" width="20" style="float:right"/>
            <img src="multimedija/twitter.png" alt="twitter" width="20" style="float:right"/>
            <img src="multimedija/instagram.png" alt="instgram" width="20" style="float:right" />


            
        </header>
        <nav>
            <ul>
                <li><a href="galerija.php">Galerija</a> </li>
                <li><a href="pocetkaNRK.php">Prijedlozi</a> </li>
                <li><a href="index.php">Pocetna</a> </li>

                

            </ul>
        </nav>

        <section id="prazniProstor">
             <div class="popup2"><span class="popuptext" id="myPopup0"></span></div>
        </section>
        <h2> Zahtjevi </h2><br>
        <section id="pocetak">
            <table id="tablica">
                <thead> <tr><th>Ime grada</th>
                        <th>Naziv znamenitosti</th>
                        <th>Status</th>
                        <th>Opis znamenitosti</th>
                        <th>Godina</th>
                    </tr>
                </thead><tbody>
                    <?php
                    $veza->SpojiDB();

                    $upit = "SELECT lokacija_grad as grad, zahtjev_naziv as naziv, zahtjev_status as status, zahtjev_opis as opis, zahtjev_godina as godina FROM WebDiP2020x073.lokacija, WebDiP2020x073.zahtjev where zahtjev_lokacija = lokacija_id;";
                    $rezultat = $veza->SelectDB($upit);



                    while ($red = mysqli_fetch_array($rezultat)) {
                        echo "<tr><td>" . $red['grad'] . "</td><td>" . $red['naziv'] . "</td><td>" . $red['status'] . "</td><td>" . $red['opis'] . "</td><td>" . $red['godina'] . "</td></tr>";
                    }

                    $veza->ZatvoriDB();
                    ?>
                </tbody></table></section>

        <section id="pocetakZahtjeva">

            <form name="pretraga" id="pretraga" method="get">
                <label for="gradPret">Grad:</label>
                <input name="gradPret" id="gradPret" type="text"/>
                <label for="znamenitostPret">Znamenitost</label>
                <input id="znamenitostPret" name="znamenitostPret" type="test"/>
                <input name="submitSortGrad" id="submitSortGrad" type="button" value="Sortiraj po gradu"/>
                <input name="submitSortZnam" id="submitSortZnam" type="button" value="Sortiraj po znamenitosti"/>
                <input name="submitPret" id="submitPret" type="button" value="Pretrazi"/>
                <input type="button" name="reset" id="reset" value="Reset"/>
            </form>
            <p>Dodaj</p>
            <form name="zahtjev" id="zahtjev" method="get" action="pocetnaRK.php">
                <label for="gradovi">Grad: </label>
                <select id="gradovi" name="gradovi" required="required">
<?php
$veza->SpojiDB();
$upitIdGrada = "SELECT lokacija_id as ID FROM WebDiP2020x073.lokacija WHERE lokacija_grad='{$_POST['gradTablica']}'";
$upit2 = "SELECT lokacija_grad as Grad, lokacija_id as ID FROM WebDiP2020x073.lokacija;";
$result = $veza->selectDB($upit2);
$rezultatGrad = $veza->selectDB($upitIdGrada);
if (!isset($_POST["tablicaSubmit"])) {
    echo "<option value='-1' selected='selected'>== Odaberi grad ==</option>";
} elseif (isset($_POST["tablicaSubmit"])) {
    while ($rowGrad = mysqli_fetch_array($rezultatGrad)) {
        echo "<option value='" . $rowGrad['ID'] . "'>" . $_POST['gradTablica'] . "</option>";
    }
}

while ($row = mysqli_fetch_array($result)) {
    echo "<option value='" . $row['ID'] . "'>" . $row['Grad'] . "</option>";
}
$veza->zatvoriDB();
?>
                </select>              
                <label for="naziv">Naziv: </label>
                <input id="naziv" name="naziv" type="text"  required="required" value="<?php if (isset($_POST["tablicaSubmit"])) echo $_POST["nazivTablica"] ?>"/>
                <label for="opis">Opis: </label>
                <input id="opis" name="opis" type="text"  value="<?php if (isset($_POST["tablicaSubmit"])) echo $_POST["opisTablica"] ?>"/>
                <label for="godina">Godina: </label>
                <input id="godina" name="godina"  type="text"/>
                <input type="radio" id="potvrdeno" name="status" required="required" value="Potvrdeno" >
                <label for="potvrdeno">Potvrdeno</label>
                <input type="radio" id="odbijeno" name="status" required="requred "value="Odbijeno">
                <label for="odbijeno">Odbijeno</label>
                <input name="submit2" type="submit" value="Dodaj" />


            </form>
        </section>
        <?php  if($blokiran){ echo "<p>Blokirani ste</p>";} ?>
        <h2> Prijedlozi </h2><br>
        </<section id="pocetak">;
<?php
if (isset($_GET["submitPret2"])) {
    $gradPret2 = $_GET['gradPret2'];
    $znamenitostPret2 = $_GET['znamenitostPret2'];

    $veza->SpojiDB();

    $upit = "SELECT lokacija_grad as grad, prijedlog_naziv as naziv, prijedlog_opis as opis, prijedlog_ime as ime FROM WebDiP2020x073.lokacija, WebDiP2020x073.prijedlog where prijedlog_grad = lokacija_id AND lokacija_grad = '{$gradPret2}' OR prijedlog_grad = lokacija_id AND prijedlog_naziv = '{$znamenitostPret2}' ;";
    $rezultat = $veza->SelectDB($upit);
} elseif (isset($_GET["submitSortGrad2"])) {
    $veza->SpojiDB();

    $upit = "SELECT lokacija_grad as grad, prijedlog_naziv as naziv, prijedlog_opis as opis, prijedlog_ime as ime FROM WebDiP2020x073.lokacija, WebDiP2020x073.prijedlog where prijedlog_grad = lokacija_id order by grad;";
    $rezultat = $veza->SelectDB($upit);
} elseif (isset($_GET["submitSortZnam2"])) {
    $veza->SpojiDB();

    $upit = "SELECT lokacija_grad as grad, prijedlog_naziv as naziv, prijedlog_opis as opis, prijedlog_ime as ime FROM WebDiP2020x073.lokacija, WebDiP2020x073.prijedlog where prijedlog_grad = lokacija_id order by naziv;";
    $rezultat = $veza->SelectDB($upit);
} else {
    $veza->SpojiDB();

    $upit = "SELECT lokacija_grad as grad, prijedlog_naziv as naziv, prijedlog_opis as opis, prijedlog_ime as ime FROM WebDiP2020x073.lokacija, WebDiP2020x073.prijedlog where prijedlog_grad = lokacija_id;";
    $rezultat = $veza->SelectDB($upit);
}

echo '<table id="prijedlozi">';
echo "<thead> <tr><th>Ime grada</th>
                <th>Naziv znamenitosti</th>
                <th>Opis znamenitosti</th>
                <th>Ime predlagatelja</th>
                </tr>
            </thead>";

while ($red = mysqli_fetch_array($rezultat)) {
    echo '<form name="tablicaform" id="tablicaForm" method="post" action="pocetnaRK.php">'
    . '<tr><td>' . $red['grad'] . "</td><td>" . $red['naziv'] . "</td><td>" . $red['opis'] . "</td><td>" . $red['ime'] . "</td><td>"
    . "<input type='hidden' id='gradTablica' name='gradTablica' value=" . $red['grad'] . ">"
    . "<input type='hidden' id='nazivTablica' name='nazivTablica' value='" . $red['naziv'] . "'>"
    . "<input type='hidden' id='opisTablica' name='opisTablica' value='" . $red['opis'] . "'>"
    . "<input type='hidden' id='imeTablica' name='imeTablica' value=" . $red['ime'] . ">"
    . "<input name='tablicaSubmit' type='submit' value='Potvrdi' /> </td></tr></form>";
}
echo "</table>";

$veza->ZatvoriDB();
?>
        </section>
        <section id="pocetakZahtjeva">
            <form name="pretraga" id="pretraga" method="get" action="pocetnaRK.php">
                <label for="gradPret2">Grad:</label>
                <input name="gradPret2" id="gradPret2" type="text"/>
                <label for="znamenitostPret2">Znamenitost</label>
                <input id="znamenitostPret2" name="znamenitostPret2" type="test"/>
                <input name="submitPret2" id="submitPret2" type="submit" value="Pretrazi"/>
                <input name="submitSortGrad2" id="submitSortGrad2" type="submit" value="Sortiraj po gradu"/>
                <input name="submitSortZnam2" id="submitSortZnam2" type="submit" value="Sortiraj po znamenitosti"/>
                <input type="submit" name="reset2" id="reset2" value="Reset"/>
            </form>
        </section>
        <footer>
            <a href="https://validator.w3.org/check?uri=http://barka.foi.hr/WebDiP/2020_projekti/WebDiP2020x073/pocetnaRK.php"><img src="multimedija/HTML5.png" width="50" alt="HTML5"/></a>
            <a href="https://jigsaw.w3.org/css-validator/validator?uri=http://barka.foi.hr/WebDiP/2020_projekti/WebDiP2020x073/CSS/jprga.css"><img src="multimedija/CSS3.png" width="50" alt="CSS3"/></a> 
            <a href="o_autoru.html"><p>&copy; 2021 Josip Prga</p></a>
            <a href="dokumentacija.html"><p>Dokumentacija</p></a>
        </footer>
    </body>
</html>

