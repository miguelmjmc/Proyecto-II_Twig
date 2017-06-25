<?php

include_once PATH . "/model/admin/adminBase.php";

class adminIndex extends adminBase
{
    public function __construct()
    {
    }

    function load()
    {
        $admin=$this->loadmain();

        $query = new query();

        $a = $query->query("SELECT * FROM configuration WHERE id= 1");

        $array = compact("admin","a");

        $directory = "admin";

        $view = "index.html.twig";

        $values = compact("directory", "view", "array");

        return $values;


    }


}



/*
 * Created by PhpStorm.
 * User: MJMC
 * Date: 21/06/2017
 * Time: 05:15 AM
 */

?>