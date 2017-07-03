<?php

include_once PATH . "/model/admin/adminBase.php";

class adminConfig extends adminBase
{
    public function __construct()
    {
    }

    public function load()
    {
        $alert=null;
        
        if (isset($_POST["action"])) {
            if ($_POST["action"] == "update") {
                $alert = $this->update();
            }
        }

        $directory = "admin";

        $view = "config.html.twig";

        $array = $this->select();

        $array["alert"] = $alert;

        $values = compact("directory", "view", "array");

        return $values;
    }

    public function select()
    {
        $admin = $this->loadmain();

        $query = new query();

        $config = $query->query("SELECT * FROM configuration");

        $about = $query->query("SELECT * FROM about");

        $slide = $query->query("SELECT * FROM slide");
        for ($i = 0; $i < 3; $i++) {
            $slide["$i"]["slideImg"] = base64_encode($slide["$i"]["slideImg"]);
        }

        $config = $config["0"];

        $about = $about["0"];

        $config["img"] = base64_encode($config["img"]);

        $array = compact("admin", "config", "about", "slide");

        return $array;
    }

    public function update()
    {
        $query = new query();
        if ($_POST["object"] == "slide") {
            $title = $_POST["title"];
            $content = $_POST["content"];
            $link = $_POST["slideLink"];
            $id = $_POST["id"];
            $upload = new imgClass();
            $imgSrc = $upload->upload();
            $img = $imgSrc["file"];
            $type = $imgSrc["type"];
            $img = addslashes($img);

            if (is_uploaded_file($_FILES["file"]["tmp_name"])) {
                $success = $query->querySuccess("UPDATE jemaro.slide SET title = '$title', content = '$content', link = '$link', slideImg = '$img', slideImgType = '$type' WHERE id = '$id'");
                if ($success > 0) {
                    $query->history("Actualización: Slide");
                    $alert = "success";
                } else {
                    $alert = "danger";
                }
            } else {
                $success = $query->querySuccess("UPDATE jemaro.slide SET title = '$title', content = '$content', link = '$link' WHERE id = '$id'");
                if ($success > 0) {
                    $query->history("Actualización: Slide");
                    $alert = "success";
                } else {
                    $alert = "danger";
                }
            }

        } else if ($_POST["object"] == "config") {
            $name1 = $_POST["name1"];
            $name2 = $_POST["name2"];
            $slogan = $_POST["slogan"];
            $rif = $_POST["rif"];
            $email = $_POST["email"];
            $phone1 = $_POST["phone1"];
            $phone2 = $_POST["phone2"];
            $location = $_POST["location"];
            $facebook = $_POST["facebook"];
            $twitter = $_POST["twitter"];
            $googleplus = $_POST["googleplus"];
            $skype = $_POST["skype"];
            $youtube = $_POST["youtube"];
            $view = $_POST["view"];
            $mission = $_POST["mission"];
            $values = $_POST["values"];
            $upload = new imgClass();
            $imgSrc = $upload->upload();
            $img = $imgSrc["file"];
            $type = $imgSrc["type"];
            $img = addslashes($img);

            if (is_uploaded_file($_FILES["file"]["tmp_name"])) {
                $success1 = $query->querySuccess("UPDATE jemaro.configuration SET img = '$img', imgType = '$type', name1 = '$name1', name2 = '$name2', slogan = '$slogan', rif = '$rif', email = '$email', phone1 = '$phone1', phone2 = '$phone2', location = '$location', facebook = '$facebook', twitter = '$twitter', googlePlus = '$googleplus', skype = '$skype', youtube = '$youtube' WHERE id = 1 ");
                $success2 = $query->querySuccess("UPDATE jemaro.about SET `view` = '$view', mission = '$mission', `values` = '$values' WHERE id = 1");
                if (($success1 > 0) || ($success2 > 0)) {
                    $query->history("Actualización: Datos de la empresa");
                    $alert = "success";
                } else {
                    $alert = "danger";
                }
            } else {
                $success1 = $query->querySuccess("UPDATE jemaro.configuration SET name1 = '$name1', name2 = '$name2', slogan = '$slogan', rif = '$rif', email = '$email', phone1 = '$phone1', phone2 = '$phone2', location = '$location', facebook = '$facebook', twitter = '$twitter', googlePlus = '$googleplus', skype = '$skype', youtube = '$youtube' WHERE id = 1 ");
                $success2 = $query->querySuccess("UPDATE jemaro.about SET `view` = '$view', mission = '$mission', `values` = '$values' WHERE id = 1");
                if (($success1 > 0) || ($success2 > 0)) {
                    $query->history("Actualización: Datos de la empresa");
                    $alert = "success";
                } else {
                    $alert = "danger";
                }
            }
        }
        return $alert;
    }
}



/*
 * Created by PhpStorm.
 * User: MJMC
 * Date: 28/06/2017
 * Time: 02:41 PM
 */