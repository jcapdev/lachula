window.onload = function(){
    $.get("https://ipinfo.io", function (response) {
        
        var timezone = ['America/Chihuahua','Africa/Malabo','America/Argentina/Buenos_Aires','America/Argentina/Catamarca','America/Argentina/Cordoba','America/Argentina/Jujuy','America/Argentina/La_Rioja','America/Argentina/Mendoza','America/Argentina/Rio_Gallegos','America/Argentina/San_Juan','America/Argentina/Tucuman','America/Argentina/Ushuaia','America/Asuncion','America/Bogota','America/Campo_Grande','America/Cancun','America/Caracas','America/Costa_Rica','America/El_Salvador','America/Guatemala','America/Guayaquil','America/Havana','America/Hermosillo','America/La_Paz','America/Lima','America/Managua','America/Mazatlan','America/Merida','America/Mexico_City','America/Monterrey','America/Montevideo','America/Panama','America/Puerto_Rico','America/Santo_Domingo','America/Tegucigalpa','America/Tijuana','Chile/Continental','Europe/Andorra','Europe/Gibraltar','Europe/Madrid','Pacific/Galapagos','America/Sao_Paulo','America/Araguaina','America/Bahia','America/Belem','America/Boa_Vista','America/Campo_Grande','America/Fortaleza','America/Maceio','America/Manaus','America/Noronha','America/Porto_Velho','America/Rio_Branco'];
        var code= response.timezone;
        var index = timezone.indexOf(code);
        if(index > -1){
            document.getElementById('selected_lang').value = 'es'
            $("#selected_lang").val("es");
            translator.lang("es");
            var uno = document.getElementById('dropdownMenuButton');
            uno.innerHTML = 'Español';
        }
        else{
            document.getElementById('selected_lang').value = 'en'
            $("#selected_lang").val("en");
            translator.lang("en");

            var uno = document.getElementById('dropdownMenuButton');
            uno.innerHTML = 'English';

            $("#name1").attr("placeholder", "Name:");
            $("#client1").attr("placeholder", "Company:");
            $("#email1").attr("placeholder", "Email:");
            $("#phone1").attr("placeholder", "Phone number:");
            $("#subject1").attr("placeholder", "Subject:");
            $("#message1").attr("placeholder", "Message:");
            $("#lang").val("en");
            $(".imgtraditional").attr("src", "images/English/TIPOS DE SALSA_TRADICIONAL.png");
            $(".imggreen").attr("src", "images/English/TIPOS DE SALSA__GREEN.png");
            $(".imgchip").attr("src", "images/English/TIPOS DE SALSA_CHIPOTLE.png");
            
            $("#pop_tradicional").attr("src", "images/English/TRADICIONAL_EN.png");
            $("#pop_verde").attr("src", "images/English/VERDE_EN.png");
            $("#pop_chipotle").attr("src", "images/English/CHIPOTLE_EN.png");
        }
    }, "jsonp");
}