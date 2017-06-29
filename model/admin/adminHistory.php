<?php

include_once PATH . "/model/admin/adminBase.php";

class adminHistory extends adminBase
{
    public function __construct()
    {
    }

    function load()
    {
        $admin = $this->loadmain();

        $query = new query();

        $history = $query->query("SELECT * FROM history");

        $array = compact("admin", "history");

        $directory = "admin";

        $view = "history.html.twig";

        $values = compact("directory", "view", "array");

        return $values;


    }


}
/*
 * Created by PhpStorm.
 * User: MJMC
 * Date: 28/06/2017
 * Time: 02:11 PM
 */