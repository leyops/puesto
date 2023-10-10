<?php 
include("sesion.php");
include("./sys/Class-OptionCnx.php");

if(!isset($_GET['id'])){
    header("Location: crud_compras.php");
}


$opts = new OptionCnx();
$conexionMySQL = $opts->openConexion();

$sql = "Delete from puesto.tmp_compras WHERE count = $_GET[id]";
$resultado = mysqli_query($conexionMySQL, $sql);

if(!$resultado){
    $_SESSION['message']='Error de borrado';
    $_SESSION['message_type']='danger';
    die("Error en la consulta. Query fail: " . $sql);
}

$_SESSION['message']='Borrado exitoso';
$_SESSION['message_type']='success';

$opts->closeConexion();
header("Location: crud_compras.php");
?>