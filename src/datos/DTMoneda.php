<?php

include_once("Conexion.php");

class DTMoneda extends Conexion
{
    private $myCon;

    public function listarMoneda()
    {
        try 
        {
            $this->myCon = parent::Conectar();
            $result = array();
            $sql = 'SELECT * from tbl_moneda';

            $stm = $this->myCon->prepare($sql);
            $stm->execute();

            foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
            {
                $moneda = new Moneda();
                //SET(CAMPOBD, atributoEntidad)
                $moneda->__SET('id_moneda', $r->id_moneda);
                $moneda->__SET('nombre', $r->nombre);
                $moneda->__SET('simbolo', $r->simbolo);
                $moneda->__SET('estado', $r->estado);

                $result[] = $moneda;
            }

            $this->myCon = parent::desconectar();
            return $result;
        } 
        catch (Exception $e) 
        {
            die($e->getMessage());
        }
    }

    public function registrarMoneda(Moneda $data)
    {
        try
        {
            $this->myCon = parent::Conectar();
            $sql = "INSERT INTO tbl_moneda (nombre, simbolo, estado)
                VALUES(?,?,?)";
            
            $this->myCon->prepare($sql)
            ->execute(array(
                $data->__GET('nombre'),
                $data->__GET('simbolo'),
                $data->__GET('estado')
            ));

            $this->myCon = parent::desconectar();
        }
        catch(Exception $e)
        {
            die($e->getMessage());
        }
    }
}