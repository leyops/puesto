function loadVentaTempoConsulta(){
	location.href = 'venta_tempo_consultas.php';
}


function searchVentas(inHtml){
	var producto = document.forms["frmSearchProducto"]["producto"].value;

	if(!producto){
		window.alert("Ningun valor puede ser nulo, vacio o cero");
		return;
	}

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
	    if (this.readyState == 4 && this.status == 200) {
            var myObj = JSON.parse(this.responseText);
            muestraVentas(inHtml, myObj);
        }
    }
    xmlhttp.open("GET", "./api.puesto/com.ventas/getVentasSearch.php?productoVenta="+producto, true);
	xmlhttp.send();
}
/**/


function muestraVentas(inHtml, listaVentas){
	
	txt = "<form name='edit_listaVentas'>";
    txt +="	<table>";
	txt += "<tr>";
	txt += "<td>Consecutivo</td><td>Producto</td><td>Cantidad</td><td>Precio Unitario</td><td>SubTotal</td><td>Fecha</td><td>Hora</td><td></td><td></td>";
	txt += "</tr>";
	
	for(i=0;i<listaVentas.length;i++){
		
		txt += "<tr>";
		
		txt += "<td>"+listaVentas[i].id_venta+"</td>";
		txt += "<td><div id=\"producto_"+listaVentas[i].id_venta+"\">"+listaVentas[i].producto+"</div></td>";
		txt += "<td><div id=\"cantidad_"+listaVentas[i].id_venta+"\">"+listaVentas[i].cantidad+"</div></td>";
		txt += "<td><div id=\"precio_"+listaVentas[i].id_venta+"\">"+listaVentas[i].precio+"</div></td>";
		txt += "<td><div id=\"subtotal_"+listaVentas[i].id_venta+"\">"+listaVentas[i].subtotal+"</div></td>";
		txt += "<td>"+listaVentas[i].fecha+"</td>";
		txt += "<td>"+listaVentas[i].hora+"</td>";
		//txt += "<td><img src=\"./img/edit_3601684.png\" height=\"5%\" width=\"5%\"></td>";
		//txt += "<td><img src=\"./img/Delete-button.svg.png\" height=\"10%\" width=\"10%\"></td>";
		
		txt += "<td><div id=\"butAceptar_"+listaVentas[i].id_venta+"\"><input type=\"button\" value=\"Editar\" onclick=\"editarVentaInDB('"+inHtml+"',"+listaVentas[i].id_venta+",'"+listaVentas[i].producto+"',"+listaVentas[i].cantidad+","+listaVentas[i].precio+");\"></div></td>";
		txt += "<td><div id=\"butCancelar_"+listaVentas[i].id_venta+"\"><input type=\"button\" value=\"Borrar\" onclick=\"deleteVentaInDB('"+inHtml+"',"+listaVentas[i].id_venta+");\"></div></td>";
		
		txt += "</tr>";
		
	}
	txt += "</table>";
	txt += "</form>";
		
	document.getElementById(inHtml).innerHTML = txt;
}

function editarVentaInDB(inHtml,id_venta,producto,cantidad,precio){
	document.getElementById("producto_"+id_venta).innerHTML = "<input type='text' name='edit_producto_"+id_venta+"' value='"+producto+"'>";
	document.getElementById("cantidad_"+id_venta).innerHTML = "<input type='number' name='edit_cantidad_"+id_venta+"' value='"+cantidad+"'>";
	document.getElementById("precio_"+id_venta).innerHTML = "<input type='text' name='edit_precio_"+id_venta+"' value='"+precio+"'>";
	
	document.getElementById("butAceptar_"+id_venta).innerHTML = "<input type='button' name='butAceptar_"+id_venta+"' value='Guardar' onclick=\"guardarEdicionVenta('"+inHtml+"',"+id_venta+");\">";
	document.getElementById("butCancelar_"+id_venta).innerHTML = "<input type='button' name='butCancelar_"+id_venta+"' value='Cancelar' onclick=\"cancelarEdicionVenta('"+inHtml+"',"+id_venta+",'"+producto+"',"+cantidad+","+precio+");\"> ";
}

