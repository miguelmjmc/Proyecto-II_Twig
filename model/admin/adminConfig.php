<?php

include_once PATH . "/model/admin/adminBase.php";

class adminConfig extends adminBase
{
    public function __construct()
    {
    }

    public function load()
    {

        if (isset($_POST["action"])) {
            if ($_POST["action"] == "new") {
                $this->news();
            } else if ($_POST["action"] == "update") {
                $this->update();
            } else if ($_POST["action"] == "delete") {
                $this->delete();
            }
        }
        $directory = "admin";

        $view = "config.html.twig";

        $array = $this->select();

        $values = compact("directory", "view", "array");

        return $values;
    }

    public function select()
    {
        $admin = $this->loadmain();

        $query = new query();



        $array = compact("admin", "vehicleList", "vehicleBrandList");

        return $array;
    }
}



/*
 * Created by PhpStorm.
 * User: MJMC
 * Date: 28/06/2017
 * Time: 02:41 PM
 */