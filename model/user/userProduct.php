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

        $productList = $query->loadArray("SELECT * FROM product INNER JOIN  productImage ON 
                                                        product.code = productImage.product_code AND 
                                                        product.productBrand_id = productImage.product_productBrand_id AND 
                                                        product.productClass_id = productImage.product_productclass_id WHERE  
                                                        product.id = ");

        $product = compact("productList");

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
?>