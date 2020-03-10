<?php


require_once "../controladores/productos.controlador.php";
require_once "../modelos/productos.modelo.php";

require_once "../controladores/categorias.controlador.php";
require_once "../modelos/categorias.modelo.php";

class TablaProductos{

 /*Muestro tabla de productos*/
	 public function mostrarTablaProductos(){


	 	$item = null;
	 	$valor = null;
	 	$orden = "id";

	 	$productos = ControladorProductos::ctrMostrarProductos($item, $valor, $orden);

	 	$datosJson = '{
			  "data": [';


			  for($i = 0; $i < count($productos); $i ++){

			  	/*Traigo botones*/

			  	if(isset($_GET["perfilOculto"]) && $_GET["perfilOculto"] == "Supervisor"){

			  	$botones = "<div class='btn-group'><button class='btn btn-warning btnEditarProducto' idProducto='".$productos[$i]["id"]."' data-toggle='modal' data-target='#modalEditarProducto'><i class='fa fa-pencil'></i></button></div>";

			  	}else{
			  	$botones = "<div class='btn-group'><button class='btn btn-warning btnEditarProducto' idProducto='".$productos[$i]["id"]."' data-toggle='modal' data-target='#modalEditarProducto'><i class='fa fa-pencil'></i></button><button class='btn btn-danger btnEliminarProducto' idProducto='".$productos[$i]["id"]."' codigo='".$productos[$i]["codigo"]."' imagen='".$productos[$i]["imagen"]."' data-toggle='modal' data-target='#modalEliminarProducto'><i class='fa fa-times'></i></button></div>";
			    }

			  	/*Traigo imagen*/
			  	$imagen = "<img src='".$productos[$i]["imagen"]."' width='35px'>";

			  	$item ="id";
			  	$valor = $productos[$i]["id_categoria"];

			  	$categorias = ControladorCategorias::ctrMostrarCategorias($item, $valor);

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
			      "'.$categorias["categoria"].'",
			      "'.$stock.'",
			      "'.$productos[$i]["precio_compra"].'",
			      "'.$productos[$i]["precio_venta"].'",
			      "'.$productos[$i]["fecha"].'",
			      "'.$botones.'"
			    ],';

			  }

			   $datosJson = substr($datosJson, 0, -1);
			   $datosJson .= '] }';

			 echo $datosJson;

	}
}

/*Activo tabla de productos*/

$activarProductos = new TablaProductos();
$activarProductos -> mostrarTablaProductos();
