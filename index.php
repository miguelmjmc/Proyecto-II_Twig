<?php

//$_GET["link"]="userSingleProduct";


include_once "config/configPath.php";
include_once PATH. "/model/query.php";

$a=new query();
$b=$a->query("SELECT * FROM product inner join productimage where product.code=productimage.product_code and product.productbrand_id=productimage.product_productbrand_id");
echo print_r($b);
echo "<img src='data:;base64,"."$b['img']"."'>";




/*
 * Created by PhpStorm.
 * User: Windows
 * Date: 27/05/2017
 * Time: 11:50 PM
 */