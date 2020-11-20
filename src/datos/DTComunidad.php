<?php

include_once("Conexion.php");

class DTComunidad extends Conexion
{
    private $myCon;

    public function listarComunidades()
    {
        try 
        {
            $this->myCon = parent::Conectar();
            $result = array();
            $sql = 'SELECT * from tbl_comunidad';

            $stm = $this->myCon->prepare($sql);
            $stm->execute();

            foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
            {
                $comunidad = new Comunidad();
                //SET(CAMPOBD, atributoEntidad)
                $comunidad->__SET('id_comunidad', $r->id_comunidad);
                $comunidad->__SET('nombre', $r->nombre);
                $comunidad->__SET('responsable', $r->responsable);
                $comunidad->__SET('desc_contribucion', $r->desc_contribucion);
                $comunidad->__SET('estado', $r->estado);
                
                $result[] = $comunidad;
            }

            $this->myCon = parent::desconectar();
            return $result;
        } 
        catch (Exception $e) 
        {
            die($e->getMessage());
        }
    }

    public function registrarComunidad(Comunidad $data)
    {
        try
        {
            $this->myCon = parent::Conectar();
            $sql = "INSERT INTO tbl_comunidad (nombre, responsable, desc_contribucion, estado)
                VALUES(?,?,?,?)";
            
            $this->myCon->prepare($sql)
            ->execute(array(
                $data->__GET('nombre'),
                $data->__GET('responsable'),
                $data->__GET('desc_contribucion'),
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