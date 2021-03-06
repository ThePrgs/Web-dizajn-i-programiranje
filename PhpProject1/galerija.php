
<!DOCTYPE html>
<html>
    <head>
        <title>Galerija</title>
        <meta charset="utf-8">       
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="naslov" content="Galerija">
        <meta name="autor" content="Josip Prga">
        <meta name="opis" content="Galerija naše web stranice">
        <meta name="kljucne_rijeci" content="galerija, slike, web">
        <link href="CSS/jprga.css" type = "text/css" rel = "stylesheet" id="stylesheet"/>
        <style type="text/css">.image:hover{transform: scale(1.1);border-color: blue;} </style>
      
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
         <script type="text/javascript" src="javascript/jprga.js" defer></script>
        
        <script type="text/javascript" src="javascript/jprga_jquery.js"></script>
    </head>
    <body id="tijelo">
       
        <header>
             <a href="odjava.php"><p style="float:right">Odjava</p></a>
            <h1>Galerija</h1>
            <a href="#"><img src="multimedija/ikona_pristupacnosti.png" id="ikonaPoc" alt="pristupanost" width="20" style="float:right"/></a>
            <img src="multimedija/rss.png" alt="RSS" width="20" style="float:right"/>
            <img src="multimedija/twitter.png" alt="twitter" width="20" style="float:right"/>
            <img src="multimedija/instagram.png" alt="instgram" width="20" style="float:right" />
        </header>
        <nav>
            <ul>
                <li><a href="index.php">Početna</a> </li>
                
                              
            </ul>
        </nav>
        <section id="prazniProstor">
             <div class="popup2"><span class="popuptext" id="myPopup0"></span></div>
        </section>
        <section id="pocetak">
            <hr>
            <figure>              
                <img src='multimedija/arh1.jpeg' alt="arh1" width="410" height="300" class="image" >
                <figcaption>Bioinnova, Mexico</figcaption>           
            </figure>
            <figure>             
                <img src='multimedija/arh2.jpg' alt="arh2" width="410" height="300" class="image">
                <figcaption>Model</figcaption>           
            </figure>
            <figure>            
                <img src='multimedija/arh11.jpg' alt="arh11" width="410" height="300" class="image">
                <figcaption>City Hall, Hamburg</figcaption>                
            </figure>
            <figure>              
                <img src='multimedija/arh12.jpg' alt="arh12" width="410" height="300" class="image">
                <figcaption>Palace of Fine Arts Weddings, San Francisco</figcaption>             
            </figure> 
            <figure>                
                <img src='multimedija/arh3.jpg' alt="arh3" width="410" height="300" class="image">
                <figcaption>Riverside Museum, Glasgow</figcaption>              
            </figure>
            <figure>             
                <img src='multimedija/arh4.jpg' alt="arh4" width="410" height="300" class="image">
                <figcaption>Crtež arhitekta</figcaption>              
            </figure>  
            <figure>             
                <img src='multimedija/arh5.jpg' alt="arh5" width="410" height="300" class="image">
                <figcaption>Skica kuće</figcaption>              
            </figure>
            <figure>             
                <img src='multimedija/arh6.jpg' alt="arh6" width="410" height="300" class="image">
                <figcaption>Resident Building, LA</figcaption>                         
            </figure>  
            <figure>
                <img src='multimedija/arh7.jpg' alt="arh7" width="410" height="300" class="image">
                <figcaption>Bosjes, Worcester</figcaption>
            </figure><!-- comment -->
            <figure>
                <img src='multimedija/arh8.jpg' alt="arh8" width="410" height="300" class="image">
                <figcaption>Dean Hotel, Dublin</figcaption>
            </figure>  
            <figure>
                <img src='multimedija/arh9.jpg' alt="arh9" width="410" height="300" class="image">
                <figcaption>Shelby Farms Park, Memphis</figcaption>
            </figure><!-- comment -->
            <figure>
                <img src='multimedija/arh10.jpg' alt="arh10" width="410" height="300" class="image">
                <figcaption>Crkva, Pskov</figcaption>
            </figure>  
            <hr>
            <div id="noveSlike">
                
            </div>
        </section>
            
        
        <footer>
            <a href="https://validator.w3.org/check?uri=http://barka.foi.hr/WebDiP/2020_projekti/WebDiP2020x073/galerija.php"><img src="multimedija/HTML5.png" width="50" alt="HTML5"/></a>
            <a href="https://jigsaw.w3.org/css-validator/validator?uri=http://barka.foi.hr/WebDiP/2020_projekti/WebDiP2020x073/CSS/jprga.css"><img src="multimedija/CSS3.png" width="50" alt="CSS3"/></a> 
            <a href="o_autoru.html"><p>&copy; 2021 Josip Prga</p></a>
            <a href="dokumentacija.html"><p>Dokumentacija</p></a>
        </footer>
    </body>
</html>
