jQuery(document).ready(function($) {
    $("#resetear").click(function() {
        $("#prestamo").val("");
        $("#anos").val("");
        $("#interes").val("");
        $("#resultado").html("resultado");
		
		    }});
    $("#calcularprestamos").click(function() {
        var prestamo = parseFloat($("#prestamo").val());
        		var inicial = parseInt (1 * 0);
       var anos = parseInt($("#anos").val());
	   var mes = parseInt(anos + 0);
	   var interes = parseFloat($("#interes").val());
	   var totalinteres = parseFloat (interes / 1200);
        var montoapagar = prestamo + totalinteres;
        var montoapagar2 = montoapagar - inicial;
	   
	   var cuotamensual = montoapagar2 * totalinteres / (1 - (Math.pow(1/(1 + totalinteres), mes)));
      cuotamensual = cuotamensual.toFixed(2);
	
        if (prestamo < inicial) {
            $("#resultado").html("Mala entrada");
        } else if ($.isNumeric(montoapagar)) {
            $("#resultado").html("$" + cuotamensual + " / mes");
        } else if (prestamo == "" || incial == "" || mes == "" || interes == "") {
            $("#resultado").html("Ponga Todos los campos");
        } else {
            $("#resultado").html("Mala entrada");
        }

    });
});
