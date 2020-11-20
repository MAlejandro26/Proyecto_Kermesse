<?php

include_once("../entidades/region.php");
include_once("../datos/DTRegion.php");

$reg = new Region();
$dtr = new DTRegion();

if($_POST)
{
    $varAccion = $_POST['txtaccion'];

    switch($varAccion)
    {
        case '1':
            try
            {
                $reg->__SET('region_id', $_POST['txtregionid']);
                $reg->__SET('region_name', $_POST['txtregion']);

                $dtr->registrarReg($reg);
                header("Location: daw/HR/regions.php?msjNewReg=1");
            }
            catch(Exception $e)
            {
                header("Location: daw/HR/regions.php?msjNewReg=2");
                die($e->getMessage);
            }
            break;
    }
}