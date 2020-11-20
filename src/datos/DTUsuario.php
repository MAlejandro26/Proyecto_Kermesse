<?php

include_once("Conexion.php");

class DTUsuario extends Conexion
{
    private $myCon;

    public function listarUsuario()
    {
        try 
        {
            $this->myCon = parent::Conectar();
            $result = array();
            $sql = 'SELECT * from tbl_usuario';

            $stm = $this->myCon->prepare($sql);
            $stm->execute();

            foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
            {
                $usuario = new Usuario();
                //SET(CAMPOBD, atributoEntidad)
                $usuario->__SET('id_usuario', $r->id_usuario);
                $usuario->__SET('usuario', $r->usuario);
                $usuario->__SET('pwd', $r->pwd);
                $usuario->__SET('nombres', $r->nombres);
                $usuario->__SET('apellidos', $r->apellidos);
                $usuario->__SET('email', $r->email);
                $usuario->__SET('estado', $r->estado);

                $result[] = $usuario;
            }

            $this->myCon = parent::desconectar();
            return $result;
        } 
        catch (Exception $e) 
        {
            die($e->getMessage());
        }
    }

    public function registrarUsuario(Usuario $data)
    {
        try
        {
            $this->myCon = parent::Conectar();
            $sql = "INSERT INTO tbl_usuario (usuario, pwd, nombres, apellidos, email, estado)
                VALUES(?,?,?,?,?,?)";
            
            $this->myCon->prepare($sql)
            ->execute(array(
                $data->__GET('usuario'),
                $data->__GET('pwd'),
                $data->__GET('nombres'),
                $data->__GET('apellidos'),
                $data->__GET('email'),
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