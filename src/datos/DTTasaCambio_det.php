<?php

include_once("Conexion.php");

class DTTasaCambio_det extends Conexion
{
    private $myCon;

    public function listarTasaCambio_det()
    {
        try 
        {
            $this->myCon = parent::Conectar();
            $result = array();
            $sql = 'SELECT * from tasaCambio_det';

            $stm = $this->myCon->prepare($sql);
            $stm->execute();

            foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
            {
                $tasaCambio_det = new TasaCambio_det();
                //SET(CAMPOBD, atributoEntidad)
                $tasaCambio_det->__SET('id_tasaCambio_det', $r->id_tasaCambio_det);
                $tasaCambio_det->__SET('id_tasaCambio', $r->id_tasaCambio);
                $tasaCambio_det->__SET('fecha', $r->fecha);
                $tasaCambio_det->__SET('tipoCambio', $r->tipoCambio);
                $tasaCambio_det->__SET('estado', $r->estado);
            
                $result[] = $tasaCambio_det;
            }

            $this->myCon = parent::desconectar();
            return $result;
        } 
        catch (Exception $e) 
        {
            die($e->getMessage());
        }
    }

    public function registrarTasaCambio_det(TasaCambio_det $data)
    {
        try
        {
            $this->myCon = parent::Conectar();
            $sql = "INSERT INTO tasaCambio_det (id_tasaCambio, fecha, tipoCambio, estado)
                VALUES(?,?,?,?)";
            
            $this->myCon->prepare($sql)
            ->execute(array(
                $data->__GET('id_tasaCambio'),
                $data->__GET('fecha'),
                $data->__GET('tipoCambio'),
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