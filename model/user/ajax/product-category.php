<?php

include_once "../../../config/configPath.php";
include_once PATH . "/config/include.php";

$query = new query();

$array = explode (",",$_POST["array"]);
$category = $array["0"];
$vehicle = $array["1"];

$productList = $query->query("SELECT * FROM product WHERE (((productCode IN (SELECT productCode FROM vehicleModel_has_product WHERE vehicleModel_id = '$vehicle' GROUP BY productCode)) AND  (productClass IN (SELECT productClass FROM vehicleModel_has_product WHERE vehicleModel_id = '$vehicle' GROUP BY productClass)) AND (productBrand IN (SELECT productBrand FROM vehicleModel_has_product WHERE vehicleModel_id = '$vehicle' GROUP BY productBrand))) AND (productClass IN (SELECT productClass FROM productClass WHERE productCategory = '$category')))");
$i = 0;
while (isset($productList["$i"])) {
    $productList["$i"]["productImg"] = base64_encode($productList["$i"]["productImg"]);

    echo "
<div class=\"col-md-3 col-sm-6\">
                            <div class=\"single-product\">
                                <div class=\"product-f-image\">
                                    <img src=\"data:", $productList["$i"]["productImgType"], "; base64,", $productList["$i"]["productImg"], "\"
                                         alt=\"", $productList["$i"]["productClass"], " ", $productList["$i"]["productCode"], "\">
                                    <div class=\"product-hover\">
                                        <a href=\"index.php?link=userSingleProduct&class=", $productList["$i"]["productClass"], "&brand=", $productList["$i"]["productBrand"], "&code=", $productList["$i"]["productCode"], "\"
                                           class=\"view-details-link\"><i
                                                    class=\"fa fa-link\"></i>detalles</a>
                                    </div>
                                </div>
                                <h2><a href=\"\">", $productList["$i"]["productClass"], " ", $productList["$i"]["productCode"], "</a></h2>
                                <div class=\"product-carousel-price\">
                                    <ins>", $productList["$i"]["offer"], " Bs.</ins>
                                    <del>", $productList["$i"]["price"], " Bs.</del>
                                </div>
                            </div>
                        </div>";

    $i++;
}
/*
 * Created by PhpStorm.
 * User: MJMC
 * Date: 05/07/2017
 * Time: 05:42 PM
 */