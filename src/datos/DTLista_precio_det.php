<?php

include_once("Conexion.php");

class DTLista_precio_det extends Conexion
{
    private $myCon;

    public function listarLista_precio_det()
    {
        try 
        {
            $this->myCon = parent::Conectar();
            $result = array();
            $sql = 'SELECT * from tbl_ListaPrecio_det';

            $stm = $this->myCon->prepare($sql);
            $stm->execute();

            foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
            {
                $ListaPrecio_det = new Lista_precio_det();
                //SET(CAMPOBD, atributoEntidad)
                $ListaPrecio_det->__SET('id_listaprecio_det', $r->id_listaprecio_det);
                $ListaPrecio_det->__SET('id_lista_precio', $r->id_lista_precio);
                $ListaPrecio_det->__SET('id_producto', $r->id_producto);
                $ListaPrecio_det->__SET('precio_venta', $r->precio_venta);

                $result[] = $ListaPrecio_det;
            }

            $this->myCon = parent::desconectar();
            return $result;
        } 
        catch (Exception $e) 
        {
            die($e->getMessage());
        }
    }

    public function registrarListaPrecio_det(Lista_precio_det $data)
    {
        try
        {
            $this->myCon = parent::Conectar();
            $sql = "INSERT INTO tbl_ListaPrecio_det (id_listaprecio_det, id_lista_precio, id_producto, precio_venta)
                VALUES(?,?,?)";
            
            $this->myCon->prepare($sql)
            ->execute(array(
                $data->__GET('id_lista_precio'),
                $data->__GET('id_producto'),
                $data->__GET('precio_venta')
            ));

            $this->myCon = parent::desconectar();
        }
        catch(Exception $e)
        {
            die($e->getMessage());
        }
    }
}