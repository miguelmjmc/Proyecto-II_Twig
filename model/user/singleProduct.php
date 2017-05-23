<?php

include_once PATH . "/model/user/base.php";

class product extends base
{

    public function __construct()
    {
    }

    public function loadSingleProduct($code)
    {
        $main = $this->loadMain();

        $query = new query();

        $product = $query->query("SELECT * FROM (product INNER JOIN productClass ON product.productClass_id = productClass.id) 
                                          INNER JOIN productCategory ON prodcutClass.productCategory_id = productCategory.id)
                                          INNER JOIN productBrand ON product.productBrand_id = productBrand.id WHERE product.code = $code");

        $singleProduct = compact("product");

        $array = compact("main", "singleProduct");

        return $array;
    }
}
  

/*
 * Created by PhpStorm.
 * User: Windows
 * Date: 23/05/2017
 * Time: 02:12 AM
 */

?>