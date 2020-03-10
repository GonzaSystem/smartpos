<?php

require_once "../../../vistas/modulos/Afip.php";

require_once "../../../controladores/nota-debito-ventas.controlador.php";
require_once "../../../modelos/nota-debito-ventas.modelo.php";

require_once "../../../controladores/clientes.controlador.php";
require_once "../../../modelos/clientes.modelo.php";

require_once "../../../controladores/usuarios.controlador.php";
require_once "../../../modelos/usuarios.modelo.php";

require_once "../../../controladores/productos.controlador.php";
require_once "../../../modelos/productos.modelo.php";


class imprimirFactura{

	public $codigo;

	public function traerImpresionFactura(){

	/*Traigo información de la venta*/

	$itemVenta = "id";
	$valorVenta = $this->codigo;
	$respuestaVenta = ControladorNotaDebitoVentas::ctrMostrarNotaDebitoVentas($itemVenta, $valorVenta);

	$cuit = "20389531376";
	$ptoVenta = "0001";
	$fecha = substr($respuestaVenta["fecha"],0,-8);
	$productos = json_decode($respuestaVenta["productos"], true);
	$neto = number_format($respuestaVenta["neto"],2);
	$impuesto = number_format($respuestaVenta["impuesto"],2);
	$total = number_format($respuestaVenta["total"],2);
	$cae = ($respuestaVenta["cae"]);
	$vencimiento_cae = $respuestaVenta["vencimiento_cae"];
	$vencimientoCaeString= date("Ymd", strtotime($vencimiento_cae));
  $tipo_factura = $respuestaVenta["tipo_factura"];

//Estilo de código de barras
// define barcode style
$style = array(
    'position' => '',
    'align' => 'C',
    'stretch' => false,
    'fitwidth' => true,
    'cellfitalign' => '',
    'border' => false,
    'hpadding' => 'auto',
    'vpadding' => 'auto',
    'fgcolor' => array(0,0,0),
    'bgcolor' => false, //array(255,255,255),
    'text' => true,
    'font' => 'helvetica',
    'fontsize' => 8,
    'stretchtext' => 4
);



//Condiciones
	if($tipo_factura == "A"){
	$codigo_factura = "02";
}else if($tipo_factura == "B"){
	$codigo_factura = "07";
}else if($tipo_factura == "C"){
	$codigo_factura = "12";
}

if($valorVenta<"10"){
	$nroComprobante="0000000".$valorVenta;
}else if($valorVenta<"100"){
	$nroComprobante="000000".$valorVenta;
}else if($valorVenta<"1000"){
	$nroComprobante="00000".$valorVenta;
}
	//Digito verificador
$Numero = $cuit.$codigo_factura.$ptoVenta.$cae.$vencimientoCaeString;

$j=strlen($Numero);
$par=0;$impar=0;
for ($i=0; $i < $j ; $i++) {
	if ($i%2==0){
		$par=$par+$Numero[$i];
	}else{
		$impar=$impar+$Numero[$i];
	}

}
$par=$par*3;
$suma=$par+$impar;
for ($i=0; $i < 9; $i++) {
	if ( fmod(($suma +$i),10) == 0) {
        $verificador=$i;
    }
}
$digito = 10 - ($suma - (intval($suma / 10) * 10));
if ($digito == 10){
	$digito = 0;
}
$digitoVerificador = $Numero.$digito;



	//Traigo información del cliente

	$itemCliente = "id";
	$valorCliente = $respuestaVenta["id_cliente"];

	$respuestaCliente = ControladorClientes::ctrMostrarClientes($itemCliente, $valorCliente);

	//Traigo información del vendedor

	$itemVendedor = "id";
	$valorVendedor = $respuestaVenta["id_vendedor"];

	$respuestaVendedor = ControladorUsuarios::ctrMostrarUsuarios($itemVendedor, $valorVendedor);

	//Requiero clase FPDF

	require_once('tcpdf_include.php');

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

$pdf->startPageGroup();

$pdf->AddPage('P', 'A4');


$bloque1 = <<<EOF

	<table>

		<tr>
		<br>

			<td style="width:150px; text-align:right"><img src="images/LOGO_NEGRO.jpg" width="125" height="125"></td>

			<p style="font-size: 10px">
					<b>Razón Social:</b> Smart Point of Sale S.A.

					<br>
					<b>Dirección comercial:</b> Smart Town, Buenos Aires.

					<br>
					<b>Condición frente al IVA:</b> Responsable Inscripto.

			</p>


			<td style="width:295px; margin-right:55px">

				<div style="font-size:30px; text-align:right; line-height:15px;">

					<br>
					$tipo_factura



				</div>

			</td>

			<td style="width:220px">

				<div style="font-size:10px; text-align:right; line-height:15px">

					<br>

					<br>

					<b style="font-size:17px">NOTA DE DÉBITO</b>

					<br>

					<p style="font-size: 10px"><b>Número de comprobante:</b> $nroComprobante</p>

					<b>Fecha de emisión:</b> $fecha

					<br>

					<br>

					<b>CUIT:</b> 20-38953137-6
					<br>
					<b>Ingresos Brutos:</b> 16042017-00
					<br>
					<b>Fecha de inicio de actividades:</b> 01/01/2019



				</div>



				<div style="font-size:10px; text-align:left; line-height:15px">



				</div>

			</td>

		</tr>

	</table>

EOF;

$pdf->writeHTML($bloque1, false, false, false, false, '');
$pdf->writeHTML("<hr>", true, false, false, false, '');
//----------------------------------------------------------

$bloque2 = <<<EOF

	<table>

		<tr>

			<td style="width:540px"><img src="images/back.jpg"></td>

		</tr>

	</table>

	<table style="font-size:10px; padding:5px 10px;">

		<tr>

			<td style="border: 1px solid #666; background-color:white; width:200px">

				Cliente: $respuestaCliente[nombre]

			</td>

			<td style="border: 1px solid #666; background-color:white; width:150px">

				Documento: $respuestaCliente[documento]

			</td>

	<td style="border: 1px solid #666; background-color:white; width:190px; text-align:left">

				Dirección: $respuestaCliente[direccion]

			</td>

		</tr>

		<tr>

			<td style="border: 1px solid #666; background-color:white; width:540px">Vendedor: $respuestaVendedor[nombre]</td>

		</tr>

		<tr>

		<td style="border-bottom: 1px solid #666; background-color:white; width:540px"></td>

		</tr>

	</table>

EOF;

$pdf->writeHTML($bloque2, false, false, false, false, '');

$bloque3 = <<<EOF

	<table style="font-size:10px; padding:5px 10px;">

		<tr>

		<td style="border: 1px solid #666; background-color:white; width:260px; text-align:center">Producto</td>
		<td style="border: 1px solid #666; background-color:white; width:80px; text-align:center">Cantidad</td>
		<td style="border: 1px solid #666; background-color:white; width:100px; text-align:center">Valor Unit.</td>
		<td style="border: 1px solid #666; background-color:white; width:100px; text-align:center">Valor Total</td>

		</tr>

	</table>

EOF;

$pdf->writeHTML($bloque3, false, false, false, false, '');

// ---------------------------------------------------------

foreach ($productos as $key => $item) {

$itemProducto = "descripcion";
$valorProducto = $item["descripcion"];
$orden = null;

$respuestaProducto = ControladorProductos::ctrMostrarProductos($itemProducto, $valorProducto, $orden);

$valorUnitario = number_format($respuestaProducto["precio_venta"], 2);

$precioTotal = number_format($item["total"], 2);

$bloque4 = <<<EOF

	<table style="font-size:10px; padding:5px 10px;">

		<tr>

			<td style="border: 1px solid #666; color:#333; background-color:white; width:260px; text-align:center">
				$item[descripcion]
			</td>

			<td style="border: 1px solid #666; color:#333; background-color:white; width:80px; text-align:center">
				$item[cantidad]
			</td>

			<td style="border: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center">$
				$valorUnitario
			</td>

			<td style="border: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center">$
				$precioTotal
			</td>


		</tr>

	</table>


EOF;

$pdf->writeHTML($bloque4, false, false, false, false, '');

}

// ---------------------------------------------------------

$bloque5 = <<<EOF

	<table style="font-size:10px; padding:5px 10px;">

		<tr>

			<td style="color:#333; background-color:white; width:340px; text-align:center"></td>

			<td style="border-bottom: 1px solid #666; background-color:white; width:100px; text-align:center"></td>

			<td style="border-bottom: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center"></td>

		</tr>

		<tr>

			<td style="border-right: 1px solid #666; color:#333; background-color:white; width:340px; text-align:center"></td>

			<td style="border: 1px solid #666;  background-color:white; width:100px; text-align:center">
				Subtotal:
			</td>

			<td style="border: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center">
				$ $neto
			</td>

		</tr>

		<tr>

			<td style="border-right: 1px solid #666; color:#333; background-color:white; width:340px; text-align:center"></td>

			<td style="border: 1px solid #666; background-color:white; width:100px; text-align:center">
				IVA:
			</td>

			<td style="border: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center">
				$ $impuesto
			</td>

		</tr>

		<tr>

			<td style="border-right: 1px solid #666; color:#333; background-color:white; width:340px; text-align:center"></td>

			<td style="border: 1px solid #666; background-color:white; width:100px; text-align:center">
				Total:
			</td>

			<td style="border: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center">
				$ $total
			</td>

		</tr>


	</table>

EOF;

$pdf->writeHTML($bloque5, false, false, false, false, '');



$pdf->SetFont('Helvetica', '', 10);



// Interleaved 2 of 5
$pdf->Cell(0, 0, '', 0, 1);
$pdf->write1DBarcode($digitoVerificador, 'I25', '', 245, '', 18, 0.4, $style, 'N');

$pdf->Ln();




$bloque7 = <<<EOF

CAE:	$cae


EOF;

$pdf->SetFont("","B","10");
$pdf->Text(14,265,$bloque7);

$bloque8 = <<<EOF

Vencimiento CAE: $vencimiento_cae


EOF;

$pdf->Text(14,270,$bloque8);

$x = 15;
$y = 230;
$w = 100;
$h = 15;
$pdf->Image('images/afipCbteAutorizado.jpg', $x,$y,$w,$h, 'JPG', '', '', 150);

$CodFactura = "Codigo: ";
$pdf->Text(96,30,$CodFactura);
$pdf->Text(109,30,$codigo_factura);

/*Salida de archivo*/

$pdf->Output('factura.php', 'I');

}

}

$factura = new imprimirFactura();
$factura -> codigo = $_GET["codigo"];
$factura ->traerImpresionFactura();
 ?>
