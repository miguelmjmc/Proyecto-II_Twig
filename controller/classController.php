<?php

include_once PATH . "/config/include.php";

class classController
{
    public function __construct()
    {
    }

    public function selectView($post, $get)
    {
        if (isset($post["link"])) {
            $className = $post["link"];
        } elseif (isset($get["link"])) {
            $className = $get["link"];
        } else {
            $className = "userIndex";
        }
        return $className;
    }

    public function loadModel($className, $post, $get)
    {

        $load = new $className();
        $values = null;
        if (isset($post["aux"])) {
            $values = $load->load($post["aux"]);

        } elseif (isset($get["aux"])) {
            $values = $load->load($get["aux"]);
        } else {
            $values = $load->load();
        }
        return $values;
    }

    public function renderView($values)
    {
        $renderTwig = new renderTwig();
        if ($values["directory"] == "user") {
            $renderTwig->renderTwig($values["directory"], $values["view"], $values["array"]);
        } elseif ($values["directory"] == "admin" && isset($_SESSION["name"])) {
            $renderTwig->renderTwig($values["directory"], $values["view"], $values["array"]);
        } else {
            $load = new userIndex();
            $values = $load->load();
            $renderTwig->renderTwig($values["directory"], $values["view"], $values["array"]);
        }
    }

    public function session($post)
    {
        if (isset($post["login"])) {
            $query = new query();
            $admin = $query->query("SELECT * FROM admin WHERE id=1");
            if ($post["login"] == $admin["email"] && $post["password"] == $admin["password"]) {
                session_start();
                $_SESSION["name"] = $admin["name"];
            }
        }
    }
    
    public function test($d, $v, $a)
    {
        $renderTwig = new renderTwig();
        $renderTwig->renderTwig($d, $v, $a);
    }

}
    


    /*
     * Created by PhpStorm.
     * User: Windows
     * Date: 11/12/2010
     * Time: 12:44 AM
     */

?>