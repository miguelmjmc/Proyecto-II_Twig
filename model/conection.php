<?php

include_once PATH. "/config/configDB.php";

class conection
{
    //declaración de variables
    public $host; // para conectarnos a localhost o el ip del servidor de postgres
    public $db; // seleccionar la base de datos que vamos a utilizar
    public $user; // seleccionar el usuario con el que nos vamos a conectar
    public $pass; // la clave del usuario
    public $conection; //dirección de la conexión

    //creación del constructor
    function __construct()
    {
        $config_db = configDB();
        $this->host = $config_db["host"];
        $this->db = $config_db["db"];
        $this->user = $config_db["user"];
        $this->pass = $config_db["pass"];

    }
    
    //función que se utilizara al momento de hacer la instancia de la clase
    function connect()
    {
        $this->conection = mysqli_connect($this->host, $this->user, $this->pass, $this->db);
        mysqli_set_charset($this->conection,"UTF-8");
    }

    //función para destruir la conexión.
    function disconnect()
    {
        mysqli_close($this->conection);
    }
}

/*
 * Created by PhpStorm.
 * User: Windows
 * Date: 16/05/2017
 * Time: 11:46 PM
 */