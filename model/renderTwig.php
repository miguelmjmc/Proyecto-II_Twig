<?php

include_once PATH . "/vendor/autoload.php";

class renderTwig
{
    public function __construct()
    {
    }

    public function loadDirectory($directory)
    {
        if ($directory == "user") {
            $loader = new Twig_Loader_Filesystem(PATH . "/views/user");
            return $loader;
        } elseif ($directory == "admin") {
            $loader = new Twig_Loader_Filesystem(PATH . "/views/admin");
            return $loader;
        }
    }

    public function loadAsset($directory)
    {
        if ($directory == "user") {
            $asset = userAsset;
            return $asset;
        } elseif ($directory == "admin") {
            $asset = adminAsset;
            return $asset;
        }
    }

    public function renderTwig($directory, $view, $array)
    {
        $twig = new Twig_Environment($this->loadDirectory($directory));
        $pathAsset = $this->loadAsset($directory);
        echo $twig->render($view, compact("pathAsset", "array"));
    }
}

/*
 * Created by PhpStorm.
 * User: Windows
 * Date: 20/05/2017
 * Time: 10:39 PM
 */

?>