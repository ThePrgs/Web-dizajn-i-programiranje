<?php
$putanja = dirname($_SERVER['REQUEST_URI'], 2);
$direktorij = dirname(getcwd());

include 'sesija.class.php';
include 'baza.class.php';

$veza = new Baza();
if (isset($_GET["submit2"])) {
    $veza->spojiDB();
    Sesija::dajKorisnika();
    $grad = $_GET['gradovi'];
    $naziv = $_GET['naziv'];
    $opis = $_GET['opis'];
    $godina = $_GET['godina'];
    $potvrda = $_GET['status'];

    $upitZahtjev = "SELECT zahtjev_naziv from zahtjev;";

    $zahtjevi = $veza->selectDB($upitZahtjev);
    $postojeci = false;

    while ($red1 = mysqli_fetch_array($zahtjevi)) {
        if ($red1['zahtjev_naziv'] == $naziv) {
            $postojeci = true;
        }
    }

    if ($postojeci) {
        $update = "UPDATE zahtjev SET zahtjev_status = '{$potvrda}' WHERE zahtjev_naziv='{$naziv}';";
    }

    if (!$postojeci) {
        $update = "INSERT INTO zahtjev (zahtjev_lokacija, zahtjev_korisnik ,zahtjev_naziv, zahtjev_status, zahtjev_opis, zahtjev_godina) VALUES ('{$grad}', '{$_SESSION['uloga']}', '{$naziv}', '{$potvrda}','{$opis}','{$godina}')";
    }


    $veza->selectDB($update);

    $veza->zatvoriDB();
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Pocetna stranica za RK</title>
        <meta charset="utf-8">       
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="naslov" content="Početna stranica za NRK">
        <meta name="autor" content="Josip Prga">
        <meta name="opis" content="Početna stranica za NRK naše web stranice">
        <meta name="kljucne_rijeci" content="pocetna, stranica, web, neregistrirani korisnik">      
        <link href="CSS/jprga.css" type = "text/css" rel = "stylesheet"/>
    </head>
    <body>
        <header>
            <a href="odjava.php"><p style="float:right">Odjava</p></a>
            <a href="#pocetak"> <h1>Početna stranica</h1></a>
            <img src="multimedija/rss.png" alt="RSS" width="20" style="float:right"/>
            <img src="multimedija/twitter.png" alt="twitter" width="20" style="float:right"/>
            <img src="multimedija/instagram.png" alt="instgram" width="20" style="float:right" />

            <link rel="stylesheet" href="//cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
            <script type="text/javascript" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
            <script type="text/javascript" src="javascript/jprga_jquery.js"></script>
        </header>
        <nav>
            <ul>
                <li><a href="galerija.php">Galerija</a> </li>
                
                <li><a href="obrasci/registracija.php">Registracija</a> </li>

            </ul>
        </nav>

        <section id="prazniProstor">

        </section>
        <h2> Zahtjevi </h2><br>
        <section id="pocetak">
            <table id="tablica" class= "display">
                
                <?php
                if (isset($_GET["reset"])) {
                    unset($_GET["submitPret"]);
                    unset($_GET["submitSortGrad"]);
                    unset($_GET["submitSortZnam"]);
                }
                if (isset($_GET["submitPret"])) {
                    $gradPret = $_GET['gradPret'];
                    $znamenitostPret = $_GET['znamenitostPret'];

                    $veza->SpojiDB();

                    $upit = "SELECT lokacija_grad as grad, zahtjev_naziv as naziv, zahtjev_status as status, zahtjev_opis as opis, zahtjev_godina as godina FROM webdip2020x073.lokacija, webdip2020x073.zahtjev where zahtjev_lokacija = lokacija_id AND lokacija_grad = '{$gradPret}' OR zahtjev_lokacija = lokacija_id AND zahtjev_naziv = '{$znamenitostPret}';";
                    $rezultat = $veza->SelectDB($upit);


                    echo "<thead> <tr><th>Ime grada</th>
                    <th>Naziv znamenitosti</th>
                    <th>Status</th>
                    <th>Opis znamenitosti</th>
                    <th>Godina</th>
                    </tr>
                    </thead><tbody>";

                    while ($red = mysqli_fetch_array($rezultat)) {
                        echo "<tr><td>" . $red['grad'] . "</td><td>" . $red['naziv'] . "</td><td>" . $red['status'] . "</td><td>" . $red['opis'] . "</td><td>" . $red['godina'] . "</td></tr>";
                    }

                    echo "</tbody></table>";

                    $veza->ZatvoriDB();
                }
                elseif(isset($_GET["submitSortGrad"])){
                    $veza->SpojiDB();

                    $upit = "SELECT lokacija_grad as grad, zahtjev_naziv as naziv, zahtjev_status as status, zahtjev_opis as opis, zahtjev_godina as godina FROM webdip2020x073.lokacija, webdip2020x073.zahtjev where zahtjev_lokacija = lokacija_id order by grad;";
                    $rezultat = $veza->SelectDB($upit);


                    echo "<thead> <tr><th>Ime grada</th>
                <th>Naziv znamenitosti</th>
                <th>Status</th>
                <th>Opis znamenitosti</th>
                <th>Godina</th>
                </tr>
            </thead><tbody>";

                    while ($red = mysqli_fetch_array($rezultat)) {
                        echo "<tr><td>" . $red['grad'] . "</td><td>" . $red['naziv'] . "</td><td>" . $red['status'] . "</td><td>" . $red['opis'] . "</td><td>" . $red['godina'] . "</td></tr>";
                    }

                    echo "</tbody></table>";

                    $veza->ZatvoriDB();
                }
                elseif(isset($_GET["submitSortZnam"])){
                    $veza->SpojiDB();

                    $upit = "SELECT lokacija_grad as grad, zahtjev_naziv as naziv, zahtjev_status as status, zahtjev_opis as opis, zahtjev_godina as godina FROM webdip2020x073.lokacija, webdip2020x073.zahtjev where zahtjev_lokacija = lokacija_id order by naziv;";
                    $rezultat = $veza->SelectDB($upit);


                    echo "<thead> <tr><th>Ime grada</th>
                <th>Naziv znamenitosti</th>
                <th>Status</th>
                <th>Opis znamenitosti</th>
                <th>Godina</th>
                </tr>
            </thead><tbody>";

                    while ($red = mysqli_fetch_array($rezultat)) {
                        echo "<tr><td>" . $red['grad'] . "</td><td>" . $red['naziv'] . "</td><td>" . $red['status'] . "</td><td>" . $red['opis'] . "</td><td>" . $red['godina'] . "</td></tr>";
                    }

                    echo "</tbody></table>";

                    $veza->ZatvoriDB();
                }
                else {
                    $veza->SpojiDB();

                    $upit = "SELECT lokacija_grad as grad, zahtjev_naziv as naziv, zahtjev_status as status, zahtjev_opis as opis, zahtjev_godina as godina FROM webdip2020x073.lokacija, webdip2020x073.zahtjev where zahtjev_lokacija = lokacija_id;";
                    $rezultat = $veza->SelectDB($upit);


                    echo "<thead> <tr><th>Ime grada</th>
                <th>Naziv znamenitosti</th>
                <th>Status</th>
                <th>Opis znamenitosti</th>
                <th>Godina</th>
                </tr>
            </thead><tbody>";

                    while ($red = mysqli_fetch_array($rezultat)) {
                        echo "<tr><td>" . $red['grad'] . "</td><td>" . $red['naziv'] . "</td><td>" . $red['status'] . "</td><td>" . $red['opis'] . "</td><td>" . $red['godina'] . "</td></tr>";
                    }

                    echo "</tbody></table>";

                    $veza->ZatvoriDB();
                }
                ?>
        </section>
        
        <section id="pocetakZahtjeva">
            
            <form name="pretraga" id="pretraga" method="get" action="pocetnaRK.php">
                <label for="gradPret">Grad:</label>
                <input name="gradPret" id="gradPret" type="text"/>
                <label for="znamenitostPret">Znamenitost</label>
                <input id="znamenitostPret" name="znamenitostPret" type="test"/>
                <input name="submitSortGrad" type="submit" value="Sortiraj po gradu"/>
                <input name="submitSortZnam" type="submit" value="Sortiraj po znamenitosti"/>
                <input name="submitPret" type="submit" value="Pretrazi"/>
                <input type="submit" name="reset" value="Reset"/>
            </form>
            <p>Dodaj</p>
            <form name="zahtjev" id="zahtjev" method="get" action="pocetnaRK.php">
                <label for="gradovi">Grad: </label>
                <select id="gradovi" name="gradovi" required="required">
                    <?php
                    $veza->SpojiDB();
                    $upit2 = "SELECT lokacija_grad FROM webdip2020x073.lokacija;";
                    $result = $veza->selectDB($upit2);
                    echo "<option value='-1' selected='selected'>== Odaberi grad ==</option>";
                    $brojac = 1;
                    while ($row = mysqli_fetch_array($result)) {
                        echo "<option value='" . $brojac . "'>" . $row['lokacija_grad'] . "</option>";
                        $brojac++;
                    }
                    $veza->zatvoriDB();
                    ?>
                </select>              
                <label for="naziv">Naziv: </label>
                <input id="naziv" name="naziv" type="text"  required="required" />
                <label for="opis">Opis: </label>
                <input id="opis" name="opis" type="text"  required="required"/>
                <label for="godina">Godina: </label>
                <input id="godina" name="godina" type="text"  required="required"/>
                <input type="radio" id="potvrdeno" name="status" value="potvrdeno" >
                <label for="potvrdeno">Potvrdeno</label>
                <input type="radio" id="odbijeno" name="status" value="odbijeno">
                <label for="odbijeno">Odbijeno</label>
                <input name="submit2" type="submit" value="Posalji zahtjev" />

            </form>
        </section>

            <h2> Prijedlozi </h2><br>
            </<section id="pocetak">;
            <?php
            if (isset($_GET["reset2"])) {
                unset($_GET["submitPret2"]);
                unset($_GET["submitSortGrad2"]);
                unset($_GET["submitSortZnam2"]);
            }
            if (isset($_GET["submitPret2"])) {
                $gradPret2 = $_GET['gradPret2'];
                $znamenitostPret2 = $_GET['znamenitostPret2'];

                $veza->SpojiDB();

                $upit = "SELECT lokacija_grad as grad, prijedlog_naziv as naziv, prijedlog_opis as opis, prijedlog_ime as ime FROM webdip2020x073.lokacija, webdip2020x073.prijedlog where prijedlog_grad = lokacija_id AND lokacija_grad = '{$gradPret2}' OR prijedlog_grad = lokacija_id AND prijedlog_naziv = '{$znamenitostPret2}' ;";
                $rezultat = $veza->SelectDB($upit);

                echo "<table>";
                echo "<thead> <tr><th>Ime grada</th>
                <th>Naziv znamenitosti</th>
                <th>Opis znamenitosti</th>
                <th>Ime predlagatelja</th>
                </tr>
            </thead>";

                while ($red = mysqli_fetch_array($rezultat)) {
                    echo "<tr><td>" . $red['grad'] . "</td><td>" . $red['naziv'] . "</td><td>" . $red['opis'] . "</td><td>" . $red['ime'] . "</td></tr>";
                }

                echo "</table>";

                $veza->ZatvoriDB();
            }
            elseif(isset($_GET["submitSortGrad2"])) {
                $veza->SpojiDB();

                $upit = "SELECT lokacija_grad as grad, prijedlog_naziv as naziv, prijedlog_opis as opis, prijedlog_ime as ime FROM webdip2020x073.lokacija, webdip2020x073.prijedlog where prijedlog_grad = lokacija_id order by grad;";
                $rezultat = $veza->SelectDB($upit);

                echo "<table>";
                echo "<thead> <tr><th>Ime grada</th>
                <th>Naziv znamenitosti</th>
                <th>Opis znamenitosti</th>
                <th>Ime predlagatelja</th>
                </tr>
            </thead>";

                while ($red = mysqli_fetch_array($rezultat)) {
                    echo "<tr><td>" . $red['grad'] . "</td><td>" . $red['naziv'] . "</td><td>" . $red['opis'] . "</td><td>" . $red['ime'] . "</td></tr>";
                }

                echo "</table>";

                $veza->ZatvoriDB();
            }
            elseif(isset($_GET["submitSortZnam2"])) {
                $veza->SpojiDB();

                $upit = "SELECT lokacija_grad as grad, prijedlog_naziv as naziv, prijedlog_opis as opis, prijedlog_ime as ime FROM webdip2020x073.lokacija, webdip2020x073.prijedlog where prijedlog_grad = lokacija_id order by naziv;";
                $rezultat = $veza->SelectDB($upit);

                echo "<table>";
                echo "<thead> <tr><th>Ime grada</th>
                <th>Naziv znamenitosti</th>
                <th>Opis znamenitosti</th>
                <th>Ime predlagatelja</th>
                </tr>
            </thead>";

                while ($red = mysqli_fetch_array($rezultat)) {
                    echo "<tr><td>" . $red['grad'] . "</td><td>" . $red['naziv'] . "</td><td>" . $red['opis'] . "</td><td>" . $red['ime'] . "</td></tr>";
                }

                echo "</table>";

                $veza->ZatvoriDB();
            }
            else {
                $veza->SpojiDB();

                $upit = "SELECT lokacija_grad as grad, prijedlog_naziv as naziv, prijedlog_opis as opis, prijedlog_ime as ime FROM webdip2020x073.lokacija, webdip2020x073.prijedlog where prijedlog_grad = lokacija_id;";
                $rezultat = $veza->SelectDB($upit);

                echo "<table>";
                echo "<thead> <tr><th>Ime grada</th>
                <th>Naziv znamenitosti</th>
                <th>Opis znamenitosti</th>
                <th>Ime predlagatelja</th>
                </tr>
            </thead>";

                while ($red = mysqli_fetch_array($rezultat)) {
                    echo "<tr><td>" . $red['grad'] . "</td><td>" . $red['naziv'] . "</td><td>" . $red['opis'] . "</td><td>" . $red['ime'] . "</td></tr>";
                }

                echo "</table>";

                $veza->ZatvoriDB();
            }
            
            ?>
            </section>
            <section id="pocetakZahtjeva">
            <form name="pretraga" id="pretraga" method="get" action="pocetnaRK.php">
                <label for="gradPret2">Grad:</label>
                <input name="gradPret2" id="gradPret2" type="text"/>
                <label for="znamenitostPret2">Znamenitost</label>
                <input id="znamenitostPret2" name="znamenitostPret2" type="test"/>
                <input name="submitPret2" type="submit" value="Pretrazi"/>
                <input name="submitSortGrad2" type="submit" value="Sortiraj po gradu"/>
                <input name="submitSortZnam2" type="submit" value="Sortiraj po znamenitosti"/>
                <input type="submit" name="reset2" value="Reset"/>
            </form>
        </section>
        <footer>
            <a href="https://validator.w3.org/check?uri=http://barka.foi.hr/WebDiP/2020/zadaca_03/jprga/index.html"><img src="multimedija/HTML5.png" width="50" alt="HTML5"/></a>
            <a href="https://jigsaw.w3.org/css-validator/validator?uri=http://barka.foi.hr/WebDiP/2020/zadaca_03/jprga/CSS/jprga.css"><img src="multimedija/CSS3.png" width="50" alt="CSS3"/></a>
            <a href="autor.html"><p>&copy; 2021 Josip Prga</p></a>
        </footer>
    </body>
</html>

