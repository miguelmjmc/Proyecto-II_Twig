<?php

include_once PATH . "/model/user/userBase.php";

class userProduct extends userBase
{

    public function __construct()
    {
    }

    public function load()
    {
        $main = $this->loadMain();

        $query = new query();

        $productList = $query->query("SELECT * FROM product ");
        $i = 0;
        while (isset($productList["$i"])) {
            $productList["$i"]["productImg"] = base64_encode($productList["$i"]["productImg"]);
            $i++;
        }

        $vehicleBrandList = $query->query("SELECT * FROM vehicleBrand WHERE vehicleBrand IN (SELECT vehicleBrand FROM vehicleModel GROUP BY vehicleBrand)");

        $product = compact("productList", "vehicleBrandList");

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