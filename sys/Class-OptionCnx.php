<?php
/**Clase de conexion a base de datos de php a MySQL
 *
 */
class OptionCnx
{
  public $ip = 'localhost';
	public $dataBaseName= 'puesto';
	public $port = "3306";
	public $user = 'leo';
	public $password = '3808cce1764a7461ac1d5ff310acf05f';
  public $conexion = null;

  function getConexion(){
    $this->conexion = mysqli_connect($this->ip . ':' . $this->port, $this->user, $this->password, $this->dataBaseName);
    if(!$this->conexion){
      die('No se pudo conectar ');
    }
    return $this->conexion;
  }

  function openConexion(){
    $this->conexion = mysqli_connect($this->ip . ':' . $this->port, $this->user, $this->password, $this->dataBaseName);
    if(!$this->conexion){
      die('No se pudo conectar ');
    }
    return $this->conexion;
  }

  function closeConexion(){
    mysqli_close($this->conexion);
  }


}


?>
