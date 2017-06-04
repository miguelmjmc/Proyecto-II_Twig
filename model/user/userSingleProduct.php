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

        $productList = $query->loadArray("SELECT * FROM product INNER JOIN  productImage ON 
                                                        product.code = productImage.product_code AND 
                                                        product.productBrand_id = productImage.product_productBrand_id AND 
                                                        product.productClass_id = productImage.product_productclass_id WHERE  
                                                        product.id = ");
        return $productList;
    }

    public function load($aux)
    {
        $main = $this->loadMain();

        $query = new query();

        $product = $query->query("SELECT * FROM (((product INNER JOIN  productImage ON
 product.code = productImage.product_code AND
 product.productBrand_id = productImage.product_productBrand_id AND
 product.productClass_id = productImage.product_productclass_id) 
 INNER JOIN productClass ON
 product.productClass_id = productClass.id) 
 INNER JOIN productCategory_has_productClass ON
 productClass.id = productCategory_has_productClass.productClass_id) 
 INNER JOIN productCategory ON
 productCategory_has_productClass.productCategory_id = productCategory.id WHERE product.id=1");

        $productList = $this->loadRelatedProducts();

        $singleProduct = compact("productList","product");

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





