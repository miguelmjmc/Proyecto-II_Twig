<?php

class imgClass
{
// Los posible valores que puedes obtener de la imagen son:
//echo "<BR>".$_FILES["userfile"]["name"];      //nombre del archivo
//echo "<BR>".$_FILES["userfile"]["type"];      //tipo
//echo "<BR>".$_FILES["userfile"]["tmp_name"];  //nombre del archivo de la imagen temporal
//echo "<BR>".$_FILES["userfile"]["size"];      //tamaño

    public function upload()
    {
        //Comprovamos que se haya subido un fichero
        if (is_uploaded_file($_FILES["file"]["tmp_name"])) {
            //verificamos el tamaño de la imagen
            if ($_FILES["file"]["size"] < 3000000) {
                //verificamos el formato de la imagen
                if ($_FILES["file"]["type"] == "image/jpeg" || $_FILES["file"]["type"] == "image/gif" || $_FILES["file"]["type"] == "image/bmp" || $_FILES["file"]["type"] == "image/png") {
                    $route = fopen($_FILES["file"]["tmp_name"], "r");
                    $file = fread($route, $_FILES["file"]["size"]);
                    fclose($route);
                    $type=$_FILES["file"]["type"];
                    $src=compact("file","type");
                    return $src;
                } else {
                    echo "<div class='error'>Error: El formato de archivo tiene que ser JPG, GIF, BMP o PNG.</div>";
                }
            } else {
                echo "<div class='error'>Error: El tamaño de archivo no debe superar los 3mb.</div>";
            }
        }
    }
}
/*
 * Created by PhpStorm.
 * User: MJMC
 * Date: 27/06/2017
 * Time: 08:15 PM
 */