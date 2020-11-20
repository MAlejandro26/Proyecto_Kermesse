<?php

include_once("../entidades/location.php");
include_once("../datos/DTLocation.php");

$location = new Location();
$dtl = new DTLocation();

if($_POST)
{
    $varAccion = $_POST['txtaccion'];

    switch ($varAccion) 
    {
        case '1':
            try 
            {
                $location->__SET('street_address', $_POST['txtStreet']);
                $location->__SET('postal_code', $_POST['txtPostalCode']);
                $location->__SET('city', $_POST['txtCity']);
                $location->__SET('state_province', $_POST['txtState']);
                $location->__SET('country_id', $_POST['txtCountry']);

                $dtl->registrarLocation($location);
                header("Location: /locations.php?msjNewReg=1");
            } 
            catch (\Throwable $th) 
            {
                header("Location: daw/HR/locations.php?msjNewReg=2");
                die($e->getMessage());
            }
            break;
        
        default:
            
            break;
    }
}