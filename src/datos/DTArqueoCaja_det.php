<?php

include_once("Conexion.php");

class DTArqueoCaja_det extends Conexion
{
    private $myCon;

    public function listarArqueoCaja_det()
    {
        try 
        {
            $this->myCon = parent::Conectar();
            $result = array();
            $sql = 'SELECT * from tbl_ArqueoCaja_det';

            $stm = $this->myCon->prepare($sql);
            $stm->execute();

            foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
            {
                $arqueoCaja_det = new ArqueoCaja_det();
                //SET(CAMPOBD, atributoEntidad)
                $arqueoCaja_det->__SET('idArqueoCaja_det', $r->idArqueoCaja_det);
                $arqueoCaja_det->__SET('idArqueoCaja', $r->idArqueoCaja);
                $arqueoCaja_det->__SET('idMoneda', $r->idMoneda);
                $arqueoCaja_det->__SET('idDenominacion', $r->idDenominacion);
                $arqueoCaja_det->__SET('cantidad', $r->cantidad);
                $arqueoCaja_det->__SET('subtotal', $r->subtotal);

                $result[] = $arqueoCaja_det;
            }

            $this->myCon = parent::desconectar();
            return $result;
        } 
        catch (Exception $e) 
        {
            die($e->getMessage());
        }
    }

    public function registrarArqueoCaja_det(ArqueoCaja_det $data)
    {
        try
        {
            $this->myCon = parent::Conectar();
            $sql = "INSERT INTO tbl_ArqueoCaja_Det (idArqueoCaja, idMoneda, idDenominacion, cantidad, subtotal)
                VALUES(?,?,?,?,?)";
            
            $this->myCon->prepare($sql)
            ->execute(array(
                $data->__GET('idArqueoCaja'),
                $data->__GET('idMoneda'),
                $data->__GET('idDenominacion'),
                $data->__GET('cantidad'),
                $data->__GET('subtotal')
            ));

            $this->myCon = parent::desconectar();
        }
        catch(Exception $e)
        {
            die($e->getMessage());
        }
    }

    public function eliminarArqueoCaja_det($idArqueoCaja_Det)
    {
        try
        {
            $this->myCon = parent::Conectar();
            $sql = "DELETE FROM tbl_ArqueoCaja_Det WHERE idArqueoCaja_det = $idArqueoCaja_Det";
            
            $this->myCon->prepare($sql)->execute();

            $this->myCon = parent::desconectar();
        }
        catch(Exception $e)
        {
            die($e->getMessage());
        }
    }
}