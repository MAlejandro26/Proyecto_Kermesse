<?php

include_once("Conexion.php");

class DTArqueoCaja extends Conexion
{
    private $myCon;

    public function listarArqueoCaja()
    {
        try 
        {
            $this->myCon = parent::Conectar();
            $result = array();
            $sql = 'SELECT * from tbl_ArqueoCaja';

            $stm = $this->myCon->prepare($sql);
            $stm->execute();

            foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
            {
                $arqueoCaja = new ArqueoCaja();
                //SET(CAMPOBD, atributoEntidad)
                $arqueoCaja->__SET('id_ArqueoCaja', $r->id_ArqueoCaja);
                $arqueoCaja->__SET('idKermesse', $r->idKermesse);
                $arqueoCaja->__SET('fechaArqueo', $r->fechaArqueo);
                $arqueoCaja->__SET('granTotal', $r->granTotal);
                $arqueoCaja->__SET('usuario_creacion', $r->usuario_creacion);
                $arqueoCaja->__SET('fecha_creacion', $r->fecha_creacion);
                $arqueoCaja->__SET('usuario_modificacion', $r->usuario_modificacion);
                $arqueoCaja->__SET('fecha_modificacion', $r->fecha_modificacion);
                $arqueoCaja->__SET('usuario_eliminacion',$r->usuario_eliminacion);
                $arqueoCaja->__SET('fecha_eliminacion',$r->fecha_eliminacion);
                $arqueoCaja->__SET('estado',$r->estado);

                $result[] = $arqueoCaja;
            }

            $this->myCon = parent::desconectar();
            return $result;
        } 
        catch (Exception $e) 
        {
            die($e->getMessage());
        }
    }

    public function registrarArqueoCaja(ArqueoCaja $data)
    {
        try
        {
            $this->myCon = parent::Conectar();
            $sql = "INSERT INTO tbl_ArqueoCaja (idkermesse, fechaArqueo, granTotal, usuario_creacion, fecha_creacion, estado)
                VALUES(?,?,?,?,?,?)";
            
            $this->myCon->prepare($sql)
            ->execute(array(
                $data->__GET('idkermesse'),
                $data->__GET('fechaArqueo'),
                $data->__GET('granTotal'),
                $data->__GET('usuario_creacion'),
                $data->__GET('fecha_creacion'),
                /*$data->__GET('usuario_modificacion'),
                $data->__GET('fecha_modificacion'),
                $data->__GET('usuario_eliminacion'),
                $data->__GET('fecha_eliminacion'),*/
                $data->__GET('estado')
            ));

            $this->myCon = parent::desconectar();
        }
        catch(Exception $e)
        {
            die($e->getMessage());
        }
    }

    public function obtenerArqueoCaja($id_ArqueoCaja)
    {
        try
        {
            $this->myCon = parent::Conectar();
            $sql = "SELECT * from tbl_arqueocaja WHERE id_ArqueoCaja = $id_ArqueoCaja";
            
            $stm = $this->myCon->prepare($sql);
            $stm->execute();

            $r = $stm->fetch(PDO::FETCH_OBJ);

            $arqueoCaja = new ArqueoCaja();
            //SET(CAMPOBD, atributoEntidad)
            $arqueoCaja->__SET('id_ArqueoCaja', $r->id_ArqueoCaja);
            $arqueoCaja->__SET('idKermesse', $r->idKermesse);
            $arqueoCaja->__SET('fechaArqueo', $r->fechaArqueo);
            $arqueoCaja->__SET('granTotal', $r->granTotal);
            $arqueoCaja->__SET('usuario_creacion', $r->usuario_creacion);
            $arqueoCaja->__SET('fecha_creacion', $r->fecha_creacion);
            $arqueoCaja->__SET('usuario_modificacion', $r->usuario_modificacion);
            $arqueoCaja->__SET('fecha_modificacion', $r->fecha_modificacion);
            $arqueoCaja->__SET('usuario_eliminacion',$r->usuario_eliminacion);
            $arqueoCaja->__SET('fecha_eliminacion',$r->fecha_eliminacion);
            $arqueoCaja->__SET('estado',$r->estado);

            return $arqueoCaja;

            $this->myCon = parent::desconectar();
        }
        catch(Exception $e)
        {
            die($e->getMessage());
        }
    }
    public function actualizarArqueoCaja(ArqueoCaja $data)
    {
        try
        {
            
            $this->myCon = parent::Conectar();
            $sql = "UPDATE tbl_arqueoCaja SET usuario_modificacion = ?, fecha_modificacion = ? WHERE id_ArqueoCaja = ?";
            

            $this->myCon->prepare($sql)
            ->execute(array(
                $data->__GET('usuario_modificacion'),
                $data->__GET('fecha_modificacion'),
            ));

            $this->myCon = parent::desconectar();
        }
        catch(Exception $e)
        {
            die($e->getMessage());
        }
    }

    public function eliminarArqueoCaja($id_ArqueoCaja)
    {
        try
        {
            $this->myCon = parent::Conectar();
            $sql = "DELETE FROM tbl_arqueocaja WHERE id_ArqueoCaja = $id_ArqueoCaja";
            
            $this->myCon->prepare($sql)->execute();

            $this->myCon = parent::desconectar();
        }
        catch(Exception $e)
        {
            die($e->getMessage());
        }
    }
}