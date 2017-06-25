<?php

include_once PATH . "/model/admin/adminBase.php";

class adminProduct extends adminBase
{
    public function __construct()
    {
    }

    function load()
    {
        $admin = $this->loadmain();

        $query = new query();


        /* if (isset($post["action"])) {
            if ($post["action"] == "delete") {
                $this->delete();
            }
        }*/

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

        $productBrandList = $query->query("SELECT * FROM productBrand");

        $productCategoryList = $query->query("SELECT * FROM productCategory");

        $productClassList = $query->query("SELECT * FROM productClass");

        $array = compact("admin", "productList", "productBrandList", "productCategoryList", "productClassList");

        $directory = "admin";

        $view = "product.html.twig";

        $values = compact("directory", "view", "array");

        return $values;


    }

    function delete()
    {
        $a = $post["code"];
        $b = $post["brand"];
        $c = $post["class"];

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