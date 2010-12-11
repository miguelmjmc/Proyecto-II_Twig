<?php

require_once "../vendor/autoload.php";


$loader = new Twig_Loader_Filesystem("../views/user");
$twig = new Twig_Environment($loader);

$bsse = 


echo $twig->render("base.html.twig", compact("base"));


/*
 * Created by PhpStorm.
 * User: Windows
 * Date: 16/05/2017
 * Time: 03:14 PM
 */

?>