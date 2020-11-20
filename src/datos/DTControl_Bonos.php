<?php

include_once("Conexion.php");

class DTControl_Bonos extends Conexion
{
    private $myCon;

    public function listarControl_Bonos()
    {
        try 
        {
            $this->myCon = parent::Conectar();
            $result = array();
            $sql = 'SELECT * from tbl_control_bonos';

            $stm = $this->myCon->prepare($sql);
            $stm->execute();

            foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
            {
                $control_bonos = new Control_Bonos();
                //SET(CAMPOBD, atributoEntidad)
                $control_bonos->__SET('id_bono', $r->id_bono);
                $control_bonos->__SET('nombre', $r->nombre);
                $control_bonos->__SET('valor', $r->valor);
                $control_bonos->__SET('estado', $r->estado);
                
                $result[] = $control_bonos;
            }

            $this->myCon = parent::desconectar();
            return $result;
        } 
        catch (Exception $e) 
        {
            die($e->getMessage());
        }
    }

    public function registrarControl_Bonos(Control_Bono $data)
    {
        try
        {
            $this->myCon = parent::Conectar();
            $sql = "INSERT INTO tbl_control_bonos (nombre, valor, estado)
                VALUES(?,?,?)";
            
            $this->myCon->prepare($sql)
            ->execute(array(
                $data->__GET('nombre'),
                $data->__GET('valor'),
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