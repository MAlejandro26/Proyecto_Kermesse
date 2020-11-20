<?php

include_once("Conexion.php");

class DTRol extends Conexion
{
    private $myCon;

    public function listarRoles()
    {
        try 
        {
            $this->myCon = parent::Conectar();
            $result = array();
            $sql = 'SELECT * from tbl_rol';

            $stm = $this->myCon->prepare($sql);
            $stm->execute();

            foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
            {
                $rol = new rol();
                //SET(CAMPOBD, atributoEntidad)
                $rol->__SET('id_rol', $r->id_rol);
                $rol->__SET('rol_descripcion', $r->rol_descripcion);
                $rol->__SET('estado', $r->estado);

                $result[] = $rol;
            }

            $this->myCon = parent::desconectar();
            return $result;
        } 
        catch (Exception $e) 
        {
            die($e->getMessage());
        }
    }

    public function registrarRol(Rol $data)
    {
        try
        {
            $this->myCon = parent::Conectar();
            $sql = "INSERT INTO tbl_rol (rol_descripcion, estado)
                VALUES(?,?)";
            
            $this->myCon->prepare($sql)
            ->execute(array(
                $data->__GET('rol_descripcion'),
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