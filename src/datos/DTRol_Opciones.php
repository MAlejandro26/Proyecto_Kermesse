<?php

include_once("Conexion.php");

class DTRol_Opcion extends Conexion
{
    private $myCon;

    public function listarRoles_Opciones()
    {
        try 
        {
            $this->myCon = parent::Conectar();
            $result = array();
            $sql = 'SELECT * from rol_opciones';

            $stm = $this->myCon->prepare($sql);
            $stm->execute();

            foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
            {
                $rol_opciones = new Rol_Opciones();
                //SET(CAMPOBD, atributoEntidad)
                $rol_opciones->__SET('id_rol_opciones', $r->id_rol_opciones);
                $rol_opciones->__SET('tbl_rol_id_rol', $r->tbl_rol_id_rol);
                $rol_opciones->__SET('tbl_opciones_id_opciones', $r->tbl_opciones_id_opciones);

                $result[] = $rol_opciones;
            }

            $this->myCon = parent::desconectar();
            return $result;
        } 
        catch (Exception $e) 
        {
            die($e->getMessage());
        }
    }

    public function registrarRol_Opciones(Rol_Opcion $data)
    {
        try
        {
            $this->myCon = parent::Conectar();
            $sql = "INSERT INTO rol_opciones (tbl_rol_id_rol, tbl_opciones_id_opciones)
                VALUES(?,?)";
            
            $this->myCon->prepare($sql)
            ->execute(array(
                $data->__GET('tbl_rol_id_rol'),
                $data->__GET('tbl_opciones_id_opciones')
            ));

            $this->myCon = parent::desconectar();
        }
        catch(Exception $e)
        {
            die($e->getMessage());
        }
    }
}