<?php 
include("sesion.php");
include("./sys/Class-OptionCnx.php");

if(isset($_POST['cancel_update_compra_producto'])){
    header("Location: crud_compras.php");
    die();
}

$data=array("id","producto", "cantidad", "precio", "lugar");
$values = array();

foreach ($data as $dato){
    if(isset($_POST[$dato])){
        $values[$dato] = $_POST[$dato];
    }
    else{
        $values[$dato] = null;
    }
}

if(!isset($values['id'])){
    header("Location: crud_compras.php");
    die();
}

$opts = new OptionCnx();
$conexionMySQL = $opts->openConexion();

$sql = "Update puesto.tmp_compras SET 
        cosa = '$values[producto]', 
        cantidad = $values[cantidad], 
        precio = $values[precio], 
        lugar = '$values[lugar]' 
        Where count = '$values[id]'";

$resultado = mysqli_query($conexionMySQL, $sql);

if(!$resultado){
    die("Error en la consulta. Query fail: " . $sql);
}

$_SESSION['message']='Compra Actualizada';
$_SESSION['message_type']='success';

$opts->closeConexion();

header("Location: crud_compras.php");
?>