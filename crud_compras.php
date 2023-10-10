<!DOCTYPE html>
<?php 
    include("./sys/Class-OptionCnx.php");

    $opts = new OptionCnx();
    $conexionMySQL = $opts->openConexion();

?>


<?php include("./includes/header.php"); ?>

    <div class="row">
        <div class="col-md-3">
            <?php if(isset($_SESSION['message'])){ ?> 
                <div class="alert alert-<?=$_SESSION['message_type']; ?> alert-dismissible fade show" role="alert">
                    <?= $_SESSION['message']; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php } $_SESSION['message'] = null ?>
            <div class="card card-body">
                <form action="crud_save_compra_producto.php" method="POST">
                    <div class="form-group">
                        <p></p>
                        <input type="date" class="form-control" name="fechaCompra" value="<?=$_SESSION['last_date'];?>">
                        <p></p>
                        <input type="text" placeholder="Producto" class="form-control" name="producto" autofocus>
                        <p></p>
                        <input type="number" step="any" placeholder="1" class="form-control" name="cantidad">
                        <p></p>
                        <input type="number" step="any" placeholder="10.00" class="form-control" name="precio">
                        <p></p>
                        <input type="text" placeholder="Lugar de compra" class="form-control" name="lugar">
                        <p></p>
                        <div class="d-flex justify-content-center">
                            <div class="col d-flex justify-content-center"">
                            <input type="submit" value="Seleccionar" class="btn btn-primary" name="selecciona_compra_producto">
                            </div>
                            <div class="col d-flex justify-content-center"">
                            <input type="submit" value="   Agregar   " class="btn btn-success" name="save_compra_producto">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-md-7">
                <table class="table table-bordered">

                    <thead>
                        <tr>
                            <th class="text-center">Producto</th>
                            <th class="text-center">Cantidad</th>
                            <th class="text-center">Precio</th>
                            <th class="text-center">SubTotal</th>
                            <th class="text-center">Lugar de compra</th>
                            <th class="text-center">Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $total = 0;
                            $fecha = "";

                            $sql="";
                            if(isset($_SESSION['last_date'])){
                                $sql="SELECT count, fecha, cosa, cantidad, precio, Format(CAST(`tmp_compras`.`Cantidad` AS DECIMAL (10 , 2 )) * CAST(`tmp_compras`.`Precio` AS DECIMAL (10 , 2 )), 2 ) AS `SubTotal`, lugar FROM puesto.tmp_compras Where fecha = DATE_FORMAT(str_to_date('$_SESSION[last_date]','%Y-%m-%d'),'%d-%m-%Y')";
                                $fecha = $_SESSION['last_date'];
                            }
                            else{
                                $sql="SELECT count, fecha, cosa, cantidad, precio, Format(CAST(`tmp_compras`.`Cantidad` AS DECIMAL (10 , 2 )) * CAST(`tmp_compras`.`Precio` AS DECIMAL (10 , 2 )), 2 ) AS `SubTotal`, lugar FROM puesto.tmp_compras Where fecha = DATE_FORMAT((SELECT max(str_to_date(fecha,'%d-%m-%Y')) as Ffecha FROM puesto.tmp_compras),'%d-%m-%Y')";
                            }
                            
                            $resultado_compras = mysqli_query($conexionMySQL, $sql);
                            
                            while($row = mysqli_fetch_array($resultado_compras)){
                                $fecha = $row['fecha'];
                                $total += (float)str_replace(",","",$row['SubTotal']); 
                                $id = $row['count'];
                        ?>
                        <tr>
                            <td><?=$row['cosa'];?></td>
                            <td><?=$row['cantidad'];?></td>
                            <td><?=$row['precio'];?></td>
                            <td><?=$row['SubTotal'];?></td>
                            <td><?=$row['lugar'];?></td>
                            <td>
                                <a href="crud_edit_compra.php?id=<?=$id;?>" class="btn btn-warning">
                                    <i class="fa fa-pencil fa-fw"></i>
                                </a>
                                <a href="crud_delete_compra.php?id=<?=$id;?>" class="btn btn-danger">
                                    <i class="fa fa-trash-o fa-fw"></i>
                                </a>
                            </td>
                        </tr>
                        <?php }?>

                    </tbody>
                </table>
                <?=$fecha;?> Total $<?=$total;?>
        </div>

    </div>


<?php include("./includes/footer.php"); 
    $opts->closeConexion();
?>
