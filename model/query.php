<?php

include_once PATH . "/model/connection.php";
include_once PATH . "/model/imgClass.php";

class query extends connection
{
    function __construct()
    {
        parent::__construct();
    }

    function query($query)
    {
        $this->connect();
        $result = mysqli_query($this->conection, "$query");
        $data = null;
        $i = 0;
        while ($assoc = mysqli_fetch_assoc($result)) {
            $data["$i"] = $assoc;
            $i++;
        };
        mysqli_free_result($result);
        $this->disconnect();
        return $data;
    }

    function querySuccess($query)
    {
        $this->connect();
        mysqli_query($this->conection, "$query");
        $success = mysqli_affected_rows($this->conection);
        $this->disconnect();
        return $success;
    }

    public function history ($action){
        $this->connect();
        $access=$_SESSION["access"]["email"];
        mysqli_query($this->conection, "INSERT INTO history (`email`, `action`, `date`) values ('$access', '$action', now()) ");
    }
}

/*
 * Created by PhpStorm.
 * User: Windows
 * Date: 17/05/2017
 * Time: 01:46 AM
 */