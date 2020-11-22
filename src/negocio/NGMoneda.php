<?php

include_once("../entidades/Moneda.php");
include_once("../datos/DTMoneda.php");

$moneda = new Moneda();
$dtd = new DTMoneda();

if($_POST)
{
    $varAccion = $_POST['txtAccion'];

    switch ($varAccion) 
    {
        case '1':
            try 
            {

                $moneda->__SET('id_moneda',$_POST['txtMoneda']);
                $moneda->__SET('nombre',$_POST['txtNombre']);
                $moneda->__SET('simbolo', $_POST['txtSimbolo']);
                $moneda->__SET('estado',$_POST['txtEstado']);

                $dtd->registrarMoneda($moneda);
                header("Location: ../../moneda.php");
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

    $dtd->eliminarMoneda($_GET['id']);
    header("Location: ../../moneda.php");


}