<?php

include_once PATH . "/config/include.php";

class controller
{
    public function logout()
    {
        if (isset($_GET["logout"])) {
            $query = new query();
            $query->history("Cierre de sesión");
            session_start();
            session_destroy();
            $_GET = null;
            $_POST = null;
            header("LOCATION:index.php");
        }
    }

    public function session()
    {
        if (isset($_POST["login"])) {
            $query = new query();
            $encrypt = new encrypt();
            $admin = $query->query("SELECT * FROM `user`");
            $i = 0;
            while (isset($admin["$i"])) {
                if ($admin["$i"]["email"] == $_POST["login"] && $encrypt->passwordVerify($_POST["password"], $admin["$i"]["password"])) {
                    if ($admin["$i"]["userType"] == "Administrador") {
                        session_start();
                        $_SESSION["access"] = $admin["$i"];
                        $query->history("Inicio de sesión");
                        header("LOCATION:index.php");
                    } else {
                        if ($admin["$i"]["status"] == "Habilitado") {
                            session_start();
                            $_SESSION["access"] = $admin["$i"];
                            $query->history("Inicio de sesión");
                            header("LOCATION:index.php");
                        }else{
                            header("LOCATION:index.php");
                        }
                    }
                }
                $i++;
            }
        }
    }

    public
    function selectModel()
    {
        if (isset($_SESSION["access"])) {
            if (isset($_POST["link"])) {
                $className = $_POST["link"];
            } elseif (isset($_GET["link"])) {
                $className = $_GET["link"];
            } else {
                $className = "adminIndex";
            }
        } elseif (isset($_GET["link"])) {
            $className = $_GET["link"];
        } else {
            $className = "userIndex";
        }
        return $className;
    }

    function loadModel($className)
    {
        $load = new $className();
        $values = null;
        if (isset($_SESSION["access"])) {
            if (isset($_POST["aux"])) {
                $values = $load->load($_POST);
            } else {
                $values = $load->load($_POST);
            }

        } elseif (isset($_GET)) {
            $values = $load->load($_GET);
        } else {
            $values = $load->load();
        }
        return $values;
    }

    function renderView($values)
    {
        $renderTwig = new renderTwig();
        if ($values["directory"] == "user") {
            $renderTwig->renderTwig($values["directory"], $values["view"], $values["array"]);
        } elseif ($values["directory"] == "admin" && isset($_SESSION["access"])) {
            $renderTwig->renderTwig($values["directory"], $values["view"], $values["array"]);
        } else {
            $load = new userIndex();
            $values = $load->load();
            $renderTwig->renderTwig($values["directory"], $values["view"], $values["array"]);
        }
    }
}
/*
 * Created by PhpStorm.
 * User: Windows
 * Date: 11/12/2010
 * Time: 12:44 AM
 */