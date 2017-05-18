<?php

include_once "../vendor/autoload.php";
include_once "../config/configAsset.php";
include_once "../model/user/main.php";
include_once "../model/query.php";
include_once "../model/conection.php";
include_once "../config/configDB.php";



$loader = new Twig_Loader_Filesystem("../views/user");
$twig = new Twig_Environment($loader);


$configAsset=configAsset();
$main=load();


/*"titulo_pagina" => "Inicio",
       "index_user" => "prueba.php",
*/
echo $twig->render("product.html.twig", compact("configAsset","main"));


/*
 * Created by PhpStorm.
 * User: Windows
 * Date: 16/05/2017
 * Time: 03:14 PM
 */

?>