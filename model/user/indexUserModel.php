<?php

include_once PATH . "model/user/mainUserModel.php";

class indexUserModel extends mainUserModel
{

    public function __construct()
    {
    }

    public function loadIndex()
    {
        $main = $this->loadMain();

        $query = new query();
        $index = $query->query("");


        $array = compact("main", "index");
        return $array;
    }

}


/*

$main = null;
$i = 1;
$query = new query();

while ($query->query("SELECT * FROM `configuracion` WHERE id= $i") != null) {
    $main["$i"] = $query->query("SELECT * FROM `configuracion` WHERE id= $i");
    $i++;

}

return $main;


$product = array(
    "img" => "https://www.ramirezmoto.es/admin/pictures/zoom/Buj%C3%ADa-Ngk-CPR8EA-9-1.jpg",
    "name" => "bujia",
    "offer" => "10.000",
    "price" => "12.000",
);

*/

/*
 * Created by PhpStorm.
 * User: Windows
 * Date: 22/05/2017
 * Time: 03:09 AM
 */