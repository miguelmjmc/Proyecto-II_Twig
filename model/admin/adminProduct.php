<?php

include_once PATH . "/model/admin/adminBase.php";

class adminProduct extends adminBase
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

        $view = "product.html.twig";

        $array = $this->select();

        $values = compact("directory", "view", "array");

        return $values;
    }

    public function select()
    {
        $admin = $this->loadmain();

        $query = new query();

        $productList = $query->query("SELECT * FROM product ");
        $i = 0;
        while (isset($productList["$i"])) {
            $code = $productList["$i"]["productCode"];
            $brand = $productList["$i"]["productBrand"];
            $class = $productList["$i"]["productClass"];

            $productList["$i"]["img"] = $query->query("SELECT * FROM  productImage WHERE productCode = '$code' AND productBrand = '$brand' AND productClass = '$class' ");
            $j = 0;
            while (isset($productList["$i"]["img"]["$j"])) {
                $productList["$i"]["img"]["$j"]["productImg"] = base64_encode($productList["$i"]["img"]["$j"]["productImg"]);
                $j++;
            }
            $i++;
        }

        $productBrandList = $query->query("SELECT * FROM productBrand");
        $i = 0;
        while (isset($productBrandList["$i"]["productBrandImg"])) {
            $productBrandList["$i"]["productBrandImg"] = base64_encode($productBrandList["$i"]["productBrandImg"]);
            $i++;
        }

        $productCategoryList = $query->query("SELECT * FROM productCategory");

        $productClassList = $query->query("SELECT * FROM productClass");

        $array = compact("admin", "productList", "productBrandList", "productCategoryList", "productClassList");

        return $array;
    }

    public function news()
    {
        $query = new query();
        if ($_POST["object"] == "productBrand") {
            $brand = $_POST["brand"];
            $upload = new imgClass();
            $imgSrc = $upload->upload();
            $img = $imgSrc["file"];
            $type = $imgSrc["type"];
            $img = addslashes($img);
            $success = $query->querySuccess("INSERT INTO jemaro.productBrand (productBrand, productBrandImg, productBrandImgType) VALUES ('$brand','$img','$type')");
            if ($success > 0) {
                $query->history("Registro: Marca de producto");
            }
        } elseif ($_POST["object"] == "productCategory") {
            $category = $_POST["category"];
            $success = $query->querySuccess("INSERT INTO jemaro.productCategory (`productCategory`) VALUES ('$category')");
            if ($success > 0) {
                $query->history("Registro: Categoria de producto");
            }
        } else if ($_POST["object"] == "productClass") {
            $class = $_POST["class"];
            $success = $query->querySuccess("INSERT INTO jemaro.productClass (`productClass`) VALUES ('$class')");
            if ($success > 0) {
                $query->history("Registro: Clase de producto");
            }
        } else if ($_POST["object"] == "product") {
            $code = $_POST["code"];
            $class = $_POST["class"];
            $brand = $_POST["brand"];
            $price = $_POST["price"];
            $offer = $_POST["offer"];
            $description = $_POST["description"];
            $success = $query->querySuccess("INSERT INTO jemaro.product (productCode, productClass, productBrand, price, offer, description) VALUES ('$code','$class','$brand','$price','$offer','$description')");
            if ($success > 0) {
                $query->history("Registro: Producto");
            }
        }
        header("LOCATION:index.php?link=adminProduct");
    }

    public function update()
    {
        $query = new query();
        if ($_POST["object"] == "productBrand") {
            $id = $_POST["id"];
            $brand = $_POST["brand"];
            $upload = new imgClass();
            $imgSrc = $upload->upload();
            $img = $imgSrc["file"];
            $type = $imgSrc["type"];
            $img = addslashes($img);
            if (is_uploaded_file($_FILES["file"]["tmp_name"])) {
                $success = $query->querySuccess("UPDATE jemaro.productBrand SET productBrand = '$brand',  productBrandImg = '$img', productBrandImgType = '$type' where productBrand = '$id'");
                if ($success > 0) {
                    $query->history("Actualización: Marca de producto");
                }
            } else {
                $success = $query->querySuccess("UPDATE jemaro.productBrand SET productBrand = '$brand' where productBrand = '$id'");
                if ($success > 0) {
                    $query->history("Actualización: Marca de producto");
                }
            }
        } elseif ($_POST["object"] == "productCategory") {
            $id = $_POST["id"];
            $category = $_POST["category"];
            $success = $query->querySuccess("UPDATE jemaro.productCategory SET productCategory = '$category' WHERE productCategory = '$id'");
            if ($success > 0) {
                $query->history("Actualización: Categoria de producto");
            }
        } else if ($_POST["object"] == "productClass") {
            $id = $_POST["id"];
            $class = $_POST["class"];
            $success = $query->querySuccess("UPDATE jemaro.productClass SET productClass = '$class' WHERE productClass = '$id'");
            if ($success > 0) {
                $query->history("Actualización: Clase de producto");
            }
        } else if ($_POST["object"] == "product") {
            $codeId = $_POST["codeId"];
            $brandId = $_POST["brandId"];
            $classId = $_POST["classId"];
            $code = $_POST["code"];
            $class = $_POST["class"];
            $brand = $_POST["brand"];
            $price = $_POST["price"];
            $offer = $_POST["offer"];
            $description = $_POST["description"];
            $success = $query->querySuccess("UPDATE jemaro.product SET productCode = '$code', productClass = '$class', productBrand = '$brand', price = '$price', offer = '$offer', description = '$description' WHERE  productCode = '$codeId' AND productBrand = '$brandId' AND productClass = '$classId'");
            if ($success > 0) {
                $query->history("Actualización: Producto");
            }
        }
        header("LOCATION:index.php?link=adminProduct");
    }


    public function delete()
    {
        $query = new query();
        if ($_POST["object"] == "productBrand") {
            $id = $_POST["id"];
            $success = $query->querySuccess("DELETE FROM jemaro.productBrand WHERE productBrand = '$id'");
            if ($success > 0) {
                $query->history("Eliminación: Marca de producto");
            }
        } else if ($_POST["object"] == "productCategory") {
            $id = $_POST["id"];
            $success = $query->querySuccess("DELETE FROM jemaro.productCategory  WHERE productCategory = '$id'");
            if ($success > 0) {
                $query->history("Eliminación: Categoria de producto");
            }
        } else if ($_POST["object"] == "productClass") {
            $id = $_POST["id"];

            $success = $query->querySuccess("DELETE FROM jemaro.productClass WHERE productClass = '$id'");
            if ($success > 0) {
                $query->history("Eliminación: Clase de producto");
            }
        } else if ($_POST["object"] == "product") {
            $codeId = $_POST["codeId"];
            $brandId = $_POST["brandId"];
            $classId = $_POST["classId"];
            $success = $query->querySuccess("DELETE FROM jemaro.product WHERE productCode = '$codeId' AND productBrand = '$brandId' AND productClass = '$classId'");
            if ($success > 0) {
                $query->history("Eliminación: Producto");
            }
        }
        header("LOCATION:index.php?link=adminProduct");
    }


}


/*
 * Created by PhpStorm.
 * User: MJMC
 * Date: 21/06/2017
 * Time: 05:16 AM
 */

?>