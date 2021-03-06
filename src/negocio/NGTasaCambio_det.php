<?php

include_once("../entidades/TasaCambio_det.php");
include_once("../datos/DTTasaCambio_det.php");

$tasaCambio_det = new TasaCambio_det();
$dtd = new DTTasaCambio_det();

if($_POST)
{
    $varAccion = $_POST['txtAccion'];

    switch ($varAccion) 
    {
        case '1':
            try 
            {
                $tasaCambio_det->__SET('id_tasaCambio', $_POST['txtTasaCambio']);
                $tasaCambio_det->__SET('tipoCambio', $_POST['txtTipoCambio']);
                $tasaCambio_det->__SET('estado', $_POST['txtEstado']);

                $dtd->registrarTasaCambio_det($tasaCambio_det);
                header("Location: ../../tasaCambio_det.php");
            } 
            catch (\Throwable $th) 
            {
                header("Location: ../../index.php");
                die($e->getMessage());
            }
            break;

        case '2':
            try 
            {
                $tasaCambio_det->__SET('id_tasaCambio_det', $_POST['txtIdTasaCambio_det']);
                $tasaCambio_det->__SET('id_tasaCambio', $_POST['txtTasaCambio']);
                $tasaCambio_det->__SET('fecha', $_POST['txtFecha']);
                $tasaCambio_det->__SET('tipoCambio', $_POST['txtTipoCambio']);
                $tasaCambio_det->__SET('estado', $_POST['txtState']);

                $dtd->actualizarTasaCambio_det($tasaCambio_det);
                header("Location: ../../tasaCambio_det.php");
            } 
            catch (\Throwable $th) 
            {
                header("Location: ../../index.php");
                die($e->getMessage());
            }
            break;
        
        default:
            
            break;
    }
}
if($_GET)
{
    try 
    {
        $tasaCambio_det->__SET('id_tasaCambio_det', $_GET['id_tasaCambio_det']);
        $dtd->eliminarTasaCambio_det($tasaCambio_det->__GET('id_tasaCambio_det'));

        header("Location: ../../tasaCambio_det.php?msjDelTC_det=1");
    } 
    catch (Exception $e) 
    {
        die($e->getMessage());
        header("Location: ../../tasaCambio_det.php?msjDelTC_det=2");
    }
}