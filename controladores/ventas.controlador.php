<?php


class ControladorVentas{

	/*Mostrar ventas*/


	static public function ctrMostrarVentas($item, $valor){

		$tabla = "ventas";

		$respuesta = ModeloVentas::mdlMostrarVentas($tabla, $item, $valor);

		return $respuesta;
	}

	/*Crear ventas*/
	static public function ctrCrearVenta(){

		if(isset($_POST["nuevaVenta"])){

			/*Actualizo las compras del cliente, reduzco stock y aumento las ventas del producto*/

			$listaProductos = json_decode($_POST["listaProductos"], true);

			$totalProductosComprados = array();

			foreach ($listaProductos as $key => $value) {

				array_push($totalProductosComprados, $value["cantidad"]);


				$tablaProductos = "productos";

				$item = "id";
				$valor = $value["id"];
				$orden = "id";

				$traerProducto = ModeloProductos::mdlMostrarProductos($tablaProductos, $item, $valor, $orden);


				$item1a = "ventas";
				$valor1a = $value["cantidad"] + $traerProducto["ventas"];

				$nuevasVentas = ModeloProductos::mdlActualizarProducto($tablaProductos, $item1a, $valor1a, $valor);

				$item1b = "stock";
				$valor1b = $value["stock"];

				$nuevoStock = ModeloProductos::mdlActualizarProducto($tablaProductos, $item1b, $valor1b, $valor);

			}

			$tablaClientes = "clientes";

			$item = "id";
			$valor = $_POST["seleccionarCliente"];

			$traerCliente = ModeloClientes::mdlMostrarClientes($tablaClientes, $item, $valor);

			$item1a = "compras";
			$valor1a = array_sum($totalProductosComprados) + $traerCliente["compras"];

			$comprasCliente = ModeloClientes::mdlActualizarCliente($tablaClientes, $item1a, $valor1a, $valor);

			$item1b = "ultima_compra";

			$fecha = date('Y-m-d');
			$hora = date('H:i:s');
			$valor1b = $fecha.' '.$hora;

			$comprasCliente = ModeloClientes::mdlActualizarCliente($tablaClientes, $item1b, $valor1b, $valor);

			/*Guardo la compra*/

			//Factura electrónica

			include "vistas/modulos/Afip.php";

			date_default_timezone_set('America/Argentina/Buenos_Aires');

			$afip = new Afip(array('CUIT' => 20389531376));


			$CbteTipo = $_POST["seleccionarTipoComprobante"];

			$last_voucher = $afip->ElectronicBilling->GetLastVoucher(1,$CbteTipo);

			$valfac = $last_voucher + 1;

			$Concepto = $_POST["seleccionarConcepto"];
			$DocTipo = $_POST["seleccionarTipoDocumento"];
			$DocNro = $_POST["seleccionarNumeroDocumento"];
			$tipoIva = $_POST["nuevoImpuestoVenta"];

			if($tipoIva == "21"){

				$tipoIva = "5";

			}else if($tipoIva == "10.5"){

				$tipoIva = "4";

			}else if($tipoIva == "27"){

				$tipoIva = "6";

			}else if($tipoIva == "0.0"){

				$tipoIva = "1";

			}else if($tipoIva == "0.00"){

				$tipoIva = "2";

			}else if($tipoIva == "0.000"){

				$tipoIva = "3";

			}

			echo "<br>";

			if($CbteTipo == "11"){

				$data = array(
				'CantReg' 	=> 1,  // Cantidad de comprobantes a registrar
				'PtoVta' 	=> 1,  // Punto de venta
				'CbteTipo' 	=> $CbteTipo,  // Tipo de comprobante (ver tipos disponibles)
				'Concepto' 	=> $Concepto,  // Concepto del Comprobante: (1)Productos, (2)Servicios, (3)Productos y Servicios
				'DocTipo' 	=> $DocTipo, // Tipo de documento del comprador (99 consumidor final, ver tipos disponibles)
				'DocNro' 	=> $DocNro,  // Número de documento del comprador (0 consumidor final)
				'CbteDesde' 	=> $valfac,  // Número de comprobante o numero del primer comprobante en caso de ser mas de uno
				'CbteHasta' 	=> $valfac,  // Número de comprobante o numero del último comprobante en caso de ser mas de uno
				'CbteFch' 	=> intval(date('Ymd')), // (Opcional) Fecha del comprobante (yyyymmdd) o fecha actual si es nulo
				'ImpTotal' 	=> $_POST["totalVenta"], // Importe total del comprobante
				'ImpTotConc' 	=> 0,   // Importe neto no gravado
				'ImpNeto' 	=> $_POST["nuevoPrecioNeto"], // Importe neto gravado
				'ImpOpEx' 	=> 0,   // Importe exento de IVA
				'ImpIVA' 	=> $_POST["nuevoPrecioImpuesto"],  //Importe total de IVA
				'ImpTrib' 	=> 0,   //Importe total de tributos
				'MonId' 	=> 'PES', //Tipo de moneda usada en el comprobante (ver tipos disponibles)('PES' para pesos argentinos)
				'MonCotiz' 	=> 1,     // Cotización de la moneda usada (1 para pesos argentinos)
				);
				}else{

				$data = array(
				'CantReg' 	=> 1,  // Cantidad de comprobantes a registrar
				'PtoVta' 	=> 1,  // Punto de venta
				'CbteTipo' 	=> $CbteTipo,  // Tipo de comprobante (ver tipos disponibles)
				'Concepto' 	=> $Concepto,  // Concepto del Comprobante: (1)Productos, (2)Servicios, (3)Productos y Servicios
				'DocTipo' 	=> $DocTipo, // Tipo de documento del comprador (99 consumidor final, ver tipos disponibles)
				'DocNro' 	=> $DocNro,  // Número de documento del comprador (0 consumidor final)
				'CbteDesde' 	=> $valfac,  // Número de comprobante o numero del primer comprobante en caso de ser mas de uno
				'CbteHasta' 	=> $valfac,  // Número de comprobante o numero del último comprobante en caso de ser mas de uno
				'CbteFch' 	=> intval(date('Ymd')), // (Opcional) Fecha del comprobante (yyyymmdd) o fecha actual si es nulo
				'ImpTotal' 	=> $_POST["totalVenta"], // Importe total del comprobante
				'ImpTotConc' 	=> 0,   // Importe neto no gravado
				'ImpNeto' 	=> $_POST["nuevoPrecioNeto"], // Importe neto gravado
				'ImpOpEx' 	=> 0,   // Importe exento de IVA
				'ImpIVA' 	=> $_POST["nuevoPrecioImpuesto"],  //Importe total de IVA
				'ImpTrib' 	=> 0,   //Importe total de tributos
				'MonId' 	=> 'PES', //Tipo de moneda usada en el comprobante (ver tipos disponibles)('PES' para pesos argentinos)
				'MonCotiz' 	=> 1,     // Cotización de la moneda usada (1 para pesos argentinos)
				'Iva' 		=> array( // (Opcional) Alícuotas asociadas al comprobante
					array(
						'Id' 		=> $tipoIva, // Id del tipo de IVA (5 para 21%)(ver tipos disponibles)
						'BaseImp' 	=> $_POST["nuevoPrecioNeto"], // Base imponible
						'Importe' 	=> $_POST["nuevoPrecioImpuesto"] // Importe
					)
				),
			);

				}


		$res = $afip->ElectronicBilling->CreateVoucher($data);

		$res['CAE']; //CAE asignado el comprobante
		$res['CAEFchVto']; //Fecha de vencimiento del CAE (yyyy-mm-dd)

		if($CbteTipo == "1"){

			$CbteTipo = "A";

		}else if($CbteTipo == "6"){

			$CbteTipo = "B";

		}else if($CbteTipo == "11"){

			$CbteTipo = "C";

		}

			$tabla = "ventas";

			$datos = array("id_vendedor"=>$_POST["idVendedor"],
						   "id_cliente"=>$_POST["seleccionarCliente"],
						   "codigo"=>$valfac,
						   "tipo_factura"=>$CbteTipo,
						   "productos"=>$_POST["listaProductos"],
						   "impuesto"=>$_POST["nuevoPrecioImpuesto"],
						   "neto"=>$_POST["nuevoPrecioNeto"],
						   "total"=>$_POST["totalVenta"],
						   "metodo_pago"=>$_POST["listaMetodoPago"],
						   "cae"=>$res['CAE'],
						   "vencimiento_cae"=>$res['CAEFchVto']);


			$respuesta = ModeloVentas::mdlIngresarVenta($tabla, $datos);

			if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "La venta ha sido guardada correctamente.",
							text: "Número de factura: '.$valfac.'",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "crear-venta";

									}
								})

					</script>';}else{

					echo'<script>

					swal({
						  type: "error",
						  title: "La venta no ha sido guardada.",
							text: "Por favor corrobore los datos ingresados e intente nuevamente.",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "crear-venta";

									}
								})

					</script>';}
		}

	}

	/*Rango de fechas*/

	static public function ctrRangoFechaVentas($fechaInicial, $fechaFinal){

		$tabla = "ventas";

		$respuesta = ModeloVentas::mdlRangoFechaVentas($tabla, $fechaInicial, $fechaFinal);

		return $respuesta;

	}

	/*Descargo reporte en excel*/

	public function ctrDescargarReporte(){

		if(isset($_GET["reporte"])){

			$tabla = "ventas";

			if(isset($_GET["fechaInicial"]) && isset($_GET["fechaFinal"])){

				$ventas = ModeloVentas::mdlRangoFechaVentas($tabla, $_GET["fechaInicial"], $_GET["fechaFinal"]);

			}else{

				$item = null;
				$valor = null;

				$ventas = ModeloVentas::mdlMostrarVentas($tabla, $item, $valor);

			}


			/*=============================================
			CREAMOS EL ARCHIVO DE EXCEL
			=============================================*/

			$Name = $_GET["reporte"].'.xls';

			header('Expires: 0');
			header('Cache-control: private');
			header("Content-type: application/vnd.ms-excel"); // Archivo de Excel
			header("Cache-Control: cache, must-revalidate");
			header('Content-Description: File Transfer');
			header('Last-Modified: '.date('D, d M Y H:i:s'));
			header("Pragma: public");
			header('Content-Disposition:; filename="'.$Name.'"');
			header("Content-Transfer-Encoding: binary");

			echo utf8_decode("<table border='0'>

					<tr>
					<td style='font-weight:bold; border:1px solid #eee;'>CÓDIGO</td>
					<td style='font-weight:bold; border:1px solid #eee;'>CLIENTE</td>
					<td style='font-weight:bold; border:1px solid #eee;'>VENDEDOR</td>
					<td style='font-weight:bold; border:1px solid #eee;'>CANTIDAD</td>
					<td style='font-weight:bold; border:1px solid #eee;'>PRODUCTOS</td>
					<td style='font-weight:bold; border:1px solid #eee;'>IMPUESTO</td>
					<td style='font-weight:bold; border:1px solid #eee;'>NETO</td>
					<td style='font-weight:bold; border:1px solid #eee;'>TOTAL</td>
					<td style='font-weight:bold; border:1px solid #eee;'>METODO DE PAGO</td
					<td style='font-weight:bold; border:1px solid #eee;'>FECHA</td>
					</tr>");

			foreach ($ventas as $row => $item){

				$cliente = ControladorClientes::ctrMostrarClientes("id", $item["id_cliente"]);
				$vendedor = ControladorUsuarios::ctrMostrarUsuarios("id", $item["id_vendedor"]);

			 echo utf8_decode("<tr>
			 			<td style='border:1px solid #eee;'>".$item["codigo"]."</td>
			 			<td style='border:1px solid #eee;'>".$cliente["nombre"]."</td>
			 			<td style='border:1px solid #eee;'>".$vendedor["nombre"]."</td>
			 			<td style='border:1px solid #eee;'>");

			 	$productos =  json_decode($item["productos"], true);

			 	foreach ($productos as $key => $valueProductos) {

			 			echo utf8_decode($valueProductos["cantidad"]."<br>");
			 		}

			 	echo utf8_decode("</td><td style='border:1px solid #eee;'>");

		 		foreach ($productos as $key => $valueProductos) {

		 			echo utf8_decode($valueProductos["descripcion"]."<br>");

		 		}

		 		echo utf8_decode("</td>
					<td style='border:1px solid #eee;'>$ ".number_format($item["impuesto"],2)."</td>
					<td style='border:1px solid #eee;'>$ ".number_format($item["neto"],2)."</td>
					<td style='border:1px solid #eee;'>$ ".number_format($item["total"],2)."</td>
					<td style='border:1px solid #eee;'>".$item["metodo_pago"]."</td>
					<td style='border:1px solid #eee;'>".substr($item["fecha"],0,10)."</td>
		 			</tr>");


			}


			echo "</table>";

		}

	}


	/*Sumo total de ventas*/

	public function ctrSumaTotalVentas(){

		$tabla = "ventas";

		$respuesta = ModeloVentas::mdlSumaTotalVentas($tabla);

		return $respuesta;

	}

}
