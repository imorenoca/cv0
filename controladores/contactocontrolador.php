<?php

require_once '../vistas/contacto.php';
require_once '../modelos/contactomodelo.php';

class ContactoControlador{
    private $contactoModelo;

    public function __construct() {
        $this->contactoModelo = new ContactoModelo();
    }

    public function mostrarContactos() {
        return $this->contactoModelo->obtenerContactos();
    }
    public function agregarContacto($nombre,$cargo, $correo,$telefono)
    {
        return $this->contactoModelo->agregarContacto($nombre,$cargo, $correo,$telefono);
    }

    public function actualizarContacto($id,$nombre,$cargo, $correo,$telefono) {
       // var_dump($id,$nombre,$cargo, $correo,$telefono);
        return $this->contactoModelo->actualizarContacto($id,$nombre,$cargo, $correo,$telefono);
    

    }
    

    public function eliminarContacto($id)
    {
        // Verificar si la empresa está asociada a alguna oferta antes de eliminarla
        if ($this->contactoModelo->contactoEstaAsociadaAOferta($id)) {
            return "No se puede eliminar esta empresa, está asociada a una oferta.";
        } else {
            return $this->contactoModelo->eliminarContacto($id);
        }
    }
    public function obtenerContactoPorId($id)
    {
        return $this->contactoModelo->obtenerContactoPorId($id);
    }

}

