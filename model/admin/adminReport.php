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
        } elseif ($_GET["object"] == "vehicle") {
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
        $main = $query->query("SELECT * FROM configuration WHERE id = 1");
        $main = $main["0"];

        $html = '
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Reporte de productos</title>
</head>
<body>

<h2>' . $main["name1"] . ' ' . $main["name2"] . '</h2>
<h4 style="display:inline-block">Rif: ' . $main["rif"] . '</h4>

<center><h2>Reporte de Productos</h2></center>
<table width="100%" border="1" cellspacing="0" cellpadding="0">
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
        $date = getdate();
        $html .= '
</table>
<p >Reporte emitodo por ' . $_SESSION["access"]["email"] . ' el dia ' . $date["mday"] . '/' . $date["mon"] . '/' . $date["year"] . '. </p>
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
        $query = new query();
        $vehicle = $query->query("SELECT * FROM vehicleModel");
        $main = $query->query("SELECT * FROM configuration WHERE id = 1");
        $main = $main["0"];

        $html = '
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Reporte de vehiculos</title>
</head>
<body>

<h2>' . $main["name1"] . ' ' . $main["name2"] . '</h2>
<h4 style="display:inline-block">Rif: ' . $main["rif"] . '</h4>

<center><h2>Reporte de Vehiculos</h2></center>
<table width="100%" border="1" cellspacing="0" cellpadding="0">
  <tr>
    <td><strong>Marca </strong></td>
    <td><strong>Modelo</strong></td>
    <td><strong>Serie</strong></td>
  </tr>';

        $i = 0;
        while (isset($vehicle["$i"])) {
            $html .= '	
	<tr>
	    <td>' . $vehicle["$i"]["vehicleBrand"] . '</td>
	    <td>' . $vehicle["$i"]["vehicleModel"] . '</td>
		<td>' . $vehicle["$i"]["firstYear"] . ' - ' . $vehicle["$i"]["lastYear"] . '</td>							
	</tr>';
            $i++;
        }
        $date = getdate();
        $html .= '
</table>
<p >Reporte emitodo por ' . $_SESSION["access"]["email"] . ' el dia ' . $date["mday"] . '/' . $date["mon"] . '/' . $date["year"] . '. </p>
</body>
</html>';


        $html = utf8_encode($html);
        $dompdf = new DOMPDF();
        $dompdf->load_html($html);
        ini_set("memory_limit", "128M");
        $dompdf->render();
        $dompdf->stream("Reporte_de_vehiculos.pdf");

    }

    public function userReport()
    {
        $query = new query();
        $user = $query->query("SELECT * FROM `user`");
        $main = $query->query("SELECT * FROM configuration WHERE id = 1");
        $main = $main["0"];

        $html = '
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Reporte de usuarios</title>
</head>
<body>

<h2>' . $main["name1"] . ' ' . $main["name2"] . '</h2>
<h4 style="display:inline-block">Rif: ' . $main["rif"] . '</h4>

<center><h2>Reporte de Usuarios</h2></center>
<table width="100%" border="1" cellspacing="0" cellpadding="0">
  <tr>
    <td><strong>Nombre </strong></td>
    <td><strong>Email</strong></td>
    <td><strong>Tipo de ususario</strong></td>
    <td><strong>Estado</strong></td>
  </tr>';

        $i = 0;
        while (isset($user["$i"])) {
            $html .= '	
	<tr>
	    <td>' . utf8_decode ($user["$i"]["name"]) . ' ' . utf8_decode ($user["$i"]["lastName"]) .'</td>
	    <td>' . $user["$i"]["email"] . '</td>
		<td>' . $user["$i"]["userType"] . '</td>
		<td>' . $user["$i"]["status"] . '</td>							
	</tr>';
            $i++;
        }
        $date = getdate();
        $html .= '
</table>
<p >Reporte emitodo por ' . $_SESSION["access"]["email"] . ' el dia ' . $date["mday"] . '/' . $date["mon"] . '/' . $date["year"] . '. </p>
</body>
</html>';

        $html = utf8_encode($html);
        $dompdf = new DOMPDF();
        $dompdf->load_html($html);
        ini_set("memory_limit", "128M");
        $dompdf->render();
        $dompdf->stream("Reporte_de_usuarios.pdf");
    }

    public function historyReport()
    {
        $query = new query();
        $history = $query->query("SELECT * FROM history INNER JOIN `user` ON (history.email = `user`.email) WHERE `action` like'inicio%' ORDER BY `name`, `date` DESC");
        $main = $query->query("SELECT * FROM configuration WHERE id = 1");
        $main = $main["0"];

        $html = '
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Reporte de accesos</title>
</head>
<body>

<h2>' . $main["name1"] . ' ' . $main["name2"] . '</h2>
<h4 style="display:inline-block">Rif: ' . $main["rif"] . '</h4>

<center><h2>Reporte de Accesos al Sistema</h2></center>
<table width="100%" border="1" cellspacing="0" cellpadding="0">
  <tr>
    <td><strong>Nombre </strong></td>
    <td><strong>Email</strong></td>
    <td><strong>Tipo de ususario</strong></td>
    <td><strong>Fecha</strong></td>
  </tr>';

        $i = 0;
        while (isset($history["$i"])) {
            $html .= '	
	<tr>
	    <td>' . utf8_decode ($history["$i"]["name"]) . ' ' . utf8_decode ($history["$i"]["lastName"]) .'</td>
	    <td>' . $history["$i"]["email"] . '</td>
		<td>' . $history["$i"]["userType"] . '</td>
		<td>' . $history["$i"]["date"] . '</td>							
	</tr>';
            $i++;
        }
        $date = getdate();
        $html .= '
</table>
<p >Reporte emitodo por ' . $_SESSION["access"]["email"] . ' el dia ' . $date["mday"] . '/' . $date["mon"] . '/' . $date["year"] . '. </p>
</body>
</html>';

        $html = utf8_encode($html);
        $dompdf = new DOMPDF();
        $dompdf->load_html($html);
        ini_set("memory_limit", "128M");
        $dompdf->render();
        $dompdf->stream("Reporte_de_usuarios.pdf");

    }
}

/*
 * Created by PhpStorm.
 * User: MJMC
 * Date: 03/07/2017
 * Time: 02:29 PM
 */