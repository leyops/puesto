<!DOCTYPE html>
<?php 

    if(!isset($_GET['id'])){
        header("Location: crud_compras.php");
    }

    include("./sys/Class-OptionCnx.php");

    $opts = new OptionCnx();
    $conexionMySQL = $opts->openConexion();

    $sql="Select count, DATE_FORMAT(str_to_date(fecha,'%d-%m-%Y'),'%Y-%m-%d') as fecha, cosa, cantidad, precio, lugar from puesto.tmp_compras Where count=$_GET[id]";
    $resultado = mysqli_query($conexionMySQL,$sql);

    if(mysqli_num_rows($resultado)!=1){
        $opts->closeConexion();
        header("Location: crud_compras.php");
    }
    $row = mysqli_fetch_array($resultado);
?>
<?php include("./includes/header.php"); ?>

<div class="container p-4">
<div class="row">
        <div class="col-md-6 mx-auto">
            <div class="card card-body">
                <form action="crud_update_compra_producto.php" method="POST">
                    <div class="form-group">
                        <input type="hidden" name="id" value="<?=$row['count'];?>">
                        <input type="date" class="form-control" name="fechaCompra" value="<?=$row['fecha'];?>" disabled>
                        <input type="text" placeholder="Producto" class="form-control" name="producto" autofocus value="<?=$row['cosa'];?>">
                        <input type="number" step="any" placeholder="1" class="form-control" name="cantidad" value="<?=$row['cantidad'];?>">
                        <input type="number" step="any" placeholder="10.00" class="form-control" name="precio" value="<?=$row['precio'];?>">
                        <input type="text" placeholder="Lugar de compra" class="form-control" name="lugar" value="<?=$row['lugar'];?>">

                        <div class="d-flex justify-content-center">
                            <input type="submit" value="Cancelar" class="btn btn-secondary" name="cancel_update_compra_producto">
                            <input type="submit" value="Actualizar" class="btn btn-success" name="update_compra_producto">
                        </div>
                    </div>
                </form>
            </div>
        </div>

        

</div>
</div>


<?php include("./includes/footer.php"); 
    $opts->closeConexion();
?>
