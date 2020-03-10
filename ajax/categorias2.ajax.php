<?php

require_once "../controladores/categorias.controlador.php";
require_once "../modelos/categorias.modelo.php";

class AjaxCategorias{

	/*Editar categoría*/

	public $idCategoria;

	public function ajaxEditarCategoria(){

		$item = "id";
		$valor = $this->idCategoria;

		$respuesta = controladorCategorias::ctrMostrarCategorias($item, $valor);

		echo json_encode($respuesta);
	}

 }


	/*Editar categoría*/

if(isset($_POST["idCategoria"])){

	$categoria = new AjaxCategorias;
	$categoria -> idCategoria = $_POST["idCategoria"];

}