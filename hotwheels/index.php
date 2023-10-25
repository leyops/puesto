<?php
require("./sys/Class-Hotwheels.php");

$hots = new hotwheelslist();

$anios = $hots->get_listado_anios();

 ?>
 
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotwheels</title>
</head>
<body>
    <a href='index.php'> <h1>Hotwheels</h1> </a>

    <nav>
        <?php
        foreach ($anios as $anio){
            echo "<a href='".$anio."'>".$anio."</a>";
        }
         ?>
         <a href='registrarStock.php'> Registrar</a>
    </nav>
</body>
</html>