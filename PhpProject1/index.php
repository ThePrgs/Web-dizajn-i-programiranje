<?php
$putanja = dirname($_SERVER['REQUEST_URI'], 2);
$direktorij = dirname(getcwd());

include 'sesija.class.php';
include 'baza.class.php';

Sesija::dajKorisnika();

if (!isset($_SESSION["uloga"])) {

    header("Location: pocetkaNRK.php");
}

if($_SESSION["uloga"]==3){
    header("Location: pocetnaRK.php");
}

if($_SESSION["uloga"]==2){
    header("Location: pocetnaMod.php");
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Pocetna stranica</title>
        <meta charset="utf-8">       
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="naslov" content="Početna stranica">
        <meta name="autor" content="Josip Prga">
        <meta name="opis" content="Početna stranica naše web stranice">
        <meta name="kljucne_rijeci" content="pocetna, stranica, web">      
        <link href="CSS/jprga.css" type = "text/css" rel = "stylesheet"/>
    </head>
    <body>
        <header>
             <a href="odjava.php"><p style="float:right">Odjava</p></a>
            <a href="#pocetak"> <h1>Početna stranica</h1></a>
            <img src="multimedija/rss.png" alt="RSS" width="20" style="float:right"/>
            <img src="multimedija/twitter.png" alt="twitter" width="20" style="float:right"/>
            <img src="multimedija/instagram.png" alt="instgram" width="20" style="float:right" />
        </header>
        <nav>
            <ul>
                <li><a href="autor.php">Autor</a> </li>
                <li><a href="galerija.php">Galerija</a> </li>
                <li><a href="obrasci/obrazac.php">Obrazac</a> </li>
                <li><a href="obrasci/prijava.php">Prijava</a> </li>
                <li><a href="obrasci/registracija.php">Registracija</a> </li>

            </ul>
        </nav>

        <section id="pocetak">
            <?php
            $veza = new Baza();

            $veza->SpojiDB();

            $upit = "SELECT * FROM arhitekt";

            $rezultat = $veza->SelectDB($upit);

            echo "<table>";
            echo "<thead> <tr><th>Ime arhitektra</th>
                <th>Prezime arhitekta</th>
                <th>Godina rodjenja</th>
                <th>Godina smrti</th>
                </tr>
            </thead>";

            while ($red = mysqli_fetch_array($rezultat)) {
                echo "<tr><td>" . $red['arhitekt_ime'] . "</td><td>" . $red['arhitekt_prezime'] . "</td><td>" . $red['arhitekt_godinaRodjenja'] . "</td><td>" . $red['arhitekt_godinaSmrti'] . "</td></tr>";
            }

            echo "</table>";

            $veza->ZatvoriDB();
            ?>

        </section>          
        <footer>
            <a href="https://validator.w3.org/check?uri=http://barka.foi.hr/WebDiP/2020/zadaca_03/jprga/index.html"><img src="multimedija/HTML5.png" width="50" alt="HTML5"/></a>
            <a href="https://jigsaw.w3.org/css-validator/validator?uri=http://barka.foi.hr/WebDiP/2020/zadaca_03/jprga/CSS/jprga.css"><img src="multimedija/CSS3.png" width="50" alt="CSS3"/></a>
            <a href="autor.html"><p>&copy; 2021 Josip Prga</p></a>
        </footer>
    </body>
</html>
