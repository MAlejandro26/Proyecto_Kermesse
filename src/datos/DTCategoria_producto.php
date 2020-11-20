<?php

include_once("Conexion.php");

class DTCategoria_producto extends Conexion
{
    private $myCon;

    public function listarCategoria_producto()
    {
        try 
        {
            $this->myCon = parent::Conectar();
            $result = array();
            $sql = 'SELECT * from tbl_categoria_producto';

            $stm = $this->myCon->prepare($sql);
            $stm->execute();

            foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
            {
                $categoria_producto = new Categoria_producto();
                //SET(CAMPOBD, atributoEntidad)
                $categoria_producto->__SET('id_categoria_producto', $r->id_categoria_producto);
                $categoria_producto->__SET('nombre', $r->nombre);
                $categoria_producto->__SET('descripcion', $r->descripcion);
                $categoria_producto->__SET('estado', $r->estado);

                $result[] = $categoria_producto;
            }

            $this->myCon = parent::desconectar();
            return $result;
        } 
        catch (Exception $e) 
        {
            die($e->getMessage());
        }
    }

    public function registrarCategoria_producto(Categoria_producto $data)
    {
        try
        {
            $this->myCon = parent::Conectar();
            $sql = "INSERT INTO tbl_categoria_producto (nombre, descripcion, estado)
                VALUES(?,?,?)";
            
            $this->myCon->prepare($sql)
            ->execute(array(
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