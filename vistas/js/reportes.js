/*Variable localStorage*/

if(localStorage.getItem("capturarRango2") != null){

	$("#daterange-btn2 span").html(localStorage.getItem("capturarRango2"));

}else{

	$("#daterange-btn2 span").html('<i class="fa fa-calendar"></i> Rango de fecha');

}

/*Rango de ventas*/

 $('#daterange-btn2').daterangepicker(
      {
        ranges   : {
          'Hoy'       : [moment(), moment()],
          'Ayer'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Últimos 7 días' : [moment().subtract(6, 'days'), moment()],
          'Últimos 30 días': [moment().subtract(29, 'days'), moment()],
          'Este mes'  : [moment().startOf('month'), moment().endOf('month')],
          'Último mes'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment(),
        endDate  : moment()
      },
      function (start, end) {
        $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));

        var fechaInicial = start.format('YYYY-MM-DD');

        var fechaFinal = end.format('YYYY-MM-DD');

        var capturarRango = $("#daterange-btn span").html();

        localStorage.setItem("capturarRango", capturarRango);

        window.location = "index.php?ruta=reportes&fechaInicial="+fechaInicial+"&fechaFinal="+fechaFinal;

      }
    )

 /*Cancelar rango de fechas*/

 $(".daterangepicker.opensright .range_inputs .cancelBtn").on("click", function(){

 	localStorage.removeItem("capturarRango2");
 	localStorage.clear();
 	window.location = "reportes";

 })

 /*Capturo día de la fecha*/

 $(".daterangepicker.opensright .ranges li").on("click", function(event){

 	var text = $(this).attr("data-range-key");

 	if(text == "Hoy"){

 		var d = new Date();

 		var dia = d.getDate();
 		var mes = d.getMonth()+1;
 		var año = d.getFullYear();

 		if(mes<10){

 			var fechaInicial = año+"-0"+mes+"-"+dia;
 			var fechaFinal = año+"-0"+mes+"-"+dia;

 		}else if(dia<10){

 			var fechaInicial = año+"-"+mes+"-0"+dia;
 			var fechaFinal = año+"-"+mes+"-0"+dia;

 		}else if(dia<10 == mes<10){

 			var fechaInicial = año+"-0"+mes+"-0"+dia;
 			var fechaFinal = año+"-0"+mes+"-0"+dia;

 		}else{

 		var fechaInicial = año+"-"+mes+"-"+dia;

 		var fechaFinal = año+"-"+mes+"-"+dia;

 		}

 		localStorage.setItem("capturarRango2", "Hoy");

 		window.location = "index.php?ruta=reportes&fechaInicial="+fechaInicial+"&fechaFinal="+fechaFinal;


 	}

 })
