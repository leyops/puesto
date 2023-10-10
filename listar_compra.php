<!DOCTYPE html>
<?php 
    // Conexión a la base de datos
    include("./sys/Class-OptionCnx.php");

    $opts = new OptionCnx();
    $conexionMySQL = $opts->openConexion();

    
    $NumLineasAMostrar=50;
    $IndiceMostrado=0;          // SubIndice que ayuda a indicar en que pagina vamos de los resultados

    $values = [];               // Array con los datos del formulario que recibomos en el post
    $backIndice="";             // indica si deshabilita el botón de regresar en los resultados
    $nextIndice="";
    $offSet = 0;                // SubIndice para la consulta, a partir de que elemento debe mostrar resultados
    $acarreo = 0;

    if(isset($_POST['IndiceMostrado'])){
        $IndiceMostrado = $_POST['IndiceMostrado'];
        if(isset($_POST['selecciona_compra_producto'])){
            $IndiceMostrado = 0;
        }
    }
    
    if(isset($_POST['siguiente_indice_compra_producto'])){
        $IndiceMostrado += 1;
    }
    
    if(isset($_POST['anterior_indice_compra_producto'])){
        $IndiceMostrado -= 1;
    }

    $offSet = $IndiceMostrado * $NumLineasAMostrar;

    if($IndiceMostrado==0){
        $backIndice = "disabled";
    }
    
    //Armado de clausula where de los Querys
    $where = "";
    if(isset($_POST['fechaCompra'])){
        $values['fechaCompra'] = $_POST['fechaCompra'];
        if(strcmp($values['fechaCompra'],"")!=0)
            $where = " fecha = str_to_date('$_POST[fechaCompra]','%Y-%m-%d') AND ";
    }
    else{
        $values['fechaCompra'] = "";
    }
    if(isset($_POST['producto'])){
        $values['producto'] = $_POST['producto'];
        if(strcmp($values['producto'],"")!=0)
            $where = $where . " cosa like '%$_POST[producto]%' AND ";
    }
    else{
        $values['producto'] = "";
    }
    if(isset($_POST['lugar'])){
        $values['lugar'] = $_POST['lugar'];
        if(strcmp($values['lugar'],"")!=0)
            $where = $where . " lugar like '%$_POST[lugar]%' ";
    }
    else{
        $values['lugar'] = "";
    }
    
    if(strlen($where)>0){
        $where = "WHERE " . $where;
    }

    // Quitamos un posible "AND " que pueda quedar al final de la clausula Where
    if(strcmp(substr($where,strlen($where)-4,4),"AND ")==0){
        $where = substr($where,0,strlen($where)-4);
    }
    
    //Revisamos cuantos resultados puede regresar la consulta
    $sql="SELECT count(*) 
            FROM puesto.view_tmp_compras 
            $where ";
    $res = mysqli_query($conexionMySQL, $sql);
    $row = mysqli_fetch_array($res);
    $NumLineasEncontradas = $row[0];

    if(($NumLineasEncontradas%$NumLineasAMostrar)>0){
        $acarreo = 1;
    }

    if(intval($NumLineasEncontradas/$NumLineasAMostrar)==($IndiceMostrado)){
        $nextIndice="disabled";
    }


?>


<?php include("./includes/header.php"); ?>

<form action="listar_compra.php" method="POST">
<div class="row">
        <div class="col-md-3">
            <div class="card card-body">
                
                    <div class="form-group">
                        <p></p>
                        <input type="date" class="form-control" name="fechaCompra" value="<?=$values['fechaCompra'];?>">
                        <p></p>
                        <input type="text" placeholder="Producto" class="form-control" name="producto" value="<?=$values['producto']?>">
                        <p></p>
                        <input type="text" placeholder="Lugar de compra" class="form-control" name="lugar" value="<?=$values['lugar']?>">
                        <p></p>

                        <input type="hidden" name="IndiceMostrado" value="<?=$IndiceMostrado?>">
                        <div class="d-flex justify-content-center">
                            <input type="submit" value="Buscar" class="btn btn-primary" name="selecciona_compra_producto">
                        </div>
                        
                        
                    </div>
                
            </div>
        </div>

        <div class="col-md-8">
            <div class="row">
                <div class="col">
                    Resultaods encontrados: <?=$NumLineasEncontradas?>
                </div>
                <?php
                        if(($NumLineasEncontradas/$NumLineasAMostrar)>1){
                        ?>
                            <div class="col">
                                Página <?=($IndiceMostrado+1)?> de <?=(intval($NumLineasEncontradas/$NumLineasAMostrar)+$acarreo)?>
                            </div>
                            <div class="col">
                            <input type="submit" value="  <  " class="btn btn-primary" name="anterior_indice_compra_producto" <?=$backIndice?>>
                            <input type="submit" value="  >  " class="btn btn-primary" name="siguiente_indice_compra_producto" <?=$nextIndice?>>
                            </div>
                            <p></p>
                        <?php
                        
                        }
                        ?>
                
            </div>
                <table class="table table-bordered">

                    <thead>
                        <tr>
                            <th class="text-center">Fecha</th>
                            <th class="text-center">Producto</th>
                            <th class="text-center">Cantidad</th>
                            <th class="text-center">Precio</th>
                            <th class="text-center">SubTotal</th>
                            <th class="text-center">Tienda</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            
                            $sql="SELECT count, fecha, cosa, cantidad, precio, SubTotal, lugar 
                                    FROM puesto.view_tmp_compras 
                                    $where 
                                    order by fecha desc LIMIT $offSet, $NumLineasAMostrar";
                            
                            $resultado_compras = mysqli_query($conexionMySQL, $sql);
                            
                            while($row = mysqli_fetch_array($resultado_compras)){ ?>
                        <tr>
                            <td  class="text-center"><?=$row['Fecha'];?></td>
                            <td><?=$row['Cosa'];?></td>
                            <td class="text-center"><?=$row['Cantidad'];?></td>
                            <td class="text-center"><?=$row['Precio'];?></td>
                            <td class="text-center"><?=$row['SubTotal'];?></td>
                            <td><?=$row['Lugar'];?></td>
                        </tr>
                        <?php }?>
                    </tbody>
                </table>
        </div>

    </div>







<?php include("./includes/footer.php"); 
    $opts->closeConexion();
?>
