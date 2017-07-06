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

        if (isset($_GET["filter"])) {
            $brand = $_GET["filter"];
            $productList = $query->query("SELECT * FROM product WHERE((productCode in(SELECT productCode FROM vehicleModel_has_product inner join vehicleModel ON(vehicleModel_has_product . vehicleModel_id = vehicleModel . id) where vehicleModel . vehicleBrand = '$brand' group by vehicleModel_has_product . productCode, vehicleModel_has_product . productBrand, vehicleModel_has_product . productClass)) AND (productClass in(SELECT productClass FROM vehicleModel_has_product inner join vehicleModel ON(vehicleModel_has_product . vehicleModel_id = vehicleModel . id) where vehicleModel . vehicleBrand = '$brand' group by vehicleModel_has_product . productCode, vehicleModel_has_product . productBrand, vehicleModel_has_product . productClass)) AND (productBrand in(SELECT productBrand FROM vehicleModel_has_product inner join vehicleModel ON(vehicleModel_has_product . vehicleModel_id = vehicleModel . id) where vehicleModel . vehicleBrand = '$brand' group by vehicleModel_has_product . productCode, vehicleModel_has_product . productBrand, vehicleModel_has_product . productClass)))");
            $i = 0;
            while (isset($productList["$i"])) {
                $productList["$i"]["productImg"] = base64_encode($productList["$i"]["productImg"]);
                $i++;
            }
        } else {
            $productList = $query->query("SELECT * FROM product ");
            $i = 0;
            while (isset($productList["$i"])) {
                $productList["$i"]["productImg"] = base64_encode($productList["$i"]["productImg"]);
                $i++;
            }
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