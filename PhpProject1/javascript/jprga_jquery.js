$(document).ready((function () {
    naslov = $(document).find("title").text();
    switch (naslov) {
        case "Pocetna stranica":

            $('#tablica').dataTable(
                    {
                        "aaSorting": [[0, "asc"], [1, "asc"], [2, "asc"]],
                        "bPaginate": true,
                        "bLengthChange": true,
                        "bFilter": true,
                        "bSort": true,
                        "bInfo": true,
                        "bAutoWidth": true
                    });
            break;

        case "Registracija":

            $(document).ready(function () {

                $("#registracija").submit(function () {

                    var username = $("#korimeReg").val().trim();

                    if (username != '') {

                        $.ajax({
                            url: 'registracija.php',
                            type: 'post',
                            data: {username: username},
                            success: function (response) {

                                $('#uname_response').html(response);

                            }
                        });
                    } else {
                        $("#uname_response").html("");
                    }

                });

            });

            document.getElementById("email").addEventListener("input", function () {

                if (/^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/.test($('#email').val())) {

                    var datumVrijemeBox = document.getElementById("email");
                    datumVrijemeBox.style.borderColor = "green";
                } else {
                    var datumVrijemeBox = document.getElementById("email");
                    datumVrijemeBox.style.borderColor = "red";
                }
            });

            document.getElementById("korimeReg").addEventListener("input", function () {

                if (/\w{4,}/.test($('#korimeReg').val())) {

                    var korimeRegBox = document.getElementById("korimeReg");
                    korimeRegBox.style.borderColor = "green";
                } else {
                    var korimeRegBox = document.getElementById("korimeReg");
                    korimeRegBox.style.borderColor = "red";
                }
            });

            document.getElementById("lozinka2").addEventListener("input", function () {

                var lozinka1 = document.getElementById("lozinka1").value;
                var lozinka2 = document.getElementById("lozinka2").value;
                if (lozinka1 === lozinka2) {

                    var lozinka2Box = document.getElementById("lozinka2");
                    lozinka2Box.style.borderColor = "green";

                } else {
                    var lozinka2Box = document.getElementById("lozinka2");
                    lozinka2Box.style.borderColor = "red";
                }
            });

            document.getElementById("ime").addEventListener("input", function () {

                if (/[A-Z][a-z]{2,}/.test($('#ime').val())) {

                    var korimeRegBox = document.getElementById("ime");
                    korimeRegBox.style.borderColor = "green";
                } else {
                    var korimeRegBox = document.getElementById("ime");
                    korimeRegBox.style.borderColor = "red";
                }
            });

        

            document.getElementById("datumRodj").addEventListener("input", function () {
                if (/(19|20)\d\d\-(0[1-9]|1[012])\-(0[1-9]|[12][0-9]|3[01])/.test($('#datumRodj').val())) {

                    var datumVrijemeBox = document.getElementById("datumRodj");
                    datumVrijemeBox.style.borderColor = "green";
                } else {
                    var datumVrijemeBox = document.getElementById("datumRodj");
                    datumVrijemeBox.style.borderColor = "red";
                }
            });


            break;


        case "Galerija":
            function dobaviSlike() {
                $.ajax({
                    url: 'https://barka.foi.hr/WebDiP/2020/materijali/zadace/dz3/userNameSurname.php?all',
                    type: 'GET',
                    dataType: 'xml',
                    success: function (xml) {
                        $(xml).find('korisnik').each(function () {
                            if ($(this).find('slika').attr('url') === 'images/users/default.jpg') {
                                $('#noveSlike').append('<figure>' + '<img src="multimedija/default.jpg" alt="default" width="410" height="300" class="image">' + '<figcaption>' + $(this).find('imePrezime').text() + '</figcaption>' + '</figure>');
                            }
                        });
                    },
                    error: function (error) {
                        alert("Pogreska");
                    }
                });
            }
            document.getElementById('tipka').onclick = dobaviSlike;




            $("#noveSlike").on('click', 'figure', function () {
                var slika = $(this);
                var imePrezime = $(this).find('figcaption').text();
                var imeIPrezime = imePrezime.split(" ");

                $.ajax({
                    url: 'https://barka.foi.hr/WebDiP/2020/materijali/zadace/dz3/userNameSurname.php?ime=' + imeIPrezime[0] + '&prezime=' + imeIPrezime[1],
                    type: 'POST',
                    dataType: 'xml',
                    async: false,
                    success: function (xml) {
                        $(xml).find('korisnici').each(function () {
                            if ($(this).find('username').text() === 0) {
                                alert("Greška kod učitavanja!");
                            } else {
                                document.cookie = "ime=" + $(this).find('ime').text() + " prezime=" + $(this).find('prezime').text() + " username=" + $(this).find('username').text() + " tip=" + $(this).find('tip').text();
                                slika.find('img').attr('style', 'border: 2px solid black');

                            }
                        });
                    },
                    error: function (error) {
                        alert("Pogreska");
                    }

                });
            });

            break;
    }



}));

