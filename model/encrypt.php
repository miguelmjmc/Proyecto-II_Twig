<?php

class encrypt
{
    //blowfish
    public function __construct()
    {
    }

    public function passwordEncrypt($password)
    {
        $hash=password_hash($password, PASSWORD_DEFAULT);
        return $hash;
    }

    public function passwordVerify($password, $hash)
    {
        $check = password_verify($password, $hash);
        return $check;
    }
}


/*
 * Created by PhpStorm.
 * User: MJMC
 * Date: 30/06/2017
 * Time: 01:26 AM
 */