<?php

class adminUser extends adminBase
{
    public function __construct()
    {
    }

    public function load()
    {
        if ($_SESSION["access"]["userType"] == "Administrador") {

            $alert = null;
            if (isset($_POST["action"])) {
                if ($_POST["action"] == "new") {
                    $alert = $this->news();
                } else if ($_POST["action"] == "update") {
                    $alert = $this->update();
                }
            }
            $directory = "admin";

            $view = "user.html.twig";

            $array = $this->select();

            $array["alert"] = $alert;

            $values = compact("directory", "view", "array");

            return $values;
        }
    }

    public function select()
    {
        $admin = $this->loadmain();

        $query = new query();

        $userList = $query->query("SELECT * FROM `user` WHERE userType like 'Operador'");

        $i = 0;
        while (isset($userList["$i"])) {
            $userList["$i"]["adminImg"] = base64_encode($userList["$i"]["adminImg"]);
            $i++;
        }


        $array = compact("admin", "userList");

        return $array;
    }


    public function news()
    {
        $query = new query();
        $upload = new imgClass();
        $encrypt = new encrypt();
        if ($_POST["object"] == "user") {
            $email = $_POST["email"];
            $name = $_POST["name"];
            $lastName = $_POST["lastName"];
            $ci = $_POST["ci"];
            $phone = $_POST["phone"];
            $rol = $_POST["rol"];
            $status = $_POST["status"];
            $password = $encrypt->passwordEncrypt($_POST["password"]);
            $imgSrc = $upload->upload();
            $img = $imgSrc["file"];
            $type = $imgSrc["type"];
            $img = addslashes($img);
            $success = $query->querySuccess("INSERT INTO jemaro.`user` (email,`name`, lastName, ci, phone, userType, password, adminImg, adminImgType, status) VALUES ('$email', '$name', '$lastName', '$ci', '$phone', '$rol', '$password', '$img', '$type', '$status')");
            if ($success > 0) {
                $query->history("Registro: Usuario");
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
        $upload = new imgClass();
        $encrypt = new encrypt();
        if ($_POST["object"] == "user") {
            $emailId = $_POST["emailId"];
            $email = $_POST["email"];
            $name = $_POST["name"];
            $lastName = $_POST["lastName"];
            $ci = $_POST["ci"];
            $phone = $_POST["phone"];
            $rol = $_POST["rol"];
            $status = $_POST["status"];
            if($_POST["password"]!= null){
                $password = $encrypt->passwordEncrypt($_POST["password"]);
            }else{
                $passwordOld=$query->query("SELECT password FROM `user` where email = '$emailId' ");
                $password = $passwordOld["0"]["password"];
            }

            $imgSrc = $upload->upload();
            $img = $imgSrc["file"];
            $type = $imgSrc["type"];
            $img = addslashes($img);
            if (is_uploaded_file($_FILES["file"]["tmp_name"])) {
                $success = $query->querySuccess("UPDATE jemaro.`user` SET email = '$email',`name` = '$name', lastName = '$lastName', ci = '$ci', phone = '$phone', userType '$rol', password = '$password', adminImg = '$img', adminImgType = '$type', status = '$status' where email = '$emailId'");
                if ($success > 0) {
                    $query->history("Actualización: Usuario");
                    $alert = "success";
                } else {
                    $alert = "danger";
                }
            } else {
                $success = $query->querySuccess("UPDATE jemaro.`user` SET email = '$email',`name` = '$name', lastName = '$lastName', ci = '$ci', phone = '$phone', userType ='$rol', password = '$password', status = '$status' WHERE email = '$emailId'");
                if ($success > 0) {
                    $query->history("Actualización: Usuario");
                    $alert = "success";
                } else {
                    $alert = "danger";
                }
            }
        }else  if ($_POST["object"] == "admin") {
            $emailId = $_POST["emailId"];
            $email = $_POST["email"];
            $name = $_POST["name"];
            $lastName = $_POST["lastName"];
            $ci = $_POST["ci"];
            $phone = $_POST["phone"];
            if($_POST["password"]!= null){
                $password = $encrypt->passwordEncrypt($_POST["password"]);
            }else{
                $passwordOld=$query->query("SELECT password FROM `user` where email = '$emailId' ");
                $password = $passwordOld["0"]["password"];
            }
            $imgSrc = $upload->upload();
            $img = $imgSrc["file"];
            $type = $imgSrc["type"];
            $img = addslashes($img);
            if (is_uploaded_file($_FILES["file"]["tmp_name"])) {
                $success = $query->querySuccess("UPDATE jemaro.`user` SET email = '$email',`name` = '$name', lastName = '$lastName', ci = '$ci', phone = '$phone', password = '$password', adminImg = '$img', adminImgType = '$type' where email = '$emailId'");
                if ($success > 0) {
                    $query->history("Actualización: Administrador");
                    $alert = "success";
                    session_destroy();
                    header("LOCATION:index.php");
                } else {
                    $alert = "danger";
                }
            } else {
                $success = $query->querySuccess("UPDATE jemaro.`user` SET email = '$email',`name` = '$name', lastName = '$lastName', ci = '$ci', phone = '$phone', password = '$password' WHERE email = '$emailId'");
                if ($success > 0) {
                    $query->history("Actualización: Administrador");
                    $alert = "success";
                    session_destroy();
                    header("LOCATION:index.php");
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
 * Date: 04/07/2017
 * Time: 04:59 AM
 */