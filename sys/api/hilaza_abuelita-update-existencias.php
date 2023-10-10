<?php
    include("../Class-hilaza_abuelita.php");

    $abue = new Hilaza_abuelita();
    $resultado = $abue->updateExistencias($_POST["code_hilaza_abuelita"],$_POST["existencias_abuelita"]);
    echo json_encode($resultado);
?>