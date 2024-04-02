<?php

class Conectar
{

    public static function conexion()
    {

        $conexion = new mysqli("localhost", "root", "Johan12345*", "gestion_datos");
        return $conexion;
    }
}


$conex = new Conectar();
$con = $conex->conexion();
