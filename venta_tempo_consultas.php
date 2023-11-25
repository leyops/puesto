<?php
// Conexión a la base de datos
include($_SERVER['DOCUMENT_ROOT']."/puesto/api.puesto/com.ventas/Ventas.php");
//include("./Class-ItemVentas.php");

$ventas = new Ventas();
//$listadoVentas = $ventas->get_listado_ventas();
?>
<html>
  <head>
    <title>Ventas</title>
  </head>
  <!--<body onload="loadResumenVentas('zonaVentas');">-->
   <body>
  
	<h1 style="text-align: center;">Ventas del puesto de romería</h1>
	
	<div>
	<table>
		<tr>
        <td> <a href="ventas_tempo.php">Atrás</a> </td>
		</tr>
	</table>
	</div>
	
	<div>
	<p>Consultar venta</p>
	<form name="frmSearchProducto" onsubmit="event.preventDefault();">
		<input type="text" name="producto" placeholder="nombre producto">
		<input type="button" name="addVenta" value="Buscar" onclick="searchVentas('zonaVentas');">
	</form>
	</div>
	<br>
	<br>
	<div id="zonaVentas">
            
    </div>
	
	
    <script src="js/puestonavidad_ventas_consulta.js"></script>
    <!--<script src="js/puestonavidad_ventas.js"></script> -->
	<!--<script src="js/puestonavidad_estadisticas_ventas.js"></script> -->
  </body>
</html>



