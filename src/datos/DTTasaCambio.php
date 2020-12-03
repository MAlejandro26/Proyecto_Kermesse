<?php

include_once("Conexion.php");

class DTTasaCambio extends Conexion
{
    private $myCon;

    public function listarTasaCambio()
    {
        try 
        {
            $this->myCon = parent::Conectar();
            $result = array();
            $sql = 'SELECT * from tbl_tasacambio';

            $stm = $this->myCon->prepare($sql);
            $stm->execute();

            foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
            {
                $tasaCambio = new TasaCambio();
                //SET(CAMPOBD, atributoEntidad)
                $tasaCambio->__SET('id_tasaCambio', $r->id_tasaCambio);
                $tasaCambio->__SET('id_monedaO', $r->id_monedaO);
                $tasaCambio->__SET('id_monedaC', $r->id_monedaC);
                $tasaCambio->__SET('mes', $r->mes);
                $tasaCambio->__SET('anio', $r->anio);
                $tasaCambio->__SET('estado', $r->estado);

                $result[] = $tasaCambio;
            }

            $this->myCon = parent::desconectar();
            return $result;
        } 
        catch (Exception $e) 
        {
            die($e->getMessage());
        }
    }

    public function registrarTasaCambio(TasaCambio $data)
    {
        try
        {
            $this->myCon = parent::Conectar();
            $sql = "INSERT INTO tbl_tasaCambio (id_monedaO, id_monedaC, mes, anio, estado)
                VALUES(?,?,?,?,?)";
            
            $this->myCon->prepare($sql)
            ->execute(array(
                $data->__GET('id_monedaO'),
                $data->__GET('id_monedaC'),
                $data->__GET('mes'),
                $data->__GET('anio'),
                $data->__GET('estado')
            ));

            $this->myCon = parent::desconectar();
        }
        catch(Exception $e)
        {
            die($e->getMessage());
        }
    }

    public function eliminarTasaCambio($id_tasaCambio)
    {
        try
        {
            $this->myCon = parent::Conectar();
            $sql = "DELETE FROM tbl_tasaCambio WHERE id_tasaCambio = $id_tasaCambio";
            
            $this->myCon->prepare($sql)->execute();

            $this->myCon = parent::desconectar();
        }
        catch(Exception $e)
        {
            die($e->getMessage());
        }
    }
}