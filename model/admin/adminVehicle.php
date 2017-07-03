<?php

include_once PATH . "/model/admin/adminBase.php";

class adminVehicle extends adminBase
{
    public function __construct()
    {
    }

    public function load()
    {
        $alert = null;
        if (isset($_POST["action"])) {
            if ($_POST["action"] == "new") {
                $alert = $this->news();
            } else if ($_POST["action"] == "update") {
                $alert = $this->update();
            } else if ($_POST["action"] == "delete") {
                $alert = $this->delete();
            }
        }

        $directory = "admin";

        $view = "vehicle.html.twig";

        $array = $this->select();

        $array["alert"] = $alert;

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
        if ($_POST["object"] == "vehicle") {
            $model = $_POST["model"];
            $brand = $_POST["brand"];
            $firstYear = $_POST["firstYear"];
            $lastYear = $_POST["lastYear"];
            $success = $query->querySuccess("INSERT INTO jemaro.vehicleModel (vehicleModel, vehicleBrand, firstYear, lastYear) VALUES ('$model','$brand','$firstYear','$lastYear')");
            if ($success > 0) {
                $query->history("Registro: Vehiculo");
                $alert = "success";
            } else {
                $alert = "danger";
            }
        } elseif ($_POST["object"] == "vehicleBrand") {
            $upload = new imgClass();
            $imgSrc = $upload->upload();
            $img = $imgSrc["file"];
            $type = $imgSrc["type"];
            $brand = $_POST["brand"];
            $img = addslashes($img);
            $success = $query->querySuccess("INSERT INTO jemaro.vehicleBrand (vehicleBrand, vehicleBrandImg, vehicleBrandImgType) VALUES ('$brand','$img','$type')");
            if ($success > 0) {
                $query->history("Registro: Marca de vehiculo");
                $alert = "success";
            } else {
                $alert = "danger";
            }
        }
        return $alert;
    }

    public function update()
    {
        $query = new query();
        if ($_POST["object"] == "vehicle") {
            $id = $_POST["id"];
            $model = $_POST["model"];
            $brand = $_POST["brand"];
            $firstYear = $_POST["firstYear"];
            $lastYear = $_POST["lastYear"];
            $success = $query->querySuccess("UPDATE jemaro.vehicleModel SET vehicleModel = '$model', vehicleBrand = '$brand', firstYear = '$firstYear', lastYear = '$lastYear' WHERE id = $id");
            if ($success > 0) {
                $query->history("Actualización: Vehiculo");
                $alert = "success";
            } else {
                $alert = "danger";
            }
        } elseif ($_POST["object"] == "vehicleBrand") {
            $id = $_POST["id"];
            $brand = $_POST["brand"];
            $upload = new imgClass();
            $imgSrc = $upload->upload();
            $img = $imgSrc["file"];
            $type = $imgSrc["type"];
            $img = addslashes($img);
            if (is_uploaded_file($_FILES["file"]["tmp_name"])) {
                $success = $query->querySuccess("UPDATE jemaro.vehicleBrand SET vehicleBrand = '$brand',  vehicleBrandImg = '$img', vehicleBrandImgType = '$type' where vehicleBrand = '$id' ");
                if ($success > 0) {
                    $query->history("Actualización: Marca de vehiculo");
                    $alert = "success";
                } else {
                    $alert = "danger";
                }
            } else {
                $success = $query->querySuccess("UPDATE jemaro.vehicleBrand SET vehicleBrand = '$brand' where vehicleBrand = '$id'");
                if ($success > 0) {
                    $query->history("Actualización: Marca de vehiculo");
                    $alert = "success";
                } else {
                    $alert = "danger";
                }
            }
        }
        return $alert;
    }

    public function delete()
    {
        $query = new query();
        if ($_POST["object"] == "vehicle") {
            $id = $_POST["id"];
            $success = $query->querySuccess("DELETE FROM jemaro.vehicleModel WHERE id = $id");
            if ($success > 0) {
                $query->history("Eliminación: Vehiculo");
                $alert = "success";
            } else {
                $alert = "danger";
            }
        } elseif ($_POST["object"] == "vehicleBrand") {
            $id = $_POST["id"];
            $success = $query->querySuccess("DELETE FROM jemaro.vehicleBrand WHERE vehicleBrand = '$id'");
            if ($success > 0) {
                $query->history("Eliminación: Marca de vehiculo");
                $alert = "success";
            } else {
                $alert = "danger";
            }
        }
        return $alert;
    }

}


/*
 * Created by PhpStorm.
 * User: MJMC
 * Date: 21/06/2017
 * Time: 05:16 AM
 */

?>