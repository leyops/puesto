<?php
include($_SERVER['DOCUMENT_ROOT']."/puesto/api.puesto/com.estadisticas.ventas/estadisticasVentas.php");

$estadisticas = new EstadisticasVentas();
$strJson = "[";
$lista = $estadisticas->get_ventas_por_dia();

foreach($lista as $dia_actual){
	$strJson=$strJson."{";
	  $strJson=$strJson."\"fecha\":\"".$dia_actual->fecha."\",";
	  $strJson=$strJson."\"total\":\"".$dia_actual->total."\"";
	$strJson=$strJson."},";
}
if(count($lista)){
	$strJson=substr($strJson,0,strlen($strJson)-1);
}
//$myJSON = json_encode($ventas->get_listado_ventas());
//echo $myJSON;
$strJson=$strJson."]";
echo $strJson;
?>
