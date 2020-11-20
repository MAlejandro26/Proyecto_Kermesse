<?php

include_once("Conexion.php");

class DTKermesse extends Conexion
{
    private $myCon;

    public function listarKermesses()
    {
        try 
        {
            $this->myCon = parent::Conectar();
            $result = array();
            $sql = 'SELECT * from tbl_kermesse';

            $stm = $this->myCon->prepare($sql);
            $stm->execute();

            foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
            {
                $kermesse = new Kermesse();
                //SET(CAMPOBD, atributoEntidad)
                $kermesse->__SET('id_kermesse', $r->id_kermesse);
                $kermesse->__SET('idParroquia', $r->idParroquia);
                $kermesse->__SET('nombre', $r->nombre);
                $kermesse->__SET('fInicio', $r->fInicio);
                $kermesse->__SET('fFinal', $r->fFinal);
                $kermesse->__SET('descripcion', $r->descripcion);
                $kermesse->__SET('estado', $r->estado);
                $kermesse->__SET('usuario_creacion', $r->usuario_creacion);
                $kermesse->__SET('fecha_creacion', $r->fecha_creacion);
                $kermesse->__SET('usuario_modificacion', $r->usuario_modificacion);
                $kermesse->__SET('fecha_modificacion', $r->fecha_modificacion);
                $kermesse->__SET('usuario_eliminacion', $r->usuario_eliminacion);
                $kermesse->__SET('fecha_eliminacion', $r->fecha_eliminacion);
                
                $result[] = $kermesse;
            }

            $this->myCon = parent::desconectar();
            return $result;
        } 
        catch (Exception $e) 
        {
            die($e->getMessage());
        }
    }

    public function registrarkermesse(Kermesse $data)
    {
        try
        {
            $this->myCon = parent::Conectar();
            $sql = "INSERT INTO tbl_kermesse (idParroquia, nombre, fInicio, fFinal, descripcion, estado, usuario_creacion, fecha_creacion, usuario_modificacion, fecha_modificacion, usuario_eliminacion, fecha_eliminacion)
                VALUES(?,?,?,?,?,?,?,?,?,?,?,?)";
            
            $this->myCon->prepare($sql)
            ->execute(array(
                $data->__GET('idParroquia'),
                $data->__GET('nombre'),
                $data->__GET('fInicio'),
                $data->__GET('fFinal'),
                $data->__GET('descripcion'),
                $data->__GET('estado'),
                $data->__GET('usuario_creacion'),
                $data->__GET('fecha_creacion'),
                $data->__GET('usuario_modificacion'),
                $data->__GET('fecha_modificacion'),
                $data->__GET('usuario_eliminacion'),
                $data->__GET('fecha_eliminacion')
            ));

            $this->myCon = parent::desconectar();
        }
        catch(Exception $e)
        {
            die($e->getMessage());
        }
    }
}