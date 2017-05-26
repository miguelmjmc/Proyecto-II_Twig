<?php

include_once PATH . "/model/user/userBase.php";

class userSingleProduct extends userBase
{

    public function __construct()
    {
    }

    public function load($product)
    {
        $main = $this->loadMain();

        //$query = new query();

        //$product = $query->query("SELECT * FROM (product INNER JOIN productClass ON product.productClass_id = productClass.id) 
          //                                INNER JOIN productCategory ON prodcutClass.productCategory_id = productCategory.id)
            //                              INNER JOIN productBrand ON product.productBrand_id = productBrand.id WHERE product.code = $product");

        //$singleProduct = compact("product");

        $array = compact("main");

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

?>