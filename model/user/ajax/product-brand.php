<?php

include_once "../../../config/configPath.php";
include_once PATH . "/config/include.php";

$query = new query();
$id = $_POST["id"];

$productList = $query->query("SELECT * FROM product WHERE((productCode in(SELECT productCode FROM vehicleModel_has_product inner join vehicleModel ON(vehicleModel_has_product . vehicleModel_id = vehicleModel . id) where vehicleModel . vehicleBrand = '$id' group by vehicleModel_has_product . productCode, vehicleModel_has_product . productBrand, vehicleModel_has_product . productClass)) AND (productClass in(SELECT productClass FROM vehicleModel_has_product inner join vehicleModel ON(vehicleModel_has_product . vehicleModel_id = vehicleModel . id) where vehicleModel . vehicleBrand = '$id' group by vehicleModel_has_product . productCode, vehicleModel_has_product . productBrand, vehicleModel_has_product . productClass)) AND (productBrand in(SELECT productBrand FROM vehicleModel_has_product inner join vehicleModel ON(vehicleModel_has_product . vehicleModel_id = vehicleModel . id) where vehicleModel . vehicleBrand = '$id' group by vehicleModel_has_product . productCode, vehicleModel_has_product . productBrand, vehicleModel_has_product . productClass)))");
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
 * Time: 02:27 PM
 */


?>


