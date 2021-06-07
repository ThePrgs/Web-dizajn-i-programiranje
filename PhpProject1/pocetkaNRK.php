
<?php
$putanja = dirname($_SERVER['REQUEST_URI'], 2);
$direktorij = dirname(getcwd());

include 'sesija.class.php';
include 'baza.class.php';
$cooki = false;
$naziv = 'Name';
if (!isset($_COOKIE[$naziv])) {
    echo '<script type="text/JavaScript"> 
     var now = new Date();
     var time = now.getTime();
     var expireTime = time + 1048*24*60*60*7;
     now.setTime(expireTime);
     if(confirm("Prihvaćate li uvjete korištenja")){
        document.cookie = "Name=test; expires="+now.toUTCString()+"; path=/";
     }
     </script>';
}


$veza = new Baza();
if (isset($_GET["submit1"])) {
    $veza->spojiDB();

    $grad = $_GET['gradovi'];
    $naziv = $_GET['naziv'];
    $opis = $_GET['opis'];
    $ime = $_GET['imeprezime'];



    $update = "INSERT INTO prijedlog (prijedlog_grad, prijedlog_naziv, prijedlog_opis, prijedlog_ime) VALUES ('{$grad}', '{$naziv}', '{$opis}', '{$ime}')";


    $veza->selectDB($update);

    $veza->zatvoriDB();
}
?>
<!DOCTYPE html>


