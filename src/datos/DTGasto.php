<?php

include_once("Conexion.php");

class DTGasto extends Conexion
{
    private $myCon;

    public function listarGatos()
    {
        try 
        {
            $this->myCon = parent::Conectar();
            $result = array();
            $sql = 'SELECT * from tbl_gastos';

            $stm = $this->myCon->prepare($sql);
            $stm->execute();

            foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
            {
                $gasto = new Gasto();
                //SET(CAMPOBD, atributoEntidad)
                $gasto->__SET('id_registro_gastos', $r->id_registro_gastos);
                $gasto->__SET('idKermesse', $r->idKermesse);
                $gasto->__SET('idCatGastos', $r->idCatGastos);
                $gasto->__SET('fechaGasto', $r->fechaGasto);
                $gasto->__SET('concepto', $r->concepto);
                $gasto->__SET('monto', $r->monto);
                $gasto->__SET('usuario_creacion', $r->usuario_creacion);
                $gasto->__SET('fecha_creacion',$r->fecha_creacion);
                $gasto->__SET('usuario_modificacion',$r->usuario_modificacion);
                $gasto->__SET('fecha_modificacion',$r->fecha_modificacion);
                $gasto->__SET('usuario_eliminacion',$r->usuario_eliminacion);
                $gasto->__SET('fecha_eliminacion',$r->fecha_eliminacion);
                $gasto->__SET('estado',$r->estado);

                $result[] = $gasto;
            }

            $this->myCon = parent::desconectar();
            return $result;
        } 
        catch (Exception $e) 
        {
            die($e->getMessage());
        }
    }

    public function registrarGastos(Gasto $data)
    {
        try
        {
            $this->myCon = parent::Conectar();
            $sql = "INSERT INTO tbl_gastos (idKermesse, idCatGastos, fechaGasto, concepto, monto, usuario_creacion, fecha_creacion, usuario_modificacion, fecha_modificacion, usuario_eliminacion, fecha_eliminacion, estado)
                VALUES(?,?,?,?,?,?,?,?,?,?,?,?)";
            
            $this->myCon->prepare($sql)
            ->execute(array(
                $data->__GET('idKermesse'),
                $data->__GET('idCatGastos'),
                $data->__GET('fechaGasto'),
                $data->__GET('concepto'),
                $data->__GET('monto'),
                $data->__GET('usuario_creacion'),
                $data->__GET('fecha_creacion'),
                $data->__GET('usuario_modificacion'),
                $data->__GET('fecha_modificacion'),
                $data->__GET('usuario_eliminacion'),
                $data->__GET('fecha_eliminacion'),
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