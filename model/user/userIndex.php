<?php

include_once PATH . "/model/user/userBase.php";

class userIndex extends userBase
{

    public function __construct()
    {
    }

    public function load()
    {
        $main = $this->loadMain();

        $query = new query();

        $slide = $query->loadArray("SELECT * FROM slide WHERE id= ");

        $about = $query->query("SELECT * FROM about WHERE id=1");

        $vehicleBrand = $query->loadArray("SELECT * FROM vehicleBrand WHERE id=");

        $index = compact("slide","about","vehicleBrand");

        $array = compact("main","index");

        $directory = "user";
       
        $view = "index.html.twig";

        $values = compact("directory", "view", "array");

        return $values;
    }
}


/*
 * Created by PhpStorm.
 * User: Windows
 * Date: 22/05/2017
 * Time: 03:09 AM
 */

?>