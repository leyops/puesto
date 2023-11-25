<?php
include($_SERVER['DOCUMENT_ROOT']."/puesto/api.puesto/com.ventas/Class-ItemVentas.php");
include($_SERVER['DOCUMENT_ROOT']."/puesto/api.puesto/common/Class-OptionCnx.php");
include($_SERVER['DOCUMENT_ROOT']."/puesto/api.puesto/common/Func-Utils.php");

class Ventas{



	function get_listado_ventas(){

		$opts = new OptionCnx();
		$conexionMySQL = $opts->getConexion();
		$listaBusqueda = array();
		$listWhere = array();
		

		//$sql = "SELECT * FROM PuestoNavidad.ventas order by id_venta;";
		$sql = "SELECT id_venta, producto, cantidad, precio, cantidad * precio AS subtotal, DATE( fecha ) AS fecha, TIME( fecha ) AS hora FROM  puesto.ventas_temporadas ORDER BY id_venta DESC limit 35";

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

	function get_listado_ventas_search($search){

		$opts = new OptionCnx();
		$conexionMySQL = $opts->getConexion();
		$listaBusqueda = array();
		$listWhere = array();
		

		//$sql = "SELECT * FROM PuestoNavidad.ventas order by id_venta;";
		$sql = "SELECT id_venta, producto, cantidad, precio, cantidad * precio AS subtotal, DATE( fecha ) AS fecha, TIME( fecha ) AS hora FROM  puesto.ventas_temporadas WHERE producto LIKE '%".$search."%' ORDER BY id_venta DESC; ";

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


	
	function get_venta_index($id_venta){
		$opts = new OptionCnx();
		$conexionMySQL = $opts->getConexion();
		$listaBusqueda = array();
		$listWhere = array();
		

		//$sql = "SELECT * FROM PuestoNavidad.ventas order by id_venta;";
		$sql = "SELECT id_venta, producto, cantidad, precio, cantidad * precio AS subtotal, DATE( fecha ) AS fecha, TIME( fecha ) AS hora FROM  puesto.ventas_temporadas WHERE id_venta= ".$id_venta." ";

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
	
	function add_venta($producto, $cantidad, $precio_unitario){
		
		$opts = new OptionCnx();
		$conexionMySQL = $opts->getConexion();
		
		$sql = "INSERT INTO puesto.ventas_temporadas (producto,cantidad,precio) values ('".strSQL($producto)."',".$cantidad.",".$precio_unitario.")";


		$resultado = mysqli_query($conexionMySQL, $sql);
		
		
		mysqli_close($conexionMySQL);

	}
	
	
	function update_venta($id_venta, $producto, $cantidad, $precio_unitario){
		
		$opts = new OptionCnx();
		$conexionMySQL = $opts->getConexion();
		
		$sql = "UPDATE puesto.ventas_temporadas SET producto='".strSQL($producto)."', cantidad=".$cantidad.", precio=".$precio_unitario." WHERE id_venta=" . $id_venta;

		$resultado = mysqli_query($conexionMySQL, $sql);
		
		mysqli_close($conexionMySQL);
	}
	
	function delete_venta($id_venta){
		
		$opts = new OptionCnx();
		$conexionMySQL = $opts->getConexion();
		
		$sql = "DELETE FROM puesto.ventas_temporadas WHERE id_venta=".$id_venta."";


		$resultado = mysqli_query($conexionMySQL, $sql);
		
		
		mysqli_close($conexionMySQL);

	}

/*
	function updateExistencias($code_hilaza_abuelita,$existencias_abuelita){
		$opts = new OptionCnx();
		$conexionMySQL = $opts->getConexion();
		$listaBusqueda = array();
		$listWhere = array();

		

		$sql = 	"UPDATE puesto.hilaza_abuelita SET " . 
				" existencias_abuelita = " .$existencias_abuelita. 
				" WHERE code_hilaza_abuelita = ".$code_hilaza_abuelita.";";


		$resultado = mysqli_query($conexionMySQL, $sql);

		mysqli_close($conexionMySQL);
		return $resultado;
	}
/* */

}


/*
$opts = new OptionCnx();
$conexionMySQL = $opts->getConexion();
$listaBusqueda = array();
$listWhere = array();




$sql = "SELECT code_hilaza_abuelita, name_abuelita, existencias_abuelita, eje_x, eje_y FROM puesto.hilaza_abuelita order by code_hilaza_abuelita;";


$resultado = mysqli_query($conexionMySQL, $sql);

$lista = array();

while ($fila = mysqli_fetch_assoc($resultado)) {

	$current = new Item_hilaz_abuelita();
	
	$current->code_hilaza_abuelita=$fila['code_hilaza_abuelita'];
	$current->name_abuelita=$fila['name_abuelita'];
	$current->existencias_abuelita=$fila['existencias_abuelita'];
	$current->eje_x=$fila['eje_x'];
	$current->eje_y=$fila['eje_y'];

	
	$lista[]=$current;
}

mysqli_close($conexionMySQL);

$myJSON = json_encode($lista);
echo $myJSON;
/* */

?>
