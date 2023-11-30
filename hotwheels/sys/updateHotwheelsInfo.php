<?php
require("./constants.php");
require("../../sys/Class-OptionCnx.php");
require("./Hotwheels.php");
require("../../api.puesto/common/Func-Utils.php");

//Por ahora solo actualizaremos stock, price y location

$txtCodeHotwheels = $_POST["txtCodeHotwheels"];
$numStock = $_POST["numStock"];
$numPrice = $_POST["numPrice"];
$txtLocation = $_POST["txtLocation"];

$opts = new OptionCnx();
$conexionMySQL = $opts->getConexion();

$sql = "UPDATE ".$databaseName.".hotwheelslist " . 
       "SET price=".strSQLfull($numPrice).", " . 
       "    stock=".strSQLfull($numStock).", " . 
       "    location='".strSQLfull($txtLocation)."' WHERE toy='" . strSQLfull($txtCodeHotwheels)."';";

$resultado = mysqli_query($conexionMySQL, $sql);

mysqli_close($conexionMySQL);


