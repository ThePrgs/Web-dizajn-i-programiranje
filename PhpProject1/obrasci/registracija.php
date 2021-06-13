<?php
$putanja = dirname($_SERVER['REQUEST_URI'], 2);
$direktorij = dirname(getcwd());

include '../sesija.class.php';
include '../baza.class.php';
$postojeci = false;
$lozinkeIste = false;
$captchaDobra =false;
$datumDobar = false;
$imeDobro=false;
$korimeDobro=false;
$emailDobar=false;

$veza = new Baza();


if (isset($_POST['korimeReg'])) {
    $veza->spojiDB();
    Sesija::dajKorisnika();
    $korimeReg = $_POST['korimeReg'];
    $email = $_POST['email'];
    $lozinka1 = $_POST['lozinka1'];
    $lozinka2 = $_POST['lozinka2'];
    $captchaUnesena = $_POST['captchaUnesena'];
    $capchaDana =$_POST['captcha'];
    $datumRodj =$_POST['datumRodj'];
    $ime = $_POST['ime'];

    $query = "select count(*) as cntUser from WebDiP2020x073.korisnik where korisnik_naziv='" . $korimeReg . "'";

    $result = $veza->selectDB($query);
    if ($lozinka1 != $lozinka2) {
        $lozinkeIste = true;
    }
    
    if(preg_match("/\w{4,}/", $korimeReg)){
        $korimeDobro=true;
    }
    
    if(preg_match("/^[\w\.]+@([\w]+\.)+[\w]{2,4}/", $email)){
        $emailDobar=true;       
    }
    
    if(preg_match("/[A-Z][a-z]{2,}/", $ime)){
        $imeDobro=true;
    }
    
    if(preg_match("/(19|20)\d\d\-(0[1-9]|1[012])\-(0[1-9]|[12][0-9]|3[01])/", $datumRodj)){
        $datumDobar=true;
    }
    
    if($captchaUnesena == $capchaDana){
        $captchaDobra=true;
    }
    
    if (mysqli_num_rows($result)) {
        $row = mysqli_fetch_array($result);

        $count = $row['cntUser'];

        if ($count > 0) {
            $postojeci = true;
        }
        
        
        $lozinkaSHA = hash('sha256', $lozinka1);
        
        
        if ($count == 0 && $korimeReg != "" && !$lozinkeIste && $captchaDobra && $imeDobro && $korimeDobro && $datumDobar && $emailDobar) {
            
            $dodaj = "INSERT INTO WebDiP2020x073.korisnik (tipkorisnika_id, korisnik_email, korisnik_naziv, korisnik_lozinka, korisnik_lozinkaSHA,korisnik_ime, korisnik_datumRodj) VALUES ('3', '{$email}', '{$korimeReg}', '{$lozinka1}','{$lozinkaSHA}' ,'{$ime}','{$datumRodj}')";
            $veza->selectDB($dodaj);
        }
    }
   

    $veza->zatvoriDB();
}
?>
<!DOCTYPE html>

<html>
    <head>
        <title>Registracija</title>
        <meta charset="utf-8">       
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="naslov" content="Registracija">
        <meta name="autor" content="Josip Prga">
        <meta name="opis" content="Registracija naše web stranice">
        <meta name="kljucne_rijeci" content="registracija, stranica, web">
        <link href="../CSS/jprga.css" type = "text/css" rel = "stylesheet" id="stylesheet"/>
        <link rel='stylesheet' href='//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css'>
        
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js" defer></script>
        <script src="//code.jquery.com/jquery-1.12.4.js" defer></script>
        <script src="//code.jquery.com/ui/1.12.1/jquery-ui.js" defer></script>       
        <script type="text/javascript" src='../javascript/jprga_jquery.js' defer></script>
        <script src="../javascript/jprga.js" defer></script>
        <script src="../javascript/popup.js" defer></script>


    </head>
    <body id="tijelo">
        <header>
            <h1>Registracija</h1>
            <a href="#"><img src="../multimedija/ikona_pristupacnosti.png" id="ikonaR" alt="pristupanost" width="20" style="float:right"/></a>
            <img src="../multimedija/rss.png" alt="RSS" width="20" style="float:right"/>
            <img src="../multimedija/twitter.png" alt="twitter" width="20" style="float:right"/>
            <img src="../multimedija/instagram.png" alt="instgram" width="20" style="float:right" />
        </header>
        <nav>
            <ul>
                <li><a href="../index.php">Početna</a></li>
               
                <li><a href="prijava.php">Prijava</a> </li>

            </ul>
        </nav>
        <section id="pocetakPrijave">
            <form id="registracija" name="registracija" method="post">
                <div class="popup"><label for="ime">Ime: </label>
                    <span class="popuptext" id="myPopup0">Veliko pocetno slovo</span></div>
                <input type="text" id="ime" name="ime" size="15" maxlength="15"/><br>
                <div class="popup"><label for="korimeReg">Korisničko ime: </label>
                    <span class="popuptext" id="myPopup1">Minimalno 4 slova</span></div>
                <input type="text" id="korimeReg" name="korimeReg" size="15" maxlength="15"  placeholder="korisničko ime"/><br>
                 <div class="popup"><label for="email">Email adresa: </label>
                      <span class="popuptext" id="myPopup2">Format xxx@xx.xx</span></div>
                <input type="text" id="email" name="email" size="35" maxlength="35" placeholder="ime.prezime@posluzitelj.xxx" /><br> 
                <div class="popup"><label for="datumRodj">Datum rođenja: </label>
                    <span class="popuptext" id="myPopup3">Format gggg-mm-dd</span></div>
                <input type="text" id="datumRodj" name="datumRodj" size="15"/><br>
                <div class="popup"><label for="lozinka1">Lozinka: </label>
                    <span class="popuptext" id="myPopup4">Lozinke moraju biti iste</span></div>
                <input type="password" id="lozinka1" name="lozinka1" size="15" placeholder="lozinka" /><br>
                <label for="lozinka2">Ponovi lozinku: </label>
                <input type="password" id="lozinka2" name="lozinka2" size="15" placeholder="lozinka" /><br>   
                <?php
                
                $capcha = rand();
                echo '<div class="popup"><label for="captcha">Captcha:<br>' . $capcha . '</label><br><span class="popuptext" id="myPopup5">Unesite prikazani broj</span></div><br>';
                echo '<input type = "text" id="captchaUnesena" name="captchaUnesena" required="required"><br>';
                echo "<input type = hidden id='captcha' name='captcha' value= '{$capcha}' />"; 
                
                ?>
                <input name = "submit3" type = "submit" value = "Registriraj se"/>
            </form>
        </section>

        
        <?php
        if ($lozinkeIste == true) {
            echo "<p> Lozinke nisu jednake </p>";
        }
        if ($postojeci == true) {
            echo "<p> Korisnik vec postoji </p>";
        }
        ?>
        <div id="uname_response" ></div>
        <footer>
            <a href="https://validator.w3.org/check?uri=http://barka.foi.hr/WebDiP/2020_projekti/WebDiP2020x073/obrasci/registracija.php"><img src="multimedija/HTML5.png" width="50" alt="HTML5"/></a>
            <a href="https://jigsaw.w3.org/css-validator/validator?uri=http://barka.foi.hr/WebDiP/2020_projekti/WebDiP2020x073/CSS/jprga.css"><img src="multimedija/CSS3.png" width="50" alt="CSS3"/></a> 
            <a href="../o_autoru.html"><p>&copy; 2021 Josip Prga</p></a>
            <a href="../dokumentacija.html"><p>Dokumentacija</p></a>
        </footer>
    </body>
</html>
