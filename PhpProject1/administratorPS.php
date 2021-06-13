<?php
$putanja = dirname($_SERVER['REQUEST_URI'], 2);
$direktorij = dirname(getcwd());

include 'sesija.class.php';
include 'baza.class.php';

$veza = new Baza();
$postojeci = false;
if (isset($_GET['submit3'])) {
    $grad = $_GET['grad'];
    $drzava = $_GET['drzava'];
    $veza->spojiDB();

    $upit = "SELECT lokacija_grad as Grad, lokacija_drzava as Drzava FROM WebDiP2020x073.lokacija;";
    $rezultat = $veza->selectDB($upit);

    while ($red = mysqli_fetch_array($rezultat)) {
        if ($red['Grad'] == $grad && $red['Drzava'] == $drzava) {
            $postojeci = true;
        }
    }

    if (!$postojeci) {
        $unos = "INSERT INTO WebDiP2020x073.lokacija (lokacija_grad, lokacija_drzava) VALUES ('{$grad}','$drzava');";
    } else {
        $unos = "UPDATE WebDiP2020x073.lokacija SET lokacija_grad='{$grad}' WHERE lokacija_drzava='{$drzava}';";
    }

    $veza->updateDB($unos);
    $veza->zatvoriDB();
}

if (isset($_GET["submitDodjela"])) {
    $gradDodjela = $_GET['gradovi'];
    $korisnik = $_GET['korisnici'];
    $veza->spojiDB();
    $vecDodjeljen = false;

    $upitProvjere = "SELECT lokacija_korisnik as Korisnik, lokacija_grad as Grad from WebDiP2020x073.lokacija WHERE lokacija_grad='{$gradDodjela}';";
    $rezultatProvjere = $veza->selectDB($upitProvjere);
    while ($red = mysqli_fetch_array($rezultatProvjere)) {
        if ($red['Korisnik'] == $korisnik) {
            $vecDodjeljen = true;
        }
    }



    if (!$vecDodjeljen) {

        $dodjela = "UPDATE lokacija SET lokacija_korisnik='{$korisnik}' WHERE lokacija_id='{$gradDodjela}';";
        $veza->updateDB($dodjela);
    }

    $veza->zatvoriDB();
}
if (isset($_GET["submitDodjelaMod"])) {

    $korisnik = $_GET['korisnici'];
    $veza->spojiDB();

    $dodjela = "UPDATE korisnik SET tipkorisnika_id=2 WHERE korisnik_id='{$korisnik}';";
    $veza->updateDB($dodjela);


    $veza->zatvoriDB();
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Pocetna</title>
        <meta charset="utf-8">       
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="naslov" content="Pocetna">
        <meta name="autor" content="Josip Prga">
        <meta name="opis" content="Početna stranica za Admine naše web stranice">
        <meta name="kljucne_rijeci" content="pocetna, stranica, web, neregistrirani korisnik">      
        <link href="CSS/jprga.css" type = "text/css" rel = "stylesheet" id="stylesheet"/>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script type="text/javascript" src="javascript/jprga.js" defer></script>
        <!--<script type="text/javascript" src="javascript/jprga_jquery.js"></script>-->
    </head>
    <body id="tijelo">
        <header>
            <a href="odjava.php"><p style="float:right">Odjava</p></a>
            <h1>Pocetna</h1>
            <a href="#"><img src="multimedija/ikona_pristupacnosti.png" id="ikonaPoc" alt="pristupanost" width="20" style="float:right"/></a>
            <img src="multimedija/rss.png" alt="RSS" width="20" style="float:right"/>
            <img src="multimedija/twitter.png" alt="twitter" width="20" style="float:right"/>
            <img src="multimedija/instagram.png" alt="instgram" width="20" style="float:right" />



        </header>
        <nav>
            <ul>
                <li><a href="galerija.php">Galerija</a> </li>
                <li><a href="pocetnaMod.php">Moderator</a> </li>

                <li><a href="Pomocni/BlokiranjeRacuna.php">Upravljanje racunima</a> </li>

            </ul>
        </nav>

        <section id="prazniProstor">
            <div class="popup2"><span class="popuptext" id="myPopup0"></span></div>
        </section>

        <h2> Gradovi </h2><br>
        <section id="pocetak">

            <table id="tablica">
                <thead> <tr><th>Grad</th>
                        <th>Drzava</th>
                        <th>Korisnik</th>          
                    </tr>
                </thead><tbody>
<?php
if (isset($_GET['submitSortKori'])) {

    $veza->SpojiDB();

    $upit = "SELECT lokacija_grad as Grad, lokacija_drzava as Drzava, korisnik_naziv as Korisnik FROM WebDiP2020x073.lokacija, WebDiP2020x073.korisnik where lokacija_korisnik=korisnik_id order by Korisnik;";
    $rezultat = $veza->SelectDB($upit);
} elseif (isset($_GET['submitSortGrad'])) {

    $veza->SpojiDB();

    $upit = "SELECT lokacija_grad as Grad, lokacija_drzava as Drzava, korisnik_naziv as Korisnik FROM WebDiP2020x073.lokacija, WebDiP2020x073.korisnik where lokacija_korisnik=korisnik_id order by Grad;";
    $rezultat = $veza->SelectDB($upit);
} elseif (isset($_GET['submitPret'])) {

    $korisnikBaza = $_GET['korisnikPret'];
    $grad = $_GET['gradPret'];
    $veza->SpojiDB();

    $upit = "SELECT lokacija_grad as Grad, lokacija_drzava as Drzava, korisnik_naziv as Korisnik FROM WebDiP2020x073.lokacija, WebDiP2020x073.korisnik where lokacija_korisnik=korisnik_id and korisnik_naziv='{$korisnikBaza}' or lokacija_korisnik=korisnik_id and lokacija_grad='{$grad}';";
    $rezultat = $veza->SelectDB($upit);
} else {

    $veza->SpojiDB();

    $upit = "SELECT lokacija_grad as Grad, lokacija_drzava as Drzava, korisnik_naziv as Korisnik FROM WebDiP2020x073.lokacija, WebDiP2020x073.korisnik where lokacija_korisnik=korisnik_id;";
    $rezultat = $veza->SelectDB($upit);
}

while ($red = mysqli_fetch_array($rezultat)) {
    echo "<tr><td>" . $red['Grad'] . "</td><td>" . $red['Drzava'] . "</td><td>" . $red['Korisnik'] . "</td></tr>";
}

echo "</tbody></table>";

$veza->ZatvoriDB();
?>
                <section id="pocetakZahtjeva">
                    <form name="pretraga" id="pretraga" method="get" action="administratorPS.php">
                        <label for="gradPret">Grad:</label>
                        <input name="gradPret" id="gradPret" type="text"/>
                        <label for="korisnikPret">Korisnik</label>
                        <input id="korisnikPret" name="korisnikPret" type="text"/>
                        <input name="submitSortGrad" type="submit" value="Sortiraj po gradu"/>
                        <input name="submitSortKori" type="submit" value="Sortiraj po korisniku"/>
                        <input name="submitPret" type="submit" value="Pretrazi"/>
                        <input type="submit" name="reset" value="Reset"/>
                    </form>

                    <p>Dodaj</p>
                    <form name="zahtjev" id="zahtjev" method="get" action="administratorPS.php">
                        <label for="grad">Grad: </label>         
                        <input id="grad" name="grad" type="text" required="required"/>
                        <label for="drzava">Drzava: </label>
                        <input id="drzava" name="drzava" type="text"  required="required" />
                        <input name="submit3" type="submit" value="Posalji zahtjev" />

                    </form>

                    <p>Dodjeli moderatora gradu</p>

                    <form name="dodjela" id="dodjela" method="get" action="administratorPS.php">
                        <label for="gradovi">Grad: </label>
                        <select id="gradovi" name="gradovi" required="required">
<?php
$veza->SpojiDB();
$upit2 = "SELECT lokacija_grad, lokacija_id FROM WebDiP2020x073.lokacija;";
$result = $veza->selectDB($upit2);
echo "<option value='-1' selected='selected'>== Odaberi grad ==</option>";

while ($row = mysqli_fetch_array($result)) {
    echo "<option value='" . $row['lokacija_id'] . "'>" . $row['lokacija_grad'] . "</option>";
}
$veza->zatvoriDB();
?>
                        </select>   
                        <select id="korisnici" name="korisnici" required="required">
                            <?php
                            $veza->SpojiDB();
                            $upit2 = "SELECT korisnik_naziv, korisnik_id FROM WebDiP2020x073.korisnik WHERE tipkorisnika_id = 2;";
                            $result = $veza->selectDB($upit2);
                            echo "<option value='-1' selected='selected'>== Odaberi korisnka ==</option>";

                            while ($row = mysqli_fetch_array($result)) {
                                echo "<option value='" . $row['korisnik_id'] . "'>" . $row['korisnik_naziv'] . "</option>";
                            }
                            $veza->zatvoriDB();
                            ?>
                        </select>  
                        <input name="submitDodjela" type="submit" value="Dodjeli" />
                    </form>


                    <p>Dodjeli moderatora registriranom korisniku</p>

                    <form name="dodjelaMod" id="dodjelaMod" method="get" action="administratorPS.php">

                        <select id="korisnici" name="korisnici" required="required">
<?php
$veza->SpojiDB();
$upit2 = "SELECT korisnik_naziv, korisnik_id FROM WebDiP2020x073.korisnik WHERE tipkorisnika_id = 3;";
$result = $veza->selectDB($upit2);
echo "<option value='-1' selected='selected'>== Odaberi korisnka ==</option>";

while ($row = mysqli_fetch_array($result)) {
    echo "<option value='" . $row['korisnik_id'] . "'>" . $row['korisnik_naziv'] . "</option>";
}
$veza->zatvoriDB();
?>
                        </select>  
                        <input name="submitDodjelaMod" type="submit" value="Dodjeli" />
                    </form>
                </section>
                <footer>
                    <a href="https://validator.w3.org/check?uri=http://barka.foi.hr/WebDiP/2020_projekti/WebDiP2020x073/administratorPS.php"><img src="multimedija/HTML5.png" width="50" alt="HTML5"/></a>
                    <a href="https://jigsaw.w3.org/css-validator/validator?uri=http://barka.foi.hr/WebDiP/2020_projekti/WebDiP2020x073/CSS/jprga.css"><img src="multimedija/CSS3.png" width="50" alt="CSS3"/></a> 
                    <a href="o_autoru.html"><p>&copy; 2021 Josip Prga</p></a>
                    <a href="dokumentacija.html"><p>Dokumentacija</p></a>
                </footer>
                </body>
                </html>

