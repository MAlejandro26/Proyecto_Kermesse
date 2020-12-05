<?php

include_once("../entidades/TasaCambio.php");
include_once("../datos/DTTasaCambio.php");

$tasaCambio = new tasaCambio();
$dtd = new DTTasaCambio();

if($_POST)
{
    $varAccion = $_POST['txtAccion'];

    switch ($varAccion) 
    {
        case '1':
            try 
            {

                $tasaCambio->__SET('id_monedaO',$_POST['txtMonedaO']);
                $tasaCambio->__SET('id_monedaC',$_POST['txtMonedaC']);
                $tasaCambio->__SET('mes', $_POST['txtMes']);
                $tasaCambio->__SET('anio', $_POST['txtAnio']);
                $tasaCambio->__SET('estado',$_POST['txtEstado']);

                $dtd->registrarTasaCambio($tasaCambio);
                header("Location: ../../tasaCambio.php");
            } 
            catch (Exception $e) 
            {
                header("Location: ../../index.php");
                die($e->getMessage());
            }
            break;
        
        case '2':
            try {
                $tasaCambio->__SET('id_tasaCambio', $_POST['txtId_TasaCambio']);
                $tasaCambio->__SET('id_monedaO',$_POST['txtMonedaO']);
                $tasaCambio->__SET('id_monedaC',$_POST['txtMonedaC']);
                $tasaCambio->__SET('mes', $_POST['txtMes']);
                $tasaCambio->__SET('anio', $_POST['txtAnio']);
                $tasaCambio->__SET('estado',$_POST['txtEstado']);
                $dtd->editartasaCambio($tasaCambio);
                header("Location: ../../tasaCambio.php");
            } 
            catch (Exception $e) 
            {
                header("Location: ../../index.php");
                die($e->getMessage());
            }
        
        default:
            
        break;
    }
}
if($_GET)
{
    try 
    {
        $tasaCambio->__SET('id_tasaCambio', $_GET['idTasacambio']);
        $dtd->eliminarTasaCambio($tasaCambio->__GET('id_tasaCambio'));

        header("Location: ../../tasaCambio.php?msjDelTac=1");
    } 
    catch (Exception $e) 
    {
        die($e->getMessage());
        header("Location: ../../tasaCambio.php?msjDelTac=2");
    }
}