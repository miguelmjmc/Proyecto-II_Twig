<?php

include_once "../config/configPath.php";
include_once PATH . "/config/include.php";


if ($_POST) {
    $className = $_POST["link"];
} elseif ($_GET) {
    $className = $_GET["link"];
} else {
    $className = "userIndex";
}


$load = new $className();
$values = $load->load();


$renderTwig = new renderTwig();
$renderTwig->renderTwig($values["directory"], $values["view"], $values["array"]);


/*
 * Created by PhpStorm.
 * User: Windows
 * Date: 16/05/2017
 * Time: 03:14 PM
 */

?>