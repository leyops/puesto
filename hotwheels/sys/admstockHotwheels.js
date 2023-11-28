function getInfoHotwheelsByModelo(){
    document.getElementById("ventanaRegistro").style.display = "none";

    let txtTo = document.forms["frmSearchCode"]["hotwheelsCode"].value;
    //window.alert("Entre"); HCX22
	if(!txtTo){
		//window.alert("Ningun valor puede ser nulo, vacio o cero");
		return;
	}

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
	    if (this.readyState == 4 && this.status == 200) {
            var myObj = JSON.parse(this.responseText);
            //muestraVentas(inHtml, myObj); HCX22

            //window.alert(this.responseText);
            //document.getElementById("producto_"+id_venta).innerHTML = "<input type='text' name='edit_producto_"+id_venta+"' value='"+producto+"'>";
            //HCT05
            document.forms["frmRegistroStockHotwheels"]["numYearHotwheels"].value = myObj.year;
            document.forms["frmRegistroStockHotwheels"]["txtCodeHotwheels"].value = myObj.toy;
            document.forms["frmRegistroStockHotwheels"]["txtColHotwheels"].value = myObj.col;
            document.forms["frmRegistroStockHotwheels"]["txtModelName"].value = myObj.model_name;
            document.forms["frmRegistroStockHotwheels"]["numStock"].value = myObj.stock;
            document.forms["frmRegistroStockHotwheels"]["numPrice"].value = myObj.price;
            document.forms["frmRegistroStockHotwheels"]["txtLocation"].value = myObj.location;

            document.forms["frmRegistroStockHotwheels"]["txtSerieName"].value = myObj.serie_name;
            document.forms["frmRegistroStockHotwheels"]["txtSerieNum"].value = myObj.serie_num;

            if (myObj.photo!=null){
                let imgPortada = "<img src=\""+myObj.photo+"\" name=\"imgPortada\" alt=\"Img de Hotwheels\" id=\"imgHotwheelsPortada\">";
                document.getElementById("imgsDivs").innerHTML = imgPortada;
            }
            
            document.getElementById("ventanaRegistro").style.display = "block";
        }
    }
    xmlhttp.open("GET", "./sys/getHotwheels.php?toy="+txtTo, true);
	xmlhttp.send();
}


function uploadPhotoFile(){
    //var url = "/ReadMoveWebServices/WSUploadFile.asmx/UploadFile";
    var url = "./sys/uploadPhoto.php";
    var archivoSeleccionado = document.getElementById("imgPhotoHotwheels");
    var file = archivoSeleccionado.files[0];
    var fd = new FormData();
    fd.append("archivo", file);
    var xmlHTTP = new XMLHttpRequest();
    xmlHTTP.onreadystatechange = function() {
	    if (this.readyState == 4 && this.status == 200) {

            alert("chido " + this.responseText);
        }
    }
    //xmlHTTP.upload.addEventListener("loadstart", loadStartFunction, false);
    //xmlHTTP.upload.addEventListener("progress", progressFunction, false);
    //xmlHTTP.addEventListener("load", transferCompleteFunction, false);
    //xmlHTTP.addEventListener("error", uploadFailed, false);
    //xmlHTTP.addEventListener("abort", uploadCanceled, false);
    xmlHTTP.open("POST", url, true);
    //xmlHTTP.setRequestHeader('book_id','10');
    xmlHTTP.send(fd);
   }