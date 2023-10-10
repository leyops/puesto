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
        <a href="abuelita_faltantes.php">Hilazas faltantes</a>
    </nav>

    <section class="producto">

        <div>
            <img id="muestra-hilaza-abuelita" src="./img/Hilaza_abuelita.png" alt="">
        </div>

        <div>
            <p>Hilaza de algodón ideal para amigurumi, 100% algodón no mercerizado.</p>
            <p>Presentación: Bolas de 50 g., 50 g. = 1.76oz </p>
            <p>Agujas: 2 - 3</p>
        </div>

    </section>

    <h2>Catálogo de colores</h2>

    <div class="main">
        <?php
        include("./sys/Class-hilaza_abuelita.php");

        $abue = new Hilaza_abuelita();

        $listado_abuelitas = $abue->get_listado_abuelitas();

        foreach ($listado_abuelitas as $curr_abuelita){

            echo '<div class="hilaza-abuelita">';
            echo '   <img id="' . $curr_abuelita->get_name_format_id() . '" src="./img/trans.png" alt="" onclick="ventanaEditExistencias(\''.$curr_abuelita->code_hilaza_abuelita.'\', '.$curr_abuelita->existencias_abuelita.', \''.$curr_abuelita->name_abuelita.'\')">';
            echo '   <p>' . $curr_abuelita->code_hilaza_abuelita . ' - ' . $curr_abuelita->name_abuelita . '</p>';
            echo '   <p> Piezas: '.$curr_abuelita->existencias_abuelita.'</p> ';
            echo '</div>'."\n";
            echo '';
        }

        ?>
    </div>


</body>

<style>
<?php
    foreach ($listado_abuelitas as $curr_abuelita){

        echo '   img#'.$curr_abuelita->get_name_format_id().'{';
        echo ' width: 130px; ';
        echo ' height: 80px; ';
        echo ' background: url(./img/Catalogo_hilaza_abuelita_2020.jpg) -' . $curr_abuelita->eje_x . 'px -' . $curr_abuelita->eje_y . 'px; ';
        echo ' } '."\n";
    }
    ?>
</style>

<script src="./js/jquery-3.5.1.min.js"></script>
<script src="./js/hilaza_abuelita.js"></script>

</html>