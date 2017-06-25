<?php

include_once PATH . "/model/user/userBase.php";

class userProduct extends userBase
{

    public function __construct()
    {
    }

    public function load($var)
    {
        $main = $this->loadMain();

        $query = new query();

        $productList = $query->query("SELECT * FROM product ");
        $i = 0;
        while (isset($productList["$i"])) {
            $code = $productList["$i"]["productCode"];
            $brand = $productList["$i"]["productBrand"];
            $class = $productList["$i"]["productClass"];

            $productList["$i"]["img"] = $query->query("SELECT * FROM  productImage WHERE productCode = '$code' AND productBrand = '$brand' AND productClass = '$class' ");
            $j = 0;
            while (isset($productList["$i"]["img"]["$j"])){
                $productList["$i"]["img"]["$j"]["productImg"]=base64_encode($productList["$i"]["img"]["$j"]["productImg"]);
                $j++;
            }
            $i++;
        }
        
        $product = compact("productList");

        $array = compact("main", "product");

        $directory = "user";

        $view = "product.html.twig";

        $values = compact("directory", "view", "array");

        return $values;
    }
}

/*
 * Created by PhpStorm.
 * User: Windows
 * Date: 23/05/2017
 * Time: 12:36 AM
 */