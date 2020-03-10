<?php

require_once "conexion.php";


class ModeloNotaCreditoVentas{

	static public function mdlMostrarNotaCreditoVentas($tabla, $item, $valor){

				if($item != null){

				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item ORDER BY id ASC");

				$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

				$stmt -> execute();

				return $stmt -> fetch();

			}else{

				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY id ASC");
				$stmt -> execute();

				return $stmt -> fetchAll();

			}

			$stmt -> close();
			$stmt = null;

	}

	/*Registro de ventas*/

	static public function mdlIngresarNotaCreditoVenta($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(codigo, tipo_factura, id_cliente, id_vendedor, productos, impuesto, neto, total, concepto, cae, vencimiento_cae) VALUES (:codigo, :tipo_factura, :id_cliente, :id_vendedor, :productos, :impuesto, :neto, :total, :concepto, :cae, :vencimiento_cae)");

		$stmt->bindParam(":codigo", $datos["codigo"], PDO::PARAM_INT);
		$stmt->bindParam(":tipo_factura", $datos["tipo_factura"], PDO::PARAM_STR);
		$stmt->bindParam(":id_cliente", $datos["id_cliente"], PDO::PARAM_INT);
		$stmt->bindParam(":id_vendedor", $datos["id_vendedor"], PDO::PARAM_INT);
		$stmt->bindParam(":productos", $datos["productos"], PDO::PARAM_STR);
		$stmt->bindParam(":impuesto", $datos["impuesto"], PDO::PARAM_STR);
		$stmt->bindParam(":neto", $datos["neto"], PDO::PARAM_STR);
		$stmt->bindParam(":total", $datos["total"], PDO::PARAM_STR);
		$stmt->bindParam(":concepto", $datos["concepto"], PDO::PARAM_STR);
		$stmt->bindParam(":cae", $datos["cae"], PDO::PARAM_STR);
		$stmt->bindParam(":vencimiento_cae", $datos["vencimiento_cae"], PDO::PARAM_STR);

	 if($stmt->execute()){

			return "ok";

		}else{

			return "error";

		}

		$stmt->close();
		$stmt = null;

	}

	/*Rango de ventas*/

	static public function mdlRangoFechaNotaCreditoVentas($tabla, $fechaInicial, $fechaFinal){

		if($fechaInicial == null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY id ASC");
			$stmt -> execute();

			return $stmt -> fetchAll();

		}else if($fechaInicial == $fechaFinal){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE fecha like '%$fechaFinal%'");

			$stmt -> bindParam(":fecha", $fechaFinal, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetchAll();


		}else{

			$fechaActual = new DateTime();
			$fechaActual -> add(new DateInterval("P1D"));
			$fechaActualMasUno = $fechaActual->format("Y-m-d");

			$fechaFinal2 = new DateTime($fechaFinal);
			$fechaFinal2 -> add(new DateInterval("P1D"));
			$fechaFinalMasUno = $fechaFinal2->format("Y-m-d");

			if($fechaFinalMasUno == $fechaActualMasUno){

				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE fecha BETWEEN '$fechaInicial' AND '$fechaFinalMasUno'");

			}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE fecha BETWEEN '$fechaInicial' AND '$fechaFinal'");

			}

			$stmt-> execute();

			return $stmt -> fetchAll();

		}

	}

	/*Sumo total de ventas*/

	static public function mdlSumaTotalNotaCreditoVentas($tabla){

		$stmt = Conexion::conectar()->prepare("SELECT SUM(neto) as total FROM $tabla");

		$stmt -> execute();

		return $stmt -> fetch();

		$stmt -> close();

		$stmt = null;

	}

}
