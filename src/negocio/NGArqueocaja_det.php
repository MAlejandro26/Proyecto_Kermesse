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
            catch (Exception $e) 
            {
                header("Location: ../../index.php");
                die($e->getMessage());
            }
            break;
        
        case '2':
            try 
            {
                $arqueo_det->__SET('idArqueoCaja_Det', $_POST["txtArqueoCajaDet"]);
                $arqueo_det->__SET('idArqueoCaja', $_POST['txtArqueoCaja']);
                $arqueo_det->__SET('idMoneda', $_POST['txtMoneda']);
                $arqueo_det->__SET('idDenominacion', $_POST['txtDenominacion']);
                $arqueo_det->__SET('cantidad', $_POST['txtCantidad']);
                $arqueo_det->__SET('subtotal', $_POST['txtSubtotal']);

                
                $acd->editarArqueoCaja_det($arqueo_det);
                header("Location: ../../arqueocajaDet");
            } 
            catch (Exception $e) 
            {
                header("Location: ../../index.php");
                die($e->getMessage());
            }
            
            break;
    }
}

if($_GET)
{
    try 
    {
        $location->__SET('idArqueoCaja_Det', $_GET['idArqueoCajaDet']);
        $dtl->eliminarLocation($location->__GET('idArqueoCaja_Det'));
        header("Location: ../../arqueocajaDet.php?msjDelACD=1");
    } 
    catch (Exception $e) 
    {
        
        header("Location: ../../arqueocajaDet.php?msjDelACD=2");
        die($e->getMessage());
    }
}