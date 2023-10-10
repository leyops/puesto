<!DOCTYPE html>
<?php 
    include("./sys/Class-OptionCnx.php");

    $opts = new OptionCnx();
    $conexionMySQL = $opts->openConexion();

    include("./Class-Estadisticas.php");

    $est = new Estadisticas();
    $est->getEstadisticas($conexionMySQL);

    // Habilitar php_intl.dll
    $fmt = new NumberFormatter( 'es-MX', NumberFormatter::CURRENCY );
    

?>


<?php include("./includes/header.php"); ?>

<div class="d-flex justify-content-center">
<div class="row">
    <div class="col"><h2> Total de compras: <?=$fmt->formatCurrency($est->Total, "MXN")?></<h2> </div>
</div>
</div>
<p></p>

<p></p>

<div class="d-flex justify-content-center">
<div class="row col-md-5 text-center ">
    <div class="col">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th class="text-center">Año</th>
                    <th class="text-center">Mes</th>
                    <th class="text-center">Gasto del Mes</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($est->GastoxMes as $row){ ?> 
                <tr>
                    <td><?=$row['Anio'];?></td>
                    <td><?=$row['Mes'];?></td>
                    <td><?=$row['SumaMes'];?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <div class="col">
        <div>
            Top 10 de días con mayor gasto.
        </div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th class="text-center">Fecha</th>
                    <th class="text-center">Gasto del Día</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($est->TopDias as $row){ ?> 
                <tr>
                    <td><?=$row['Fecha'];?></td>
                    <td><?=$row['SumaDia'];?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
</div>


<div class="row">
    
</div>






<?php include("./includes/footer.php"); 
    $opts->closeConexion();
?>
