<?php

include_once("Conexion.php");

class DTParroquia extends Conexion
{
    private $myCon;

    public function listarParroquias()
    {
        try 
        {
            $this->myCon = parent::Conectar();
            $result = array();
            $sql = 'SELECT * from tbl_parroquia';

            $stm = $this->myCon->prepare($sql);
            $stm->execute();

            foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
            {
                $parroquia = new Parroquia();
                //SET(CAMPOBD, atributoEntidad)
                $parroquia->__SET('idParroquia', $r->idParroquia);
                $parroquia->__SET('nombre', $r->nombre);
                $parroquia->__SET('direccion', $r->direccion);
                $parroquia->__SET('telefono', $r->telefono);
                $parroquia->__SET('parroco', $r->parroco);
                $parroquia->__SET('logo', $r->logo);
                $parroquia->__SET('sitio_web', $r->sitio_web);
                

                $result[] = $parroquia;
            }

            $this->myCon = parent::desconectar();
            return $result;
        } 
        catch (Exception $e) 
        {
            die($e->getMessage());
        }
    }

    public function registrarParroquia(Parroquia $data)
    {
        try
        {
            $this->myCon = parent::Conectar();
            $sql = "INSERT INTO tbl_parroquia (nombre, direccion, telefono, parroco, logo, sitio_web)
                VALUES(?,?,?,?,?,?)";
            
            $this->myCon->prepare($sql)
            ->execute(array(
                $data->__GET('nombre'),
                $data->__GET('direccion'),
                $data->__GET('telefono'),
                $data->__GET('parroco'),
                $data->__GET('logo'),
                $data->__GET('sitio_web')
            ));

            $this->myCon = parent::desconectar();
        }
        catch(Exception $e)
        {
            die($e->getMessage());
        }
    }
}