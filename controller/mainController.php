<?php

include_once "../config/configPath.php";
include_once PATH . "/config/include.php";


if (isset($_POST["link"])) {
    $className = $_POST["link"];
} elseif (isset($_GET["link"])) {
    $className = $_GET["link"];
} else {
    $className = "userIndex";
}

$values = null;
$load = new $className();


if (isset($_POST["aux"]) || isset($_GET["aux"])) {
    $values = $load->load($_POST["aux"]);
} else {
    $values = $load->load();
}

$renderTwig = new renderTwig();
$renderTwig->renderTwig($values["directory"], $values["view"], $values["array"]);


/*
 * Created by PhpStorm.
 * User: Windows
 * Date: 16/05/2017
 * Time: 03:14 PM
 */

?>