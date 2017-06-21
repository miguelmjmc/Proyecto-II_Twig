<?php

include_once PATH . "/controller/classController.php";

$controller = new controller();

$controller->logout();

if (isset($_POST["login"])) {
    $controller->session();
} else {
    session_start();
}

$controller->renderView($controller->loadModel($controller->selectModel()));





/*
 * Created by PhpStorm.
 * User: Windows
 * Date: 16/05/2017
 * Time: 03:14 PM
 */