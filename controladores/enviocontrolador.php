<?php

require_once '../vistas/envio.php';
require_once '../modelos/envioModelo.php';

class EnvioControlador
{
    private $envioModel;

    public function __construct()
    {
        $this->envioModel = new envioModelo();
    }

    public function mostrarEnvio()
    {
        return $this->envioModel->obtenerEnvio();
    }

    public function agregarEnvio($tipo)
    {
        return $this->envioModel->agregarEnvio($tipo);
    }

    public function actualizarEnvio($id_envio, $tipo)
    {
        // var_dump($id_envio, $tipo, $web);
        return $this->envioModel->actualizarEnvio($id_envio, $tipo);


    }


    public function eliminarEnvio($id)
    {
        // Verificar si la empresa está asociada a alguna oferta antes de eliminarla
        if ($this->envioModel->ofertaAsociadoEnvio($id)) {
            return "No se puede eliminar, dato asociado a una oferta.";
        } else {
            return $this->envioModel->eliminarEnvio($id);
        }
    }
    public function obtenerEnvioPorId($id)
    {
        return $this->envioModel->obtenerEnvioPorId($id);
    }

}
