<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="css/estilo_general.css" rel="stylesheet" type="text/css">
    <link href="css/estilo_abuelita.css" rel="stylesheet" type="text/css">
    

    <title>Hilaza abuelita</title>
</head>
<body>

    <?php
    include('encabezado.php');
    ?>
    
    <h1>Hilaza abuelita</h1>

    <nav>
        <a href="abuelita.php">Hilaza abuelita</a>
    </nav>

    <div class="main">
    <?php
    include("./sys/Class-hilaza_abuelita.php");

    $abue = new Hilaza_abuelita();

    $listado_abuelitas = $abue->get_listado_abuelitas();

    foreach ($listado_abuelitas as $curr_abuelita){

        if($curr_abuelita->existencias_abuelita==0){
            echo '<div class="hilaza-abuelita">';
            echo '   <img id="' . $curr_abuelita->get_name_format_id() . '" src="./img/trans.png" alt="">';
            echo '   <p>' . $curr_abuelita->code_hilaza_abuelita . ' - ' . $curr_abuelita->name_abuelita . '</p>';
            echo '   <p> Piezas: '.$curr_abuelita->existencias_abuelita.'</p> ';
            echo '</div>'."\n";
            echo '';
        }
    }

    ?>
    </div>


</body>

<style>
<?php
    foreach ($listado_abuelitas as $curr_abuelita){

        if($curr_abuelita->existencias_abuelita==0){
            echo '   img#'.$curr_abuelita->get_name_format_id().'{';
            echo ' width: 110px; ';
            echo ' height: 75px; ';
            echo ' background: url(./img/Catalogo_hilaza_abuelita_2020.jpg) -' . $curr_abuelita->eje_x . 'px -' . $curr_abuelita->eje_y . 'px; ';
            echo ' } '."\n";
        }
    }
    ?>
</style>


</html>