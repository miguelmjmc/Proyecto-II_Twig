<?php

include_once PATH . "/model/admin/adminBase.php";

class adminVehicle extends adminBase
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

        $view = "vehicle.html.twig";

        $array = $this->select();

        $values = compact("directory", "view", "array");

        return $values;
    }

    public function select()
    {
        $admin = $this->loadmain();

        $query = new query();

        $vehicleList = $query->query("SELECT * FROM vehicleModel INNER JOIN vehicleBrand ON (vehicleModel.vehicleBrand = vehicleBrand.vehicleBrand)");
        $i = 0;
        while (isset($vehicleList["$i"]["vehicleBrandImg"])) {
            $vehicleList["$i"]["vehicleBrandImg"] = base64_encode($vehicleList["$i"]["vehicleBrandImg"]);
            $i++;
        }

        $vehicleBrandList = $query->query("SELECT * FROM vehicleBrand");
        $i = 0;
        while (isset($vehicleBrandList["$i"]["vehicleBrandImg"])) {
            $vehicleBrandList["$i"]["vehicleBrandImg"] = base64_encode($vehicleBrandList["$i"]["vehicleBrandImg"]);
            $i++;
        }

        $array = compact("admin", "vehicleList", "vehicleBrandList");

        return $array;
    }

    public function news()
    {
        $query = new query();
        if ($_POST["object"] = "vehicle") {
            $model = $_POST["model"];
            $brand = $_POST["brand"];
            $firstYear = $_POST["firstYear"];
            $lastYear = $_POST["lastYear"];
            $success = $query->querySuccess("INSERT INTO jemaro.vehicleModel (vehicleModel, vehicleBrand, firstYear, lastYear) VALUES ('$model','$brand','$firstYear','$lastYear')");
            echo $success;
        } elseif ($_POST["object"] = "vehicleBrand") {

        };
        header("LOCATION:index.php?link=adminVehicle");
    }

    public function update()
    {
        $query = new query();
        if ($_POST["object"] = "vehicle") {
            $model = $_POST["model"];
            $brand = $_POST["brand"];
            $firstYear = $_POST["firstYear"];
            $lastYear = $_POST["lastYear"];
            $success = $query->querySuccess("INSERT INTO jemaro.vehicleModel (vehicleModel, vehicleBrand, firstYear, lastYear) VALUES ('$model','$brand','$firstYear','$lastYear')");
            echo $success;
        } elseif ($_POST["object"] = "vehicleBrand") {

        };
        header("LOCATION:index.php?link=adminVehicle");
    }

    public function delete()
    {

        $query = new query();
        if ($_POST["object"] = "vehicle") {
            $id = $_POST["id"];
            $query->querySuccess("DELETE FROM jemaro.vehicleModel WHERE id = $id");
        } elseif ($_POST["object"] = "vehicleBrand") {
            $id = $_POST["id"];
            $query->querySuccess("DELETE FROM jemaro.vehicleBrand WHERE vehicleBrand ilike '$id'");
        };
        header("LOCATION:index.php?link=adminVehicle");
    }

}


/*
 * Created by PhpStorm.
 * User: MJMC
 * Date: 21/06/2017
 * Time: 05:16 AM
 */

?>