<?php

include_once("../entidades/ArqueoCaja_det.php");
include_once("../datos/DTArqueoCaja_det.php");

$arqueo_det = new ArqueoCaja_det();
$acd = new DTArqueoCaja_det();

if($_POST)
{
    $varAccion = $_POST['txtAccion'];

    switch ($varAccion) 
    {
        case '1':
            try 
            {

                $arqueo_det->__SET('idArqueoCaja',$_POST['txtArqueoCaja']);
                $arqueo_det->__SET('idMoneda',$_POST['txtMoneda']);
                $arqueo_det->__SET('idDenominacion', $_POST['txtDenominacion']);
                $arqueo_det->__SET('cantidad',$_POST['txtCantidad']);
                $arqueo_det->__SET('subtotal',$_POST['txtSubtotal']);


                $acd->registrarArqueoCaja_det($arqueo_det);
                header("Location: ../../arqueocajaDet.php");
            } 
            catch (\Throwable $th) 
            {
                header("Location: proyecto_kermesse/index.php");
                die($e->getMessage());
            }
            break;
        
        default:
            
            break;
    }
}elseif ($_GET['accion']=='e') {

    $acd->eliminarArqueoCaja_det($_GET['id']);
    header("Location: ../../arqueocajaDet.php");


}