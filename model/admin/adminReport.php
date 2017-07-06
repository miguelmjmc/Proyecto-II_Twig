<?php

include_once PATH . "/dompdf/dompdf_config.inc.php";

class adminReport
{
    public function __construct()
    {
    }

    function load()
    {

        if ($_GET["object"] == "product") {
            $this->productReport();
        } elseif ($_POST["object"] == "vehicle") {
            $this->vehicleReport();
        } elseif ($_GET["object"] == "user") {
            $this->userReport();
        } elseif ($_GET["object"] == "history") {
            $this->historyReport();
        }

    }

    public function productReport()
    {

        $query = new query();
        $product = $query->query("SELECT * FROM (product INNER JOIN productClass ON (product.productClass = productClass.productClass)) INNER JOIN productBrand ON (product.productBrand = productBrand.productBRand)");


        $html = '
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
</head>
<body>
<table width="100%" border="1" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="4"><CENTER><strong>REPORTE DE PRODUCTOS</strong></CENTER></td>
  </tr>
  <tr>
    <td><strong>Categoria</strong></td>
    <td><strong>Clase</strong></td>
    <td><strong>Codigo</strong></td>
    <td><strong>Marca</strong></td>
  </tr>';

        $i = 0;
        while (isset($product["$i"])) {
            $html .= '	
	<tr>
	    <td>' . $product["$i"]["productCategory"] . '</td>
	    <td>' . $product["$i"]["productClass"] . '</td>
		<td>' . $product["$i"]["productCode"] . '</td>
		<td>' . $product["$i"]["productBrand"] . '</td>							
	</tr>';
            $i++;
        }
        $html .= '
</table>
</body>
</html>';


        $html = utf8_encode($html);
        $dompdf = new DOMPDF();
        $dompdf->load_html($html);
        ini_set("memory_limit", "128M");
        $dompdf->render();
        $dompdf->stream("Reporte_de_productos.pdf");
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
 * Created by PhpStorm.
 * User: MJMC
 * Date: 03/07/2017
 * Time: 02:29 PM
 */