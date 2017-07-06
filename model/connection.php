<?php

include_once PATH . "/config/configDB.php";

class connection
{
    //declaration of variables
    public $host; //server address
    public $db; //data base name
    public $user; //user
    public $password; //password
    public $manager; //data base manager
    public $connection; //connection address

    //load configuration
    public function __construct()
    {
        $config_DB = configDB();
        $this->host = $config_DB["host"];
        $this->db = $config_DB["db"];
        $this->user = $config_DB["user"];
        $this->password = $config_DB["password"];
        $this->manager = $config_DB["manager"];

    }

    //connection data base
    public function connect()
    {
        if ($this->manager == "mysql") {
            $this->connection = mysqli_connect($this->host, $this->user, $this->password, $this->db);
            if (!$this->connection) {
                printf("No hay conexión con la base de datos. Error: %s", mysqli_connect_error());
                exit();
            }
            mysqli_set_charset($this->connection, "UTF-8");
        } elseif ($this->manager == "postgresql") {
            $this->connection = pg_connect("host = $this->host, user = $this->user, password = $this->password, dbname = $this->db");
            if (!$this->connection) {
                printf("No hay conexión con la base de datos. Error: %s", pg_last_error());
                exit();
            }
        }
    }

    //connection close
    public function disconnect()
    {
        if ($this->manager == "mysql") {
            mysqli_close($this->connection);
        } elseif ($this->manager == "postgresql") {
            pg_close($this->connection);
        }
    }
}

/*
 * Created by PhpStorm.
 * User: Windows
 * Date: 16/05/2017
 * Time: 11:46 PM
 */