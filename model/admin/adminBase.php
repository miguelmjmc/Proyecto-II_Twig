<?php

include_once PATH . "/model/query.php";

class adminBase
{
    public function __construct()
    {
    }

    function load()
    {

        $query = new query();
        $main = $query->query("SELECT * FROM configuration WHERE id= 1");

        $productList = $query->loadArray("SELECT * FROM ((((product INNER JOIN  productImage ON
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

        $productBrandList=  $query->loadArray("SELECT * FROM productBrand where id=");
        $productCategoryList=  $query->loadArray("SELECT * FROM productCategory where id=");
        $productClassList=  $query->loadArray("SELECT * FROM productClass where id=");

        $array = compact("main","productList","productBrandList","productCategoryList","productClassList");

        $directory = "admin";

        $view = "tabla.html.twig";

        $values = compact("directory", "view", "array");

        return $values;
        
        
        
        
    }



    
    
    
}







/*
 * Created by PhpStorm.
 * User: Windows
 * Date: 26/05/2017
 * Time: 02:50 AM
 */

?>