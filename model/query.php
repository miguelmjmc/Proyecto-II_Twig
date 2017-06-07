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
        $data = mysqli_fetch_assoc($result);
        if (isset($data["img"])) {
            $data["img"] = $this->decode($data["img"]);
        }
        $this->disconnect();
        return $data;
    }

    public function loadArray($query)
    {
        $data = null;
        $i = 1;
        while ($this->query("$query $i") != null) {
            $data["$i"] = $this->query("$query $i");
            $i++;
        }
        return $data;
    }

    public function decode($data)
    {
        $img = new imgCode();
        $data = $img->decode($data);
        return $data;
    }

    public function aa()
    {
       mysqli_real_escape_string();
    }
}

/*
 * Created by PhpStorm.
 * User: Windows
 * Date: 17/05/2017
 * Time: 01:46 AM
 */