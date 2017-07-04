<?php

include_once PATH . "/model/user/userBase.php";
include_once PATH . "/model/user/userProduct.php";

class userSingleProduct extends userBase
{

    public function __construct()
    {
    }

    public function loadRelatedProducts()
    {
        $query = new query();
        $productList = $query->query("SELECT * FROM product ");
        $i = 0;
        while (isset($productList["$i"])) {
            $productList["$i"]["productImg"] = base64_encode($productList["$i"]["productImg"]);
            $i++;
        }
        return $productList;
    }

    public function load($var)
    {
        $main = $this->loadMain();

        $query = new query();

        $code = $var["code"];
        $class = $var["class"];
        $brand = $var["brand"];

        $product = $query->query("SELECT * FROM product WHERE productCode = '$code' AND productClass = '$class' AND productBrand = '$brand'");
        $product = $product["0"];
        $product["productImg"] = base64_encode($product["productImg"]);
       
        $productList = $this->loadRelatedProducts();

        $singleProduct = compact("productList", "product");

        $array = compact("main", "singleProduct");

        $directory = "user";

        $view = "singleProduct.html.twig";

        $values = compact("directory", "view", "array");

        return $values;
    }
}

/*
 * Created by PhpStorm.
 * User: Windows
 * Date: 23/05/2017
 * Time: 02:12 AM
 */





