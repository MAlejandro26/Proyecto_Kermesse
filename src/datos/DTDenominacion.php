<?php

include_once("Conexion.php");

class DTDenominacion extends Conexion
{
    private $myCon;

    public function listarDenominacion()
    {
        try 
        {
            $this->myCon = parent::Conectar();
            $result = array();
            $sql = 'SELECT * from tbl_denominacion';

            $stm = $this->myCon->prepare($sql);
            $stm->execute();

            foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
            {
                $denominacion = new Denominacion();
                //SET(CAMPOBD, atributoEntidad)
                $denominacion->__SET('id_Denominacion', $r->id_Denominacion);
                $denominacion->__SET('idMoneda', $r->idMoneda);
                $denominacion->__SET('valor', $r->valor);
                $denominacion->__SET('valor_letras', $r->valor_letras);
                $denominacion->__SET('estado', $r->estado);

                $result[] = $denominacion;
            }

            $this->myCon = parent::desconectar();
            return $result;
        } 
        catch (Exception $e) 
        {
            die($e->getMessage());
        }
    }

    public function registrarDenominacion(Denominacion $data)
    {
        try
        {
            $this->myCon = parent::Conectar();
            $sql = "INSERT INTO tbl_Denominacion (idMoneda, valor, valor_letras, estado)
                VALUES(?,?,?,?)";
            
            $this->myCon->prepare($sql)
            ->execute(array(
                $data->__GET('idMoneda'),
                $data->__GET('valor'),
                $data->__GET('valor_letras'),
                $data->__GET('estado')
            ));

            $this->myCon = parent::desconectar();
        }
        catch(Exception $e)
        {
            die($e->getMessage());
        }
    }

    public function obtenerDenominacion($id_Denominacion)
    {
        try
        {
            $this->myCon = parent::Conectar();
            $sql = "SELECT * from tbl_Denominacion WHERE id_Denominacion = $id_Denominacion";
            
            $stm = $this->myCon->prepare($sql);
            $stm->execute();

            $r = $stm->fetch(PDO::FETCH_OBJ);

            $denominacion = new Denominacion();
            //SET(CAMPOBD, atributoEntidad)
            $denominacion->__SET('id_Denominacion', $r->id_Denominacion);
            $denominacion->__SET('idMoneda', $r->idMoneda);
            $denominacion->__SET('valor', $r->valor);
            $denominacion->__SET('valor_letras', $r->valor_letras);
            $denominacion->__SET('estado', $r->estado);

            return $denominacion;

            $this->myCon = parent::desconectar();
        }
        catch(Exception $e)
        {
            die($e->getMessage());
        }
    }

    public function actualizarDenominacion(Denominacion $data)
    {
        try
        {
            
            $this->myCon = parent::Conectar();
            $sql = "UPDATE tbl_Denominacion SET idMoneda = ?, valor = ?, valor_letras = ?, estado = ? WHERE id_Denominacion = ?";
            

            $this->myCon->prepare($sql)
            ->execute(array(
                $data->__GET('idMoneda'),
                $data->__GET('valor'),
                $data->__GET('valor_letras'),
                $data->__GET('estado'),
                $data->__GET('id_Denominacion'),
            ));

            $this->myCon = parent::desconectar();
        }
        catch(Exception $e)
        {
            die($e->getMessage());
        }
    }

    public function eliminarDenominacion($id_Denominacion)
    {
        try
        {
            $this->myCon = parent::Conectar();
            $sql = "DELETE FROM tbl_Denominacion WHERE id_Denominacion = $id_Denominacion";
            
            $this->myCon->prepare($sql)->execute();

            $this->myCon = parent::desconectar();
        }
        catch(Exception $e)
        {
            die($e->getMessage());
        }
    }
}