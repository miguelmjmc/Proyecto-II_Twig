<?php

include_once PATH . "/model/query.php";

class userBase
{
    public function __construct()
    {
    }

    function loadMain()
    {
        $query = new query();
        $main = $query->query("SELECT * FROM configuration WHERE id= 1");
        $main=$main["0"];
        $main["img"]=base64_encode($main["img"]);
        return $main;
    }
}


/*
 * Created by PhpStorm.
 * User: Windows
 * Date: 16/05/2017
 * Time: 11:48 PM
 */