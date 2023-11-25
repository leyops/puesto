<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Hotwheels</title>
</head>
<body>
    <a href='index.php'><h2>Hotwheels</h2></a>
    <h1>Registra existencia Hotwheels</h1>


    <form name="frmSearchCode">
        <label for="">Código de hotwheels</label>
        <input type="text" name="hotwheelsCode" placeholder="HCX22">
        <br>
        <input type="button" name="searchCode" value="Busca Modelo" onclick="">
    </form>
	<br>	

    <div id="ventanaRegistro">
	<form name="frmRegistroStockHotwheels">
	  <label name="lblcodeHotwheels">Codigo</label>
	  <input type="text" name="txtCodeHotwheels" value="">
	  <br>
	  <label name="lblmodelName">Nombre del modelo</label>
	  <input type="text" name="txtModelName" value="">
	  <br>
	  <label name="lblstock">Piezas disponibles</label>
	  <input type="number" name="numStock" value="">
	  <br>
	  <label name="lblprice">Precio</label>
	  <input type="number" name="numPrice" value="">
	  <br>
	  <label name="lbllocation">Ubicacion</label>
	  <input type="text" name="txtLocation" value="">
	  
	</form>
    </div>

</body>
</html>
