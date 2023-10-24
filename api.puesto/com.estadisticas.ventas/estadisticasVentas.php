<?php
include($_SERVER['DOCUMENT_ROOT']."/puesto/api.puesto/com.estadisticas.ventas/Class-ItemVentasDia.php");
include($_SERVER['DOCUMENT_ROOT']."/puesto/api.puesto/common/Class-OptionCnx.php");
include($_SERVER['DOCUMENT_ROOT']."/puesto/api.puesto/common/Func-Utils.php");

class EstadisticasVentas{



	function get_ventas_por_dia(){
		
		$opts = new OptionCnx();
		$conexionMySQL = $opts->getConexion();
		
		$sql = "SELECT SUM(cantidad * precio) as total, date(fecha) as fecha " . 
				"FROM puesto.ventas_temporadas " . 
				"GROUP BY date(fecha) " . 
				"ORDER BY date(fecha) ";

		$resultado = mysqli_query($conexionMySQL, $sql);
		
		$lista = array();
		
		while ($fila = mysqli_fetch_assoc($resultado)){
			$current = new VentaXDia();

			$current->fecha=$fila['fecha'];
			$current->total=$fila['total'];
			
			
			$lista[]=$current;
		}

		mysqli_close($conexionMySQL);
		
		return $lista;
	}
	
	/*
	function get_venta_index($id_venta){
		$opts = new OptionCnx();
		$conexionMySQL = $opts->getConexion();
		$listaBusqueda = array();
		$listWhere = array();
		

		//$sql = "SELECT * FROM PuestoNavidad.ventas order by id_venta;";
		$sql = "SELECT id_venta, producto, cantidad, precio, cantidad * precio AS subtotal, DATE( fecha ) AS fecha, TIME( fecha ) AS hora FROM  PuestoNavidad.ventas WHERE id_venta= ".$id_venta." ";

		$resultado = mysqli_query($conexionMySQL, $sql);


		$lista = array();

		while ($fila = mysqli_fetch_assoc($resultado)) {
			$current = new ItemVentas();

			$current->id_venta=$fila['id_venta'];
			$current->producto=$fila['producto'];
			$current->cantidad=$fila['cantidad'];
			$current->precio=$fila['precio'];
			$current->subtotal=$fila['subtotal'];
			$current->fecha=$fila['fecha'];
			$current->hora=$fila['hora'];
			
			$lista[]=$current;
		}

		mysqli_close($conexionMySQL);

		return $lista;
	}
	/**/
	
}



?>
