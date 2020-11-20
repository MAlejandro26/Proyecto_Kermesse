<?php 

class Rol_Opcion
{
    private $id_rol_opciones;
    private $tbl_rol_id_rol;
    private $tbl_opciones_id_opciones;

    public function __GET($k){return $this->$k;}
    public function __SET($k, $v){return $this->$k=$v;}
}