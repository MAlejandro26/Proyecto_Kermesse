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
            $sql = "INSERT INTO tasaCambio_det (id_tasaCambio, tipoCambio, estado)
                VALUES(?,?,?)";
            
            $this->myCon->prepare($sql)
            ->execute(array(
                $data->__GET('id_tasaCambio'),
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

    public function obtenerTasaCambio_det($id_tasaCambio_det)
    {
        try
        {
            $this->myCon = parent::Conectar();
            $sql = "SELECT * from tasaCambio_det WHERE id_tasaCambio_det = $id_tasaCambio_det";
            
            $stm = $this->myCon->prepare($sql);
            $stm->execute();

            $r = $stm->fetch(PDO::FETCH_OBJ);

            $tasaCambio_det = new TasaCambio_det();
            //SET(CAMPOBD, atributoEntidad)
            $tasaCambio_det->__SET('id_tasaCambio_det', $r->id_tasaCambio_det);
            $tasaCambio_det->__SET('fecha', $r->fecha);
            $tasaCambio_det->__SET('id_tasaCambio', $r->id_tasaCambio);
            $tasaCambio_det->__SET('tipoCambio', $r->tipoCambio);
            $tasaCambio_det->__SET('estado', $r->estado);

            return $tasaCambio_det;

            $this->myCon = parent::desconectar();
        }
        catch(Exception $e)
        {
            die($e->getMessage());
        }
    }

    public function actualizarTasaCambio_det(TasaCambio_det $data)
    {
        try
        {
            
            $this->myCon = parent::Conectar();
            $sql = "UPDATE tasaCambio_det SET id_tasaCambio = ?, fecha = ?, tipoCambio = ?, estado = ? WHERE id_tasaCambio_det = ?";
            

            $this->myCon->prepare($sql)
            ->execute(array(
                $data->__GET('id_tasaCambio'),
                $data->__GET('fecha'),
                $data->__GET('tipoCambio'),
                $data->__GET('estado'),
                $data->__GET('id_tasaCambio_det')
            ));

            $this->myCon = parent::desconectar();
        }
        catch(Exception $e)
        {
            die($e->getMessage());
        }
    }

    public function eliminarTasaCambio_det($id_tasaCambio_det)
    {
        try
        {
            $this->myCon = parent::Conectar();
            $sql = "DELETE FROM tasaCambio_det WHERE id_tasaCambio_det = $id_tasaCambio_det";
            
            $this->myCon->prepare($sql)->execute();

            $this->myCon = parent::desconectar();
        }
        catch(Exception $e)
        {
            die($e->getMessage());
        }
    }
}