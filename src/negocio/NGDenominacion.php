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
        
        case '2':

            try 
            {
                $denominacion->__SET('id_Denominacion',$_POST['txtIdDenominacion']);
                $denominacion->__SET('idMoneda',$_POST['txtIdMoneda']);
                $denominacion->__SET('valor',$_POST['txtValor']);
                $denominacion->__SET('valor_letras', $_POST['txtValorLetras']);
                $denominacion->__SET('estado',$_POST['txtState']);

                $dtd->actualizarDenominacion($denominacion);
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
}
if($_GET)
{
    try 
    {
        $denominacion->__SET('id_Denominacion', $_GET['idDenominacion']);
        $dtd->eliminarDenominacion($denominacion->__GET('id_Denominacion'));

        header("Location: ../../denominacion.php?msjDelDen=1");
    } 
    catch (Exception $e) 
    {
        die($e->getMessage());
        header("Location: ../../denominacion.php?msjDelDen=2");
    }
}