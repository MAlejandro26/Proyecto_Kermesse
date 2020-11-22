<?php

class Conexion
{
    //Variables para almacenar los datos de conexión
    private $pdo;
    private $pdoStmt;
    private $serverName;
    private $dbName;
    private $userName;
    private $pwd;

    public function Conectar()
    {
        $serverName = 'localhost';
        $dbName = 'dbkermesse_grupo4';
        $userName = 'root';
        $pwd = '';

        try 
        {
            //Cadena de Conexión
            $this->pdo = new PDO("mysql:host={$serverName}; dbname={$dbName}", $userName, $pwd);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //capturar errores o excepciones
            //echo 'Conexión exitosa a "$dbName"';
            return $this->pdo;
        } 
        catch (PDOException $e) 
        {
            echo 'La conexión falló!';
        }
    }

    public function desconectar()
    {
        try 
        {
            $pdo = null;
            return $pdo;
        } 
        catch (PDOException $e) 
        {
            die($e->getMessage());
        }
    }
}

//Test
//$con = new Conexion();
//$con->Conectar();
//$con->desconectar();