<?php

function strSQL($str) {
    return str_replace("'","''",$str);
}

function strSQLNum($str) {
    if($str=='N/A')
        return -1;
    return str_replace(",","",$str);
}


function numYear($str){
    $asd=strSQLNum($str);
    $asd=trim($asd);
    if(strlen($asd)>4)
        $asd = substr($asd, 0, 4);
    return $asd;
}

function strSQLfull($str){
    return (strSQL(trim($str)));
}





?>