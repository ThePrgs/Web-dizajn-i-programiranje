<?php
require '../sesija.class.php';
require '../baza.class.php';

$nePostoji=true;
$emailDobar = false;
if (isset($_POST["submit"])) {
$veza = new Baza();
$veza->spojiDB();
    
    
$mail = $_POST['mail'];
    
$upit = "SELECT korisnik_email FROM webdip2020x073.korisnik;";

$rezultat = $veza->selectDB($upit);

while($red= mysqli_fetch_array($rezultat)){
    if($mail == $red['korisnik_email']){
        $nePostoji=false;
    }
}

if(preg_match("/^[\w\.]+@([\w]+\.)+[\w]{2,4}/", $mail)){
        $emailDobar=true;       
    }

if(!$nePostoji && $emailDobar){
    $sifra = rand();
    mail($mail,"Zaboravljena sifra","Vasa nova sifra je '{$sifra}'");
    $upitZaUpdate = "UPDATE webdip2020x073.korisnik SET 'korisnik_lozinka' = '{$sifra}' WHERE 'korisnik_email' = '{$mail}'";
    $veza->updateDB($upitZaUpdate);
}    
    
$veza->zatvoriDB();
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Zaboravljena sifra</title>
        <meta charset="utf-8">       
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="naslov" content="Zaboravljena sifra">
        <meta name="autor" content="Josip Prga">
        <meta name="opis" content="Stranica za zaboravljenu sifru naše web stranice">
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
            <a href="../obrasci/prijava.php"><p style="float:left">Natrag</p></a>
            <a href="#pocetakPrijave"> <h1>Zaboravljena sifra</h1></a>
        </header>
     
        <section id="pocetakPrijave">
            <form name="sifra" id="sifra" method="post" action=zaboravljenaSifra.php>
                <label for="email">Vas mail: </label>
                <input id="email" name="mail" type="text"/><br>
               
                <input name="submit" type="submit" value="Prijavi se" />

            </form>
            
        </section>
        <?php if($nePostoji || !$emailDobar) echo "<p>Takav mail ne postoji registriran</p>"; ?>
        <footer>
            <a href="https://validator.w3.org/check?uri=http://barka.foi.hr/WebDiP/2020/zadaca_03/jprga/obrasci/prijava.html"><img src="../multimedija/HTML5.png" width="50" alt="HTML5"/></a>
            <a href="https://jigsaw.w3.org/css-validator/validator?uri=http://barka.foi.hr/WebDiP/2020/zadaca_03/jprga/CSS/jprga.css"><img src="../multimedija/CSS3.png" width="50" alt="CSS3"/></a>
            <a href="autor.html"><p>&copy; 2021 Josip Prga</p></a>
        </footer>   
    </body>
</html>