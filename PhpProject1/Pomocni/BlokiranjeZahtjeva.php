<?php

$putanja = dirname($_SERVER['REQUEST_URI'], 2);
$direktorij = dirname(getcwd());

include '../sesija.class.php';
include '../baza.class.php';

$veza = new Baza();

if(isset($_POST["blokSubmit"])){
    $id= $_POST["IDblok"];
    $blokiran=$_POST["blok"];
    $veza->spojiDB();
    
    if($blokiran==1){
        $upit="UPDATE korisnik SET korisnik_zahtjevBlokiran=0 WHERE korisnik_naziv='{$id}'";
    }else{
        $upit="UPDATE korisnik SET korisnik_zahtjevBlokiran=1 WHERE korisnik_naziv='{$id}'";
    }
    
    $veza->selectDB($upit);
    $veza->zatvoriDB();
}
?>

<html>
    <head>
        <title>Blokiranje racuna</title>
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
            <a href="../pocetnaMod.php"><p style="float:left">Natrag</p></a>
            <h1>Blokiranje Zahtjeva</h1></a>
        </header>
        <h1>Korisnici</h1>
        <table id="tablica">
            <?php
            $veza->spojiDB();
            $upit = "SELECT count(zahtjev_id) as broj, korisnik_naziv as Korisnik, korisnik_zahtjevBlokiran as Blokiran FROM WebDiP2020x073.zahtjev, WebDiP2020x073.korisnik where korisnik_id=zahtjev_korisnik group by zahtjev_korisnik;";
            $rezultat = $veza->selectDB($upit);

            echo "<thead> <tr><th>Korisnik</th>
                <th>Broj zahtjeva</th>
                <th>Blokiran</th>
                
                </tr>
            </thead><tbody>";

            while ($red = mysqli_fetch_array($rezultat)) {
                echo '<form name="blokForm" id="blokForm" method="post" action="BlokiranjeZahtjeva.php">'
                . "<tr><td>" . $red['Korisnik'] . "</td><td>" . $red['broj'] . "</td><td>" . $red['Blokiran'] . "</td><td>"  
                . "<input type='hidden' id='IDblok' name='IDblok' value='" . $red['Korisnik'] . "'> " 
                . "<input type='hidden' id='blok' name='blok' value='" . $red['Blokiran'] . "'>" 
                . "<input name='blokSubmit' type='submit' value='Blokiraj/Odblokiraj' /> </td></tr></form>";
            }

            echo "</tbody></table>";

            $veza->ZatvoriDB();
            ?>
            <footer>
                <a href="https://validator.w3.org/check?uri=http://barka.foi.hr/WebDiP/2020/zadaca_03/jprga/Pomocni/Blokiranjezahtjeva.php"><img src="../multimedija/HTML5.png" width="50" alt="HTML5"/></a>
                <a href="https://jigsaw.w3.org/css-validator/validator?uri=http://barka.foi.hr/WebDiP/2020/zadaca_03/jprga/CSS/jprga.css"><img src="../multimedija/CSS3.png" width="50" alt="CSS3"/></a>
                <a href="../o_autoru.html"><p>&copy; 2021 Josip Prga</p></a>
            <a href="../dokumentacija.html"><p>Dokumentacija</p></a>
            </footer>   
    </body>
</html>