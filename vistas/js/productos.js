/*Cargo la tabla dinámica de los productos*/
/*
$.ajax({

	url:"ajax/datatable-productos.ajax.php",
	success:function(respuesta){

		console.log("respuesta", respuesta);

	}

})*/

var perfilOculto = $("#perfilOculto").val();

/*Importo datos a tabla desde BBDD*/

$('.tablaProductos').DataTable( {
	"ajax": "ajax/datatable-productos.ajax.php?perfilOculto="+perfilOculto,
	"deferRender": true,
	"retrieve": true,
	"processing": true,
		 "language": {

			"sProcessing":     "Procesando...",
			"sLengthMenu":     "Mostrar _MENU_ registros",
			"sZeroRecords":    "No se encontraron resultados",
			"sEmptyTable":     "Ningún dato disponible en esta tabla",
			"sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
			"sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0",
			"sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
			"sInfoPostFix":    "",
			"sSearch":         "Buscar:",
			"sUrl":            "",
			"sInfoThousands":  ",",
			"sLoadingRecords": "Cargando...",
			"oPaginate": {
			"sFirst":    "Primero",
			"sLast":     "Último",
			"sNext":     "Siguiente",
			"sPrevious": "Anterior"
			},
			"oAria": {
				"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
				"sSortDescending": ": Activar para ordenar la columna de manera descendente"
			}

	}
 } );


/*Obtengo categoría para asignar el código de producto*/

$("#nuevaCategoria").change(function(){

	var idCategoria = $(this).val();

	var datos = new FormData();
	datos.append("idCategoria", idCategoria);

	$.ajax({

		url:"ajax/productos.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success:function(respuesta){


			if(!respuesta){
			/*Creo codigo para la nueva categoria en caso de que no exista*/
				var nuevoCodigo = idCategoria+"01";
				$("#nuevoCodigo").val(nuevoCodigo);

			}else{
			var nuevoCodigo = Number(respuesta["codigo"]) +1;
			$("#nuevoCodigo").val(nuevoCodigo);
			}
		}

	})

})

/*Agregando precio de venta basado en porcentaje*/

$("#nuevoPrecioCompra, #editarPrecioCompra").change(function(){

	if($(".porcentaje").prop("checked")){


	var valorPorcentaje = $(".nuevoPorcentaje").val();

	var porcentaje = Number(($("#nuevoPrecioCompra").val()*valorPorcentaje/100))+Number($("#nuevoPrecioCompra").val());

	var editarPorcentaje = Number(($("#editarPrecioCompra").val()*valorPorcentaje/100))+Number($("#editarPrecioCompra").val());

	$("#nuevoPrecioVenta").val(porcentaje);
	$("#nuevoPrecioVenta").prop("readonly",true);

	$("#editarPrecioVenta").val(editarPorcentaje);
	$("#editarPrecioVenta").prop("readonly",true);

	}

})

/*Cambio de porcentaje*/

$(".nuevoPorcentaje").change(function(){

	if($(".porcentaje").prop("checked")){


	var valorPorcentaje = $(this).val();

	var porcentaje = Number(($("#nuevoPrecioCompra").val()*valorPorcentaje/100))+Number($("#nuevoPrecioCompra").val());

	var editarPorcentaje = Number(($("#editarPrecioCompra").val()*valorPorcentaje/100))+Number($("#editarPrecioCompra").val());

	$("#nuevoPrecioVenta").val(porcentaje);
	$("#nuevoPrecioVenta").prop("readonly",true);

	$("#editarPrecioVenta").val(editarPorcentaje);
	$("#editarPrecioVenta").prop("readonly",true);

	}

})

$(".porcentaje").on("ifUnchecked",function(){

	$("#nuevoPrecioVenta").prop("readonly",false);
	$("#editarPrecioVenta").prop("readonly",false);

})


$(".porcentaje").on("ifChecked",function(){

	$("#nuevoPrecioVenta").prop("readonly",true);
	$("#editarPrecioVenta").prop("readonly",true);

})

/*Subo imagen del producto*/

$(".nuevaImagen").change(function(){

	var imagen = this.files[0];

	/*=============================================
  	VALIDAMOS EL FORMATO DE LA IMAGEN SEA JPG O PNG
  	=============================================*/

  	if(imagen["type"] != "image/jpeg" && imagen["type"] != "image/png"){

  		$(".nuevaImagen").val("");

  		 swal({
		      title: "Error al subir la imagen",
		      text: "¡La imagen debe estar en formato JPG o PNG!",
		      type: "error",
		      confirmButtonText: "¡Cerrar!"
		    });

  	}else if(imagen["size"] > 2000000){

  		$(".nuevaImagen").val("");

  		 swal({
		      title: "Error al subir la imagen",
		      text: "¡La imagen no debe pesar más de 2MB!",
		      type: "error",
		      confirmButtonText: "¡Cerrar!"
		    });

  	}else{

  		var datosImagen = new FileReader;
  		datosImagen.readAsDataURL(imagen);

  		$(datosImagen).on("load", function(event){

  			var rutaImagen = event.target.result;

  			$(".previsualizar").attr("src", rutaImagen);

  		})

  	}
})

/*Edito producto demo*/
$(".tablaProductos tbody").on("click", "button.btnEditarProductoDemo",function(){

	swal({
	 title: 'No se puede realizar la acción',
	 text: "¡Esta opción no está disponible en el usuario de prueba!",
	 type: 'warning',
	 showCancelButton: true,
	 showConfirmButton: false,
	 confirmButtonColor: '#3085d6',
	 cancelButtonColor: '#d33',
	 cancelButtonText: 'Cancelar'
	})

})
/*Edito producto*/
$(".tablaProductos tbody").on("click", "button.btnEditarProducto",function(){

	var idProducto = $(this).attr("idProducto");

	var datos = new FormData();
	datos.append("idProducto", idProducto);

	$.ajax({

		url:"ajax/productos.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType:"json",
		success:function(respuesta){

			var datosCategoria = new FormData();
			datosCategoria.append("idCategoria", respuesta["id_categoria"]);


				$.ajax({

					url:"ajax/categorias.ajax.php",
					method: "POST",
					data: datosCategoria,
					cache: false,
					contentType: false,
					processData: false,
					dataType:"json",
					success:function(respuesta){

 					$("#editarCategoria").val(respuesta["id"]);
                    $("#editarCategoria").html(respuesta["categoria"]);

					}
			})


					$("#editarCodigo").val(respuesta["codigo"]);
					$("#editarDescripcion").val(respuesta["descripcion"]);
					$("#editarStock").val(respuesta["stock"]);
					$("#editarPrecioCompra").val(respuesta["precio_compra"]);
					$("#editarPrecioVenta").val(respuesta["precio_venta"]);

					if(respuesta["imagen"] != ""){

					$("#imagenActual").val(respuesta["imagen"]);
					$(".previsualizar").attr("src", respuesta["imagen"]);

					}
		}
	})
})

/*Elimino producto*/

$(".tablaProductos tbody").on("click", "button.btnEliminarProducto", function(){

	var idProducto = $(this).attr("idProducto");
	var codigo = $(this).attr("codigo");
	var imagen = $(this).attr("imagen");

	swal({

		title: '¿Está seguro de borrar el producto?',
		text: "¡Una vez realizada la acción no se podrá deshacer!",
		type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, borrar producto!'
        }).then(function(result){
        if (result.value) {

        	window.location = "index.php?ruta=productos&idProducto="+idProducto+"&imagen="+imagen+"&codigo="+codigo;

        }


	})

})
