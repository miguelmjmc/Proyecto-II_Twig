<?php

include_once PATH . "/model/conection.php";
include_once PATH . "/model/imgCode.php";

class query extends conection
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

}

/*
 * Created by PhpStorm.
 * User: Windows
 * Date: 17/05/2017
 * Time: 01:46 AM
 */