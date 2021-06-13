<?php
$putanja = dirname($_SERVER['REQUEST_URI'], 2);
$direktorij = dirname(getcwd());

include 'sesija.class.php';
include 'baza.class.php';
$korisnik = Sesija::dajKorisnika();
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
    $preporukaString = "";
    $korisnikBazaString = "";
    
    

    $upitZahtjev = "SELECT d1.korisnik_id as Preporuka, d2.korisnik_id as Dodano FROM WebDiP2020x073.korisnik d1, WebDiP2020x073.korisnik d2 where d1.korisnik_naziv='{$preporuka}' and d2.korisnik_naziv='{$korisnikBazaJedan}';";

    $zahtjevi = $veza->selectDB($upitZahtjev);
    $postojeci = false;

    while ($red1 = mysqli_fetch_array($zahtjevi)) {
        $preporukaString = $red1['Preporuka'];
        $korisnikBazaString = $red1['Dodano'];
        
    }
    
    $upitPostojeci = "SELECT naziv_gradevine FROM WebDiP2020x073.gradevina;";
    $postojeciGradovi=$veza->selectDB($upitPostojeci);
    
    while($redGradova= mysqli_fetch_array($postojeciGradovi)){
        if($redGradova["naziv_gradevine"]==$naziv){
            $postojeci=true;
            
        }
        
    }
    

    if ($postojeci) {
        $update = "UPDATE WebDiP2020x073.gradevina SET gradevina_lokacija='{$grad}' WHERE naziv_gradevine = '{$naziv}';";
    }else {
        $update = "INSERT INTO WebDiP2020x073.gradevina (gradevina_lokacija, naziv_gradevine ,gradevina_kreirao, gradevina_predlozio, gradevina_godina, gradevina_opis) VALUES ('{$grad}', '{$naziv}', '{$korisnikBazaString}', '{$preporukaString}','{$godina}','{$opis}')";
    }
    
    

    $veza->selectDB($update);

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
        <script type="text/javascript" src="javascript/jprga_jquery.js"></script>
    </head>
    <body id="tijelo">
        <header>
            <a href="odjava.php"><p style="float:right">Odjava</p></a>
            <h1>Početna stranica</h1>
             <a href="#"><img src="multimedija/ikona_pristupacnosti.png" id="ikonaPoc" alt="pristupanost" width="20" style="float:right"/></a>
            <img src="multimedija/rss.png" alt="RSS" width="20" style="float:right"/>
            <img src="multimedija/twitter.png" alt="twitter" width="20" style="float:right"/>
            <img src="multimedija/instagram.png" alt="instgram" width="20" style="float:right" />



        </header>
        <nav>
            <ul>
                <li><a href="galerija.php">Galerija</a> </li>

                <li><a href="Pomocni/BlokiranjeZahtjeva.php">Korisnici</a> </li>
                <li><a href="pocetkaNRK.php">Prijedlozi</a> </li>
                <li><a href="pocetnaRK.php">Zahtjevi</a> </li>
                <li><a href="index.php">Pocetna</a> </li>   
                
                

            </ul>
        </nav>

         <section id="prazniProstor">
             <div class="popup2"><span class="popuptext" id="myPopup0"></span></div>
        </section>
        <h2> Znamenitosti </h2><br>
        <section id="pocetak">

            <table id="tablica" class= "display">

                <?php
                if (isset($_GET['submitSortZnam'])) {
                    $korisnik = Sesija::dajKorisnika();
                    $veza->SpojiDB();
                    $korisnikJedan = $korisnik[Sesija::KORISNIK];
                    $upit = "SELECT d3.korisnik_naziv as idKorisnika, d1.korisnik_naziv as Korisnik_kreirao, d2.korisnik_naziv as Predlozio, naziv_gradevine as Znamenitost, lokacija_grad as Grad ,gradevina_godina as Godina, gradevina_opis as Opis FROM WebDiP2020x073.gradevina, WebDiP2020x073.korisnik d1, WebDiP2020x073.korisnik d2, WebDiP2020x073.korisnik d3, WebDiP2020x073.lokacija where d2.korisnik_id = gradevina_predlozio and d1.korisnik_id = gradevina_kreirao and lokacija_korisnik=d3.korisnik_id and gradevina_lokacija = lokacija_id and d3.korisnik_naziv='{$korisnikJedan}' order by Znamenitost;";
                    if($korisnikJedan=="admin"){
                        $upit="SELECT d3.korisnik_naziv as idKorisnika, d1.korisnik_naziv as Korisnik_kreirao, d2.korisnik_naziv as Predlozio, naziv_gradevine as Znamenitost, lokacija_grad as Grad ,gradevina_godina as Godina, gradevina_opis as Opis FROM WebDiP2020x073.gradevina, WebDiP2020x073.korisnik d1, WebDiP2020x073.korisnik d2, WebDiP2020x073.korisnik d3, WebDiP2020x073.lokacija where d2.korisnik_id = gradevina_predlozio and d1.korisnik_id = gradevina_kreirao and lokacija_korisnik=d3.korisnik_id and gradevina_lokacija = lokacija_id order by Znamenitost;";
                    }
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
                        echo "<tr><td>" . $red['Korisnik_kreirao'] . "</td><td>" . $red['Predlozio'] . "</td><td>" . $red['Znamenitost'] . "</td><td>" . $red['Grad'] . "</td><td>" . $red['Godina'] . "</td><td>" . $red['Opis'] . "</td></tr>";
                    }

                    echo "</tbody></table>";

                    $veza->ZatvoriDB();
                } elseif (isset($_GET['submitSortGrad'])) {
                    $korisnik = Sesija::dajKorisnika();
                    $veza->SpojiDB();
                    $korisnikJedan = $korisnik[Sesija::KORISNIK];
                    $upit = "SELECT d3.korisnik_naziv as idKorisnika, d1.korisnik_naziv as Korisnik_kreirao, d2.korisnik_naziv as Predlozio, naziv_gradevine as Znamenitost, lokacija_grad as Grad ,gradevina_godina as Godina, gradevina_opis as Opis FROM WebDiP2020x073.gradevina, WebDiP2020x073.korisnik d1, WebDiP2020x073.korisnik d2, WebDiP2020x073.korisnik d3, WebDiP2020x073.lokacija where d2.korisnik_id = gradevina_predlozio and d1.korisnik_id = gradevina_kreirao and lokacija_korisnik=d3.korisnik_id and gradevina_lokacija = lokacija_id and d3.korisnik_naziv='{$korisnikJedan}' order by Grad;";
                    if($korisnikJedan=="admin"){
                        $upit="SELECT d3.korisnik_naziv as idKorisnika, d1.korisnik_naziv as Korisnik_kreirao, d2.korisnik_naziv as Predlozio, naziv_gradevine as Znamenitost, lokacija_grad as Grad ,gradevina_godina as Godina, gradevina_opis as Opis FROM WebDiP2020x073.gradevina, WebDiP2020x073.korisnik d1, WebDiP2020x073.korisnik d2, WebDiP2020x073.korisnik d3, WebDiP2020x073.lokacija where d2.korisnik_id = gradevina_predlozio and d1.korisnik_id = gradevina_kreirao and lokacija_korisnik=d3.korisnik_id and gradevina_lokacija = lokacija_id order by Grad;";
                    }
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
                        echo "<tr><td>" . $red['Korisnik_kreirao'] . "</td><td>" . $red['Predlozio'] . "</td><td>" . $red['Znamenitost'] . "</td><td>" . $red['Grad'] . "</td><td>" . $red['Godina'] . "</td><td>" . $red['Opis'] . "</td></tr>";
                    }

                    echo "</tbody></table>";

                    $veza->ZatvoriDB();
                } elseif (isset($_GET['submitPret'])) {
                    $grad = $_GET['gradPret'];
                    $znamenitostPret = $_GET['znamenitostPret'];
                    $korisnik = Sesija::dajKorisnika();
                    $veza->SpojiDB();
                    $korisnikJedan = $korisnik[Sesija::KORISNIK];
                    $upit = "SELECT d3.korisnik_naziv as idKorisnika, d1.korisnik_naziv as Korisnik_kreirao, d2.korisnik_naziv as Predlozio, naziv_gradevine as Znamenitost, lokacija_grad as Grad ,gradevina_godina as Godina, gradevina_opis as Opis FROM WebDiP2020x073.gradevina, WebDiP2020x073.korisnik d1, WebDiP2020x073.korisnik d2, WebDiP2020x073.korisnik d3, WebDiP2020x073.lokacija where d2.korisnik_id = gradevina_predlozio and d1.korisnik_id = gradevina_kreirao and lokacija_korisnik=d3.korisnik_id and gradevina_lokacija = lokacija_id and d3.korisnik_naziv='{$korisnikJedan}' and lokacija_grad = '{$grad}' or d2.korisnik_id = gradevina_predlozio and d1.korisnik_id = gradevina_kreirao and lokacija_korisnik=d3.korisnik_id and gradevina_lokacija = lokacija_id and d3.korisnik_naziv='{$korisnikJedan}' and naziv_gradevine = '{$znamenitostPret}';";
                    $rezultat = $veza->SelectDB($upit);
                    if($korisnikJedan=="admin"){
                        $upit="SELECT d3.korisnik_naziv as idKorisnika, d1.korisnik_naziv as Korisnik_kreirao, d2.korisnik_naziv as Predlozio, naziv_gradevine as Znamenitost, lokacija_grad as Grad ,gradevina_godina as Godina, gradevina_opis as Opis FROM WebDiP2020x073.gradevina, WebDiP2020x073.korisnik d1, WebDiP2020x073.korisnik d2, WebDiP2020x073.korisnik d3, WebDiP2020x073.lokacija where d2.korisnik_id = gradevina_predlozio and d1.korisnik_id = gradevina_kreirao and lokacija_korisnik=d3.korisnik_id and gradevina_lokacija = lokacija_id and lokacija_grad = '{$grad}' or d2.korisnik_id = gradevina_predlozio and d1.korisnik_id = gradevina_kreirao and lokacija_korisnik=d3.korisnik_id and gradevina_lokacija = lokacija_id and naziv_gradevine = '{$znamenitostPret}';";
                    
                    }

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
                        echo "<tr><td>" . $red['Korisnik_kreirao'] . "</td><td>" . $red['Predlozio'] . "</td><td>" . $red['Znamenitost'] . "</td><td>" . $red['Grad'] . "</td><td>" . $red['Godina'] . "</td><td>" . $red['Opis'] . "</td></tr>";
                    }

                    echo "</tbody></table>";

                    $veza->ZatvoriDB();
                } else {
                    $korisnik = Sesija::dajKorisnika();
                    $veza->SpojiDB();
                    $korisnikJedan = $korisnik[Sesija::KORISNIK];
                    $upit = "SELECT d3.korisnik_naziv as idKorisnika, d1.korisnik_naziv as Korisnik_kreirao, d2.korisnik_naziv as Predlozio, naziv_gradevine as Znamenitost, lokacija_grad as Grad ,gradevina_godina as Godina, gradevina_opis as Opis FROM WebDiP2020x073.gradevina, WebDiP2020x073.korisnik d1, WebDiP2020x073.korisnik d2, WebDiP2020x073.korisnik d3, WebDiP2020x073.lokacija where d2.korisnik_id = gradevina_predlozio and d1.korisnik_id = gradevina_kreirao and lokacija_korisnik=d3.korisnik_id and gradevina_lokacija = lokacija_id and d3.korisnik_naziv='{$korisnikJedan}';";
                    if($korisnikJedan=="admin"){
                        $upit="SELECT d3.korisnik_naziv as idKorisnika, d1.korisnik_naziv as Korisnik_kreirao, d2.korisnik_naziv as Predlozio, naziv_gradevine as Znamenitost, lokacija_grad as Grad ,gradevina_godina as Godina, gradevina_opis as Opis FROM WebDiP2020x073.gradevina, WebDiP2020x073.korisnik d1, WebDiP2020x073.korisnik d2, WebDiP2020x073.korisnik d3, WebDiP2020x073.lokacija where d2.korisnik_id = gradevina_predlozio and d1.korisnik_id = gradevina_kreirao and lokacija_korisnik=d3.korisnik_id and gradevina_lokacija = lokacija_id;";
                     
                    }
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
                        echo "<tr><td>" . $red['Korisnik_kreirao'] . "</td><td>" . $red['Predlozio'] . "</td><td>" . $red['Znamenitost'] . "</td><td>" . $red['Grad'] . "</td><td>" . $red['Godina'] . "</td><td>" . $red['Opis'] . "</td></tr>";
                    }

                    echo "</tbody></table>";

                    $veza->ZatvoriDB();
                }
                ?>
        </section>
        <section id="pocetakZahtjeva">
            <form name="pretraga" id="pretraga" method="get" action="pocetnaMod.php">
                <label for="gradPret">Grad:</label>
                <input name="gradPret" id="gradPret" type="text"/>
                <label for="znamenitostPret">Znamenitost</label>
                <input id="znamenitostPret" name="znamenitostPret" type="text"/>
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
                    
                    
                    $upit2 = "SELECT lokacija_id as ID, lokacija_grad as Grad FROM WebDiP2020x073.lokacija, WebDiP2020x073.korisnik where lokacija_korisnik=korisnik_id and korisnik_naziv='{$korisnikJedan}';";
                    if($korisnikJedan=="admin"){
                        $upit="SELECT lokacija_id as ID, lokacija_grad as Grad FROM WebDiP2020x073.lokacija;";
                    
                    }
                    $result = $veza->selectDB($upit2);
                    
                    ?>
                    <option value=<?php
                    if (!isset($_GET['tablicaSubmit'])) {
                        echo "-1 selected='selected'>== Odaberi grad ==</option>";
                        while ($row = mysqli_fetch_array($result)) {
                                echo "<option value='" . $row['ID'] . "'>" . $row['Grad'] . "</option>";
                               
                            }
                          
                    } elseif (isset($_GET['tablicaSubmit'])) {
                        $upitIdGrada = "SELECT lokacija_id as ID FROM WebDiP2020x073.lokacija WHERE lokacija_grad='{$_GET["gradTablica"]}';";
                        $rezultatGrad = $veza->selectDB($upitIdGrada);
                        
                        while ($rowGrad = mysqli_fetch_array($rezultatGrad)) {
                            echo $rowGrad['ID'] ." selected='selected'>" . $_GET['gradTablica'] . "</option>";
                            
                            
                           
                        }
                    }
                    
  
                            $veza->zatvoriDB();
                            ?>
                            <select> 
                    <label for="preporuka">Preporucio: </label>
                    <input id="preporuka" name="preporuka" type="text" value="<?php if (isset($_GET['tablicaSubmit'])) echo $_GET['korisnikTablica'] ?>"/>
                    <label for="naziv">Naziv: </label>
                    <input id="naziv" name="naziv" type="text"  required="required" value="<?php if (isset($_GET['tablicaSubmit'])) echo $_GET['znamenitostTablica'] ?>"/>
                    <label for="opis">Opis: </label>
                    <input id="opis" name="opis" type="text" size="70"value="<?php if (isset($_GET['tablicaSubmit'])) echo $_GET['opisTablica'] ?>"/>
                    <label for="godina">Godina: </label>
                    <input id="godina" name="godina" type="text"value="<?php if (isset($_GET['tablicaSubmit'])) echo $_GET['godinaTablica'] ?>"/>
                    <input name="submit3" type="submit" value="Posalji zahtjev" />

            </form>

        </section>
        <h2> Zahtjevi </h2><br>
        <?php
        $veza->SpojiDB();

        if (isset($_GET['submitSortGrad2'])) {
            $upit = "SELECT lokacija_grad as Grad, d1.korisnik_naziv as Korisnik, zahtjev_naziv as Znamenitost, zahtjev_opis as Opis, zahtjev_godina as Godina, d2.korisnik_naziv as KorisnikMod, zahtjev_status as Status FROM WebDiP2020x073.zahtjev, WebDiP2020x073.lokacija, WebDiP2020x073.korisnik d1, WebDiP2020x073.korisnik d2 where zahtjev_korisnik=d1.korisnik_id and lokacija_korisnik=d2.korisnik_id and lokacija_id=zahtjev_lokacija and d2.korisnik_naziv='{$korisnikJedan}' order by Grad;";
            if($korisnikJedan=="admin"){
                        $upit="SELECT lokacija_grad as Grad, d1.korisnik_naziv as Korisnik, zahtjev_naziv as Znamenitost, zahtjev_opis as Opis, zahtjev_godina as Godina, d2.korisnik_naziv as KorisnikMod, zahtjev_status as Status FROM WebDiP2020x073.zahtjev, WebDiP2020x073.lokacija, WebDiP2020x073.korisnik d1, WebDiP2020x073.korisnik d2 where zahtjev_korisnik=d1.korisnik_id and lokacija_korisnik=d2.korisnik_id and lokacija_id=zahtjev_lokacija order by Grad;";
           
                    }
            $rezultat = $veza->SelectDB($upit);
        } elseif (isset($_GET['submitSortZnam2'])) {
            $upit = "SELECT lokacija_grad as Grad, d1.korisnik_naziv as Korisnik, zahtjev_naziv as Znamenitost, zahtjev_opis as Opis, zahtjev_godina as Godina, d2.korisnik_naziv as KorisnikMod, zahtjev_status as Status FROM WebDiP2020x073.zahtjev, WebDiP2020x073.lokacija, WebDiP2020x073.korisnik d1, WebDiP2020x073.korisnik d2 where zahtjev_korisnik=d1.korisnik_id and lokacija_korisnik=d2.korisnik_id and lokacija_id=zahtjev_lokacija and d2.korisnik_naziv='{$korisnikJedan}' order by Znamenitost;";
            if($korisnikJedan=="admin"){
                        $upit="SELECT lokacija_grad as Grad, d1.korisnik_naziv as Korisnik, zahtjev_naziv as Znamenitost, zahtjev_opis as Opis, zahtjev_godina as Godina, d2.korisnik_naziv as KorisnikMod, zahtjev_status as Status FROM WebDiP2020x073.zahtjev, WebDiP2020x073.lokacija, WebDiP2020x073.korisnik d1, WebDiP2020x073.korisnik d2 where zahtjev_korisnik=d1.korisnik_id and lokacija_korisnik=d2.korisnik_id and lokacija_id=zahtjev_lokacija order by Znamenitost;";
            }
            $rezultat = $veza->SelectDB($upit);
        } elseif (isset($_GET['submitPret2'])) {
            $grad2 = $_GET['gradPret'];
            $znamenitost2 = $_GET['znamenitostPret'];
            $upit = "SELECT lokacija_grad as Grad, d1.korisnik_naziv as Korisnik, zahtjev_naziv as Znamenitost, zahtjev_opis as Opis, zahtjev_godina as Godina, d2.korisnik_naziv as KorisnikMod, zahtjev_status as Status FROM WebDiP2020x073.zahtjev, WebDiP2020x073.lokacija, WebDiP2020x073.korisnik d1, WebDiP2020x073.korisnik d2 where zahtjev_korisnik=d1.korisnik_id and lokacija_korisnik=d2.korisnik_id and lokacija_id=zahtjev_lokacija and d2.korisnik_naziv='{$korisnikJedan}' and lokacija_grad='{$grad2}' or zahtjev_korisnik=d1.korisnik_id and lokacija_korisnik=d2.korisnik_id and lokacija_id=zahtjev_lokacija and d2.korisnik_naziv='{$korisnikJedan}' and zahtjev_naziv='{$znamenitost2}';";
            if($korisnikJedan=="admin"){
                        $upit="SELECT lokacija_grad as Grad, d1.korisnik_naziv as Korisnik, zahtjev_naziv as Znamenitost, zahtjev_opis as Opis, zahtjev_godina as Godina, d2.korisnik_naziv as KorisnikMod, zahtjev_status as Status FROM WebDiP2020x073.zahtjev, WebDiP2020x073.lokacija, WebDiP2020x073.korisnik d1, WebDiP2020x073.korisnik d2 where zahtjev_korisnik=d1.korisnik_id and lokacija_korisnik=d2.korisnik_id and lokacija_id=zahtjev_lokacija and lokacija_grad='{$grad2}' or zahtjev_korisnik=d1.korisnik_id and lokacija_korisnik=d2.korisnik_id and lokacija_id=zahtjev_lokacija and zahtjev_naziv='{$znamenitost2}';";
            }
            $rezultat = $veza->SelectDB($upit);
        } else {
            
            $upit = "SELECT lokacija_grad as Grad, d1.korisnik_naziv as Korisnik, zahtjev_naziv as Znamenitost, zahtjev_opis as Opis, zahtjev_godina as Godina, d2.korisnik_naziv as KorisnikMod, zahtjev_status as Status FROM WebDiP2020x073.zahtjev, WebDiP2020x073.lokacija, WebDiP2020x073.korisnik d1, WebDiP2020x073.korisnik d2 where zahtjev_korisnik=d1.korisnik_id and lokacija_korisnik=d2.korisnik_id and lokacija_id=zahtjev_lokacija and d2.korisnik_naziv='{$korisnikJedan}';";
            if($korisnikJedan=="admin"){
                        $upit="SELECT lokacija_grad as Grad, d1.korisnik_naziv as Korisnik, zahtjev_naziv as Znamenitost, zahtjev_opis as Opis, zahtjev_godina as Godina, d2.korisnik_naziv as KorisnikMod, zahtjev_status as Status FROM WebDiP2020x073.zahtjev, WebDiP2020x073.lokacija, WebDiP2020x073.korisnik d1, WebDiP2020x073.korisnik d2 where zahtjev_korisnik=d1.korisnik_id and lokacija_korisnik=d2.korisnik_id and lokacija_id=zahtjev_lokacija;";
            }
            $rezultat = $veza->SelectDB($upit);
        }
        echo "<table>";
        echo "<thead> <tr><th>Ime grada</th>
                <th>Korisnik</th>
                <th>Naziv znamenitosti</th>
                <th>Opis znamenitosti</th>
                <th>Godina</th>
                <th>Status</th>
                </tr>
            </thead>";


        while ($red = mysqli_fetch_array($rezultat)) {

            echo '<form name="tablicaForm" id="tablicaForm" method="get" action="pocetnaMod.php">'
            . "<tr><td>" . $red['Grad'] . "</td><td>" . $red['Korisnik'] . "</td><td>" . $red['Znamenitost'] . "</td><td>" . $red['Opis'] . "</td><td>" . $red['Godina'] . "</td><td>" . $red['Status']. "</td><td>"
            . "<input type='hidden' id='gradTablica' name='gradTablica' value='" . $red['Grad'] . "'>" .
            "<input type='hidden' id='korisnikTablica' name='korisnikTablica' value=" . $red['Korisnik'] . ">" .
            "<input type='hidden' id='godinaTablica' name='godinaTablica' value=" . $red['Godina'] . ">" .
            "<input type='hidden' id='opisTablica' name='opisTablica' value='" . $red['Opis'] . "'> " .
            "<input type='hidden' id='znamenitostTablica' name='znamenitostTablica' value='" . $red['Znamenitost'] . "'>" .
            "<input name='tablicaSubmit' type='submit' value='Potvrdi' /> </td></tr></form>";
        }


        echo "</table>";

        $veza->ZatvoriDB();
        ?>
        <section id="pocetakZahtjeva">
            <form name="pretraga" id="pretraga" method="get" action="pocetnaMod.php">
                <label for="gradPret">Grad:</label>
                <input name="gradPret" id="gradPret" type="text"/>
                <label for="znamenitostPret">Znamenitost</label>
                <input id="znamenitostPret" name="znamenitostPret" type="test"/>
                <input name="submitSortGrad2" type="submit" value="Sortiraj po gradu"/>
                <input name="submitSortZnam2" type="submit" value="Sortiraj po znamenitosti"/>
                <input name="submitPret2" type="submit" value="Pretrazi"/>
                <input type="submit" name="reset" value="Reset"/>
            </form>
        </section>
        <footer>
            <a href="https://validator.w3.org/check?uri=http://barka.foi.hr/WebDiP/2020_projekti/WebDiP2020x073/pocetnaMod.php"><img src="multimedija/HTML5.png" width="50" alt="HTML5"/></a>
            <a href="https://jigsaw.w3.org/css-validator/validator?uri=http://barka.foi.hr/WebDiP/2020_projekti/WebDiP2020x073/CSS/jprga.css"><img src="multimedija/CSS3.png" width="50" alt="CSS3"/></a> 
            <a href="o_autoru.html"><p>&copy; 2021 Josip Prga</p></a>
            <a href="dokumentacija.html"><p>Dokumentacija</p></a>
        </footer>
    </body>
</html>

