<?php
include_once "../../../config/configPath.php";
include_once PATH . "/config/include.php";

$query = new query();
$id = $_POST["id"];
$category = $query->query("SELECT * FROM productCategory WHERE productCategory IN (SELECT productCategory FROM productClass WHERE productClass IN (SELECT productClass FROM product WHERE ((productCode IN (SELECT productCode FROM vehicleModel_has_product WHERE vehicleModel_id = '$id' GROUP BY productCode)) AND  (productClass IN (SELECT productClass FROM vehicleModel_has_product WHERE vehicleModel_id = '$id' GROUP BY productClass)) AND (productBrand IN (SELECT productBrand FROM vehicleModel_has_product WHERE vehicleModel_id = '$id' GROUP BY productBrand))) GROUP BY productClass) GROUP BY productCategory)");
$i = 0;

echo "<option selected=\"selected\" disabled=\"disabled\">Seleccione una Categoria </option>";

while (isset($category["$i"])) {
    echo "<option value='",$category["$i"]["productCategory"],"'>",$category["$i"]["productCategory"],"</option>";
    $i++;
}

/*
 * Created by PhpStorm.
 * User: MJMC
 * Date: 05/07/2017
 * Time: 04:00 PM
 */