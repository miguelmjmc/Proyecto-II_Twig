<?php

include_once PATH . "/model/user/base.php";

class product extends base
{

    public function __construct()
    {
    }

    public function loadProduct()
    {
        $main = $this->loadMain();

        $query = new query();

        $productList = $query->loadArray("SELECT * FROM product INNER JOIN productClass ON product.productClass_id = productClass.id WHERE product.id= ");

        $product = compact("productList");

        $array = compact("main", "product");

        return $array;
    }
}


/*
 * Created by PhpStorm.
 * User: Windows
 * Date: 23/05/2017
 * Time: 12:36 AM
 */
?>