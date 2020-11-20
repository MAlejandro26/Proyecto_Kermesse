<?php

include_once("Conexion.php");

class DTCategoria_gasto extends Conexion
{
    private $myCon;

    public function listarCategoria_gasto()
    {
        try 
        {
            $this->myCon = parent::Conectar();
            $result = array();
            $sql = 'SELECT * from tbl_categoria_gastos';

            $stm = $this->myCon->prepare($sql);
            $stm->execute();

            foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
            {
                $CatGasto = new Categoria_Gasto();
                //SET(CAMPOBD, atributoEntidad)
                $CatGasto->__SET('id_categoria_gastos', $r->id_categoria_gastos);
                $CatGasto->__SET('nombre_categoria', $r->nombre_categoria);
                $CatGasto->__SET('descripcion', $r->descripcion);
                $CatGasto->__SET('estado', $r->estado);

                $result[] = $CatGasto;
            }

            $this->myCon = parent::desconectar();
            return $result;
        } 
        catch (Exception $e) 
        {
            die($e->getMessage());
        }
    }

    public function registrarCategoria_gastos(Categoria_gasto $data)
    {
        try
        {
            $this->myCon = parent::Conectar();
            $sql = "INSERT INTO tbl_categoria_gastos (nombre_categoria, descripcion, estado)
                VALUES(?,?,?)";
            
            $this->myCon->prepare($sql)
            ->execute(array(
                $data->__GET('nombre_categoria'),
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