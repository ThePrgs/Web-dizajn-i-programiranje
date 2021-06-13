

function myFunctionPopup() {
    var popup = document.getElementById("myPopup0");
    popup.classList.toggle("show");

}
var brojac;
window.brojac = 0;

function myFunctionPopupSecond() {

    if (brojac > 5) {
        return;
    }
    var popup = document.getElementById("myPopup" + brojac);
    popup.classList.toggle("hide");
    brojac++;
    popup = document.getElementById("myPopup" + brojac);
    popup.classList.toggle("show");
}





function ProvjeraDatuma(danRod) {


    var podjela = danRod.split(".");
    var dan = parseInt(podjela[0], 10);
    var mjesec = parseInt(podjela[1], 10);


    if (dan > 31 || dan < 0) {
        return false;
    }

    if (mjesec > 12 || mjesec < 0) {
        return false;
    }

    return true;
}

window.selected = [];

function ProvjeraMultipla() {
    for (var option of document.getElementById('dropdown').options) {
        if (option.selected) {
            selected.push(option.value);
        }
    }
    if (selected.length > 1) {
        return true;
    }
    return false;
}


window.promjenaStila = 0;

function ChangeStyle() {
    if (promjenaStila === 0) {
        document.getElementById('stylesheet').href = '../CSS/jprga_accesibility.css';
        promjenaStila = 1;
        return;
    }
    if (promjenaStila === 1) {
        document.getElementById('stylesheet').href = '../CSS/jprga.css';
        promjenaStila = 0;
        return;
    }
}

window.promjenaStila2 = 0;

function ChangeStyle2() {
    if (promjenaStila2 === 0) {
        document.getElementById('stylesheet').href = 'CSS/jprga_accesibility.css';
        promjenaStila2 = 1;
        return;
    }
    if (promjenaStila2 === 1) {
        document.getElementById('stylesheet').href = 'CSS/jprga.css';
        promjenaStila2 = 0;
        return;
    }
}


const popap = document.getElementById("tijelo");
popap.addEventListener("load", myFunctionPopup());
const popap2 = document.getElementById("tijelo");
popap2.addEventListener("click", myFunctionPopupSecond, false);


$(document).ready((function () {
    naslov = $(document).find("title").text();
    switch (naslov) {
        case "Obrazac":


            document.getElementById("ime").addEventListener("input", function () {
                var duzinaIme = document.getElementById('ime').value;

                if (duzinaIme.length < 3) {
                    var imeLabela = document.getElementById("imeLabela");
                    imeLabela.style.color = "red";
                    imeLabela.innerHTML = "Ime arhitekta*";
                } else {
                    var imeLabela = document.getElementById("imeLabela");
                    imeLabela.style.color = "black";
                    imeLabela.innerHTML = "Ime arhitekta";
                }
            });

            document.getElementById("grad").addEventListener("input", function () {
                var duzinaIme = document.getElementById('grad').value;
                if (duzinaIme.length < 3) {
                    var gradLabela = document.getElementById("gradLabela");
                    gradLabela.style.color = "red";
                    gradLabela.innerHTML = "Grad*";
                } else {
                    var gradLabela = document.getElementById("gradLabela");
                    gradLabela.style.color = "black";
                    gradLabela.innerHTML = "Grad";
                }
            });

            document.getElementById("drzava").addEventListener("input", function () {
                var duzinaIme = document.getElementById('drzava').value;
                if (duzinaIme.length < 3) {
                    var drzavaLabela = document.getElementById("drzavaLabela");
                    drzavaLabela.style.color = "red";
                    drzavaLabela.innerHTML = "Država*";
                } else {
                    var drzavaLabela = document.getElementById("drzavaLabela");
                    drzavaLabela.style.color = "black";
                    drzavaLabela.innerHTML = "Država";
                }
            });



            document.getElementById("preime").addEventListener("input", function () {
                var duzinaIme = document.getElementById('preime').value;
                if (duzinaIme.length < 3) {
                    var imeLabela = document.getElementById("preimeLabela");
                    imeLabela.style.color = "red";
                    imeLabela.innerHTML = "Prezime arhitekta*";
                } else {
                    var imeLabela = document.getElementById("preimeLabela");
                    imeLabela.style.color = "black";
                    imeLabela.innerHTML = "Prezime arhitekta";
                }
            });





            var ikona = document.getElementById("ikonaP");
            ikona.addEventListener("click", ChangeStyle, false);

            const prekid = document.getElementById("form1");
            prekid.addEventListener("submit", function (event) {
                var danRod = document.getElementById('danRod').value;
                if (ProvjeraDatuma(danRod) === true && ProvjeraMultipla() === true) {
                    return true;
                } else {
                    event.preventDefault();
                    if (window.confirm("Trebate li pomoc?")) {
                        event.preventDefault();
                        location.reload();
                        return false;
                    } else {
                        return false;
                    }
                }
            }, false);

            break;

        case "Registracija":
            var ikonaR = document.getElementById("ikonaR");
            ikonaR.addEventListener("click", ChangeStyle, false);

            break;

        case "Prijava":
            var ikonaPri = document.getElementById("ikonaPri");
            ikonaPri.addEventListener("click", ChangeStyle, false);
            break;

        case "Pocetna":
            var ikonaPoc = document.getElementById("ikonaPoc");
            ikonaPoc.addEventListener("click", ChangeStyle2, false);
            break;
        case "Galerija":
            var ikonaPoc = document.getElementById("ikonaPoc");
            ikonaPoc.addEventListener("click", ChangeStyle2, false);
            break;
            break;

    }
}));


