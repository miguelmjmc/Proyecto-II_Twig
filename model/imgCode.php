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

/*
 * Created by PhpStorm.
 * User: Windows
 * Date: 25/05/2017
 * Time: 05:53 PM
 */

?>