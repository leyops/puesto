<?php
// Conexión a la base de datos
include($_SERVER['DOCUMENT_ROOT']."/puesto/api.puesto/com.ventas/Ventas.php");
//include("./Class-ItemVentas.php");

$ventas = new Ventas();
$listadoVentas = $ventas->get_listado_ventas();
?>
<html>
  <head>
    <title>Ventas</title>
  </head>
  <body onload="loadResumenVentas('zonaVentas');">
  
	<h1 style="text-align: center;">Ventas del puesto de romería</h1>
	
	<div>
	<table>
		<tr>
		<td onclick="loadResumenVentas('zonaVentas');" style="cursor: pointer">Registro ventas</td>
		<td onclick="loadEstadisticasPorDia('zonaVentas');" style="cursor: pointer">Ventas x dia</td>
		<td onclick="" style="cursor: pointer">Top productos</td>
		</tr>
	</table>
	</div>
	
	<div>
	<p>Agregar una venta</p>
	<form name="frmEditProducto">
		<input type="text" name="producto" placeholder="nombre producto">
		<input type="number" name="cantidad" placeholder="1">
		<input type="number" name="precio" placeholder="1.0">
		<input type="button" name="addVenta" value="Agrear venta" onclick="addVentaToDB('zonaVentas');">
	</form>
	</div>
	<br>
	<br>
	<div id="zonaVentas">
            
    </div>
	
	
	
	<script src="js/puestonavidad_ventas.js"></script> 
	<script src="js/puestonavidad_estadisticas_ventas.js"></script> 
  </body>
</html>



