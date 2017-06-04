<?php

include_once PATH . "/controller/classController.php";


if (isset($_post["logout"])){
    session_destroy();
}

$controller = new classController();

$controller->session($_POST);

$className = $controller->selectView($_POST, $_GET);

$values = $controller->loadModel($className, $_POST, $_GET);

$controller->renderView($values);

/*
 * Created by PhpStorm.
 * User: Windows
 * Date: 16/05/2017
 * Time: 03:14 PM
 */