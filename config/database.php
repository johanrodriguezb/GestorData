<?php

class Conectar
{

    public static function conexion()
    {

        $conexion = new mysqli("us-cdbr-east-06.cleardb.net", "b4a4ad00f86c45", "9126dce2da3a981", "heroku_44f0cc8b5ad1524");
        return $conexion;
    }
}


$conex = new Conectar();
$con = $conex->conexion();
