

function loadEstadisticasPorDia(inHtml){
	
	var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
	    if (this.readyState == 4 && this.status == 200) {
            var myObj = JSON.parse(this.responseText);
            //muestraVentas(inHtml, myObj);
			var txt = "<h2>Venta por dia</h2>";
			
			txt +="<br>";
			txt +="	<table>";
			txt +="	  <tr>";
			txt +="	    <td>Dia</td><td>Total vendido</td>";
			txt +="	  </tr>";
			
			for(i=0;i<myObj.length;i++){
				txt +="	  <tr>";
				txt +="	    <td>"+myObj[i].fecha+"</td><td>"+myObj[i].total+"</td>";
				txt +="	  </tr>";
			}
			
			txt +="	</table>";
			
			document.getElementById(inHtml).innerHTML = txt;
			
        }
    }
    xmlhttp.open("GET", "./api.puesto/com.estadisticas.ventas/getEstadisticasPorDia.php", true);
	xmlhttp.send();
	
	
}