<?php

include_once PATH . "/model/query.php";

class adminBase
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

        $view = "product.html.twig";

        $values = compact("directory", "view", "array");

        return $values;


    }


}


/*
 * Created by PhpStorm.
 * User: Windows
 * Date: 26/05/2017
 * Time: 02:50 AM
 */

?>