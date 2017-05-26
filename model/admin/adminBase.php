<?php

include_once PATH . "/model/query.php";

class adminBase
{
    public function __construct()
    {
    }

    function load()
    {

        $array = null;

        $directory = "admin";

        $view = "base.html.twig";

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