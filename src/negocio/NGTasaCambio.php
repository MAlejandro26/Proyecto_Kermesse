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
            catch (\Throwable $th) 
            {
                header("Location: daw/HR/index.php");
                die($e->getMessage());
            }
            break;
        
        default:
            
            break;
    }
}elseif ($_GET['accion']=='e') {

    $dtd->eliminarTasaCambio($_GET['id']);
    header("Location: ../../tasaCambio.php");


}