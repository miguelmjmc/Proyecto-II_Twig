<?php

function load()
{
    $load = new query();
    $data = $load->query("SELECT * FROM `configuracion` WHERE id");

    $main = array(
        //header
        "nombre_empresa1" => $data["nombre_empresa1"],
        "nombre_empresa2" => $data["nombre_empresa2"],
        "logo" => "",

        //footer
        "telefono1" => $data["telefono1"],
        "telefono2" => $data["telefono2"],
        "correo" => $data["correo"],
        "facebook" => "https://www.facebook.com/",
        "twitter" => "https://twitter.com/",
        "youtube" => "https://www.youtube.com/",
        "linkedin" => "https://www.linkedin.com/",
        "printerest" => "https://www.pinterest.com/",
        "autores" => "Miguel, Oel, Carlos.",
        "img_tecnologias" => "",
    );
    return $main;
}









/*
 * Created by PhpStorm.
 * User: Windows
 * Date: 16/05/2017
 * Time: 11:48 PM
 */