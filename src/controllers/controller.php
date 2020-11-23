<?php

class MvcController
{
    public function plantilla()
    {
        include "templates/template.php";
    }

    public function enlacesPag()
    {
        $enlaces = $_GET["action"];
        $respuesta = EnlacesPaginas::enlacesPaginasModel($enlaces);
    }
}

?>