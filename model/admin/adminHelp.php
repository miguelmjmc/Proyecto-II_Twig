<?php

include_once PATH . "/dompdf/dompdf_config.inc.php";

class adminHelp
{
    public function __construct()
    {
    }

    function load()
    {
        $query = new query();

        $html = '
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
</head>
<h1>Manual de usuario</h1>
<p>En construccion</p>
<body>
</body>
</html>';


        $html = utf8_encode($html);
        $dompdf = new DOMPDF();
        $dompdf->load_html($html);
        ini_set("memory_limit", "128M");
        $dompdf->render();
        $dompdf->stream("Manual_del_usuario.pdf");

    }


}

/*
 * Created by PhpStorm.
 * User: MJMC
 * Date: 06/07/2017
 * Time: 02:38 AM
 */