<?php

function configDB()
{
    $configDB = array(
        "host" => "127.0.0.1", //server address
        "db" => "jemaro", //data base name
        "user" => "admin", //user
        "password" => "admin", //password
        "manager" => "mysql", //data base manager (values: mysql or postgressql)
    );

    return $configDB;
}

/*
 * Created by PhpStorm.
 * User: Windows
 * Date: 17/05/2017
 * Time: 12:54 AM
 */
