<?php

function configDB()
{
    $configDB = array(
        "host" => "127.0.0.1", // para conectarnos a localhost o el ip del servidor de postgres
        "db" => "jemaro", // seleccionar la base de datos que vamos a utilizar
        "user" => "admin", // seleccionar el usuario con el que nos vamos a conectar
        "pass" => "admin", // la clave del usuario
    );

    return $configDB;
}

/*
 * Created by PhpStorm.
 * User: Windows
 * Date: 17/05/2017
 * Time: 12:54 AM
 */

?>