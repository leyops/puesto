<?php
include("Item_hilaza_abuelita.php");
include("Class-OptionCnx.php");

class Hilaza_abuelita{



	function get_listado_abuelitas(){

		$opts = new OptionCnx();
		$conexionMySQL = $opts->getConexion();
		$listaBusqueda = array();
		$listWhere = array();

		

		$sql = "SELECT code_hilaza_abuelita, name_abuelita, existencias_abuelita, eje_x, eje_y FROM puesto.hilaza_abuelita order by code_hilaza_abuelita;";


		$resultado = mysqli_query($conexionMySQL, $sql);

		$lista = array();

		while ($fila = mysqli_fetch_assoc($resultado)) {

			$current = new Item_hilaza_abuelita();
			
			if($fila['code_hilaza_abuelita']<10)
				$current->code_hilaza_abuelita='0' . $fila['code_hilaza_abuelita'];
			else
				$current->code_hilaza_abuelita='' . $fila['code_hilaza_abuelita'];
			
			$current->name_abuelita=$fila['name_abuelita'];
			$current->existencias_abuelita=$fila['existencias_abuelita'];
			$current->eje_x=$fila['eje_x'];
			$current->eje_y=$fila['eje_y'];

			
			$lista[]=$current;
		}

		mysqli_close($conexionMySQL);

		return $lista;
	}		


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