function guardarEdicionVenta(inHtml, id_venta){
	var producto = document.forms["edit_listaVentas"]["edit_producto_"+id_venta].value;
	var cantidad = document.forms["edit_listaVentas"]["edit_cantidad_"+id_venta].value;;
	var precio = document.forms["edit_listaVentas"]["edit_precio_"+id_venta].value;;
	//alert("id_venta: " + id_venta + "; producto: " + producto  + "; cantidad: " + cantidad + "; precio: " + precio);
	
	var xmlhttp = new XMLHttpRequest();
	
	xmlhttp.onreadystatechange = function() {
	   if (this.readyState == 4 && this.status == 200) {
          var myObj = JSON.parse(this.responseText);
		  
		  document.getElementById("producto_"+myObj[0].id_venta).innerHTML = "" + myObj[0].producto;
		  document.getElementById("cantidad_"+myObj[0].id_venta).innerHTML = "" + myObj[0].cantidad;
		  document.getElementById("precio_"+myObj[0].id_venta).innerHTML = "" + myObj[0].precio;
		  document.getElementById("subtotal_"+myObj[0].id_venta).innerHTML = "" + myObj[0].subtotal;
		  
		  document.getElementById("butAceptar_"+myObj[0].id_venta).innerHTML = "<input type=\"button\" value=\"Editar\" onclick=\"editarVentaInDB('"+inHtml+"',"+myObj[0].id_venta+",'"+myObj[0].producto+"',"+myObj[0].cantidad+","+myObj[0].precio+");\">";
		  document.getElementById("butCancelar_"+myObj[0].id_venta).innerHTML = "<input type=\"button\" value=\"Borrar\" onclick=\"deleteVentaInDB('"+inHtml+"',"+myObj[0].id_venta+");\">";	
      }
    }
	
    xmlhttp.open("GET", "./api.puesto/com.ventas/upDateVenta.php?id_venta="+id_venta+"&producto="+producto+"&cantidad="+cantidad+"&precio="+precio, true);
	xmlhttp.send();
}

function cancelarEdicionVenta(inHtml,id_venta,producto,cantidad,precio){
	document.getElementById("producto_"+id_venta).innerHTML = "" + producto;
	document.getElementById("cantidad_"+id_venta).innerHTML = "" + cantidad;
	document.getElementById("precio_"+id_venta).innerHTML = "" + precio;
	
	document.getElementById("butAceptar_"+id_venta).innerHTML = "<input type=\"button\" value=\"Editar\" onclick=\"editarVentaInDB('"+inHtml+"',"+id_venta+",'"+producto+"',"+cantidad+","+precio+");\">";
	document.getElementById("butCancelar_"+id_venta).innerHTML = "<input type=\"button\" value=\"Borrar\" onclick=\"deleteVentaInDB('"+inHtml+"',"+id_venta+");\">";	
}


function deleteVentaInDB(inHtml, id_venta){
	
	if(!confirm("¿Seguro que desea borrar la venta con consecutivo "+id_venta+"?"))
		return;
	
	var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
	    if (this.readyState == 4 && this.status == 200) {
            //var myObj = JSON.parse(this.responseText);
            loadResumenVentas(inHtml);
        }
    }
    xmlhttp.open("GET", "./api.puesto/com.ventas/deleteVenta.php?id_venta="+id_venta, true);
	xmlhttp.send();
}

function addVentaToDB(inHtml){
	var producto = document.forms["frmEditProducto"]["producto"].value;
	var cantidad = document.forms["frmEditProducto"]["cantidad"].value;
	var precio = document.forms["frmEditProducto"]["precio"].value;
	
	if(!producto){
		window.alert("Ningun valor puede ser nulo, vacio o cero");
		return;
	}
	if(!cantidad){
		window.alert("Ningun valor puede ser nulo, vacio o cero");
		return;
	}
	if(!precio){
		window.alert("Ningun valor puede ser nulo, vacio o cero");
		return;
	}
	
	var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
	    if (this.readyState == 4 && this.status == 200) {
            //var myObj = JSON.parse(this.responseText);
            loadResumenVentas(inHtml);
			
			document.forms["frmEditProducto"]["producto"].value = "";
			document.forms["frmEditProducto"]["cantidad"].value = "";
			document.forms["frmEditProducto"]["precio"].value = "";
        }
    }
    xmlhttp.open("GET", "./api.puesto/com.ventas/addVenta.php?producto="+producto+"&cantidad="+cantidad+"&precio="+precio+"", true);
	xmlhttp.send();

	//loadResumenVentas(inHtml);
}




