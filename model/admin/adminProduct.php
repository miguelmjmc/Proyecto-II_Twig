<?php

include_once PATH . "/model/query.php";

class adminProduct
{
    public function __construct()
    {
    }

    function load($post)
    {

        $query = new query();
        if (isset($post["action"])) {
            if ($post["action"] == "delete") {
        }
        }








        $main = $query->query("SELECT * FROM configuration WHERE id= 1");

        $productList = $query->query("SELECT * FROM ((((product INNER JOIN  productImage ON
 product.code = productImage.product_code AND
 product.productBrand_id = productImage.product_productBrand_id AND
 product.productClass_id = productImage.product_productclass_id)
 INNER JOIN productBrand ON product.productBrand_id = productBrand.id)
 INNER JOIN productClass ON
 product.productClass_id = productClass.id) 
 INNER JOIN productCategory_has_productClass ON
 productClass.id = productCategory_has_productClass.productClass_id) 
 INNER JOIN productCategory ON
 productCategory_has_productClass.productCategory_id = productCategory.id WHERE product.id=");

        $productBrandList = $query->query("SELECT * FROM productBrand where id=");
        $productCategoryList = $query->query("SELECT * FROM productCategory where id=");
        $productClassList = $query->query("SELECT * FROM productClass where id=");

        $user = $query->query("SELECT * FROM admin WHERE id=1");

        $array = compact("main", "productList", "productBrandList", "productCategoryList", "productClassList", "user");

        $directory = "admin";

        $view = "product.html.twig";

        $values = compact("directory", "view", "array");

        return $values;


    }

    function delete(){
        $a=$post["code"];
        $b=$post["brand"];
        $c=$post["class"];

        $query->querySuccess("DELETE FROM jemaro.productImage WHERE productImage.product_code = '$a' AND productImage.product_productBrand_id IN (SELECT id FROM productBrand WHERE productBrand = '$b') AND productImage.product_productClass_id IN (SELECT id FROM productClass WHERE ProductClass = '$c')");

        $query->querySuccess("DELETE FROM jemaro.product WHERE product.code = '$a' AND product.productBrand_id IN (SELECT id FROM productBrand WHERE productBrand = '$b') AND product.productClass_id IN (SELECT id FROM productClass WHERE ProductClass = '$c')");

    }








}






/*
 * Created by PhpStorm.
 * User: MJMC
 * Date: 21/06/2017
 * Time: 05:16 AM
 */

?>