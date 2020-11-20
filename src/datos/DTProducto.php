<?php

include_once("Conexion.php");

class DTProducto extends Conexion
{
    private $myCon;

    public function listarProductos()
    {
        try 
        {
            $this->myCon = parent::Conectar();
            $result = array();
            $sql = 'SELECT * from tbl_productos';

            $stm = $this->myCon->prepare($sql);
            $stm->execute();

            foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
            {
                $producto = new Producto();
                //SET(CAMPOBD, atributoEntidad)
                $producto->__SET('id_producto', $r->id_producto);
                $producto->__SET('id_comunidad', $r->id_comunidad);
                $producto->__SET('id_cat_producto', $r->id_cat_producto);
                $producto->__SET('nombre', $r->nombre);
                $producto->__SET('descripcion', $r->descripcion);
                $producto->__SET('cantidad', $r->cantidad);
                $producto->__SET('preciov_sugerido', $r->preciov_sugerido);
                $producto->__SET('estado', $r->estado);

                $result[] = $producto;
            }

            $this->myCon = parent::desconectar();
            return $result;
        } 
        catch (Exception $e) 
        {
            die($e->getMessage());
        }
    }

    public function registrarProductos(Producto $data)
    {
        try
        {
            $this->myCon = parent::Conectar();
            $sql = "INSERT INTO tbl_productos (id_comunidad, id_cat_producto, nombre, descripcion, cantidad, preciov_sugerido, estado)
                VALUES(?,?,?,?,?,?,?)";
            
            $this->myCon->prepare($sql)
            ->execute(array(
                $data->__GET('id_comunidad'),
                $data->__GET('id_cat_producto'),
                $data->__GET('nombre'),
                $data->__GET('descripcion'),
                $data->__GET('cantidad'),
                $data->__GET('preciov_sugerido'),
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