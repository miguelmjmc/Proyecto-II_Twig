<?php

include_once PATH . "/model/user/base.php";

class index extends base
{

    public function __construct()
    {
    }

    public function loadIndex()
    {
        $main = $this->loadMain();

        $query = new query();

        //$slide = $query->loadArray("SELECT * FROM slides WHERE id= ");

        //$about = $query->query("SELECT * FROM about WHERE id=1");

        //$productBrand = $query->loadArray("SELECT * FROM productBrand WHERE id=");

        //$index = compact("slide", "about", "productBrand");

        $array = compact("main");

        return $array;
    }
}


/*
 * Created by PhpStorm.
 * User: Windows
 * Date: 22/05/2017
 * Time: 03:09 AM
 */

?>