<?php

include_once("../entidades/ArqueoCaja.php");
include_once("../datos/DTArqueoCaja.php");

$arqueoCaja = new ArqueoCaja();
$ac = new DTArqueoCaja();

if($_POST)
{
    $varAccion = $_POST['txtAccion'];
    

    switch ($varAccion) 
    {
        case '1':
            try 
            {
                date_default_timezone_set("America/Managua");
                $date = date('Y/m/d', time());
                $arqueoCaja->__SET('idkermesse',$_POST['txtIdKermesse']);
                $arqueoCaja->__SET('fechaArqueo', $date);
                $arqueoCaja->__SET('granTotal',$_POST['txtGranTotal']);
                $arqueoCaja->__SET('usuario_creacion', $_POST['txtUsuarioCreacion']);
                $arqueoCaja->__SET('fecha_creacion',$date);
                $arqueoCaja->__SET('estado',$_POST['txtEstado']);
                

                $ac->registrarArqueoCaja($arqueoCaja);
                header("Location: ../../arqueoCaja.php");
            } 
            catch (\Throwable $th) 
            {
                header("Location: proyecto_kermesse/index.php");
                die($e->getMessage());
            }
            break;

            case '2':

                try 
                {
                    date_default_timezone_set("America/Managua");
                    $date = date('Y/m/d', time());

                    $arqueoCaja->__SET('idArqueoCaja',$_POST['txtIdArqueoCaja']);
                    $arqueoCaja->__SET('idkermesse',$_POST['txtIdKermesse']);
                    $arqueoCaja->__SET('fechaArqueo', $date);
                    $arqueoCaja->__SET('granTotal',$_POST['txtGranTotal']);
                    $arqueoCaja->__SET('usuario_creacion', $_POST['txtUsuarioCreacion']);
                    $arqueoCaja->__SET('fecha_creacion',$date);
                    $arqueoCaja->__SET('estado',$_POST['txtEstado']);
                    
    
                    $ac->actualizarArqueoCaja($arqueoCaja);
                    header("Location: ../../arqueoCaja.php");
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
        $arqueoCaja->__SET('id_arqueoCaja', $_GET['idarqueoCaja']);
        $dtd->eliminarArqueoCaja($arqueoCaja->__GET('id_arqueoCaja'));

        header("Location: ../../arqueoCaja.php?msjDelDen=1");
    } 
    catch (Exception $e) 
    {
        die($e->getMessage());
        header("Location: ../../arqueoCaja.php?msjDelDen=2");
    }
}