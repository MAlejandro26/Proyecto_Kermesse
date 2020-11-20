<?php

include_once("Conexion.php");

class DTIngreso_Comunidad_Det extends Conexion
{
    private $myCon;

    public function listarIngresos_Comu_Det()
    {
        try 
        {
            $this->myCon = parent::Conectar();
            $result = array();
            $sql = 'SELECT * from tbl_ingreso_comunidad_det';

            $stm = $this->myCon->prepare($sql);
            $stm->execute();

            foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
            {
                $ingreso_comunidad_det = new Ingreso_Comunidad_Det();
                //SET(CAMPOBD, atributoEntidad)
                $ingreso_comunidad_det->__SET('id_ingreso_comunidad_det', $r->id_ingreso_comunidad_det);
                $ingreso_comunidad_det->__SET('id_ingreso_comunidad', $r->id_ingreso_comunidad);
                $ingreso_comunidad_det->__SET('id_bono', $r->id_bono);
                $ingreso_comunidad_det->__SET('denominacion', $r->denominacion);
                $ingreso_comunidad_det->__SET('cantidad', $r->cantidad);
                $ingreso_comunidad_det->__SET('subtotal_bono', $r->subtotal_bono);
                
                $result[] = $ingreso_comunidad_det;
            }

            $this->myCon = parent::desconectar();
            return $result;
        } 
        catch (Exception $e) 
        {
            die($e->getMessage());
        }
    }

    public function registrarIngreso_Comunidad_Det(Ingreso_Comunidad_Det $data)
    {
        try
        {
            $this->myCon = parent::Conectar();
            $sql = "INSERT INTO tbl_ingreso_comunidad_det (id_ingreso_comunidad, id_bono, denominacion, cantidad, subtotal_bono)
                VALUES(?,?,?,?,?)";
            
            $this->myCon->prepare($sql)
            ->execute(array(
                $data->__GET('id_ingreso_comunidad'),
                $data->__GET('id_bono'),
                $data->__GET('denominacion'),
                $data->__GET('cantidad'),
                $data->__GET('subtotal_bono')
            ));

            $this->myCon = parent::desconectar();
        }
        catch(Exception $e)
        {
            die($e->getMessage());
        }
    }
}