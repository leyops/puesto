<?php
Class Estadisticas{
    
    public $Total=0.0;
    public $FechaInicial="";
    public $FechaFinal="";
    public $GastoxMes=[];
    public $TopDias=[];

    function getEstadisticas($conn){

        //Obtenemos la fecha inicial y final de registro
        $sql="SELECT min(Fecha) AS FechaInicial, max(Fecha) AS FechaFinal
                FROM puesto.view_tmp_compras";
        $res = mysqli_query($conn,$sql);
        $row = mysqli_fetch_array($res);
        $this->FechaInicial = $row['FechaInicial'];
        $this->FechaFinal = $row['FechaFinal'];

        //Ahora obtenemos el gasto x mes y hacemos la suma al tiempo
        $this->Total=0.0;
        $this->GastoxMes=[];
        $sql="SELECT DATE_FORMAT(fecha,'%Y') AS Anio, DATE_FORMAT(fecha,'%m') AS Mes, Format(SUM(SubTotal),2) AS SumaMes
                FROM puesto.view_tmp_compras
                GROUP BY DATE_FORMAT(fecha,'%m'), DATE_FORMAT(fecha,'%Y')
                ORDER BY Fecha, mes DESC";
        $res = mysqli_query($conn,$sql);
        while($row = mysqli_fetch_array($res)){
            $this->Total += $this->tofloat($row['SumaMes']);
            array_push($this->GastoxMes,$row);
        }

        $this->TopDias=[];
        $sql="SELECT fecha, Format(SUM(SubTotal),2) AS SumaDia
                FROM puesto.view_tmp_compras
                GROUP BY fecha
                ORDER BY SUM(SubTotal) desc
                LIMIT 10";
        $res = mysqli_query($conn,$sql);
        while($row = mysqli_fetch_array($res)){
            array_push($this->TopDias,$row);
        }
    }


    function tofloat($num) {
        $dotPos = strrpos($num, '.');
        $commaPos = strrpos($num, ',');
        $sep = (($dotPos > $commaPos) && $dotPos) ? $dotPos :
            ((($commaPos > $dotPos) && $commaPos) ? $commaPos : false);
      
        if (!$sep) {
            return floatval(preg_replace("/[^0-9]/", "", $num));
        }
    
        return floatval(
            preg_replace("/[^0-9]/", "", substr($num, 0, $sep)) . '.' .
            preg_replace("/[^0-9]/", "", substr($num, $sep+1, strlen($num)))
        );
    }


}


?>