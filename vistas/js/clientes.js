/*Editar cliente demo*/

$(".btnEditarClienteDemo").click(function(){

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

/*Eliminar cliente demo*/

$(".btnEliminarClienteDemo").click(function(){

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

/*Editar cliente*/

$(".btnEditarCliente").click(function(){

	var idCliente = $(this).attr("idCliente");

	var datos = new FormData();
	datos.append("idCliente", idCliente);

	$.ajax({
		url: "ajax/clientes.ajax.php",
		method: "POST",
      	data: datos,
      	cache: false,
     	contentType: false,
     	processData: false,
     	dataType:"json",
     	success: function(respuesta){


      	   $("#idCliente").val(respuesta["id"]);
	       $("#editarCliente").val(respuesta["nombre"]);
	       $("#editarDocumento").val(respuesta["documento"]);
	       $("#editarMail").val(respuesta["email"]);
	       $("#editarTelefono").val(respuesta["telefono"]);
	       $("#editarDireccion").val(respuesta["direccion"]);
           $("#editarFechaNacimiento").val(respuesta["fecha_nacimiento"]);

     	}
	})
})

/*Eliminar cliente*/

$(".btnEliminarCliente").click(function(){

		var idCliente = $(this).attr("idCliente");

		swal({
        title: '¿Está seguro de borrar el cliente?',
        text: "¡Una vez confirmada la acción no se puede deshacer !",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, borrar cliente!'
      }).then(function(result){
        if (result.value) {

            window.location = "index.php?ruta=clientes&idCliente="+idCliente;
        }
	})
})
