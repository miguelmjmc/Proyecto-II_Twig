<?php

include_once PATH. "/model/conection.php";

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
        $this->disconnect();
        return $data;
    }


    public function loadArray($query)
    {
        $data = null;
        $i = 1;
        while ($this->query("$query") != null) {
            $data["$i"] = $this->query("$query $i");
            $i++;
        }
        return $data;
    }
}


/*
 * Created by PhpStorm.
 * User: Windows
 * Date: 17/05/2017
 * Time: 01:46 AM
 */

?>