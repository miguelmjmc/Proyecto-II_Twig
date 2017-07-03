<?php

include_once PATH. "/config/configDB.php";

class connection
{
    //declaración de variables
    public $host; // para conectarnos a localhost o el ip del servidor de postgres
    public $db; // seleccionar la base de datos que vamos a utilizar
    public $user; // seleccionar el usuario con el que nos vamos a conectar
    public $pass; // la clave del usuario
    public $conection; //dirección de la conexión

    //creación del constructor
    public function __construct()
    {
        $config_DB = configDB();
        $this->host = $config_DB["host"];
        $this->db = $config_DB["db"];
        $this->user = $config_DB["user"];
        $this->pass = $config_DB["pass"];

    }
    
    //función que se utilizara al momento de hacer la instancia de la clase
    public function connect()
    {
        $this->conection = mysqli_connect($this->host, $this->user, $this->pass, $this->db);
        if (!$this->conection) {
            printf("No hay conexión con la base de datos. Error: %s", mysqli_connect_error());
            exit();
        }
        mysqli_set_charset($this->conection,"UTF-8");
    }

    //función para destruir la conexión.
    public function disconnect()
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