<?php

include_once("Conexion.php");

class DTLista_precio extends Conexion
{
    private $myCon;

    public function listarLista_precio()
    {
        try 
        {
            $this->myCon = parent::Conectar();
            $result = array();
            $sql = 'SELECT * from tbl_lista_precio';

            $stm = $this->myCon->prepare($sql);
            $stm->execute();

            foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
            {
                $Lista_precio = new Lista_precio();
                //SET(CAMPOBD, atributoEntidad)
                $Lista_precio->__SET('id_lista_precio', $r->id_lista_precio);
                $Lista_precio->__SET('id_kermesse', $r->id_kermesse);
                $Lista_precio->__SET('nombre', $r->nombre);
                $Lista_precio->__SET('descripcion', $r->descripcion);
                $Lista_precio->__SET('estado', $r->estado);

                $result[] = $Lista_precio;
            }

            $this->myCon = parent::desconectar();
            return $result;
        } 
        catch (Exception $e) 
        {
            die($e->getMessage());
        }
    }

    public function registrarLista_precio(Lista_precio $data)
    {
        try
        {
            $this->myCon = parent::Conectar();
            $sql = "INSERT INTO tbl_lista_precio (id_kermesse, nombre, descripcion, estado)
                VALUES(?,?,?,?)";
            
            $this->myCon->prepare($sql)
            ->execute(array(
                $data->__GET('id_kermesse'),
                $data->__GET('nombre'),
                $data->__GET('descripcion'),
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