<?php

include_once("../entidades/usuario.php");
include_once("../datos/DTUsuario.php");

$user = new Usuario();
$dtUser = new DTUsuario();

if($_POST)
{
    $usuario = $_POST["user"];
    $password = $_POST["clave"];

    $user = $dtUser->validarUsuario($usuario, $password);
    print_r($user);

    session_start();

    $_SESSION['acceso'] = $user;

    if(!isset($_SESSION['acceso']))
    {
        header("Location: ../../index.php?msj=2");
    }
    else
    {
        var_dump($_SESSION['acceso']);
        header("Location: ../../index.php?msj=1");
    }
}