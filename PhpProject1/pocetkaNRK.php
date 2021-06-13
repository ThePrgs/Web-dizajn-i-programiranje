
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
        document.cookie = "Name=test; expires="+now.toUTCString()+"; path=/;";
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



    $update = "INSERT INTO WebDiP2020x073.prijedlog (prijedlog_grad, prijedlog_naziv, prijedlog_opis, prijedlog_ime) VALUES ('{$grad}', '{$naziv}', '{$opis}', '{$ime}')";


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
            <h1>Početna stranica</h1></a>
            <a href="#"><img src="multimedija/ikona_pristupacnosti.png" id="ikonaPoc" alt="pristupanost" width="20" style="float:right"/></a>
            <img src="multimedija/rss.png" alt="RSS" width="20" style="float:right"/>
            <img src="multimedija/twitter.png" alt="twitter" width="20" style="float:right"/>
            <img src="multimedija/instagram.png" alt="instgram" width="20" style="float:right" />
            


        </header>
        <nav>
            <ul>

                <li><a href="obrasci/prijava.php">Prijava</a> </li>
                <li><a href="obrasci/registracija.php">Registracija</a> </li>
                <li><a href="index.php">Pocetna</a> </li>

            </ul>
        </nav>

        <section id="pocetak">
           <table id="tablica">
                    
                <caption style="background: white"><h2>Sadržaj</h2></caption>
                    
                <thead> 
                    <tr>
                        <th>Ime grada</th>
                         <th>Broj znamenitosti</th> 
                        <th>Znamenitosti</th>
                    </tr>
                </thead>
                <tbody>
                    
                    <?php
                    if (isset($_POST["submitPret"])) {
                    $gradPret = $_POST['gradPret'];
                    

                    $veza->spojiDB();
                    $upit = "SELECT count(*) as broj, lokacija_grad as grad, naziv_gradevine as znamenitost from WebDiP2020x073.lokacija, WebDiP2020x073.gradevina where lokacija_id = gradevina_lokacija AND lokacija_grad = '{$gradPret}' group by grad;";
                    $rezultat = $veza->SelectDB($upit);
                } elseif (isset($_POST['submitSortGrad'])) {
                    $veza->spojiDB();
                    $upit = "SELECT count(*) as broj, lokacija_grad as grad, naziv_gradevine as znamenitost from WebDiP2020x073.lokacija, WebDiP2020x073.gradevina where lokacija_id = gradevina_lokacija group by grad order by grad;";
                    $rezultat = $veza->SelectDB($upit);
                } elseif (isset($_POST['submitSortZnam'])) {
                    $veza->spojiDB();
                    $upit = "SELECT count(*) as broj, lokacija_grad as grad, naziv_gradevine as znamenitost from WebDiP2020x073.lokacija, WebDiP2020x073.gradevina where lokacija_id = gradevina_lokacija group by grad order by znamenitost;";
                    $rezultat = $veza->SelectDB($upit);
                } else {
             
                    $veza->SpojiDB();

                    $upit = "SELECT count(*) as broj, lokacija_grad as grad from WebDiP2020x073.lokacija, WebDiP2020x073.gradevina where lokacija_id = gradevina_lokacija group by grad;";

                    $rezultat = $veza->SelectDB($upit);
                }
                    
                    while ($red = mysqli_fetch_array($rezultat)) {
                        echo '<form name="tablicaForm" id="tablicaForm" method="get" action="Pomocni/tabliceNRK.php">'.
                                "<tr><td>" . $red['grad'] . "</td><td>" . $red['broj'] . "</td><td>"
                                . "<input type='hidden' id='gradTablica' name='gradTablica' value='" . $red['grad'] . "'>".
                                "<input name='tablicaSubmit' type='submit' value='Otvori znamenitosti' /> </td></tr></form>";
                    }
                    
                    $veza->ZatvoriDB();
                    
                    ?>
                </tbody></table>
        </section>
        <section id="pocetakPrijedloga">
            <form name="pretraga" id="pretraga" method="post" action="pocetkaNRK.php">
                <div class="popup"><label for="gradPret">Grad:</label>
                    <span class="popuptext" id="myPopup0">Grad za filtriranje</span></div>
                <input name="gradPret" id="gradPret" type="text"/>
                
                <div class="popup"><input name="submitPret"  type="submit" value="Pretrazi"/>
                    <span class="popuptext" id="myPopup1">Filtriraj po unesenom gradu/znamenitosti</span></div>
                <div class="popup"><input name="submitSortGrad"  type="submit" value="Sortiraj po gradu"/>
                    <span class="popuptext" id="myPopup2">Sortiraj po gradu</span></div>
               
                <div class="popup"><input type="submit" name="reset" value="Reset"/>
                    <span class="popuptext" id="myPopup3">Resetiraj tablicu</span></div>
            </form>
            
              
            
            <h2> Prijedlozi</h2>
            <form name="prijedlog" id="prijedlog" method="get" action="pocetkaNRK.php">
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
            <a href="https://validator.w3.org/check?uri=http://barka.foi.hr/WebDiP/2020_projekti/WebDiP2020x073/pocetkaNRK.php"><img src="multimedija/HTML5.png" width="50" alt="HTML5"/></a>
            <a href="https://jigsaw.w3.org/css-validator/validator?uri=http://barka.foi.hr/WebDiP/2020_projekti/WebDiP2020x073/CSS/jprga.css"><img src="multimedija/CSS3.png" width="50" alt="CSS3"/></a> 
            <a href="o_autoru.html"><p>&copy; 2021 Josip Prga</p></a>
            <a href="dokumentacija.html"><p>Dokumentacija</p></a>
        </footer>
    </body>
</html>

