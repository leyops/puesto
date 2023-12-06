<?php
require("./constants.php");
require("../../sys/Class-OptionCnx.php");
require("./Hotwheels.php");
require("../../api.puesto/common/Func-Utils.php");


if (isset($_FILES['archivo'])) {
    //echo "entro post archivo";
    //Recogemos el archivo enviado por el formulario
    $archivo = $_FILES['archivo']['name'];
    //$originalfilename = 
    //Si el archivo contiene algo y es diferente de vacio
    if (isset($archivo) && $archivo != "") {
       //Obtenemos algunos datos necesarios sobre el archivo
       $tipo = $_FILES['archivo']['type'];
       $tamano = $_FILES['archivo']['size'];
       $temp = $_FILES['archivo']['tmp_name'];
       //echo "temp file: " . $temp;
       //Se comprueba si el archivo a cargar es correcto observando su extensión y tamaño
      if (!((strpos($tipo, "gif") || strpos($tipo, "jpeg") || strpos($tipo, "jpg") || strpos($tipo, "png")) && ($tamano < 100000000))) {
         echo 'Error. La extensión o el tamaño de los archivos no es correcta.<br/>';
         // - Se permiten archivos .gif, .jpg, .png. y de 200 kb como máximo.</b></div>';
      }
      else {
         $cont = 1;
         $newFile = '../photos/'.$_POST['toy'].'_'.$archivo;
         while(file_exists($newFile)){
            $newFile = '../photos/'.$cont.'_'.$_POST['toy'].'_'.$archivo;
            $cont++;
         }

         $archivo = $newFile;
         //Si la imagen es correcta en tamaño y tipo
         //Se intenta subir al servidor
         if (move_uploaded_file($temp, $archivo)) {
             //Cambiamos los permisos del archivo a 777 para poder modificarlo posteriormente
             chmod($archivo, 0777);
            
             $opts = new OptionCnx();
             $conexionMySQL = $opts->getConexion();
             
             $toyHotwheels = strSQLfull($_REQUEST['toy']);
             
             
             $sql = "INSERT INTO ".$databaseName.".hotwheels_photos (consecutive_hotwheels,src) " .
                     "VALUES ((SELECT consecutive FROM ".$databaseName.".hotwheelslist WHERE toy = '".$toyHotwheels."'),'".strSQLfull($archivo)."')" ;

             $resultado = mysqli_query($conexionMySQL, $sql);

             mysqli_close($conexionMySQL);
             echo "Ok: ".$archivo;

         }
         else {
            //Si no se ha podido subir la imagen, mostramos un mensaje de error
            echo 'Ocurrió algún error al subir el fichero. No pudo guardarse.';
         }
       }
    }
 }
 else{
   echo "Nada que subir";
 }



