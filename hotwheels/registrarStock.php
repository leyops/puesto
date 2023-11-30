<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Hotwheels</title>
</head>
<body>
    <a href='index.php'><h2>Hotwheels</h2></a>
    <h1>Registra Hotwheels</h1>


    <form name="frmSearchCode">
        <label for="">Código de hotwheels</label>
        <input type="text" name="hotwheelsCode" placeholder="HCX22">
        <br>
        <input type="button" name="searchCode" value="Busca Modelo" onclick="getInfoHotwheelsByModelo();">
    </form>
	<br>	

    <!-- <div id="ventanaRegistro" style="display:none;"> -->
	<div id="ventanaRegistro">
	<form name="frmRegistroStockHotwheels">
	  <label name="lblyearHotwheels">Año</label>
	  <input type="number" name="numYearHotwheels" value="">
	  <br>
	  
	  <label name="lblcolHotwheels">Codigo</label>
	  <input type="text" name="txtColHotwheels" value="">
	  <br>

	  <label name="lblcodeHotwheels">Col</label>
	  <input type="text" name="txtCodeHotwheels" value="">
	  <br>
	  
	  <label name="lblmodelName">Nombre del modelo</label>
	  <input type="text" name="txtModelName" value="">
	  <br>

	  <label name="lblserieName">Serie del modelo</label>
	  <input type="text" name="txtSerieName" value="">
	  <br>

	  <label name="lblserieNum">Serie del modelo</label>
	  <input type="text" name="txtSerieNum" value="">
	  <br>
	  
	  <label name="lblstock">Piezas disponibles</label>
	  <input type="number" name="numStock" value="">
	  <br>
	  
	  <label name="lblprice">Precio</label>
	  <input type="number" name="numPrice" value="">
	  <br>
	  
	  <label name="lbllocation">Comentario</label>
	  <input type="text" name="txtLocation" value="">
	  <br>

	  <input type="button" name="salvar" value="Guardar" onclick="updateHotwheelsInfo();">
	  <br>
	  <br>
	  
	  <input type="file" name="imgFileHotwheels" id="imgPhotoHotwheels">
	  <input type="button" name="addHotwheelsPhoto" value="Subir img" onclick="uploadPhotoFile();">
	  <div id="imgsDivs">
	    <!--<img src="" name="imgPortada" alt="Img de Hotwheels" id="imgHotwheelsPortada">-->
	  </div>

	  

	</form>
    </div>

	
	<script src="./sys/admstockHotwheels.js"></script>
	

</body>
</html>
