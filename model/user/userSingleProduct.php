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
        $code = $product["productCode"];
        $brand = $product["productBrand"];
        $class = $product["productClass"];
        $product["vehicle"] = $query->query("SELECT * FROM vehicleModel_has_product INNER JOIN vehicleModel ON (vehicleModel_has_product.vehicleModel_id = vehicleModel.id) WHERE (vehicleModel_has_product.productCode = '$code' AND vehicleModel_has_product.productBrand = '$brand' AND vehicleModel_has_product.productClass = '$class')");

        $iva = $query->query("SELECT * FROM iva");
        $iva = $iva["0"];
        $iva["ivaAmount"] = (($iva["iva"] * $product["offer"]) / 100);
        $iva["offerAmount"] = ($product["offer"] - (($iva["iva"] * $product["offer"]) / 100));
        
        $productList = $this->loadRelatedProducts();

        $singleProduct = compact("productList", "product", "iva");

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





