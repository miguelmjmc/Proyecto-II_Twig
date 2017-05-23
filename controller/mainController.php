<?php

include_once "../config/configPath.php";
include_once PATH . "/model/renderTwig.php";
include_once PATH . "/model/user/index.php";


$directory = "user";
$view = "index.html.twig";

$load = new index();
$array=$load->loadIndex();





$renderTwig = new renderTwig();
$renderTwig->renderTwig($directory, $view, $array);


/*
 * Created by PhpStorm.
 * User: Windows
 * Date: 16/05/2017
 * Time: 03:14 PM
 */

?>