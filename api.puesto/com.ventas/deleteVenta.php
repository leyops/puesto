<?php
include($_SERVER['DOCUMENT_ROOT']."/puesto/api.puesto/com.ventas/Ventas.php");

$ventas = new Ventas();
//$myJSON = json_encode($ventas->get_listado_ventas());
//echo $myJSON;

$ventas->delete_venta($_REQUEST['id_venta']);


?>
