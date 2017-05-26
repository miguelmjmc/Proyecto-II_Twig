<?php

include_once PATH . "/model/query.php";

class adminBase
{
    public function __construct()
    {
    }

    function loadMain()
    {
        $query = new query();
        $main = $query->query("SELECT * FROM configuration WHERE id= 1");
        return $main;
    }
}







/*
 * Created by PhpStorm.
 * User: Windows
 * Date: 26/05/2017
 * Time: 02:50 AM
 */

?>