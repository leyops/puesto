<?php 
include("sesion.php");
include("./sys/Class-OptionCnx.php");

if(isset($_POST['selecciona_compra_producto'])){
    $_SESSION['last_date']=$_POST['fechaCompra'];
    header("Location: crud_compras.php");
    die();
}

$opts = new OptionCnx();
$conexionMySQL = $opts->openConexion();

$data=array("fechaCompra", "producto", "cantidad", "precio", "lugar");
$values = array();

foreach ($data as $dato){
    if(isset($_POST[$dato])){
        $values[$dato] = $_POST[$dato];
    }
    else{
        $values[$dato] = null;
    }
}

$sql = "Insert into puesto.tmp_compras (fecha,cosa,cantidad,precio,lugar) Values (DATE_FORMAT(STR_TO_DATE('$values[fechaCompra]','%Y-%m-%d'),'%d-%m-%Y'), '$values[producto]', $values[cantidad], $values[precio], '$values[lugar]')";
$resultado = mysqli_query($conexionMySQL, $sql);

if(!$resultado){
    die("Error en la consulta. Query fail: " . $sql);
}

$_SESSION['message']='Compra Salvada';
$_SESSION['message_type']='success';
$_SESSION['last_date']=$values[fechaCompra];
//echo("Guardado.");

$opts->closeConexion();

header("Location: crud_compras.php");

?>