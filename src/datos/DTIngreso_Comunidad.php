<?php

include_once("Conexion.php");

class DTIngreso_Comunidad extends Conexion
{
    private $myCon;

    public function listarIngresos_Comunidad()
    {
        try 
        {
            $this->myCon = parent::Conectar();
            $result = array();
            $sql = 'SELECT * from tbl_ingreso_comunidad';

            $stm = $this->myCon->prepare($sql);
            $stm->execute();

            foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
            {
                $ingreso_comunidad = new Ingreso_Comunidad();
                //SET(CAMPOBD, atributoEntidad)
                $ingreso_comunidad->__SET('id_ingreso_comunidad', $r->id_ingreso_comunidad);
                $ingreso_comunidad->__SET('id_kermesse', $r->id_kermesse);
                $ingreso_comunidad->__SET('id_comunidad', $r->id_comunidad);
                $ingreso_comunidad->__SET('id_producto', $r->id_producto);
                $ingreso_comunidad->__SET('cant_productos', $r->cant_productos);
                $ingreso_comunidad->__SET('total_bonos', $r->total_bonos);
                $ingreso_comunidad->__SET('usuario_creacion', $r->usuario_creacion);
                $ingreso_comunidad->__SET('fecha_creacion', $r->fecha_creacion);
                $ingreso_comunidad->__SET('usuario_modificacion', $r->usuario_modificacion);
                $ingreso_comunidad->__SET('fecha_modificacion', $r->fecha_modificacion);
                $ingreso_comunidad->__SET('usuario_eliminacion', $r->usuario_eliminacion);
                $ingreso_comunidad->__SET('fecha_eliminacion', $r->fecha_eliminacion);
                
                $result[] = $ingreso_comunidad;
            }

            $this->myCon = parent::desconectar();
            return $result;
        } 
        catch (Exception $e) 
        {
            die($e->getMessage());
        }
    }

    public function registrarIngreso_Comunidad(Ingreso_Comunidad $data)
    {
        try
        {
            $this->myCon = parent::Conectar();
            $sql = "INSERT INTO tbl_ingreso_comunidad (id_kermesse, id_comunidad, id_producto, cant_productos, total_bonos, usuario_creacion, fecha_creacion, usuario_modificacion, fecha_modificacion, usuario_eliminacion, fecha_eliminacion)
                VALUES(?,?,?,?,?,?,?,?,?,?,?)";
            
            $this->myCon->prepare($sql)
            ->execute(array(
                $data->__GET('id_kermesse'),
                $data->__GET('id_comunidad'),
                $data->__GET('id_producto'),
                $data->__GET('cant_productos'),
                $data->__GET('total_bonos'),
                $data->__GET('usuario_creacion'),
                $data->__GET('fecha_creacion'),
                $data->__GET('usuario_modificacion'),
                $data->__GET('fecha_modificacion'),
                $data->__GET('usuario_eliminacion'),
                $data->__GET('fecha_eliminacion')
            ));

            $this->myCon = parent::desconectar();
        }
        catch(Exception $e)
        {
            die($e->getMessage());
        }
    }
}