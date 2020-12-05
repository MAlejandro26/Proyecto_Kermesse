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


    public function editarArqueoCaja_det(ArqueoCaja_det $data)
    {
        try {
            $this->myCon = parent::Conectar();
            $sql = "UPDATE tbl_ArqueoCaja_Det SET 
                    idArqueoCaja = ?,
                    idMoneda = ?,
                    idDenominacion = ?,
                    cantidad = ?,
                    subtotal = ?
                    WHERE idArqueoCaja_Det = ?";

            $this->myCon->prepare($sql)
                ->execute(
                    array(
                        $data->__GET('idArqueoCaja'),
                        $data->__GET('idMoneda'),
                        $data->__GET('idDenominacion'),
                        $data->__GET('cantidad'),
                        $data->__GET('subtotal'),
                        $data->__GET('idArqueoCaja_Det')
                    )
                );
            $this->myCon = parent::desconectar();
        } catch (Exception $e) {
            var_dump($e);
            die($e->getMessage());
        }
    }

    public function obtenerArqueoCaja_det($id)
    {
        try {
            $this->myCon = parent::Conectar();
            $result = array();
            $sql = 'SELECT * from tbl_ArqueoCaja_Det WHERE idArqueoCaja_Det = ?';

            $stm = $this->myCon->prepare($sql);
            $stm->execute(array($id));

            $r = $stm->fetch(PDO::FETCH_OBJ);

            $ArqueoCaja_det = new ArqueoCaja_det();
            //SET(CAMPOBD, atributoEntidad)
            $ArqueoCaja_det->__SET('idArqueoCaja_Det', $r->idArqueoCaja_Det);
            $ArqueoCaja_det->__SET('idArqueoCaja', $r->idArqueoCaja);
            $ArqueoCaja_det->__SET('idMoneda', $r->idMoneda);
            $ArqueoCaja_det->__SET('idDenominacion', $r->idDenominacion);
            $ArqueoCaja_det->__SET('cantidad', $r->cantidad);
            $ArqueoCaja_det->__SET('subtotal', $r->subtotal);

            $this->myCon = parent::desconectar();
            return $ArqueoCaja_det;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function eliminarArqueoCaja_Det($id)
    {
        try 
        {
            $this->myCon = parent::Conectar();
            $sql = "DELETE FROM tbl_ArqueoCaja_Det where id = ?";
            $stm = $this->myCon->prepare($sql);
            $stm->execute(array($id));

            $this->myCon = parent::desconectar();
        } 
        catch (Exception $e) 
        {
            die($e->getMessage());
        }
    }
}