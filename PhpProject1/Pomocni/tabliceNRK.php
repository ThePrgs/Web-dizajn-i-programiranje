<?php
$putanja = dirname($_SERVER['REQUEST_URI'], 2);
$direktorij = dirname(getcwd());

include '../sesija.class.php';
include '../baza.class.php';

$veza = new Baza();

?>

<html>
    <head>
        <title>Tablice znamenitosti</title>
        <meta charset="utf-8">       
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="naslov" content="Blokiranje">
        <meta name="autor" content="Josip Prga">
        <meta name="opis" content="Stranica za blokiranje racuna naše web stranice">
        <meta name="kljucne_rijeci" content="zaboravljena, sifra, web">

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
            <a href="../pocetkaNRK.php"><p style="float:left">Natrag</p></a>
             <h1>Znamenitosti</h1>
        </header>
        
        <table id="tablica">
            <section id="prazniProstor"></section>
            <?php
            if(isset($_GET['tablicaSubmit'])){
            $veza->spojiDB();
            
            $grad=$_GET['gradTablica'];
            
            $gradUpit="SELECT lokacija_id FROM WebDiP2020x073.lokacija WHERE lokacija_grad='{$grad}';";
            $rezultatGrad = $veza->selectDB($gradUpit);
            while ($redGrad = mysqli_fetch_array($rezultatGrad)) {
                $gradID=$redGrad['lokacija_id'];
            }
            
            
            
            $upit = "SELECT d1.korisnik_naziv as Kreirao, d2.korisnik_naziv as Predlozio, naziv_gradevine as Znamenitost FROM WebDiP2020x073.gradevina,WebDiP2020x073.korisnik d1, WebDiP2020x073.korisnik d2 where d1.korisnik_id = gradevina_kreirao and d2.korisnik_id = gradevina_predlozio and gradevina_lokacija='{$gradID}';";
            $rezultat = $veza->selectDB($upit);
            
            echo "<thead> <tr><th>Kreirao</th>
                <th>Predlozio</th>
                <th>Znamenitost</th>
                
                </tr>
            </thead><tbody>";

            while ($red = mysqli_fetch_array($rezultat)) {
                echo  "<tr><td>" . $red['Kreirao'] . "</td><td>" . $red['Predlozio'] . "</td><td>" . $red['Znamenitost'] . "</td></tr>";
            }

            echo "</tbody></table>";

            $veza->ZatvoriDB();
            }
            ?>
            <section id="prazniProstor"></section>
            <footer>
                <a href="https://validator.w3.org/check?uri=http://barka.foi.hr/WebDiP/2020/zadaca_03/jprga/Pomocni/tabliceNRK.php"><img src="../multimedija/HTML5.png" width="50" alt="HTML5"/></a>
                <a href="https://jigsaw.w3.org/css-validator/validator?uri=http://barka.foi.hr/WebDiP/2020/zadaca_03/jprga/CSS/jprga.css"><img src="../multimedija/CSS3.png" width="50" alt="CSS3"/></a>
                <a href="../o_autoru.html"><p>&copy; 2021 Josip Prga</p></a>
            <a href="../dokumentacija.html"><p>Dokumentacija</p></a>
            </footer>   
    </body>
</html>