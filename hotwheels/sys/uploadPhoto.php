<?php
//echo "el que lo lea.";

//if (isset($_POST['archivo'])) {
    //echo "entro post archivo";
    //Recogemos el archivo enviado por el formulario
    $archivo = $_FILES['archivo']['name'];
    //Si el archivo contiene algo y es diferente de vacio
    if (isset($archivo) && $archivo != "") {
       //Obtenemos algunos datos necesarios sobre el archivo
       $tipo = $_FILES['archivo']['type'];
       $tamano = $_FILES['archivo']['size'];
       $temp = $_FILES['archivo']['tmp_name'];
       //Se comprueba si el archivo a cargar es correcto observando su extensión y tamaño
      if (!((strpos($tipo, "gif") || strpos($tipo, "jpeg") || strpos($tipo, "jpg") || strpos($tipo, "png")) && ($tamano < 100000000))) {
         //echo '<div><b>Error. La extensión o el tamaño de los archivos no es correcta.<br/>
         // - Se permiten archivos .gif, .jpg, .png. y de 200 kb como máximo.</b></div>';
      }
      else {
         //Si la imagen es correcta en tamaño y tipo
         //Se intenta subir al servidor
         if (move_uploaded_file($temp, '../photos/'.$archivo)) {
             //Cambiamos los permisos del archivo a 777 para poder modificarlo posteriormente
             chmod('../photos/'.$archivo, 0777);
             //Mostramos el mensaje de que se ha subido co éxito
             //echo 'Se ha subido correctamente la imagen.</b></div>';
             //Mostramos la imagen subida
             echo '../photos/'.$archivo;
         }
         else {
            //Si no se ha podido subir la imagen, mostramos un mensaje de error
            //echo '<div><b>Ocurrió algún error al subir el fichero. No pudo guardarse.</b></div>';
         }
       }
    }
// }



