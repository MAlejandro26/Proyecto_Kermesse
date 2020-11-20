<?php

include_once("Conexion.php");

class DTRol_Usuario extends Conexion
{
    private $myCon;

    public function listarRoles_Usuarios()
    {
        try 
        {
            $this->myCon = parent::Conectar();
            $result = array();
            $sql = 'SELECT * from rol_usuario';

            $stm = $this->myCon->prepare($sql);
            $stm->execute();

            foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
            {
                $rol_usuario = new Rol_Usuario();
                //SET(CAMPOBD, atributoEntidad)
                $rol_usuario->__SET('id_rol_usuario', $r->id_rol_usuario);
                $rol_usuario->__SET('tbl_usuario_id_usuario', $r->tbl_usuario_id_usuario);
                $rol_usuario->__SET('tbl_rol_id_rol', $r->tbl_rol_id_rol);

                $result[] = $rol_usuario;
            }

            $this->myCon = parent::desconectar();
            return $result;
        } 
        catch (Exception $e) 
        {
            die($e->getMessage());
        }
    }

    public function registrarRol_Usuario(Rol_Usuario $data)
    {
        try
        {
            $this->myCon = parent::Conectar();
            $sql = "INSERT INTO rol_usuario (tbl_usuario_id_usuario, tbl_rol_id_rol)
                VALUES(?,?)";
            
            $this->myCon->prepare($sql)
            ->execute(array(
                $data->__GET('tbl_usuario_id_usuario'),
                $data->__GET('tbl_rol_id_rol')
            ));

            $this->myCon = parent::desconectar();
        }
        catch(Exception $e)
        {
            die($e->getMessage());
        }
    }
}