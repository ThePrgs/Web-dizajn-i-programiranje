<?php

$putanja = dirname($_SERVER['REQUEST_URI'], 2);
$direktorij = dirname(getcwd());

include '../sesija.class.php';
include '../baza.class.php';

$veza = new Baza;

$veza->spojiDB();

$query = "select * from webdip2020x073.korisnik;";

$veza->selectDB($query);


echo "<table>";
echo "<thead> <tr><th>Email</th>
                <th>Kor Ime</th>
                <th>Lozinka</th>
                <th>Ime</th>
                <th>DatumRodj</th>
                </tr>
            </thead>";

while ($red = mysqli_fetch_array($rezultat)) {
    echo "<tr><td>" . $red['korisnik_email'] . "</td><td>" . $red['korisnik_naziv'] . "</td><td>" . $red['korisnik_lozinka'] . "</td><td>" . $red['korisnik_ime'] . "</td><td>". $red['korisnik_datumRodj'] . "</td></tr>";
}

echo "</table>";

$veza->ZatvoriDB();
?>