<?php

include_once("Conexion.php");

class DTOpcion extends Conexion
{
    private $myCon;

    public function listarOpciones()
    {
        try 
        {
            $this->myCon = parent::Conectar();
            $result = array();
            $sql = 'SELECT * from tbl_opciones';

            $stm = $this->myCon->prepare($sql);
            $stm->execute();

            foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
            {
                $opcion = new Opcion();
                //SET(CAMPOBD, atributoEntidad)
                $opcion->__SET('id_opciones', $r->id_opciones);
                $opcion->__SET('opcion_descripcion', $r->opcion_descripcion);
                $opcion->__SET('estado', $r->estado);
                
                $result[] = $opcion;
            }

            $this->myCon = parent::desconectar();
            return $result;
        } 
        catch (Exception $e) 
        {
            die($e->getMessage());
        }
    }

    public function registrarOpcion(Opcion $data)
    {
        try
        {
            $this->myCon = parent::Conectar();
            $sql = "INSERT INTO tbl_opciones (opcion_descripcion, estado)
                VALUES(?,?)";
            
            $this->myCon->prepare($sql)
            ->execute(array(
                $data->__GET('opcion_descripcion'),
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