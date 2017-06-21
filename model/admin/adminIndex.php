<?php

include_once PATH . "/model/query.php";

class adminIndex
{
    public function __construct()
    {
    }

    function load()
    {

        $query = new query();




        $main = $query->query("SELECT * FROM configuration WHERE id= 1");



        $user = $query->query("SELECT * FROM admin WHERE id=1");

        $array = compact("main", "productList", "productBrandList", "productCategoryList", "productClassList", "user");

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