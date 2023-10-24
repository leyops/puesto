<?php
include($_SERVER['DOCUMENT_ROOT']."/puesto/api.puesto/com.ventas/Ventas.php");

$ventas = new Ventas();
//$myJSON = json_encode($ventas->get_listado_ventas());
//echo $myJSON;

$ventas->update_venta($_REQUEST['id_venta'], $_REQUEST['producto'], $_REQUEST['cantidad'], $_REQUEST['precio']);

$strJson = "[";
$lista = $ventas->get_venta_index($_REQUEST['id_venta']);

foreach($lista as $venta_actual){
	$strJson=$strJson."{";
	  $strJson=$strJson."\"id_venta\":\"".$venta_actual->id_venta."\",";
	  $strJson=$strJson."\"producto\":\"".$venta_actual->producto."\",";
	  $strJson=$strJson."\"cantidad\":\"".$venta_actual->cantidad."\",";
	  $strJson=$strJson."\"precio\":\"".$venta_actual->precio."\",";
	  $strJson=$strJson."\"subtotal\":\"".$venta_actual->subtotal."\",";
	  $strJson=$strJson."\"fecha\":\"".$venta_actual->fecha."\",";
	  $strJson=$strJson."\"hora\":\"".$venta_actual->hora."\"";
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
