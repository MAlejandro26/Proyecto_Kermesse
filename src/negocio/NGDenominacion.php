<?php

include_once("../entidades/Denominacion.php");
include_once("../datos/DTDenominacion.php");

$denominacion = new Denominacion();
$dtd = new DTDenominacion();

if($_POST)
{
    $varAccion = $_POST['txtAccion'];

    switch ($varAccion) 
    {
        case '1':
            try 
            {

                $denominacion->__SET('idMoneda',$_POST['txtMoneda']);
                $denominacion->__SET('valor',$_POST['txtValor']);
                $denominacion->__SET('valor_letras', $_POST['txtValor_letras']);
                $denominacion->__SET('estado',$_POST['txtEstado']);

                $dtd->registrarDenominacion($denominacion);
                header("Location: ../../denominacion.php");
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
}elseif ($_GET['accion']=='e') {

    $dtd->eliminarDenominacion($_GET['id']);
    header("Location: ../../denominacion.php");


}