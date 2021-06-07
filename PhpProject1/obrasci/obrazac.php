<?php
require '../sesija.class.php';
require '../baza.class.php';

    $putanja = dirname($_SERVER['REQUEST_URI'], 2);
    $direktorij = dirname(getcwd());
    
    Sesija::dajKorisnika();

    if (!isset($_SESSION["uloga"])) {
       
        header("Location: prijava.php");
        
    }elseif (isset($_SESSION["uloga"]) && $_SESSION["uloga"] !== "1") {
        header("Location: prijava.php");
        
    }


?>


<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>Obrazac</title>
        <meta charset="utf-8">       
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="naslov" content="Obrazac">
        <meta name="autor" content="Josip Prga">
        <meta name="opis" content="Obrazac za unos naše web stranice">
        <meta name="kljucne_rijeci" content="obrazac, unos, web">
        <link href="../CSS/jprga.css" type = "text/css" rel = "stylesheet" id="stylesheet"/>
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js" defer></script>
        <script src="//code.jquery.com/jquery-1.12.4.js" defer></script>
        <script src="//code.jquery.com/ui/1.12.1/jquery-ui.js" defer></script>       
        <script type="text/javascript" src='../javascript/jprga_jquery.js' defer></script>
        <script src="../javascript/jprga.js" defer></script>
      
    </head>
    <body id="tijelo">    
        <header>
             <a href="../odjava.php"><p style="float:right">Odjava</p></a>
            <a href id="#pocetakPrijave"> <h1>Obrazac</h1> </a>
            <img src="../multimedija/rss.png" alt="RSS" width="20" style="float:right"/>
            <img src="../multimedija/twitter.png" alt="twitter" width="20" style="float:right"/>
            <img src="../multimedija/instagram.png" alt="instgram" width="20" style="float:right" />
            <a href="#"><img src="../multimedija/ikona_pristupacnosti.png" id="ikonaP" alt="pristupanost" width="20" style="float:right"/></a>
        </header>
        <nav>
            <ul>
                <li><a href="../index.php">Početna</a></li>
                <li><a href="../autor.php">Autor</a> </li>
                <li><a href="../galerija.php">Galerija</a> </li>
                <li><a href="prijava.php">Prijava</a> </li>
                <li><a href="registracija.php">Registracija</a> </li>
                
            </ul>
        </nav>
       
      
        <section id="pocetakObrasca">

            <form id="form1" method="post" name="form1" action="http://barka.foi.hr/WebDiP/2020/materijali/zadace/ispis_forme.php">
                <section id="ogradj">
                    
                    <div class="popup"> <label id="danRodLabela" for="danRod">Datum izrade: </label>
                        <span class="popuptext" id="myPopup0">Unesite u stilu dd/mm/gggg</span>
                    </div> 
                    <input type="text" id="danRod" name="danRod"  ><br>
                    <div class="popup">  <label for="vrijeme">Vrijeme</label>
                        <span class="popuptext" id="myPopup1">Unesite u stilu ss/mm</span>
                    </div> 

                    <input type="time" id="vrijeme" name ="vrijeme" ><br>
                    <label for="godine">Godine izgradnje</label>
                    <input type="number" id="godine" name="godine"><br>   
                    <div class="popup">  <label for="visina">Visina gradjevine: </label>
                        <span class="popuptext" id="myPopup2">Od 0 do 800m</span>
                    </div> 
                    <input type="range" id="visina" name="visina" min="50" max="828" value="180"><br>
                    <label for="grad" id="gradLabela">Grad:</label>
                    <input type="text" id="grad" name="grad" size="15" maxlength="15" placeholder="Grad" ><br>
                    <label for="drzava" id="drzavaLabela">Država:</label>
                    <input type="text" id="drzava" name="drzava" size="15" maxlength="15" placeholder="Drzava" ><br>
                    <label for="cijena" id="cijenaLabela">Cijena:</label>
                    <input type="text" id="cijena" name="cijena" size="15" maxlength="15" placeholder="Cijena" ><br>
                    <div class="popup">  <label for="stil">Stil arhitekture: </label>
                        <span class="popuptext" id="myPopup3">Maksimalno 1</span>
                    </div>     
                    <select id="stil" name="stil">
                        <option value="-1" selected="selected">== Odaberi stil ==</option>
                        <option value="0">Moderna arhitektura</option>
                        <option value="1">Barokna arhitektura</option>
                        <option value="2">Gotička arhitektura</option>
                        <option value="3">Neoklasična arhitekutra</option>
                        <option value="4">Renesansna arhitektura</option>
                        <option value="4">Klasična arhitektura</option>
                        <option value="4">Rokoko arhitektura</option>
                    </select><br>  
                    <div class="popup">  <label for="dropdown" id="dropdownLabela" >Arhitekture</label>
                        <span class="popuptext" id="myPopup4">Odaberite bar 2</span>
                    </div>               
                    <select id="dropdown" name="dropdown[]" size="3" multiple="multiple">
                        <option value="-1" selected="selected">== Odaberi namjenu ==</option>
                        <optgroup label="Boravišne">
                            <option value="0" >Vikendica</option>
                            <option value="1">Boravišna kuća</option>
                        </optgroup>
                        <optgroup label="Poslovne">
                            <option value="2">Poslovna zgrada</option>
                            <option value="3">Državna ustanova</option>
                        </optgroup>
                        <optgroup label="Ostalo">
                            <option value="4">Crkva</option>
                            <option value="5">Kulturni objekt</option>
                            <option value="6">Dvorana</option>
                        </optgroup>
                    </select><br>
                    
                </section>
                <section id="oarh">
                    <p>
                        <label for="ime" id="imeLabela">Ime arhitekta:</label>
                        <input type="text" id="ime" name="korime" size="15" maxlength="15" placeholder="Ime" autofocus="autofocus" ><br>
                        <label for="preime" id="preimeLabela">Prezime arhitekta:</label>
                        <input type="text" id="preime" name="korime" size="15" maxlength="15" placeholder="Prezime" ><br>
                        <label>Spol arhitekta</label><br>
                        <input type="radio" id="musko" name="spol" value="musko">
                        <label for="musko">Muško</label>
                        <input type="radio" id="zensko" name="spol" value="zensko">
                        <label for="zensko">Žensko</label><br>
                        Životopis arhitekta: <br>
                        <textarea name="zivotopis" rows="10" cols="60" maxlength="580" placeholder="Kratak životopis"></textarea><br>
                    </p>
                </section>
                <p>
                    <input id="submit1" type="submit" value="Predaj">
                    <input id="reset1" type="reset" value=" Inicijaliziraj "><br></p>
                <p id="legenda">U gornji dio obrasca upisujete podatke o građevini. U donji dio upisujete podatke o arhitektu koji je dizajnirao.<br></p>
            </form>
        </section>



        <footer>
            <a href="https://validator.w3.org/check?uri=http://barka.foi.hr/WebDiP/2020/zadaca_03/jprga/obrasci/obrazac.html"><img src="../multimedija/HTML5.png" width="50" alt="HTML5"/></a>
            <a href="https://jigsaw.w3.org/css-validator/validator?uri=http://barka.foi.hr/WebDiP/2020/zadaca_03/jprga/CSS/jprga.css"><img src="../multimedija/CSS3.png" width="50" alt="CSS3"/></a>
            <a href="../autor.html"><p>&copy; 2021 Josip Prga</p></a>
        </footer>
    </body>
</html>
