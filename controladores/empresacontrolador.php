<?php

require_once '../vistas/empresa.php';
require_once '../modelos/empresamodelo.php';

class EmpresaControlador
{
    private $empresaModel;

    public function __construct()
    {
        $this->empresaModel = new EmpresaModelo();
    }

    public function mostrarEmpresas()
    {
        return $this->empresaModel->obtenerEmpresas();
    }

    public function agregarEmpresa($nombre, $web)
    {
        return $this->empresaModel->agregarEmpresa($nombre, $web);
    }

    public function actualizarEmpresa($id_empresa, $nombre_empresa, $web) {
       // var_dump($id_empresa, $nombre_empresa, $web);
        return $this->empresaModel->actualizarEmpresa($id_empresa, $nombre_empresa, $web);
    

    }
    

    public function eliminarEmpresa($id)
    {
        // Verificar si la empresa está asociada a alguna oferta antes de eliminarla
        if ($this->empresaModel->empresaEstaAsociadaAOferta($id)) {
            return "No se puede eliminar esta empresa, está asociada a una oferta.";
        } else {
            return $this->empresaModel->eliminarEmpresa($id);
        }
    }
    public function obtenerEmpresaPorId($id)
    {
        return $this->empresaModel->obtenerEmpresaPorId($id);
    }

}
