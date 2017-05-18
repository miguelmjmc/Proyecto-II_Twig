<?php

include_once "conection.php";

class query extends conection
{
    function __construct()
    {
        parent::__construct();
    }

    //
    function query($query)
    {
        $this->connect();
        $result = mysqli_query($this->conection, "$query");
        $data = mysqli_fetch_assoc($result);
        $this->disconnect();
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