<html>

    <head>
        <title>Pocetna stranica za NRK</title>
        <meta charset="utf-8">       
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="naslov" content="Početna stranica za NRK">
        <meta name="autor" content="Josip Prga">
        <meta name="opis" content="Početna stranica za NRK naše web stranice">
        <meta name="kljucne_rijeci" content="pocetna, stranica, web, neregistrirani korisnik">      
        <link href="CSS/jprga.css" type = "text/css" rel = "stylesheet"/>
        <script src="javascript/jprga.js" defer></script>
        <link rel="stylesheet" href="//cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
        <script type="text/javascript" src="javascript/jprga_jquery.js"></script>

    </head>
    <body>
        <header>    
            <a href="#pocetak"> <h1>Početna stranica</h1></a>
            <a href="#"><img src="multimedija/ikona_pristupacnosti.png" id="ikonaP" alt="pristupanost" width="20" style="float:right"/></a>
            <img src="multimedija/rss.png" alt="RSS" width="20" style="float:right"/>
            <img src="multimedija/twitter.png" alt="twitter" width="20" style="float:right"/>
            <img src="multimedija/instagram.png" alt="instgram" width="20" style="float:right" />



        </header>
        <nav>
            <ul>

                <li><a href="obrasci/prijava.php">Prijava</a> </li>
                <li><a href="obrasci/registracija.php">Registracija</a> </li>

            </ul>
        </nav>

        <section id="pocetak">
            <table id="tablica" class="display">
                <caption style="background: white"><h2>Sadržaj</h2></caption>
                <thead> 
                    <tr>
                        <th>Ime grada</th>
                        <th>Broj znamenitosti</th>
                        <th>Naziv znamenitosti</th>
                    </tr>
                </thead>
                <tbody>
                    
                    <?php
                    if(isset($_GET["reset"])){
                        unset($_GET["submitPret"]);
                        unset($_GET["submitSortGrad"]);
                        unset($_GET["submitSortZnam"]);
                    }
                    if (isset($_GET["submitPret"])) {
                        $gradPret = $_GET['gradPret'];
                        $znamenitostPret = $_GET['znamenitostPret'];
                        
                        $veza->spojiDB();
                        $upit = "SELECT count(*) as broj, lokacija_grad as grad, naziv_gradevine as znamenitost from webdip2020x073.lokacija, webdip2020x073.gradevina where lokacija_id = gradevina_lokacija AND lokacija_grad = '{$gradPret}' OR lokacija_id = gradevina_lokacija AND gradevina.naziv_gradevine = '{$znamenitostPret}' group by grad;";
                        $rezultatPret = $veza->SelectDB($upit);

                        while ($red = mysqli_fetch_array($rezultatPret)) {
                            echo "<tr><td>" . $red['grad'] . "</td><td>" . $red['broj'] . "</td><td>" . $red['znamenitost'] . "</td></tr>";
                    }
                    
                    $veza->ZatvoriDB();
                    }
                    elseif(isset($_GET['submitSortGrad'])){
                        $gradPret = $_GET['gradPret'];
                        $znamenitostPret = $_GET['znamenitostPret'];
                        
                        $veza->spojiDB();
                        $upit = "SELECT count(*) as broj, lokacija_grad as grad, naziv_gradevine as znamenitost from webdip2020x073.lokacija, webdip2020x073.gradevina where lokacija_id = gradevina_lokacija group by grad order by grad;";
                        $rezultatPret = $veza->SelectDB($upit);

                        while ($red = mysqli_fetch_array($rezultatPret)) {
                            echo "<tr><td>" . $red['grad'] . "</td><td>" . $red['broj'] . "</td><td>" . $red['znamenitost'] . "</td></tr>";
                    }
                    }
                    elseif(isset($_GET['submitSortZnam'])){
                        $gradPret = $_GET['gradPret'];
                        $znamenitostPret = $_GET['znamenitostPret'];
                        
                        $veza->spojiDB();
                        $upit = "SELECT count(*) as broj, lokacija_grad as grad, naziv_gradevine as znamenitost from webdip2020x073.lokacija, webdip2020x073.gradevina where lokacija_id = gradevina_lokacija group by grad order by znamenitost;";
                        $rezultatPret = $veza->SelectDB($upit);

                        while ($red = mysqli_fetch_array($rezultatPret)) {
                            echo "<tr><td>" . $red['grad'] . "</td><td>" . $red['broj'] . "</td><td>" . $red['znamenitost'] . "</td></tr>";
                    }
                    }
                    else{
                    $veza->SpojiDB();

                    $upit = "SELECT count(*) as broj, lokacija_grad as grad, naziv_gradevine as znamenitost from webdip2020x073.lokacija, webdip2020x073.gradevina where lokacija_id = gradevina_lokacija group by grad;";

                    $rezultat = $veza->SelectDB($upit);

                    while ($red = mysqli_fetch_array($rezultat)) {
                        echo "<tr><td>" . $red['grad'] . "</td><td>" . $red['broj'] . "</td><td>" . $red['znamenitost'] . "</td></tr>";
                    }
                    
                    $veza->ZatvoriDB();
                    }
                    ?>
                </tbody></table>
        </section>
        <section id="pocetakPrijedloga">
            <form name="pretraga" id="pretraga" method="get" action="pocetkaNRK.php">
                <label for="gradPret">Grad:</label>
                <input name="gradPret" id="gradPret" type="text"/>
                <label for="znamenitostPret">Znamenitost</label>
                <input id="znamenitostPret" name="znamenitostPret" type="test"/>
                <input name="submitPret" type="submit" value="Pretrazi"/>
                <input name="submitSortGrad" type="submit" value="Sortiraj po gradu"/>
                <input name="submitSortZnam" type="submit" value="Sortiraj po znamenitosti"/>
                <input type="submit" name="reset" value="Reset"/>
            </form>
            
              
            
            <h2> Prijedlozi</h2>
            <form name="prijedlog" id="prijedlog" method="get" action="pocetkaNRK.php">
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
                </select><br>               
                <label for="naziv">Naziv: </label>
                <input id="naziv" name="naziv" type="text"  required="required" /><br>
                <label for="opis">Opis: </label>
                <input id="opis" name="opis" type="text"  required="required"/><br>
                <label for="imeprezime">Ime/Prezime: </label>
                <input id="imeprezime" name="imeprezime" type="text"  /><br>
                <input name="submit1" type="submit" value="Posalji prijedlog" />


            </form>
            
        </section>       
            
        <footer>
            <a href="https://validator.w3.org/check?uri=http://barka.foi.hr/WebDiP/2020/zadaca_03/jprga/index.html"><img src="multimedija/HTML5.png" width="50" alt="HTML5"/></a>
            <a href="https://jigsaw.w3.org/css-validator/validator?uri=http://barka.foi.hr/WebDiP/2020/zadaca_03/jprga/CSS/jprga.css"><img src="multimedija/CSS3.png" width="50" alt="CSS3"/></a>
            <a href="autor.html"><p>&copy; 2021 Josip Prga</p></a>
        </footer>
    </body>
</html>

