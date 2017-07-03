<?php

include_once PATH . "/model/admin/adminBase.php";

class adminIndex extends adminBase
{
    public function __construct()
    {
    }

    function load()
    {
        $admin = $this->loadmain();

        $query = new query();

        $product = $query->query("SELECT count(*) as total FROM product");
        $product = $product["0"]["total"];

        $vehicle = $query->query("SELECT count(*) as total FROM vehicleModel");
        $vehicle = $vehicle["0"]["total"];
       

        $user = $query->query("SELECT count(*) as total FROM `user`");
        $user = $user["0"]["total"];

        $history = $query->query("SELECT count(*) as total FROM history");
        $history = $history["0"]["total"];


        $index = compact("product", "vehicle", "user", "history");
        $array = compact("admin", "index");

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