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

        $slide = $query->query("SELECT * FROM slide");
       for($i=0;$i<3;$i++){
            $slide["$i"]["slideImg"]=base64_encode($slide["$i"]["slideImg"]);
        }

        $about = $query->query("SELECT * FROM about WHERE id=1");

        $vehicleBrand = $query->query("SELECT * FROM vehicleBrand");
        $i=0;
        while (isset($vehicleBrand["$i"])){
            $vehicleBrand["$i"]["vehicleBrandImg"]=base64_encode($vehicleBrand["$i"]["vehicleBrandImg"]);
            $i++;
        }

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