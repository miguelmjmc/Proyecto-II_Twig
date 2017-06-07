<?php

include_once PATH . "/controller/classController.php";

logout();

if (isset($_POST["login"])) {
    session();
} else {
    session_start();
}

renderView(loadModel(selectModel()));




/*
 * Created by PhpStorm.
 * User: Windows
 * Date: 16/05/2017
 * Time: 03:14 PM
 */