<?php
$putanja = dirname($_SERVER['REQUEST_URI'], 2);
$direktorij = dirname(getcwd());

include '../sesija.class.php';
include '../baza.class.php';

$veza = new Baza();

if (isset($_POST["blokSubmit"])) {
    $id = $_POST["IDblok"];
    $blokiran = $_POST["blok"];
    $veza->spojiDB();

    if ($blokiran >= 3) {
        $upit = "UPDATE korisnik SET korisnik_blokiran=0 WHERE korisnik_id='{$id}'";
    } else {
        $upit = "UPDATE korisnik SET korisnik_blokiran=3 WHERE korisnik_id='{$id}'";
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
            <a href="../administratorPS.php"><p style="float:left">Natrag</p></a>
            <h1>Blokiranje Racuna</h1></a>
        </header>
        <h1>Korisnici</h1>
        <table id="tablica">
            <?php
            $veza->spojiDB();
            $upit = "SELECT korisnik_id as ID, tipkorisnika_id as Tip, korisnik_email as Mail, korisnik_naziv as Korime, korisnik_lozinka as Lozinka, korisnik_ime as Ime, korisnik_datumRodj as Datum, korisnik_blokiran as Blokiran from WebDiP2020x073.korisnik where korisnik_id!=1;";
            $rezultat = $veza->selectDB($upit);

            echo "<thead> <tr><th>Korisnik ID</th>
                <th>Tip Korisnika</th>
                <th>Mail</th>
                <th>Korisnicko ime</th>
                <th>Lozinka</th>
                <th>Ime</th>
                <th>Datum Rodjenja</th>
                <th>Blokiran</th>
                </tr>
            </thead><tbody>";

            while ($red = mysqli_fetch_array($rezultat)) {
                echo '<form name="blokForm" id="blokForm" method="post" action="BlokiranjeRacuna.php">'
                . "<tr><td>" . $red['ID'] . "</td><td>" . $red['Tip'] . "</td><td>" . $red['Mail'] . "</td><td>" . $red['Korime'] . "</td><td>" . $red['Lozinka'] . "</td><td>" . $red['Ime'] . "</td><td>" . $red['Datum'] . "</td><td>" . $red['Blokiran'] . "</td><td>"
                . "<input type='hidden' id='IDblok' name='IDblok' value='" . $red['ID'] . "'> "
                . "<input type='hidden' id='blok' name='blok' value='" . $red['Blokiran'] . "'>"
                . "<input name='blokSubmit' type='submit' value='Blokiraj/Odblokiraj' /> </td></tr></form>";
            }

            echo "</tbody></table>";

            $veza->ZatvoriDB();
            ?>
            <section id="prazniProstor"></section>
            

            <footer>
                <a href="https://validator.w3.org/check?uri=http://barka.foi.hr/WebDiP/2020/zadaca_03/jprga/Pomocni/BlokiranjeRacuna.php"><img src="../multimedija/HTML5.png" width="50" alt="HTML5"/></a>
                <a href="https://jigsaw.w3.org/css-validator/validator?uri=http://barka.foi.hr/WebDiP/2020/zadaca_03/jprga/CSS/jprga.css"><img src="../multimedija/CSS3.png" width="50" alt="CSS3"/></a>
                <a href="../o_autoru.html"><p>&copy; 2021 Josip Prga</p></a>
            <a href="../dokumentacija.html"><p>Dokumentacija</p></a>
            </footer>   
    </body>
</html>