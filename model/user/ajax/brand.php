<?php
include_once "../../../config/configPath.php";
include_once PATH . "/config/include.php";

$query = new query();
$id = $_POST["id"];
$vehicle = $query->query("SELECT * FROM vehicleModel WHERE ((vehicleBrand = '$id') AND (id IN (SELECT vehicleModel_id FROM vehicleModel_has_product GROUP BY vehicleModel_id)))");
$i = 0;


echo "<option selected=\"selected\" disabled=\"disabled\">Seleccione un vehiculo</option>";

while (isset($vehicle["$i"])) {
    echo "<option value='", $vehicle["$i"]["id"], "'>", $vehicle["$i"]["vehicleModel"]," ",$vehicle["$i"]["firstYear"]," - ",$vehicle["$i"]["lastYear"],"</option>";
    $i++;
}

echo "</select>";

/*
 * Created by PhpStorm.
 * User: MJMC
 * Date: 05/07/2017
 * Time: 02:27 PM
 */
?>
