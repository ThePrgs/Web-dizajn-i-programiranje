$(document).ready((function () {
    naslov = $(document).find("title").text();
    switch (naslov) {
        case "Pocetna stranica":



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
           
            break;

       case "Pocetna":



            function tablica() {            
                    
                    $.get("Pomocni/PomocnaAjax.php", function (data) {
                        $("#tablica").html(data);
                    });
                };
            
            function filtriranje(){
                var grad=document.getElementById("gradPret").value;
                var znamenitost=document.getElementById("znamenitostPret").value;
                
                $.ajax({
                    type: "POST",
                    url: "Pomocni/PomocnaAjax.php",
                    data: {
                        "dataGrad":grad, 
                        "dataZnam":znamenitost
                        } ,
                    cache: false,
                    success: function(data){
                        
                        $("#tablica").html(data);
                    }
                    
                });
            }
            
            function sortiranjeGrad(){
                
                var grad="";
                $.ajax({
                    
                    type: "POST",
                    url: "Pomocni/PomocnaAjax.php",
                    data: {"grad":grad} ,
                    cache: false,
                    success: function(data){
                        
                        $("#tablica").html(data);
                    }
                    
                });
            }
            
            function sortiranjeZnam(){
                
                var znam="";
                $.ajax({
                    type: "POST",
                    url: "Pomocni/PomocnaAjax.php",
                    data: {"znam":znam } ,
                    cache: false,
                    success: function(data){
                        
                        $("#tablica").html(data);
                    }
                    
                });
            }
            
            document.getElementById('reset').onclick = tablica;
            document.getElementById('submitPret').onclick= filtriranje;
            document.getElementById('submitSortGrad').onclick= sortiranjeGrad;
            document.getElementById('submitSortZnam').onclick= sortiranjeZnam;
            
    }



}));

