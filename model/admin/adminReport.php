<?php

include_once PATH . "/model/admin/adminBase.php";

class adminReport extends adminBase
{
    public function __construct()
    {
    }

    function load()
    {

        if ($_POST["object"] == "product") {
            $this->productReport;
        } elseif ($_POST["object"] == "vehicle") {
            $this->vehicleReport;
        } elseif ($_POST["object"] == "user") {
            $this->userReport;
        } elseif ($_POST["object"] == "history") {
            $this->historyReport;
        }

    }

    public function productReport()
    {

    }

    public function vehicleReport()
    {

    }

    public function userReport()
    {



    }

    public function historyReport()
    {


    }
}







/*
$query = new query();

$product = $query->query("SELECT * FROM (product INNER JOIN productClass ON (product.productClass = productClass.productClass)) INNER JOIN productBrand ON (product.productBrand = productBrand.productBRand)");

include_once PATH . "/dompdf/dompdf_config.inc.php";


$codigoHTML = '
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
</head>
<body>
<table width="100%" border="1" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="5" bgcolor="skyblue"><CENTER><strong>REPORTE DE PRODUCTOS</strong></CENTER></td>
  </tr>
  <tr>
    <td><strong>Codigo</strong></td>
    <td><strong>Clase</strong></td>
    <td><strong>Marca</strong></td>
    <td><strong>Precio</strong></td>
    <td><strong>Descuento</strong></td>
  </tr>';

$i = 0;
while (isset($product["$i"])) {
    $codigoHTML .= '	
	<tr>
	
		<td>' . $product["$i"]["productCode"] . '</td>
		<td>' . $product["$i"]["productClass"] . '</td>
		<td>' . $product["$i"]["productBrand"] . '</td>
		<td>' . $product["$i"]['price'] . '</td>
		<td>' . $product["$i"]['offer'] . '</td>										
	</tr>';
    $i++;
}
$codigoHTML .= '
</table>
</body>
</html>';


$codigoHTML = utf8_encode($codigoHTML);
$dompdf = new DOMPDF();
$dompdf->load_html($codigoHTML);
ini_set("memory_limit", "128M");
$dompdf->render();
$dompdf->stream("Reporte_tabla_usuarios.pdf");

header("LOCATION:index.php");




/*
 * Created by PhpStorm.
 * User: MJMC
 * Date: 03/07/2017
 * Time: 02:29 PM
 */