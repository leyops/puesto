function getInfoHotwheelsByModelo(){
    //document.getElementById("ventanaRegistro").style.display = "none";

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

            document.getElementById("imgsDivs").innerHTML = "";
            if (myObj.imgs.length>0){
                myObj.imgs.forEach(function(img) {
                    //console.log(numero);
                    //let imgPortada = "<img src=\""+img.file.substring(1)+"\" alt=\"Img de Hotwheels\" width=\"200\" height=\"360\">";
                    let imgPortada = "<img src=\""+img.file.substring(1)+"\" alt=\"Img de Hotwheels\">";
                    document.getElementById("imgsDivs").innerHTML = document.getElementById("imgsDivs").innerHTML + imgPortada;
                });
                //let imgPortada = "<img src=\""+myObj.photo+"\" name=\"imgPortada\" alt=\"Img de Hotwheels\" id=\"imgHotwheelsPortada\">";
                //document.getElementById("imgsDivs").innerHTML = imgPortada;
            }
            
            //document.getElementById("ventanaRegistro").style.display = "block";
        }
    }
    xmlhttp.open("GET", "./sys/getHotwheels.php?toy="+txtTo, true);
	xmlhttp.send();
}

function updateHotwheelsInfo(){

    if(!document.forms["frmRegistroStockHotwheels"]["txtCodeHotwheels"].value){
        return;
    }
    
    var url = "./sys/updateHotwheelsInfo.php";
    var fd = new FormData();
    fd.append("numYearHotwheels", ""+document.forms["frmRegistroStockHotwheels"]["numYearHotwheels"].value);
    fd.append("txtCodeHotwheels", ""+document.forms["frmRegistroStockHotwheels"]["txtCodeHotwheels"].value);
    fd.append("txtColHotwheels", ""+document.forms["frmRegistroStockHotwheels"]["txtColHotwheels"].value);
    fd.append("txtModelName", ""+document.forms["frmRegistroStockHotwheels"]["txtModelName"].value);
    fd.append("numStock", ""+document.forms["frmRegistroStockHotwheels"]["numStock"].value);
    fd.append("numPrice", ""+document.forms["frmRegistroStockHotwheels"]["numPrice"].value);
    fd.append("txtLocation", ""+document.forms["frmRegistroStockHotwheels"]["txtLocation"].value);
    fd.append("txtSerieName", ""+document.forms["frmRegistroStockHotwheels"]["txtSerieName"].value);
    fd.append("txtSerieNum", ""+document.forms["frmRegistroStockHotwheels"]["txtSerieNum"].value);
    

    var xmlHTTP = new XMLHttpRequest();
    xmlHTTP.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            alert("Regrese " + this.responseText);
            
        }
    }
    xmlHTTP.open("POST", url, true);
    xmlHTTP.send(fd);
}


function uploadPhotoFile(){
    //var url = "/ReadMoveWebServices/WSUploadFile.asmx/UploadFile";
    if(!document.forms["frmRegistroStockHotwheels"]["txtCodeHotwheels"].value)
        return;
    var url = "./sys/uploadPhoto.php";
    var archivoSeleccionado = document.getElementById("imgPhotoHotwheels");
    var file = archivoSeleccionado.files[0];
    var fd = new FormData();
    fd.append("archivo", file);
    fd.append("toy", ""+document.forms["frmRegistroStockHotwheels"]["txtCodeHotwheels"].value);
    
    var xmlHTTP = new XMLHttpRequest();
    xmlHTTP.onreadystatechange = function() {
	    if (this.readyState == 4 && this.status == 200) {

            alert("chido " + this.responseText);
            //Agregar img en el espacio de divs
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