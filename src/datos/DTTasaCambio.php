<?php

include_once("Conexion.php");

class DTTasaCambio extends Conexion
{
    private $myCon;

    public function listarTasaCambio()
    {
        try 
        {
            $this->myCon = parent::Conectar();
            $result = array();
            $sql = 'SELECT * from tbl_tasacambio';

            $stm = $this->myCon->prepare($sql);
            $stm->execute();

            foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
            {
                $tasaCambio = new TasaCambio();
                //SET(CAMPOBD, atributoEntidad)
                $tasaCambio->__SET('id_tasaCambio', $r->id_tasaCambio);
                $tasaCambio->__SET('id_monedaO', $r->id_monedaO);
                $tasaCambio->__SET('id_monedaC', $r->id_monedaC);
                $tasaCambio->__SET('mes', $r->mes);
                $tasaCambio->__SET('anio', $r->anio);
                $tasaCambio->__SET('estado', $r->estado);

                $result[] = $tasaCambio;
            }

            $this->myCon = parent::desconectar();
            return $result;
        } 
        catch (Exception $e) 
        {
            die($e->getMessage());
        }
    }

    public function registrarTasaCambio(TasaCambio $data)
    {
        try
        {
            $this->myCon = parent::Conectar();
            $sql = "INSERT INTO tbl_tasaCambio (id_monedaO, id_monedaC, mes, anio, estado)
                VALUES(?,?,?,?,?)";
            
            $this->myCon->prepare($sql)
            ->execute(array(
                $data->__GET('id_monedaO'),
                $data->__GET('id_monedaC'),
                $data->__GET('mes'),
                $data->__GET('anio'),
                $data->__GET('estado')
            ));

            $this->myCon = parent::desconectar();
        }
        catch(Exception $e)
        {
            die($e->getMessage());
        }
    }

    public function editartasaCambio(tasaCambio $data)
    {
        try {
            $this->myCon = parent::Conectar();
            $sql = "UPDATE dbkermesse.tbl_tasacambio SET 
                    id_monedaO = ?,
                    id_monedaC = ?,
                    mes = ?,
                    anio = ?,
                    estado = ?
                    WHERE id_tasaCambio = ?";

            $this->myCon->prepare($sql)
                ->execute(
                    array(
                        $data->__GET('id_monedaO'),
                        $data->__GET('id_monedaC'),
                        $data->__GET('mes'),
                        $data->__GET('anio'),
                        $data->__GET('estado'),
                        $data->__GET('id_tasaCambio')
                    )
                );
            $this->myCon = parent::desconectar();
        } catch (Exception $e) {
            var_dump($e);
            die($e->getMessage());
        }
    }

    public function obtenertasaCambios($id_tasaCambio)
    {
        try {
            $this->myCon = parent::Conectar();
            $result = array();
            $sql = 'SELECT * from tbl_tasacambio WHERE id_tasaCambio = ?';

            $stm = $this->myCon->prepare($sql);
            $stm->execute(array($id_tasaCambio));

            $r = $stm->fetch(PDO::FETCH_OBJ);

            $tasaCambio = new tasaCambio();
            //SET(CAMPOBD, atributoEntidad)
            $tasaCambio->__SET('id_tasaCambio', $r->id_tasacambio);
            $tasaCambio->__SET('id_monedaO', $r->id_monedaO);
            $tasaCambio->__SET('id_monedaC', $r->id_monedaC);
            $tasaCambio->__SET('mes', $r->mes);
            $tasaCambio->__SET('anio', $r->anio);
            $tasaCambio->__SET('estado', $r->estado);

            $this->myCon = parent::desconectar();
            return $tasaCambio;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function eliminarTasaCambio($id_tasaCambio)
    {
        try
        {
            $this->myCon = parent::Conectar();
            $sql = "DELETE FROM tbl_tasacambio WHERE id_tasaCambio = ?";
            $stm = $this->myCon->prepare($sql);
            $stm ->execute(array($id));

            $this->myCon = parent::desconectar();
        }
        catch(Exception $e)
        {
            die($e->getMessage());
        }
    }
}