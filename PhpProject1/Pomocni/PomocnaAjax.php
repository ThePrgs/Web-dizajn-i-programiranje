<?php

$putanja = dirname($_SERVER['REQUEST_URI'], 2);
$direktorij = dirname(getcwd());

include '../sesija.class.php';
include '../baza.class.php';

$veza = new Baza();
$veza->SpojiDB();
Sesija::dajKorisnika();
if (!isset($_SESSION["uloga"])) {
    ?>
    <section id="pocetak">
        <table id="tablica">
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

                if (isset($_POST["dataGrad"]) || isset($_POST["dataZnam"])) {
                    $gradPret = $_POST['dataGrad'];
                    $znamenitostPret = $_POST['dataZnam'];

                    $veza->spojiDB();
                    $upit = "SELECT count(*) as broj, lokacija_grad as grad, naziv_gradevine as znamenitost from WebDiP2020x073.lokacija, WebDiP2020x073.gradevina where lokacija_id = gradevina_lokacija AND lokacija_grad = '{$gradPret}' OR lokacija_id = gradevina_lokacija AND gradevina.naziv_gradevine = '{$znamenitostPret}' group by grad;";
                    $rezultat = $veza->SelectDB($upit);
                } elseif (isset($_POST['grad'])) {
                    $veza->spojiDB();
                    $upit = "SELECT count(*) as broj, lokacija_grad as grad, naziv_gradevine as znamenitost from WebDiP2020x073.lokacija, WebDiP2020x073.gradevina where lokacija_id = gradevina_lokacija group by grad order by grad;";
                    $rezultat = $veza->SelectDB($upit);
                } elseif (isset($_POST['znam'])) {
                    $veza->spojiDB();
                    $upit = "SELECT count(*) as broj, lokacija_grad as grad, naziv_gradevine as znamenitost from WebDiP2020x073.lokacija, WebDiP2020x073.gradevina where lokacija_id = gradevina_lokacija group by grad order by znamenitost;";
                    $rezultat = $veza->SelectDB($upit);
                } else {
                    $veza->SpojiDB();

                    $upit = "SELECT count(*) as broj, lokacija_grad as grad, naziv_gradevine as znamenitost from WebDiP2020x073.lokacija, WebDiP2020x073.gradevina where lokacija_id = gradevina_lokacija group by grad;";

                    $rezultat = $veza->SelectDB($upit);
                }
                while ($red = mysqli_fetch_array($rezultat)) {
                    echo "<tr><td>" . $red['grad'] . "</td><td>" . $red['broj'] . "</td><td>" . $red['znamenitost'] . "</td></tr>";
                }

                echo "</tbody></table></section>";
                $veza->ZatvoriDB();
            }

            if ($_SESSION["uloga"] == 3) {
                ?>
            <section id="pocetak">
                <table id="tablica">
                    <thead> <tr><th>Ime grada</th>
                            <th>Naziv znamenitosti</th>
                            <th>Status</th>
                            <th>Opis znamenitosti</th>
                            <th>Godina</th>
                        </tr>
                    </thead><tbody>
                        <?php

                        if (isset($_POST["dataGrad"]) || isset($_POST["dataZnam"])) {
                            $gradPret = $_POST['dataGrad'];
                            $znamenitostPret = $_POST['dataZnam'];

                            $veza->SpojiDB();

                            $upit = "SELECT lokacija_grad as grad, zahtjev_naziv as naziv, zahtjev_status as status, zahtjev_opis as opis, zahtjev_godina as godina FROM WebDiP2020x073.lokacija, WebDiP2020x073.zahtjev where zahtjev_lokacija = lokacija_id AND lokacija_grad = '{$gradPret}' OR zahtjev_lokacija = lokacija_id AND zahtjev_naziv = '{$znamenitostPret}';";
                            $rezultat = $veza->SelectDB($upit);
                        } elseif (isset($_POST["grad"])) {
                            $veza->SpojiDB();

                            $upit = "SELECT lokacija_grad as grad, zahtjev_naziv as naziv, zahtjev_status as status, zahtjev_opis as opis, zahtjev_godina as godina FROM WebDiP2020x073.lokacija, WebDiP2020x073.zahtjev where zahtjev_lokacija = lokacija_id order by grad;";
                            $rezultat = $veza->SelectDB($upit);
                            ;
                        } elseif (isset($_POST["znam"])) {
                            $veza->SpojiDB();

                            $upit = "SELECT lokacija_grad as grad, zahtjev_naziv as naziv, zahtjev_status as status, zahtjev_opis as opis, zahtjev_godina as godina FROM WebDiP2020x073.lokacija, WebDiP2020x073.zahtjev where zahtjev_lokacija = lokacija_id order by naziv;";
                            $rezultat = $veza->SelectDB($upit);
                        } else {
                            $veza->SpojiDB();

                            $upit = "SELECT lokacija_grad as grad, zahtjev_naziv as naziv, zahtjev_status as status, zahtjev_opis as opis, zahtjev_godina as godina FROM WebDiP2020x073.lokacija, WebDiP2020x073.zahtjev where zahtjev_lokacija = lokacija_id;";
                            $rezultat = $veza->SelectDB($upit);
                        }

                        while ($red = mysqli_fetch_array($rezultat)) {
                            echo "<tr><td>" . $red['grad'] . "</td><td>" . $red['naziv'] . "</td><td>" . $red['status'] . "</td><td>" . $red['opis'] . "</td><td>" . $red['godina'] . "</td></tr>";
                        }
                        echo "</tbody></table></section>";
                        $veza->ZatvoriDB();
                    }
                    ?>
