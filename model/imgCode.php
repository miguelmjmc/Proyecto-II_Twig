<?php


class imgCode
{
    public function __construct()
    {
    }
    
    public function decode($img){
        $img=base64_encode($img);
        return $img;
    }
}





//$filename = "c:\\files\\imagen.gif";
//$gestor = fopen($filename, "rb");
//$contenido = fread($gestor, filesize($filename));
//fclose($gestor);

/*
 * Created by PhpStorm.
 * User: Windows
 * Date: 25/05/2017
 * Time: 05:53 PM
 */