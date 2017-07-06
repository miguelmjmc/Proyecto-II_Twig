<?php

include_once PATH . "/model/connection.php";

class query extends connection
{
    function __construct()
    {
        parent::__construct();
    }

    //query return array
    function query($query)
    {
        $this->connect();
        if ($this->manager == "mysql") {
            $result = mysqli_query($this->connection, "$query");
            $data = null;
            $i = 0;
            while ($assoc = mysqli_fetch_assoc($result)) {
                $data["$i"] = $assoc;
                $i++;
            };
            mysqli_free_result($result);
            $this->disconnect();
            return $data;
        } elseif ($this->manager == "postgresql") {
            $result = pg_query($this->connection, "$query");
            $data = null;
            $i = 0;
            while ($assoc = pg_fetch_assoc($result)) {
                $data["$i"] = $assoc;
                $i++;
            };
            pg_free_result($result);
            $this->disconnect();
            return $data;
        }
    }

    //query return boolean
    function querySuccess($query)
    {
        $this->connect();
        if ($this->manager == "mysql") {
            mysqli_query($this->connection, "$query");
            $success = mysqli_affected_rows($this->connection);
        } elseif ($this->manager == "postgresql") {
            pg_query($this->connection, "$query");
            $success = pg_affected_rows($this->connection);
        }
        $this->disconnect();
        return $success;
    }

    //register history
    public function history($action)
    {
        $this->connect();
        $access = $_SESSION["access"]["email"];
        if ($this->manager == "mysql") {
            mysqli_query($this->connection, "INSERT INTO history (`email`, `action`, `date`) values ('$access', '$action', now()) ");
        } elseif ($this->manager == "postgresql") {
            pg_query($this->connection, "INSERT INTO history (`email`, `action`, `date`) values ('$access', '$action', now()) ");
        }
    }
}

/*
 * Created by PhpStorm.
 * User: Windows
 * Date: 17/05/2017
 * Time: 01:46 AM
 */