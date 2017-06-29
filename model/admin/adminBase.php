<?php

include_once PATH . "/model/query.php";

class adminBase
{
    public function __construct()
    {
    }

    function loadmain()
    {
        
        $admin = $_SESSION["access"];

        $admin["adminImg"] = base64_encode($admin["adminImg"]);
        
        return $admin;
    }
}


/*
 * Created by PhpStorm.
 * User: Windows
 * Date: 26/05/2017
 * Time: 02:50 AM
 */

?>