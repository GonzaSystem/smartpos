<?php


require_once "../controladores/productos.controlador.php";
require_once "../modelos/productos.modelo.php";
require_once "../controladores/categorias.controlador.php";
require_once "../modelos/categorias.modelo.php";


class TablaProductosCompras{

 /*Muestro tabla de productos*/
	 public function mostrarTablaProductosCompras(){


	 	$item = null;
	 	$valor = null;
	 	$orden = "id";

	 	$productos = ControladorProductos::ctrMostrarProductos($item, $valor, $orden);

	 	$datosJson = '{
			  "data": [';


			  for($i = 0; $i < count($productos); $i ++){

			  	/*Traigo botones*/
			  	$botones = "<div class='btn-group'><button class='btn btn-primary agregarProducto recuperarBoton' idProducto='".$productos[$i]["id"]."'>Agregar</button></div>";

			  	/*Traigo imagen*/
			  	$imagen = "<img src='".$productos[$i]["imagen"]."' width='35px'>";


			  	/*Stock*/

			  	if($productos[$i]["stock"] <=5){

			  		$stock = "<button class='btn btn-danger'>".$productos[$i]["stock"]."</button>";

			  	}elseif($productos[$i]["stock"] >6 && $productos[$i]["stock"] <=11) {

			  		$stock = "<button class='btn btn-warning'>".$productos[$i]["stock"]."</button>";

			  	}else{
			  	$stock = "<button class='btn btn-success'>".$productos[$i]["stock"]."</button>";
			    }


			  	$datosJson .='[
			      "'.($i+1).'",
			      "'.$imagen.'",
			      "'.$productos[$i]["codigo"].'",
			      "'.$productos[$i]["descripcion"].'",
			      "'.$stock.'",
			      "'.$botones.'"
			    ],';

			  }

			   $datosJson = substr($datosJson, 0, -1);
			   $datosJson .= '] }';

			 echo $datosJson;

	}
}

/*Activo tabla de productos*/

$activarProductos = new TablaProductosCompras();
$activarProductos -> mostrarTablaProductosCompras();
