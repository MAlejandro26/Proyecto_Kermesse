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
                header("Location: ../../index.php");
                die($e->getMessage());
            }
            break;
            case '2':

                try 
                {
                    $moneda->__SET('id_moneda',$_POST['txtIdMoneda']);
                    $moneda->__SET('nombre',$_POST['txtNombre']);
                    $moneda->__SET('simbolo', $_POST['txtSimbolo']);
                    $moneda->__SET('estado',$_POST['txtEstado']);
    
                    $dtd->actualizarMoneda($moneda);
                    header("Location: ../../moneda.php");
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
        $moneda->__SET('id_moneda', $_GET['idMoneda']);
        $dtd->eliminarMoneda($moneda->__GET('id_moneda'));

        header("Location: ../../moneda.php?msjDelDen=1");
    } 
    catch (Exception $e) 
    {
        die($e->getMessage());
        header("Location: ../../moneda.php?msjDelDen=2");
    }
}