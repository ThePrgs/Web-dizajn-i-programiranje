<?php
$putanja = dirname($_SERVER['REQUEST_URI'], 2);
$direktorij = dirname(getcwd());

include 'sesija.class.php';
include 'baza.class.php';

$veza = new Baza();
if (isset($_GET["submit3"])) {
    $veza->spojiDB();
    $korisnikBaza = Sesija::dajKorisnika();
    $korisnikBazaJedan = $korisnikBaza[Sesija::KORISNIK];
    $grad = $_GET['gradovi'];
    $naziv = $_GET['naziv'];
    $opis = $_GET['opis'];
    $godina = $_GET['godina'];
    $preporuka = $_GET['preporuka'];
    $preporukaString="";
    $korisnikBazaString="";

    $upitZahtjev = "SELECT d1.korisnik_id as Preporuka, d2.korisnik_id as Dodano FROM webdip2020x073.lokacija, webdip2020x073.korisnik d1, webdip2020x073.korisnik d2 where d1.korisnik_naziv='{$preporuka}' and d2.korisnik_naziv='{$korisnikBazaJedan}';";

    $zahtjevi = $veza->selectDB($upitZahtjev);
    $postojeci = false;

    while ($red1 = mysqli_fetch_array($zahtjevi)) {
        $preporukaString=$red1['Preporuka'];
        $korisnikBazaString= $red1['Dodano'];
        
    }

    if ($postojeci) {
        $update = "UPDATE zahtjev SET zahtjev_status = '{$potvrda}' WHERE zahtjev_naziv='{$naziv}';";
    }

    if (!$postojeci) {
        $update = "INSERT INTO gradevina (gradevina_lokacija, naziv_gradevine ,gradevina_kreirao, gradevina_predlozio, gradevina_godina, gradevina_opis) VALUES ('{$grad}', '{$naziv}', '{$korisnikBazaString}', '{$preporukaString}','{$godina}','{$opis}')";
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
        <h2> Znamenitosti </h2><br>
        <section id="pocetak">
            
            <table id="tablica" class= "display">
                
            <?php
            if(isset($_GET['submitSortZnam'])){
               $korisnik = Sesija::dajKorisnika();
            $veza->SpojiDB();
            $korisnikJedan = $korisnik[Sesija::KORISNIK];
            $upit = "SELECT d3.korisnik_naziv as idKorisnika, d1.korisnik_naziv as Korisnik_kreirao, d2.korisnik_naziv as Predlozio, naziv_gradevine as Znamenitost, lokacija_grad as Grad ,gradevina_godina as Godina, gradevina_opis as Opis FROM webdip2020x073.gradevina, webdip2020x073.korisnik d1, webdip2020x073.korisnik d2, webdip2020x073.korisnik d3, webdip2020x073.lokacija where d2.korisnik_id = gradevina_predlozio and d1.korisnik_id = gradevina_kreirao and lokacija_korisnik=d3.korisnik_id and gradevina_lokacija = lokacija_id and d3.korisnik_naziv='{$korisnikJedan}' order by Znamenitost;";
            $rezultat = $veza->SelectDB($upit);

            
            echo "<thead> <tr><th>Kreirano od</th>
                <th>Preporuceno od</th>
                <th>Znamenitost</th>
                <th>Grad</th>
                <th>Godina</th>
                <th>Opis</th>
                </tr>
            </thead><tbody>";

            while ($red = mysqli_fetch_array($rezultat)) {
                echo "<tr><td>" . $red['Korisnik_kreirao'] . "</td><td>" . $red['Predlozio'] . "</td><td>" . $red['Znamenitost'] . "</td><td>"  . $red['Grad'] . "</td><td>" . $red['Godina'] . "</td><td>" . $red['Opis'] . "</td></tr>";
            }

            echo "</tbody></table>";

            $veza->ZatvoriDB(); 
            }
            elseif(isset($_GET['submitSortGrad'])){
               $korisnik = Sesija::dajKorisnika();
            $veza->SpojiDB();
            $korisnikJedan = $korisnik[Sesija::KORISNIK];
            $upit = "SELECT d3.korisnik_naziv as idKorisnika, d1.korisnik_naziv as Korisnik_kreirao, d2.korisnik_naziv as Predlozio, naziv_gradevine as Znamenitost, lokacija_grad as Grad ,gradevina_godina as Godina, gradevina_opis as Opis FROM webdip2020x073.gradevina, webdip2020x073.korisnik d1, webdip2020x073.korisnik d2, webdip2020x073.korisnik d3, webdip2020x073.lokacija where d2.korisnik_id = gradevina_predlozio and d1.korisnik_id = gradevina_kreirao and lokacija_korisnik=d3.korisnik_id and gradevina_lokacija = lokacija_id and d3.korisnik_naziv='{$korisnikJedan}' order by Grad;";
            $rezultat = $veza->SelectDB($upit);

            //echo "<table class= 'display'>";
            echo "<thead> <tr><th>Kreirano od</th>
                <th>Preporuceno od</th>
                <th>Znamenitost</th>
                <th>Grad</th>
                <th>Godina</th>
                <th>Opis</th>
                </tr>
            </thead><tbody>";

            while ($red = mysqli_fetch_array($rezultat)) {
                echo "<tr><td>" . $red['Korisnik_kreirao'] . "</td><td>" . $red['Predlozio'] . "</td><td>" . $red['Znamenitost'] . "</td><td>"  . $red['Grad'] . "</td><td>" . $red['Godina'] . "</td><td>" . $red['Opis'] . "</td></tr>";
            }

            echo "</tbody></table>";

            $veza->ZatvoriDB(); 
            }
            else{
            $korisnik = Sesija::dajKorisnika();
            $veza->SpojiDB();
            $korisnikJedan = $korisnik[Sesija::KORISNIK];
            $upit = "SELECT d3.korisnik_naziv as idKorisnika, d1.korisnik_naziv as Korisnik_kreirao, d2.korisnik_naziv as Predlozio, naziv_gradevine as Znamenitost, lokacija_grad as Grad ,gradevina_godina as Godina, gradevina_opis as Opis FROM webdip2020x073.gradevina, webdip2020x073.korisnik d1, webdip2020x073.korisnik d2, webdip2020x073.korisnik d3, webdip2020x073.lokacija where d2.korisnik_id = gradevina_predlozio and d1.korisnik_id = gradevina_kreirao and lokacija_korisnik=d3.korisnik_id and gradevina_lokacija = lokacija_id and d3.korisnik_naziv='{$korisnikJedan}';";
            $rezultat = $veza->SelectDB($upit);

            //echo "<table class= 'display'>";
            echo "<thead> <tr><th>Kreirano od</th>
                <th>Preporuceno od</th>
                <th>Znamenitost</th>
                <th>Grad</th>
                <th>Godina</th>
                <th>Opis</th>
                </tr>
            </thead><tbody>";

            while ($red = mysqli_fetch_array($rezultat)) {
                echo "<tr><td>" . $red['Korisnik_kreirao'] . "</td><td>" . $red['Predlozio'] . "</td><td>" . $red['Znamenitost'] . "</td><td>"  . $red['Grad'] . "</td><td>" . $red['Godina'] . "</td><td>" . $red['Opis'] . "</td></tr>";
            }

            echo "</tbody></table>";

            $veza->ZatvoriDB();
            }
            ?>
        </section>
        <section id="pocetakZahtjeva">
            <form name="pretraga" id="pretraga" method="get" action="pocetnaMOD.php">
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
            <form name="zahtjev" id="zahtjev" method="get" action="pocetnaMod.php">
                <label for="gradovi">Grad: </label>
                <select id="gradovi" name="gradovi" required="required">
                    <?php
                    
                    $veza->SpojiDB();
                    $upitIdGrada = "SELECT lokacija_id as ID FROM webdip2020x073.lokacija WHERE lokacija_grad='{$_POST['gradTablica']}'";
                    $upit2 = "SELECT lokacija_id as ID, lokacija_grad as Grad FROM webdip2020x073.lokacija, webdip2020x073.korisnik where lokacija_korisnik=korisnik_id and korisnik_naziv='{$korisnikJedan}';";
                    $result = $veza->selectDB($upit2);
                    $rezultatGrad=$veza->selectDB($upitIdGrada);
                    ?>
                    <option value=<?php if(!isset($_POST['tablicaSubmit'])){echo "-1 selected='selected'>== Odaberi grad ==</option>"; }  elseif (isset($_POST['tablicaSubmit'])) {while ($rowGrad = mysqli_fetch_array($rezultatGrad)) {
                        echo "<option value='" . $rowGrad['ID'] . "'>" . $_POST['gradTablica'] . "</option>";
                        $brojac++;
                    } } ?>;
                    <?php
                    while ($row = mysqli_fetch_array($result)) {
                        echo "<option value='" . $row['ID'] . "'>" . $row['Grad'] . "</option>";
                        $brojac++;
                    }
                    $veza->zatvoriDB();
                    ?>
                <select> 
                <label for="preporuka">Preporucio: </label>
                <input id="preporuka" name="preporuka" type="text"  required="required" value="<?php if(isset($_POST['tablicaSubmit'])) echo $_POST['korisnikTablica']?>"/>
                <label for="naziv">Naziv: </label>
                <input id="naziv" name="naziv" type="text"  required="required" value="<?php if(isset($_POST['tablicaSubmit'])) echo $_POST['znamenitostTablica']?>"/>
                <label for="opis">Opis: </label>
                <input id="opis" name="opis" type="text" size="70" required="required"value="<?php if(isset($_POST['tablicaSubmit'])) echo $_POST['opisTablica']?>"/>
                <label for="godina">Godina: </label>
                <input id="godina" name="godina" type="text"  required="required"value="<?php if(isset($_POST['tablicaSubmit'])) echo $_POST['godinaTablica']?>"/>
                <input name="submit3" type="submit" value="Posalji zahtjev" />

            </form>

        </section>
        <h2> Zahtjevi </h2><br>
        <?php
        $veza->SpojiDB();

        $upit = "SELECT lokacija_grad as Grad, d1.korisnik_naziv as Korisnik, zahtjev_naziv as Znamenitost, zahtjev_opis as Opis, zahtjev_godina as Godina, d2.korisnik_naziv as KorisnikMod FROM webdip2020x073.zahtjev, webdip2020x073.lokacija, webdip2020x073.korisnik d1, webdip2020x073.korisnik d2 where zahtjev_korisnik=d1.korisnik_id and lokacija_korisnik=d2.korisnik_id and lokacija_id=zahtjev_lokacija and d2.korisnik_naziv='{$korisnikJedan}';";
        $rezultat = $veza->SelectDB($upit);

        echo "<table>";
        echo "<thead> <tr><th>Ime grada</th>
                <th>Korisnik</th>
                <th>Naziv znamenitosti</th>
                <th>Opis znamenitosti</th>
                <th>Godina</th>
                </tr>
            </thead>";
        $opis = array();
        $znamenitost=array();
        
        while ($red = mysqli_fetch_array($rezultat)) {
            array_push($opis,$red['Opis']);
            array_push($znamenitost,$red['Znamenitost']);
            echo '<form name="tablicaForm" id="tablicaForm" method="post" action="pocetnaMod.php">' 
            . "<tr><td>" . $red['Grad'] . "</td><td>" . $red['Korisnik'] . "</td><td>" . $red['Znamenitost'] . "</td><td>" . $red['Opis'] . "</td><td>" . $red['Godina'] . "</td><td>"
                    . "<input type='hidden' id='gradTablica' name='gradTablica' value=".$red['Grad'].">".
                    "<input type='hidden' id='korisnikTablica' name='korisnikTablica' value=".$red['Korisnik'].">".              
                    "<input type='hidden' id='godinaTablica' name='godinaTablica' value=".$red['Godina'].">".
                    "<input type='hidden' id='opisTablica' name='opisTablica' value='".$red['Opis'] ."'> ".
                    "<input type='hidden' id='znamenitostTablica' name='znamenitostTablica' value='".$red['Znamenitost']."'>".
                    "<input name='tablicaSubmit' type='submit' value='Potvrdi' /> </td></tr></form>";
         
            
                    
        }
        
        
      
        

        echo "</table>";

        $veza->ZatvoriDB();
        ?>
        <footer>
            <a href="https://validator.w3.org/check?uri=http://barka.foi.hr/WebDiP/2020/zadaca_03/jprga/index.html"><img src="multimedija/HTML5.png" width="50" alt="HTML5"/></a>
            <a href="https://jigsaw.w3.org/css-validator/validator?uri=http://barka.foi.hr/WebDiP/2020/zadaca_03/jprga/CSS/jprga.css"><img src="multimedija/CSS3.png" width="50" alt="CSS3"/></a>
            <a href="autor.html"><p>&copy; 2021 Josip Prga</p></a>
        </footer>
    </body>
</html>

