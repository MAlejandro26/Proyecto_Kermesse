<?php 

class Usuario
{
    private $id_usuario;
    private $usuario;
    private $pwd;
    private $nombres;
    private $apellidos;
    private $email;
    private $estado;

    public function __GET($k){return $this->$k;}
    public function __SET($k, $v){return $this->$k=$v;}
}