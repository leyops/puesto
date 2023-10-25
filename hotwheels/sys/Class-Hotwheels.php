<?php
require("../sys/Class-OptionCnx.php");

Class hotwheelslist {

    function get_listado_anios(){
		$opts = new OptionCnx();
		$conexionMySQL = $opts->getConexion();

		$sql = "SELECT distinct (year) FROM puesto.hotwheelslist where stock > 0 order by year desc;";
		$resultado = mysqli_query($conexionMySQL, $sql);
		$lista = array();

		while ($fila = mysqli_fetch_assoc($resultado)) {
			$lista[]=$fila['year'];
		}

		mysqli_close($conexionMySQL);
		return $lista;
	}


}

