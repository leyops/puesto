<?php
require("./constants.php");
require("../../sys/Class-OptionCnx.php");
require("./Hotwheels.php");
require("../../api.puesto/common/Func-Utils.php");


$opts = new OptionCnx();
$conexionMySQL = $opts->getConexion();

$toyHotwheels = strSQLfull($_REQUEST['toy']);

//$sql = "SELECT * FROM PuestoNavidad.ventas order by id_venta;";
$sql = "SELECT * FROM  ".$databaseName.".hotwheelslist WHERE toy='".$toyHotwheels."';";

$resultado = mysqli_query($conexionMySQL, $sql);

//$year;
    

while ($fila = mysqli_fetch_assoc($resultado)) {
	$current = new Hotwheels();
    $current->imgs = array();

	$current->year=$fila['year'];
	$current->toy=$fila['toy'];
    $current->col=$fila['col'];
    $current->model_name=$fila['model_name'];
    $current->serie_name=$fila['serie_name'];
    $current->serie_num=$fila['serie_num'];
    $current->photo=$fila['photo'];
    $current->stock=$fila['stock'];
    $current->price=$fila['price'];
    $current->location=$fila['location'];
    $current->consecutive=$fila['consecutive'];
    

}

$sql = "SELECT * FROM  ".$databaseName.".hotwheels_photos WHERE consecutive_hotwheels=".$current->consecutive.";";
$resultado = mysqli_query($conexionMySQL, $sql);

while ($fila = mysqli_fetch_assoc($resultado)) {
	$ImgPhoto = new ImgPhoto();
    
    $ImgPhoto->consecutive=$fila['consecutive'];
    $ImgPhoto->file=$fila['src'];

    $current->imgs[]=$ImgPhoto;
}

mysqli_close($conexionMySQL);
$encode = json_encode($current);
echo $encode;
return;


