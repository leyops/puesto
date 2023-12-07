<?php
require("./constants.php");
require("../../sys/Class-OptionCnx.php");
require("./Hotwheels.php");
require("../../api.puesto/common/Func-Utils.php");

$MAX_ANCHO = 700;
$MAX_ALTO = 1100;


function compressImage($source, $destination, $quality, $imgInfo) { 
   // Obtenemos la información de la imagen
   //$imgInfo = getimagesize($source); 
   $mime = $imgInfo['mime']; 
    
   // Creamos una imagen
   switch($mime){ 
       case 'image/jpeg': 
           $image = imagecreatefromjpeg($source); 
           break; 
       case 'image/png': 
           $image = imagecreatefrompng($source); 
           break; 
       case 'image/gif': 
           $image = imagecreatefromgif($source); 
           break; 
       default: 
           $image = imagecreatefromjpeg($source); 
   } 
    
   // Guardamos la imagen
   imagejpeg($image, $destination, $quality); 
    
   // Devolvemos la imagen comprimida
   return $destination; 
} 

//Si hay archivo, cadena de texto
if (!isset($_FILES['archivo'])) {
   echo "Error: Nada que subir";
   exit();
}

//Recogemos el archivo enviado por el formulario
$archivo = $_FILES['archivo']['name'];

//Si el archivo es diferente de vacio
if ($archivo=="") {
   echo "Error: Archivo vacio.";
   exit();
}

//Obtenemos algunos datos necesarios sobre el archivo
$tipo = $_FILES['archivo']['type'];
$tamano = $_FILES['archivo']['size'];
$temp = $_FILES['archivo']['tmp_name'];


//Se comprueba si el archivo a cargar es correcto observando su extensión y tamaño
if (!((strpos($tipo, "gif") || strpos($tipo, "jpeg") || strpos($tipo, "jpg") || strpos($tipo, "png")) && ($tamano < 100000000))) {
   echo 'Error. La extensión o el tamaño de los archivos no es correcta.';
   exit();
}

$cont = 1;
$newFile = '../photos/'.$_POST['toy'].'_'.$archivo;
while(file_exists($newFile)){
   $newFile = '../photos/'.$cont.'_'.$_POST['toy'].'_'.$archivo;
   $cont++;
}

$archivo = $newFile;
//Si la imagen es correcta en tamaño y tipo
//Se intenta subir al servidor
$imgInfo = getimagesize($temp); 
$mime = $imgInfo['mime'];
//echo "tam: ancho:" . $imgInfo[0] . "; alto:" . $imgInfo[1] . "";
$compressedImage = "";
if($imgInfo[0]>$MAX_ANCHO || $imgInfo[1] > $MAX_ALTO){
   $calidad = $calidadToRecortarAncho = ($MAX_ANCHO / $imgInfo[0])*100;
   $calidadToRecortarAlto = ($MAX_ALTO / $imgInfo[1])*100;

   if($calidadToRecortarAlto < $calidadToRecortarAncho){
      $calidad = $calidadToRecortarAlto;
   }
   $calidad = floor($calidad);
   echo "calidad: " . $calidad;
   $compressedImage = compressImage($temp, $archivo,$calidad, $imgInfo);
   if($compressedImage==""){
      echo "Error: En la compresion de la imagen.";
      exit();
   }
}
else{
   if (move_uploaded_file($temp, $archivo)) {
      $compressedImage = $archivo;
   }
   else{
      echo "Error: No se pudo cargar el archivo al servidor.";
      exit();
   }
}

//Aqui todo bien, o se subio o se comprimio y subio y esta en la variable $compressedImage
chmod($compressedImage, 0777);
$opts = new OptionCnx();
$conexionMySQL = $opts->getConexion();
             
$toyHotwheels = strSQLfull($_REQUEST['toy']);
             
             
$sql = "INSERT INTO ".$databaseName.".hotwheels_photos (consecutive_hotwheels,src) " .
         "VALUES ((SELECT consecutive FROM ".$databaseName.".hotwheelslist WHERE toy = '".$toyHotwheels."'),'".strSQLfull($compressedImage)."')" ;

$resultado = mysqli_query($conexionMySQL, $sql);

mysqli_close($conexionMySQL);
echo "Ok: ".$compressedImage;


/*

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

/* */



